<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Langganan;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class LanggananController extends Controller
{
    public function index()
    {
        $langganan = Langganan::all();
        return view('langganan.index', compact('langganan'));
    }

    public function create()
    {
        $pelanggan = \App\Models\Pelanggan::all();
        $produk = \App\Models\ProdukAir::all();
        return view('langganan.create', compact('pelanggan', 'produk'));
    }

    public function store(Request $request)
    {
        $isAdmin = auth()->user() && auth()->user()->role === 'admin';

        if (!$isAdmin) {
            $request->validate([
                'id_produk' => 'required|exists:produk_air,id_produk',
                'jumlah_pesanan' => 'required|integer|min:1',
                'hari_pengantaran' => 'required|array|min:1',
                'hari_pengantaran.*' => 'string|in:Senin,Selasa,Rabu,Kamis,Jumat,Sabtu,Minggu',
                'jam_pengantaran' => 'required|string',
                'durasi_bulan' => 'required|integer|in:1,3,6',
                'no_telepon' => 'required|string|max:20',
                'alamat' => 'required|string',
                'metode_pembayaran' => 'required|in:transfer,tunai,e-wallet',
            ]);

            $pelanggan = \App\Models\Pelanggan::firstOrCreate(
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

            if ($pelanggan->alamat !== $request->alamat || $pelanggan->no_telepon !== $request->no_telepon) {
                $pelanggan->update([
                    'alamat' => $request->alamat,
                    'no_telepon' => $request->no_telepon,
                ]);
            }

            $produk = \App\Models\ProdukAir::findOrFail($request->id_produk);

            if ($produk->stok < $request->jumlah_pesanan) {
                return redirect()->back()->with('error', 'Stok produk tidak mencukupi untuk jumlah pesanan Anda.');
            }

            $durasiBulan = (int)$request->durasi_bulan;
            $weeksCount = 4 * $durasiBulan;
            $hariPengantaranStr = implode(',', $request->hari_pengantaran);

            $dayMap = [
                'Senin' => 'next Monday',
                'Selasa' => 'next Tuesday',
                'Rabu' => 'next Wednesday',
                'Kamis' => 'next Thursday',
                'Jumat' => 'next Friday',
                'Sabtu' => 'next Saturday',
                'Minggu' => 'next Sunday',
            ];

            $deliveryDates = [];
            foreach ($request->hari_pengantaran as $hariIndo) {
                if (isset($dayMap[$hariIndo])) {
                    $dayEnglish = str_replace('next ', '', $dayMap[$hariIndo]);
                    $date = now();
                    if ($date->englishDayOfWeek !== $dayEnglish) {
                        $date = $date->modify($dayMap[$hariIndo]);
                    }
                    
                    for ($i = 0; $i < $weeksCount; $i++) {
                        $deliveryDates[] = $date->copy();
                        $date->addWeek();
                    }
                }
            }

            // Sort all delivery dates chronologically
            usort($deliveryDates, function ($a, $b) {
                return $a->timestamp <=> $b->timestamp;
            });

            $tanggalMulai = now();
            $tanggalBerakhir = count($deliveryDates) > 0 ? end($deliveryDates)->copy() : now()->addMonths($durasiBulan);

            $langganan = Langganan::create([
                'id_pelanggan' => $pelanggan->id_pelanggan,
                'id_produk' => $request->id_produk,
                'periode_pengantaran' => 'mingguan',
                'tanggal_mulai' => $tanggalMulai,
                'tanggal_berakhir' => $tanggalBerakhir,
                'jumlah_pesanan' => $request->jumlah_pesanan,
                'status_langganan' => 'aktif',
                'hari_pengantaran' => $hariPengantaranStr,
                'jam_pengantaran' => $request->jam_pengantaran,
                'durasi_bulan' => $durasiBulan,
            ]);

            DB::transaction(function () use ($langganan, $pelanggan, $produk, $deliveryDates, $request) {
                foreach ($deliveryDates as $index => $date) {
                    $kodeInvoice = 'INV-SUB-' . time() . '-' . rand(100, 999) . '-' . $index;
                    
                    $transaksi = \App\Models\Transaksi::create([
                        'id_pelanggan' => $pelanggan->id_pelanggan,
                        'id_langganan' => $langganan->id_langganan,
                        'tanggal_transaksi' => $date->setTimeFromTimeString($request->jam_pengantaran),
                        'metode_pembayaran' => $request->metode_pembayaran,
                        'total_bayar' => $produk->harga * $request->jumlah_pesanan,
                        'status_transaksi' => $request->metode_pembayaran === 'tunai' ? 'menunggu' : 'dibayar',
                        'kode_invoice' => $kodeInvoice,
                        'catatan' => 'Pesanan Langganan Otomatis (' . $langganan->hari_pengantaran . ' pukul ' . $langganan->jam_pengantaran . ')',
                    ]);

                    \App\Models\DetailPesanan::create([
                        'id_transaksi' => $transaksi->id_transaksi,
                        'id_produk' => $produk->id_produk,
                        'jumlah' => $request->jumlah_pesanan,
                        'harga_satuan' => $produk->harga,
                    ]);

                    $kurir = \App\Models\Kurir::where('status_kurir', 'aktif')->inRandomOrder()->first();

                    \App\Models\Pengiriman::create([
                        'id_transaksi' => $transaksi->id_transaksi,
                        'id_kurir' => $kurir ? $kurir->id_kurir : null,
                        'alamat_tujuan' => $request->alamat,
                        'tanggal_pengiriman' => $date->setTimeFromTimeString($request->jam_pengantaran),
                        'status_pengiriman' => 'dijadwalkan',
                        'catatan_kurir' => null,
                    ]);
                }
            });

            return redirect()->route('dashboard')->with('success', 'Langganan Cerdas berhasil diaktifkan! ' . count($deliveryDates) . ' jadwal pengiriman telah dibuat secara otomatis.');
        }

        $validated = $request->validate([
            'id_pelanggan' => 'required|exists:pelanggan,id_pelanggan',
            'id_produk' => 'required|exists:produk_air,id_produk',
            'periode_pengantaran' => 'required|in:harian,mingguan,bulanan',
            'tanggal_mulai' => 'required|date',
            'tanggal_berakhir' => 'required|date|after_or_equal:tanggal_mulai',
            'jumlah_pesanan' => 'required|integer|min:1',
            'status_langganan' => 'required|in:aktif,berhenti,tertunda',
        ]);

        Langganan::create($validated);

        return redirect()->route('langganan.index')->with('success', 'Langganan berhasil ditambahkan');
    }

    public function show($id)
    {
        $langganan = Langganan::findOrFail($id);
        return view('langganan.show', compact('langganan'));
    }

    public function edit($id)
    {
        $langganan = Langganan::findOrFail($id);
        $pelanggan = \App\Models\Pelanggan::all();
        $produk = \App\Models\ProdukAir::all();
        return view('langganan.edit', compact('langganan', 'pelanggan', 'produk'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'id_pelanggan' => 'required|exists:pelanggan,id_pelanggan',
            'id_produk' => 'required|exists:produk_air,id_produk',
            'periode_pengantaran' => 'required|in:harian,mingguan,bulanan',
            'tanggal_mulai' => 'required|date',
            'tanggal_berakhir' => 'required|date|after_or_equal:tanggal_mulai',
            'jumlah_pesanan' => 'required|integer|min:1',
            'status_langganan' => 'required|in:aktif,berhenti,tertunda',
        ]);

        $langganan = Langganan::findOrFail($id);
        $langganan->update($validated);

        return redirect()->route('langganan.index')->with('success', 'Langganan berhasil diupdate');
    }

    public function destroy($id)
    {
        $langganan = Langganan::findOrFail($id);
        $langganan->delete();

        return redirect()->route('langganan.index')->with('success', 'Langganan berhasil dihapus');
    }
}
