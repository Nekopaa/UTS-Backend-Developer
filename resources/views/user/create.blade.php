@extends('layouts.admin')

@section('title', 'Tambah Pengguna Baru')

@section('content')
<div class="max-w-2xl mx-auto">
    <!-- Back Button -->
    <a href="{{ route('users.index') }}" class="inline-flex items-center px-4 py-2 border border-slate-200 rounded-xl bg-white font-bold text-xs text-slate-700 shadow-sm hover:translate-y-[-1px] transition-all mb-6 gap-2">
        Kembali ke Daftar Akun
    </a>

    <!-- Form Container -->
    <div class="neo-brutal-card p-8 bg-white space-y-6">
        <div class="border-b border-slate-100 pb-4">
            <h3 class="text-xl font-extrabold text-slate-850">Formulir Pendaftaran Pengguna Baru</h3>
            <p class="text-xs font-semibold text-slate-500 mt-1">Buat akun pembeli atau admin baru dengan mendaftarkan email aktif.</p>
        </div>

        <form action="{{ route('users.store') }}" method="POST" class="space-y-6">
            @csrf

            <!-- Name -->
            <div class="space-y-2">
                <label for="name" class="block font-bold text-sm text-slate-700 mb-2">Nama Lengkap Pengguna <span class="text-rose-500">*</span></label>
                <input type="text" id="name" name="name" class="neo-brutal-input" value="{{ old('name') }}" required placeholder="Contoh: Rian Hidayat">
                @error('name') <p class="text-xs font-semibold text-rose-500 mt-1">{{ $message }}</p> @enderror
            </div>

            <!-- Email -->
            <div class="space-y-2">
                <label for="email" class="block font-bold text-sm text-slate-700 mb-2">Alamat Email Pengguna <span class="text-rose-500">*</span></label>
                <input type="email" id="email" name="email" class="neo-brutal-input" value="{{ old('email') }}" required placeholder="Contoh: rian@example.com">
                @error('email') <p class="text-xs font-semibold text-rose-500 mt-1">{{ $message }}</p> @enderror
            </div>

            <!-- Passwords -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-2">
                    <label for="password" class="block font-bold text-sm text-slate-700 mb-2">Password Pengguna <span class="text-rose-500">*</span></label>
                    <input type="password" id="password" name="password" class="neo-brutal-input" required placeholder="Minimal 6 karakter">
                    @error('password') <p class="text-xs font-semibold text-rose-500 mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="space-y-2">
                    <label for="password_confirmation" class="block font-bold text-sm text-slate-700 mb-2">Konfirmasi Password <span class="text-rose-500">*</span></label>
                    <input type="password" id="password_confirmation" name="password_confirmation" class="neo-brutal-input" required placeholder="Tulis ulang password">
                </div>
            </div>

            <!-- Submit -->
            <button type="submit" class="w-full py-3.5 bg-gradient-to-tr from-emerald-500 to-emerald-400 text-white rounded-xl font-bold text-sm shadow-md shadow-emerald-500/15 hover:scale-102 active:scale-98 transition-all">
                Daftarkan Akun Pengguna
            </button>
        </form>
    </div>
</div>
@endsection
