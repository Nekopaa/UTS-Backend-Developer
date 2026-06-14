<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi;

class TransaksiController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        if ($user->role === 'admin') {
            $transaksi = Transaksi::latest()->get();
            return view('transaksi.index', compact('transaksi'));
        } else {
            $pelanggan = \App\Models\Pelanggan::where('email', $user->email)->first();
            $transaksi = $pelanggan ? Transaksi::where('id_pelanggan', $pelanggan->id_pelanggan)->latest()->get() : collect();
            return view('transaksi.customer_index', compact('transaksi'));
        }
    }

    public function show($id)
    {
        $transaksi = Transaksi::findOrFail($id);
        $user = auth()->user();
        if ($user->role === 'admin') {
            return view('transaksi.show', compact('transaksi'));
        } else {
            $pelanggan = \App\Models\Pelanggan::where('email', $user->email)->first();
            if (!$pelanggan || $transaksi->id_pelanggan !== $pelanggan->id_pelanggan) {
                abort(403, 'Unauthorized action.');
            }
            return view('transaksi.customer_show', compact('transaksi'));
        }
    }

    public function update(Request $request, $id)
    {
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Unauthorized action.');
        }

        $validated = $request->validate([
            'status_transaksi' => 'required|in:menunggu,dibayar,dikirim,selesai,dibatalkan',
        ]);

        $transaksi = Transaksi::findOrFail($id);
        $oldStatus = $transaksi->status_transaksi;
        
        $transaksi->update($validated);

        if ($validated['status_transaksi'] === 'dibatalkan' && $oldStatus !== 'dibatalkan') {
            $detail = $transaksi->detailPesanan;
            if ($detail && $detail->produk) {
                $detail->produk->increment('stok', $detail->jumlah);
            }
        }

        return redirect()->route('transaksi.index')->with('success', 'Status transaksi berhasil diupdate');
    }
}
