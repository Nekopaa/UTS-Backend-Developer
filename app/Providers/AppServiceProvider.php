<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        \App\Models\ProdukAir::observe(\App\Observers\ProdukAirObserver::class);
        \App\Models\Transaksi::observe(\App\Observers\TransaksiObserver::class);
    }
}
