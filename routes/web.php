<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProdukAirController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PelangganDashboardController;
use App\Http\Controllers\LanggananController;
use App\Http\Controllers\PengirimanController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\GudangController;
use App\Http\Controllers\KurirController;
use App\Http\Controllers\RiwayatStockController;
use App\Http\Controllers\LaporanPenjualanController;
use Illuminate\Support\Facades\Route;

Route::get('/', [WelcomeController::class, 'index']);

// Shared authenticated dashboard route
Route::get('/dashboard', function () {
    if (auth()->user()->role === 'admin') {
        return redirect()->route('admin.dashboard');
    }
    
    $availableProducts = \App\Models\ProdukAir::where('status_produk', 'tersedia')->get();
    $pelanggan = \App\Models\Pelanggan::where('email', auth()->user()->email)->first();
    $myTransactions = $pelanggan ? \App\Models\Transaksi::with(['detailPesanan.produk', 'pengiriman.kurir'])->where('id_pelanggan', $pelanggan->id_pelanggan)->latest()->get() : collect();
    $mySubscriptions = $pelanggan ? \App\Models\Langganan::with(['produk', 'transaksi.pengiriman.kurir', 'transaksi.detailPesanan'])->where('id_pelanggan', $pelanggan->id_pelanggan)->latest()->get() : collect();
    return view('dashboard', compact('availableProducts', 'myTransactions', 'mySubscriptions', 'pelanggan'));
})->middleware(['auth', 'verified'])->name('dashboard');

// Customer / General Authenticated routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // Customer Order and dashboard features
    Route::post('/orders', [OrderController::class, 'store'])->name('orders.store');
    Route::get('/pelanggan/dashboard', [PelangganDashboardController::class, 'index'])->name('pelanggan.dashboard');
    Route::get('/pelanggan/langganan/create', function () {
        return view('pelanggan.create_langganan');
    })->name('pelanggan.langganan.create');
    Route::post('/pelanggan/langganan', [LanggananController::class, 'store'])->name('pelanggan.langganan.store');
    Route::get('/pelanggan/pengiriman', [PengirimanController::class, 'index'])->name('pelanggan.pengiriman');
    
    // Shared Transaksi routes (controlled via policies/role checks in controller)
    Route::resource('transaksi', TransaksiController::class)->only(['index', 'show', 'update']);
});

// Admin-only prefixed routes
Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::resource('users', UserController::class);
    Route::resource('admin', AdminController::class);
    Route::resource('produk-air', ProdukAirController::class);
    Route::resource('pelanggan', PelangganController::class);
    Route::resource('gudang', GudangController::class);
    Route::resource('kurir', KurirController::class);
    Route::resource('riwayat-stock', RiwayatStockController::class);
    Route::resource('laporan-penjualan', LaporanPenjualanController::class);
    Route::resource('langganan', LanggananController::class);
    Route::patch('/pengiriman/{id}/quick-update', [PengirimanController::class, 'quickUpdate'])->name('admin.pengiriman.quick-update');
    Route::resource('pengiriman', PengirimanController::class);
});

require __DIR__.'/auth.php';