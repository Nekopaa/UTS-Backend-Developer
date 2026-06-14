@extends('layouts.admin')

@section('title', 'Kelola Akun Pengguna')

@section('content')
<!-- Header Actions -->
<div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
    <div>
        <p class="text-sm font-semibold text-slate-700">Daftar pengguna (akun) terdaftar di sistem Rindu Water.</p>
        <p class="text-xs text-slate-500 mt-1.5">
            <strong>Info Perbedaan:</strong> Akun Pengguna (User) berisi detail otentikasi dan kredensial login, sedangkan Profil Pelanggan (Pelanggan) berisi rincian bisnis dan alamat pengiriman (seperti kategori Individu vs Lembaga/Instansi).
        </p>
    </div>
    <a href="{{ route('users.create') }}" class="inline-flex items-center justify-center px-5 py-3 bg-gradient-to-tr from-cyan-500 to-cyan-400 text-white rounded-xl font-bold text-sm shadow-md shadow-cyan-500/15 hover:scale-105 active:scale-95 transition-all shrink-0 text-center">
        Tambah Pengguna Baru
    </a>
</div>

<!-- Users List -->
<div class="neo-brutal-card p-6 bg-white space-y-6">
    <div class="border-b border-slate-100 pb-4 flex flex-col sm:flex-row sm:justify-between sm:items-center gap-4">
        <h3 class="text-xl font-extrabold text-slate-850">Direktori Akun Pengguna</h3>
        <div class="flex gap-2">
            <span class="px-3 py-1.5 bg-slate-105 border border-slate-200 text-slate-700 rounded-lg text-xs font-bold shadow-sm">
                Total Pengguna: {{ $user->count() }}
            </span>
        </div>
    </div>

    @if($user->count() > 0)
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="border-b border-slate-100 text-xs font-bold uppercase text-slate-500">
                    <th class="pb-3 pl-2">Nama Akun</th>
                    <th class="pb-3">Email Pengguna</th>
                    <th class="pb-3">Peran (Role)</th>
                    <th class="pb-3">Tanggal Dibuat</th>
                    <th class="pb-3 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @foreach($user as $u)
                <tr class="hover:bg-slate-50 transition-colors">
                    <!-- Nama -->
                    <td class="py-4 pl-2 font-extrabold text-sm text-slate-800">
                        {{ $u->name }}
                    </td>

                    <!-- Email -->
                    <td class="py-4 font-semibold text-xs text-slate-655">
                        {{ $u->email }}
                    </td>

                    <!-- Role -->
                    <td class="py-4 font-bold text-xs">
                        @if($u->role === 'admin')
                            <span class="px-2.5 py-1 bg-purple-500 text-white rounded-lg text-[10px] uppercase shadow-sm">
                                Admin Portal
                            </span>
                        @else
                            <span class="px-2.5 py-1 bg-slate-100 border border-slate-200 text-slate-600 rounded-lg text-[10px] uppercase shadow-sm">
                                Pembeli (User)
                            </span>
                        @endif
                    </td>

                    <!-- Tanggal Dibuat -->
                    <td class="py-4 font-semibold text-xs text-slate-500">
                        {{ $u->created_at ? $u->created_at->translatedFormat('d M Y') : '-' }}
                    </td>

                    <!-- Actions -->
                    <td class="py-4 text-center">
                        <div class="flex items-center justify-center gap-2">
                            <a href="{{ route('users.edit', $u->id) }}" class="inline-flex items-center px-2.5 py-1.5 bg-gradient-to-tr from-amber-400 to-amber-300 text-slate-805 rounded-lg text-[10px] font-bold shadow-sm hover:scale-105 active:scale-95 transition-all">
                                Edit
                            </a>
                            
                            <form action="{{ route('users.destroy', $u->id) }}" method="POST" onsubmit="return confirm('Hapus akun pengguna ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="inline-flex items-center px-2.5 py-1.5 bg-gradient-to-tr from-rose-500 to-rose-400 text-white rounded-lg text-[10px] font-bold shadow-sm hover:scale-105 active:scale-95 transition-all">
                                    Hapus
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @else
    <div class="text-center py-12 space-y-4">
        <div class="flex justify-center text-slate-400">
            <svg class="w-16 h-16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.109A11.386 11.386 0 0110.089 20M3 11.625a3.001 3.001 0 116 0M3 11.625a8.967 8.967 0 0112 0M3 11.625c0-1.608.824-3.024 2.079-3.878m12.11 3.878A8.967 8.967 0 008.25 7.75" />
            </svg>
        </div>
        <h4 class="font-extrabold text-lg text-slate-800">Daftar Pengguna Kosong</h4>
        <p class="text-sm font-semibold text-slate-500 max-w-sm mx-auto">Belum ada akun pengguna terdaftar.</p>
        <a href="{{ route('users.create') }}" class="inline-flex items-center px-5 py-2.5 bg-gradient-to-tr from-cyan-500 to-cyan-400 text-white rounded-xl font-bold text-xs shadow-md shadow-cyan-500/15 hover:scale-105 active:scale-95 transition-all">
            Tambah Pengguna Sekarang
        </a>
    </div>
    @endif
</div>
@endsection
