<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kurir;

class KurirController extends Controller
{
    public function index()
    {
        $kurir = Kurir::all();
        return view('kurir.index', compact('kurir'));
    }

    public function create()
    {
        return view('kurir.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_kurir' => 'required|string|max:255',
            'no_hp' => 'required|string',
            'alamat' => 'required|string',
            'status_kurir' => 'required|string',
            'kendaraan' => 'required|string',
            'plat_nomor' => 'required|string',
            'catatan' => 'nullable|string',
        ]);

        Kurir::create($validated);

        return redirect()->route('kurir.index')->with('success', 'Kurir berhasil ditambahkan');
    }

    public function show($id)
    {
        $kurir = Kurir::findOrFail($id);
        return view('kurir.show', compact('kurir'));
    }

    public function edit($id)
    {
        $kurir = Kurir::findOrFail($id);
        return view('kurir.edit', compact('kurir'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nama_kurir' => 'required|string|max:255',
            'no_hp' => 'required|string',
            'alamat' => 'required|string',
            'status_kurir' => 'required|string',
            'kendaraan' => 'required|string',
            'plat_nomor' => 'required|string',
            'catatan' => 'nullable|string',
        ]);

        $kurir = Kurir::findOrFail($id);
        $kurir->update($validated);

        return redirect()->route('kurir.index')->with('success', 'Kurir berhasil diupdate');
    }

    public function destroy($id)
    {
        $kurir = Kurir::findOrFail($id);
        $kurir->delete();

        return redirect()->route('kurir.index')->with('success', 'Kurir berhasil dihapus');
    }
}
