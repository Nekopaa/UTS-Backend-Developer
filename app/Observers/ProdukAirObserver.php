<?php

namespace App\Observers;

use App\Models\ProdukAir;

class ProdukAirObserver
{
    /**
     * Handle the ProdukAir "created" event.
     */
    public function created(ProdukAir $produkAir): void
    {
        //
    }

    /**
     * Handle the ProdukAir "updated" event.
     */
    public function updated(ProdukAir $produkAir): void
    {
        if ($produkAir->wasChanged('stok')) {
            $oldStok = $produkAir->getOriginal('stok');
            $newStok = $produkAir->stok;
            $selisih = $newStok - $oldStok;
            
            if ($selisih != 0) {
                \App\Models\RiwayatStock::create([
                    'id_produk' => $produkAir->id_produk,
                    'tanggal_perubahan' => now(),
                    'jenis_perubahan' => $selisih > 0 ? 'masuk' : 'keluar',
                    'jumlah' => abs($selisih),
                    'keterangan' => $selisih > 0 ? 'Penambahan/Pengembalian stok' : 'Penjualan/Pengurangan stok'
                ]);

                if ($selisih < 0) {
                    $this->deductFromGudang(abs($selisih));
                }
            }
        }
    }

    private function deductFromGudang(int $amountToDeduct): void
    {
        \Illuminate\Support\Facades\DB::transaction(function () use ($amountToDeduct) {
            $gudangs = \App\Models\Gudang::where('status_gudang', 'aktif')
                ->where('stok_saat_ini', '>', 0)
                ->orderBy('stok_saat_ini', 'desc')
                ->lockForUpdate()
                ->get();

            foreach ($gudangs as $gudang) {
                if ($amountToDeduct <= 0) break;

                if ($gudang->stok_saat_ini >= $amountToDeduct) {
                    $gudang->decrement('stok_saat_ini', $amountToDeduct);
                    $amountToDeduct = 0;
                } else {
                    $available = $gudang->stok_saat_ini;
                    $gudang->decrement('stok_saat_ini', $available);
                    $amountToDeduct -= $available;
                }
            }
        });
    }

    /**
     * Handle the ProdukAir "deleted" event.
     */
    public function deleted(ProdukAir $produkAir): void
    {
        //
    }

    /**
     * Handle the ProdukAir "restored" event.
     */
    public function restored(ProdukAir $produkAir): void
    {
        //
    }

    /**
     * Handle the ProdukAir "force deleted" event.
     */
    public function forceDeleted(ProdukAir $produkAir): void
    {
        //
    }
}
