<?php

use Illuminate\Support\Facades\Route;

// --- Import semua Controller ---
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProdukAirController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\GudangController;
use App\Http\Controllers\KurirController;
use App\Http\Controllers\LanggananController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\PengirimanController;
use App\Http\Controllers\RiwayatStockController;
use App\Http\Controllers\LaporanPenjualanController;
use App\Http\Controllers\DetailPesananController;

// --- Halaman Utama ---
Route::get('/', function () {
    return view('welcome');
});

// --- CRUD Lengkap (7 route otomatis) ---
Route::resource('user', UserController::class);
Route::resource('admin', AdminController::class);
Route::resource('produk-air', ProdukAirController::class);
Route::resource('pelanggan', PelangganController::class);
Route::resource('gudang', GudangController::class);
Route::resource('kurir', KurirController::class);
Route::resource('langganan', LanggananController::class);

// --- Parsial: hanya aksi tertentu ---
// Transaksi: hanya bisa dibaca dan diupdate statusnya
Route::resource('transaksi', TransaksiController::class)->only(['index', 'show', 'update']);

// Pengiriman: hanya bisa dilihat dan diupdate statusnya
Route::resource('pengiriman', PengirimanController::class)->only(['index', 'show', 'update']);

// --- Read-Only: hanya bisa dilihat ---
// Laporan dan Riwayat Stock tidak boleh diubah manual
Route::resource('laporan-penjualan', LaporanPenjualanController::class)->only(['index', 'show']);
Route::resource('riwayat-stock', RiwayatStockController::class)->only(['index', 'show']);

// Detail Pesanan: dikelola otomatis lewat Transaksi
Route::resource('detail-pesanan', DetailPesananController::class)->only(['index', 'show']);
