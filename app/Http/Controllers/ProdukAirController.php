<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProdukAir;
use Illuminate\Support\Facades\Storage;

class ProdukAirController extends Controller
{
    public function index()
    {
        $produk = ProdukAir::all();
        return view('produk_air.index', compact('produk'));
    }

    public function create()
    {
        return view('produk_air.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_produk' => 'required|string|max:255',
            'jenis_kemasan' => 'required|string',
            'kapasitas' => 'required|string',
            'harga' => 'required|numeric',
            'stok' => 'required|integer',
            'status_produk' => 'required|string',
            'foto_produk' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'deskripsi' => 'nullable|string',
        ]);

        if ($request->hasFile('foto_produk')) {
            $path = $request->file('foto_produk')->store('produk', 'public');
            $validated['foto_produk'] = $path;
        }

        ProdukAir::create($validated);

        return redirect()->route('produk-air.index')->with('success', 'Produk berhasil ditambahkan');
    }

    public function show($id)
    {
        $produk = ProdukAir::findOrFail($id);
        return view('produk_air.show', compact('produk'));
    }

    public function edit($id)
    {
        $produk = ProdukAir::findOrFail($id);
        return view('produk_air.edit', compact('produk'));
    }

    public function update(Request $request, $id)
    {
        $produk = ProdukAir::findOrFail($id);

        $validated = $request->validate([
            'nama_produk' => 'required|string|max:255',
            'jenis_kemasan' => 'required|string',
            'kapasitas' => 'required|string',
            'harga' => 'required|numeric',
            'stok' => 'required|integer',
            'status_produk' => 'required|string',
            'foto_produk' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'deskripsi' => 'nullable|string',
        ]);

        if ($request->hasFile('foto_produk')) {
            if ($produk->foto_produk) {
                Storage::disk('public')->delete($produk->foto_produk);
            }
            $path = $request->file('foto_produk')->store('produk', 'public');
            $validated['foto_produk'] = $path;
        }

        $produk->update($validated);

        return redirect()->route('produk-air.index')->with('success', 'Produk berhasil diupdate');
    }

    public function destroy($id)
    {
        $produk = ProdukAir::findOrFail($id);
        if ($produk->foto_produk) {
            Storage::disk('public')->delete($produk->foto_produk);
        }
        $produk->delete();

        return redirect()->route('produk-air.index')->with('success', 'Produk berhasil dihapus');
    }
}
