<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Gudang;

class GudangController extends Controller
{
    public function index()
    {
        $gudang = Gudang::all();
        return view('gudang.index', compact('gudang'));
    }

    public function create()
    {
        return view('gudang.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_gudang' => 'required|string|max:255',
            'lokasi' => 'required|string',
            'kapasitas_total' => 'required|integer',
            'stok_saat_ini' => 'required|integer',
            'status_gudang' => 'required|string',
        ]);

        Gudang::create($validated);

        return redirect()->route('gudang.index')->with('success', 'Gudang berhasil ditambahkan');
    }

    public function show($id)
    {
        $gudang = Gudang::findOrFail($id);
        return view('gudang.show', compact('gudang'));
    }

    public function edit($id)
    {
        $gudang = Gudang::findOrFail($id);
        return view('gudang.edit', compact('gudang'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nama_gudang' => 'required|string|max:255',
            'lokasi' => 'required|string',
            'kapasitas_total' => 'required|integer',
            'stok_saat_ini' => 'required|integer',
            'status_gudang' => 'required|string',
        ]);

        $gudang = Gudang::findOrFail($id);
        $gudang->update($validated);

        return redirect()->route('gudang.index')->with('success', 'Gudang berhasil diupdate');
    }

    public function destroy($id)
    {
        $gudang = Gudang::findOrFail($id);
        $gudang->delete();

        return redirect()->route('gudang.index')->with('success', 'Gudang berhasil dihapus');
    }
}
