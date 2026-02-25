<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengiriman;

class PengirimanController extends Controller
{
    public function index()
    {
        $pengiriman = Pengiriman::all();
        return view('pengiriman.index', compact('pengiriman'));
    }

    public function show($id)
    {
        $pengiriman = Pengiriman::findOrFail($id);
        return view('pengiriman.show', compact('pengiriman'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'status_pengiriman' => 'required|string',
            'catatan_kurir' => 'nullable|string',
        ]);

        $pengiriman = Pengiriman::findOrFail($id);
        $pengiriman->update($validated);

        return redirect()->route('pengiriman.index')->with('success', 'Status pengiriman berhasil diupdate');
    }
}
