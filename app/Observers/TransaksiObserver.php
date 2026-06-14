<?php

namespace App\Observers;

use App\Models\Transaksi;

class TransaksiObserver
{
    /**
     * Handle the Transaksi "created" event.
     */
    public function created(Transaksi $transaksi): void
    {
        //
    }

    /**
     * Handle the Transaksi "updated" event.
     */
    public function updated(Transaksi $transaksi): void
    {
        if ($transaksi->wasChanged('status_transaksi') && $transaksi->status_transaksi === 'selesai') {
            $transaksis = \App\Models\Transaksi::where('status_transaksi', 'selesai')->get();

            $totalTransaksi = $transaksis->count();
            $totalPendapatan = $transaksis->sum('total_bayar');

            \App\Models\LaporanPenjualan::updateOrCreate(
                ['periode_laporan' => 'bulanan'],
                [
                    'total_transaksi' => $totalTransaksi,
                    'total_pendapatan' => $totalPendapatan,
                    'produk_terlaris' => 'Air Mineral', // Default sementara
                    'tanggal_dibuat' => now(),
                ]
            );
        }
    }

    /**
     * Handle the Transaksi "deleted" event.
     */
    public function deleted(Transaksi $transaksi): void
    {
        //
    }

    /**
     * Handle the Transaksi "restored" event.
     */
    public function restored(Transaksi $transaksi): void
    {
        //
    }

    /**
     * Handle the Transaksi "force deleted" event.
     */
    public function forceDeleted(Transaksi $transaksi): void
    {
        //
    }
}
