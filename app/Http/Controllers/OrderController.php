<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pelanggan;
use App\Models\ProdukAir;
use App\Models\Transaksi;
use App\Models\DetailPesanan;
use App\Models\Langganan;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    /**
     * Store a newly created order (transaksi + detail_pesanan) in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_produk' => 'required|exists:produk_air,id_produk',
            'jumlah' => 'required|integer|min:1',
            'metode_pembayaran' => 'required|in:transfer,tunai,e-wallet',
            'no_telepon' => 'required|string|max:20',
            'alamat' => 'required|string',
            'catatan' => 'nullable|string',
            'metode_pengiriman' => 'required|string|in:standart,sameday,instant,kilat',
            'berlangganan' => 'nullable|in:sekali,harian,mingguan,bulanan',
            'tanggal_mulai' => 'nullable|date',
        ]);

        try {
            DB::beginTransaction();

            $produk = ProdukAir::where('id_produk', $request->id_produk)->lockForUpdate()->firstOrFail();

            if ($produk->stok < $request->jumlah) {
                DB::rollBack();
                return redirect()->back()->with('error', 'Stok produk tidak mencukupi untuk jumlah pesanan Anda.');
            }

            // Get or create Pelanggan profile for the logged in user
            $pelanggan = Pelanggan::firstOrCreate(
                ['email' => auth()->user()->email],
                [
                    'nama_pelanggan' => auth()->user()->name,
                    'penanggung_jawab' => auth()->user()->name,
                    'jenis_pelanggan' => 'individu',
                    'alamat' => $request->alamat,
                    'no_telepon' => $request->no_telepon,
                    'status_pelanggan' => 'aktif',
                    'tanggal_daftar' => now(),
                ]
            );

            // Update details if they have changed
            if ($pelanggan->alamat !== $request->alamat || $pelanggan->no_telepon !== $request->no_telepon) {
                $pelanggan->update([
                    'alamat' => $request->alamat,
                    'no_telepon' => $request->no_telepon,
                ]);
            }

            // Calculate shipping cost
            $biayaPengiriman = 0;
            if ($request->metode_pengiriman === 'standart') {
                $biayaPengiriman = 5000;
            } elseif ($request->metode_pengiriman === 'sameday') {
                $biayaPengiriman = 15000;
            } elseif ($request->metode_pengiriman === 'instant' || $request->metode_pengiriman === 'kilat') {
                $biayaPengiriman = 25000;
            }

            $totalBayar = ($produk->harga * $request->jumlah) + $biayaPengiriman;
            $kodeInvoice = 'INV-' . time() . '-' . rand(100, 999);

            // Create Transaksi
            $transaksi = Transaksi::create([
                'id_pelanggan' => $pelanggan->id_pelanggan,
                'id_langganan' => null,
                'tanggal_transaksi' => now(),
                'metode_pembayaran' => $request->metode_pembayaran,
                'total_bayar' => $totalBayar,
                'status_transaksi' => 'dibayar', // Auto-approve payment in mock flow
                'kode_invoice' => $kodeInvoice,
                'catatan' => $request->catatan,
                'metode_pengiriman' => $request->metode_pengiriman,
                'biaya_pengiriman' => $biayaPengiriman,
            ]);

            // Create DetailPesanan
            DetailPesanan::create([
                'id_transaksi' => $transaksi->id_transaksi,
                'id_produk' => $produk->id_produk,
                'jumlah' => $request->jumlah,
                'harga_satuan' => $produk->harga,
            ]);

            // Adjust Product Stock
            $produk->decrement('stok', $request->jumlah);

            // Assign courier automatically
            $kurir = \App\Models\Kurir::where('status_kurir', 'aktif')->inRandomOrder()->first();

            // Set delivery date based on shipping method rules
            $tanggalPengiriman = now();
            if ($request->metode_pengiriman === 'standart') {
                $tanggalPengiriman = now()->addDays(1);
            } elseif ($request->metode_pengiriman === 'sameday') {
                if (now()->hour >= 8) {
                    $tanggalPengiriman = now()->addDay();
                }
            } elseif ($request->metode_pengiriman === 'instant' || $request->metode_pengiriman === 'kilat') {
                $tanggalPengiriman = now()->addHours(3);
            }

            \App\Models\Pengiriman::create([
                'id_transaksi' => $transaksi->id_transaksi,
                'id_kurir' => $kurir ? $kurir->id_kurir : null,
                'alamat_tujuan' => $request->alamat,
                'tanggal_pengiriman' => $tanggalPengiriman,
                'status_pengiriman' => 'dijadwalkan',
                'catatan_kurir' => null,
            ]);

            // Handle optional Langganan (Subscription)
            if ($request->has('berlangganan') && in_array($request->berlangganan, ['harian', 'mingguan', 'bulanan'])) {
                $tanggalMulai = $request->input('tanggal_mulai') ? \Carbon\Carbon::parse($request->input('tanggal_mulai')) : now();
                
                // Calculate ending date based on subscription cycle
                if ($request->berlangganan === 'mingguan') {
                    $tanggalBerakhir = $tanggalMulai->copy()->addMonth(); // 1 month duration (4 deliveries)
                } elseif ($request->berlangganan === 'bulanan') {
                    $tanggalBerakhir = $tanggalMulai->copy()->addYear(); // 1 year duration (12 deliveries)
                } else { // harian
                    $tanggalBerakhir = $tanggalMulai->copy()->addDays(30); // 30 days duration (30 deliveries)
                }

                $langganan = Langganan::create([
                    'id_pelanggan' => $pelanggan->id_pelanggan,
                    'id_produk' => $produk->id_produk,
                    'periode_pengantaran' => $request->berlangganan,
                    'tanggal_mulai' => $tanggalMulai,
                    'tanggal_berakhir' => $tanggalBerakhir,
                    'jumlah_pesanan' => $request->jumlah,
                    'status_langganan' => 'aktif',
                ]);

                // Link the transaksi to this subscription
                $transaksi->update(['id_langganan' => $langganan->id_langganan]);
            }

            DB::commit();

            return redirect()->route('dashboard')->with('success', 'Pesanan Anda dengan Invoice ' . $kodeInvoice . ' berhasil ditempatkan!');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Terjadi kesalahan saat memproses pesanan Anda: ' . $e->getMessage());
        }
    }
}
