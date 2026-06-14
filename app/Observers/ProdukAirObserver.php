<?php

namespace App\Observers;

use App\Models\ProdukAir;
use App\Models\Gudang;
use Illuminate\Support\Facades\DB;

class ProdukAirObserver
{
    /**
     * Handle the ProdukAir "updated" event.
     *
     * @param  \App\Models\ProdukAir  $produkAir
     * @return void
     */
    public function updated(ProdukAir $produkAir)
    {
        if ($produkAir->wasChanged('stok')) {
            $originalStok = $produkAir->getOriginal('stok');
            $currentStok = $produkAir->stok;

            if ($currentStok < $originalStok) {
                $deductionAmount = $originalStok - $currentStok;
                $this->deductFromGudang($deductionAmount);
            }
        }
    }

    /**
     * Deduct the specified amount from Gudang models.
     *
     * @param int $amount
     * @return void
     */
    private function deductFromGudang(int $amount)
    {
        DB::transaction(function () use ($amount) {
            $remainingDeduction = $amount;

            // Fetch Gudangs ordered by stok_saat_ini descending
            $gudangs = Gudang::where('stok_saat_ini', '>', 0)
                            ->orderBy('stok_saat_ini', 'desc')
                            ->lockForUpdate()
                            ->get();

            foreach ($gudangs as $gudang) {
                if ($remainingDeduction <= 0) {
                    break;
                }

                $availableStock = $gudang->stok_saat_ini;

                if ($availableStock >= $remainingDeduction) {
                    $gudang->stok_saat_ini -= $remainingDeduction;
                    $gudang->save();
                    $remainingDeduction = 0;
                } else {
                    $remainingDeduction -= $availableStock;
                    $gudang->stok_saat_ini = 0;
                    $gudang->save();
                }
            }
        });
    }
}

