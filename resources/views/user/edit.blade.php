@extends('layouts.admin')

@section('title', 'Edit Akun Pengguna')

@section('content')
<div class="max-w-2xl mx-auto">
    <!-- Back Button -->
    <a href="{{ route('users.index') }}" class="inline-flex items-center px-4 py-2 border border-slate-200 rounded-xl bg-white font-bold text-xs text-slate-700 shadow-sm hover:translate-y-[-1px] transition-all mb-6 gap-2">
        Kembali ke Daftar Akun
    </a>

    <!-- Form Container -->
    <div class="neo-brutal-card p-8 bg-white space-y-6">
        <div class="border-b border-slate-100 pb-4">
            <h3 class="text-xl font-extrabold text-slate-850">Formulir Edit Akun Pengguna</h3>
            <p class="text-xs font-semibold text-slate-500 mt-1">Ubah informasi nama, email, atau password pengguna.</p>
        </div>

        <form action="{{ route('users.update', $user->id) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <!-- Name -->
            <div class="space-y-2">
                <label for="name" class="block font-bold text-sm text-slate-700 mb-2">Nama Lengkap Pengguna <span class="text-rose-500">*</span></label>
                <input type="text" id="name" name="name" class="neo-brutal-input" value="{{ old('name', $user->name) }}" required placeholder="Contoh: Rian Hidayat">
                @error('name') <p class="text-xs font-semibold text-rose-500 mt-1">{{ $message }}</p> @enderror
            </div>

            <!-- Email -->
            <div class="space-y-2">
                <label for="email" class="block font-bold text-sm text-slate-700 mb-2">Alamat Email Pengguna <span class="text-rose-500">*</span></label>
                <input type="email" id="email" name="email" class="neo-brutal-input" value="{{ old('email', $user->email) }}" required placeholder="Contoh: rian@example.com">
                @error('email') <p class="text-xs font-semibold text-rose-500 mt-1">{{ $message }}</p> @enderror
            </div>

            <!-- Passwords (Optional) -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-2">
                    <label for="password" class="block font-bold text-sm text-slate-700 mb-2">Ubah Password</label>
                    <input type="password" id="password" name="password" class="neo-brutal-input" placeholder="Isi hanya jika ingin mengganti">
                    <p class="text-[9px] font-bold text-slate-405">Biarkan kosong jika tidak ingin diubah</p>
                    @error('password') <p class="text-xs font-semibold text-rose-500 mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="space-y-2">
                    <label for="password_confirmation" class="block font-bold text-sm text-slate-700 mb-2">Konfirmasi Password Baru</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" class="neo-brutal-input" placeholder="Tulis ulang password baru">
                </div>
            </div>

            <!-- Submit -->
            <button type="submit" class="w-full py-3.5 bg-gradient-to-tr from-cyan-500 to-cyan-400 text-white rounded-xl font-bold text-sm shadow-md shadow-cyan-500/15 hover:scale-102 active:scale-98 transition-all">
                Simpan Perubahan Akun
            </button>
        </form>
    </div>
</div>
@endsection
