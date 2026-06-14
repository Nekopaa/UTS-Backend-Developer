<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kurir;
use Illuminate\Validation\Rule;

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
            'no_hp' => [
                'required',
                'string',
                Rule::unique('kurir')->whereNull('deleted_at'),
            ],
            'alamat' => 'required|string',
            'status_kurir' => 'required|string',
            'kendaraan' => 'required|string',
            'plat_nomor' => [
                'required',
                'string',
                Rule::unique('kurir')->whereNull('deleted_at'),
            ],
            'catatan' => 'nullable|string',
        ], [
            'no_hp.unique' => 'Nomor HP sudah terdaftar untuk kurir lain.',
            'plat_nomor.unique' => 'Plat nomor kendaraan sudah terdaftar untuk kurir lain.',
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
            'no_hp' => [
                'required',
                'string',
                Rule::unique('kurir')->ignore($id, 'id_kurir')->whereNull('deleted_at'),
            ],
            'alamat' => 'required|string',
            'status_kurir' => 'required|string',
            'kendaraan' => 'required|string',
            'plat_nomor' => [
                'required',
                'string',
                Rule::unique('kurir')->ignore($id, 'id_kurir')->whereNull('deleted_at'),
            ],
            'catatan' => 'nullable|string',
        ], [
            'no_hp.unique' => 'Nomor HP sudah terdaftar untuk kurir lain.',
            'plat_nomor.unique' => 'Plat nomor kendaraan sudah terdaftar untuk kurir lain.',
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
