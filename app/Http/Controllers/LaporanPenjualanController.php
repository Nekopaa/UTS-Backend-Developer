<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LaporanPenjualan;

class LaporanPenjualanController extends Controller
{
    public function index()
    {
        $laporan = LaporanPenjualan::all();
        return view('laporan_penjualan.index', compact('laporan'));
    }

    public function show($id)
    {
        $laporan = LaporanPenjualan::findOrFail($id);
        return view('laporan_penjualan.show', compact('laporan'));
    }
}
