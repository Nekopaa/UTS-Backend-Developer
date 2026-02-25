<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;

class AdminController extends Controller
{
    public function index()
    {
        $admin = Admin::all();
        return view('admin.index', compact('admin'));
    }

    public function create()
    {
        return view('admin.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_admin' => 'required|string|max:255',
            'username' => 'required|string|unique:admins,username',
            'password' => 'required|string|min:6',
            'email' => 'required|email|unique:admins,email',
            'no_hp' => 'required|string',
            'role' => 'required|string',
            'status_admin' => 'required|string',
        ]);

        Admin::create($validated);

        return redirect()->route('admin.index')->with('success', 'Admin berhasil ditambahkan');
    }

    public function show($id)
    {
        $admin = Admin::findOrFail($id);
        return view('admin.show', compact('admin'));
    }

    public function edit($id)
    {
        $admin = Admin::findOrFail($id);
        return view('admin.edit', compact('admin'));
    }

    public function update(Request $request, $id)
    {
        $admin = Admin::findOrFail($id);

        $validated = $request->validate([
            'nama_admin' => 'required|string|max:255',
            'username' => 'required|string|unique:admins,username,' . $id,
            'email' => 'required|email|unique:admins,email,' . $id,
            'no_hp' => 'required|string',
            'role' => 'required|string',
            'status_admin' => 'required|string',
        ]);

        if ($request->filled('password')) {
            $validated['password'] = bcrypt($request->password);
        }

        $admin->update($validated);

        return redirect()->route('admin.index')->with('success', 'Admin berhasil diupdate');
    }

    public function destroy($id)
    {
        $admin = Admin::findOrFail($id);
        $admin->delete();

        return redirect()->route('admin.index')->with('success', 'Admin berhasil dihapus');
    }
}
