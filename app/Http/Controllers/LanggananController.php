<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Langganan;

class LanggananController extends Controller
{
    public function index()
    {
        $langganan = Langganan::all();
        return view('langganan.index', compact('langganan'));
    }

    public function create()
    {
        return view('langganan.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'periode_pengantaran' => 'required|string',
            'tanggal_mulai' => 'required|date',
            'tanggal_berakhir' => 'required|date',
            'jumlah_pesanan' => 'required|integer',
            'status_langganan' => 'required|string',
        ]);

        Langganan::create($validated);

        return redirect()->route('langganan.index')->with('success', 'Langganan berhasil ditambahkan');
    }

    public function show($id)
    {
        $langganan = Langganan::findOrFail($id);
        return view('langganan.show', compact('langganan'));
    }

    public function edit($id)
    {
        $langganan = Langganan::findOrFail($id);
        return view('langganan.edit', compact('langganan'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'periode_pengantaran' => 'required|string',
            'tanggal_mulai' => 'required|date',
            'tanggal_berakhir' => 'required|date',
            'jumlah_pesanan' => 'required|integer',
            'status_langganan' => 'required|string',
        ]);

        $langganan = Langganan::findOrFail($id);
        $langganan->update($validated);

        return redirect()->route('langganan.index')->with('success', 'Langganan berhasil diupdate');
    }

    public function destroy($id)
    {
        $langganan = Langganan::findOrFail($id);
        $langganan->delete();

        return redirect()->route('langganan.index')->with('success', 'Langganan berhasil dihapus');
    }
}
