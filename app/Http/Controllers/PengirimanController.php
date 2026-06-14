<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengiriman;

class PengirimanController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        if ($user->role === 'admin') {
            $pengiriman = Pengiriman::with(['transaksi', 'kurir'])
                ->orderBy('tanggal_pengiriman', 'desc')
                ->get();
            return view('pengiriman.index', compact('pengiriman'));
        } else {
            $pelanggan = \App\Models\Pelanggan::where('email', $user->email)->first();
            if ($pelanggan) {
                $transactionIds = \App\Models\Transaksi::where('id_pelanggan', $pelanggan->id_pelanggan)->pluck('id_transaksi');
                $pengiriman = Pengiriman::with(['transaksi', 'kurir'])
                    ->whereIn('id_transaksi', $transactionIds)
                    ->latest()
                    ->get();
            } else {
                $pengiriman = collect();
            }
            return view('pelanggan.pengiriman_index', compact('pengiriman'));
        }
    }

    public function show($id)
    {
        $pengiriman = Pengiriman::findOrFail($id);
        $user = auth()->user();
        if ($user->role === 'admin') {
            return view('pengiriman.show', compact('pengiriman'));
        } else {
            $pelanggan = \App\Models\Pelanggan::where('email', $user->email)->first();
            if (!$pelanggan || $pengiriman->transaksi->id_pelanggan !== $pelanggan->id_pelanggan) {
                abort(403, 'Unauthorized action.');
            }
            return redirect()->route('transaksi.show', $pengiriman->id_transaksi);
        }
    }

    public function update(Request $request, $id)
    {
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Unauthorized action.');
        }

        $validated = $request->validate([
            'status_pengiriman' => 'required|string|in:dijadwalkan,dalam perjalanan,terkirim,gagal',
            'catatan_kurir' => 'nullable|string',
        ]);

        $pengiriman = Pengiriman::findOrFail($id);
        $oldStatus = $pengiriman->status_pengiriman;
        
        // If changing to 'dalam perjalanan' for a subscription, deduct stock
        if (isset($validated['status_pengiriman']) && $validated['status_pengiriman'] === 'dalam perjalanan' && $oldStatus !== 'dalam perjalanan') {
            if ($pengiriman->transaksi && $pengiriman->transaksi->id_langganan) {
                $detail = $pengiriman->transaksi->detailPesanan;
                if ($detail) {
                    $produk = \App\Models\ProdukAir::find($detail->id_produk);
                    if ($produk) {
                        if ($produk->stok < $detail->jumlah) {
                            return redirect()->back()->with('error', 'Stok tidak mencukupi untuk memproses pengiriman langganan ini.');
                        }
                        $produk->decrement('stok', $detail->jumlah);
                    }
                }
            }
        }

        $pengiriman->update($validated);

        return redirect()->route('pengiriman.index')->with('success', 'Status pengiriman berhasil diupdate');
    }

    public function quickUpdate(Request $request, $id)
    {
        if (auth()->user()->role !== 'admin') {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $pengiriman = Pengiriman::findOrFail($id);

        $validated = $request->validate([
            'status_pengiriman' => 'nullable|string|in:dijadwalkan,dalam perjalanan,terkirim,gagal',
            'id_kurir' => 'nullable|integer|exists:kurir,id_kurir',
        ]);

        $oldStatus = $pengiriman->status_pengiriman;
        
        if (isset($validated['status_pengiriman']) && $validated['status_pengiriman'] === 'dalam perjalanan' && $oldStatus !== 'dalam perjalanan') {
            if ($pengiriman->transaksi && $pengiriman->transaksi->id_langganan) {
                $detail = $pengiriman->transaksi->detailPesanan;
                if ($detail) {
                    $produk = \App\Models\ProdukAir::find($detail->id_produk);
                    if ($produk) {
                        if ($produk->stok < $detail->jumlah) {
                            return response()->json(['error' => 'Stok tidak mencukupi untuk memproses pengiriman langganan ini.'], 400);
                        }
                        $produk->decrement('stok', $detail->jumlah);
                    }
                }
            }
        }

        $pengiriman->update($validated);

        if (isset($validated['status_pengiriman']) && $validated['status_pengiriman'] === 'terkirim') {
            $pengiriman->transaksi->update(['status_transaksi' => 'selesai']);
        }

        return response()->json([
            'success' => true,
            'message' => 'Status pengiriman berhasil diperbarui',
            'pengiriman' => $pengiriman->load('kurir')
        ]);
    }
}
