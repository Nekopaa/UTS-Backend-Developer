@extends('layouts.admin')

@section('title', 'Tambah Staff Baru')

@section('content')
<div class="max-w-2xl mx-auto">
    <!-- Back Button -->
    <a href="{{ route('admin.index') }}" class="inline-flex items-center px-4 py-2 bg-white text-slate-700 font-bold text-xs rounded-xl border border-slate-200 shadow-sm hover:bg-slate-50 transition-all mb-6 gap-2">
        Kembali ke Daftar Staff
    </a>

    <!-- Form Container -->
    <div class="neo-brutal-card p-8 bg-white space-y-6">
        <div class="border-b border-slate-100 pb-4">
            <h3 class="text-xl font-bold text-slate-800">Formulir Pendaftaran Staff Baru</h3>
            <p class="text-xs font-semibold text-slate-500 mt-1">Buat akun administrative baru untuk mengelola operasional Rindu Water.</p>
        </div>

        <form action="{{ route('admin.store') }}" method="POST" class="space-y-6">
            @csrf

            <!-- Name -->
            <div class="space-y-2">
                <label for="nama_admin" class="block font-bold text-sm text-slate-700">Nama Lengkap Staff <span class="text-rose-500">*</span></label>
                <input type="text" id="nama_admin" name="nama_admin" class="neo-brutal-input" value="{{ old('nama_admin') }}" required placeholder="Contoh: Heri Darmawan">
                @error('nama_admin') <p class="text-xs font-bold text-rose-500 mt-1">{{ $message }}</p> @enderror
            </div>

            <!-- Username & Email -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-2">
                    <label for="username" class="block font-bold text-sm text-slate-700">Username Akun <span class="text-rose-500">*</span></label>
                    <input type="text" id="username" name="username" class="neo-brutal-input" value="{{ old('username') }}" required placeholder="Contoh: heri_staff">
                    @error('username') <p class="text-xs font-bold text-rose-500 mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="space-y-2">
                    <label for="email" class="block font-bold text-sm text-slate-700">Alamat Email <span class="text-rose-500">*</span></label>
                    <input type="email" id="email" name="email" class="neo-brutal-input" value="{{ old('email') }}" required placeholder="Contoh: heri@rinduwater.com">
                    @error('email') <p class="text-xs font-bold text-rose-500 mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

            <!-- Password & HP -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-2">
                    <label for="password" class="block font-bold text-sm text-slate-700">Password Akun <span class="text-rose-500">*</span></label>
                    <input type="password" id="password" name="password" class="neo-brutal-input" required placeholder="Minimal 6 karakter">
                    @error('password') <p class="text-xs font-bold text-rose-500 mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="space-y-2">
                    <label for="no_hp" class="block font-bold text-sm text-slate-700">Nomor HP / WhatsApp <span class="text-rose-500">*</span></label>
                    <input type="text" id="no_hp" name="no_hp" class="neo-brutal-input" value="{{ old('no_hp') }}" required placeholder="Contoh: 08123456789">
                    @error('no_hp') <p class="text-xs font-bold text-rose-500 mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

            <!-- Role & Status -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-2">
                    <label for="role" class="block font-bold text-sm text-slate-700">Peran Staff (Role) <span class="text-rose-500">*</span></label>
                    <select id="role" name="role" class="neo-brutal-input" required>
                        <option value="staff" {{ old('role') === 'staff' ? 'selected' : '' }}>Staff Operator</option>
                        <option value="super admin" {{ old('role') === 'super admin' ? 'selected' : '' }}>Super Admin</option>
                    </select>
                    @error('role') <p class="text-xs font-bold text-rose-500 mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="space-y-2">
                    <label for="status_admin" class="block font-bold text-sm text-slate-700">Status Keaktifan <span class="text-rose-500">*</span></label>
                    <select id="status_admin" name="status_admin" class="neo-brutal-input" required>
                        <option value="aktif" {{ old('status_admin') === 'aktif' ? 'selected' : '' }}>Aktif</option>
                        <option value="nonaktif" {{ old('status_admin') === 'nonaktif' ? 'selected' : '' }}>Nonaktif (Suspend)</option>
                    </select>
                    @error('status_admin') <p class="text-xs font-bold text-rose-500 mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

            <!-- Submit -->
            <button type="submit" class="w-full py-4 bg-gradient-to-tr from-emerald-600 to-teal-600 hover:from-emerald-700 hover:to-teal-700 text-white font-bold text-sm rounded-xl shadow-sm transition-all">
                Daftarkan Staff Baru
            </button>
        </form>
    </div>
</div>
@endsection

