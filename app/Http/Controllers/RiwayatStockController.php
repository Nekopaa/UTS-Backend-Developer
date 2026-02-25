<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RiwayatStock;

class RiwayatStockController extends Controller
{
    public function index()
    {
        $riwayat = RiwayatStock::all();
        return view('riwayat_stock.index', compact('riwayat'));
    }

    public function show($id)
    {
        $riwayat = RiwayatStock::findOrFail($id);
        return view('riwayat_stock.show', compact('riwayat'));
    }
}
