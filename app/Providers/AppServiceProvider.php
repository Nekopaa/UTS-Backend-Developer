<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\ProdukAir;
use App\Observers\ProdukAirObserver;

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
        ProdukAir::observe(ProdukAirObserver::class);
    }
}
