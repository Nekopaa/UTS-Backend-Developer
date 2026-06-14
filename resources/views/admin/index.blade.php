@extends('layouts.admin')

@section('title', 'Kelola Akun Staff')

@section('content')
<!-- Header Actions -->
<div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
    <p class="text-sm font-semibold text-slate-500">Daftar akun administrative (Staff / Operator) yang mengelola transaksi dan stok.</p>
    <a href="{{ route('admin.create') }}" class="inline-flex items-center px-4 py-2.5 bg-gradient-to-tr from-indigo-600 to-violet-600 hover:from-indigo-700 hover:to-violet-700 text-white font-bold text-sm rounded-xl shadow-sm transition-all shrink-0 text-center">
        Tambah Staff Baru
    </a>
</div>

<!-- Admin Staff Directory -->
<div class="neo-brutal-card p-6 bg-white space-y-6">
    <div class="border-b border-slate-100 pb-4 flex justify-between items-center">
        <h3 class="text-xl font-bold text-slate-800">Direktori Staff & Admin</h3>
        <span class="px-3 py-1 bg-slate-100 text-slate-600 rounded-lg text-xs font-bold">
            Total Staff: {{ $admin->count() }}
        </span>
    </div>

    @if($admin->count() > 0)
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="border-b border-slate-200 text-xs font-bold uppercase text-slate-400">
                    <th class="pb-3 pl-2">Nama Staff</th>
                    <th class="pb-3">Username</th>
                    <th class="pb-3">Email</th>
                    <th class="pb-3">Nomor HP</th>
                    <th class="pb-3">Peran (Role)</th>
                    <th class="pb-3">Status</th>
                    <th class="pb-3 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @foreach($admin as $a)
                <tr class="hover:bg-slate-50/50 transition-colors">
                    <!-- Nama -->
                    <td class="py-4 pl-2 font-bold text-sm text-slate-800">
                        {{ $a->nama_admin }}
                    </td>

                    <!-- Username -->
                    <td class="py-4 font-bold text-xs text-indigo-600">
                        @<span>{{ $a->username }}</span>
                    </td>

                    <!-- Email -->
                    <td class="py-4 font-medium text-xs text-slate-600">
                        {{ $a->email }}
                    </td>

                    <!-- Kontak -->
                    <td class="py-4 font-medium text-xs text-slate-500">
                        {{ $a->no_hp ?? '-' }}
                    </td>

                    <!-- Peran -->
                    <td class="py-4">
                        @if($a->role === 'super admin')
                            <span class="px-2.5 py-1 bg-rose-50 text-rose-700 border border-rose-100 rounded-lg text-[9px] font-bold uppercase">
                                Super Admin
                            </span>
                        @else
                            <span class="px-2.5 py-1 bg-sky-50 text-sky-700 border border-sky-100 rounded-lg text-[9px] font-bold uppercase">
                                Staff Operator
                            </span>
                        @endif
                    </td>

                    <!-- Status -->
                    <td class="py-4">
                        @if($a->status_admin === 'aktif')
                            <span class="px-2.5 py-1 bg-emerald-50 text-emerald-700 border border-emerald-100 rounded-lg text-[10px] font-bold uppercase">
                                Aktif
                            </span>
                        @else
                            <span class="px-2.5 py-1 bg-rose-50 text-rose-700 border border-rose-100 rounded-lg text-[10px] font-bold uppercase">
                                Nonaktif
                            </span>
                        @endif
                    </td>

                    <!-- Actions -->
                    <td class="py-4 text-center">
                        <div class="flex items-center justify-center gap-2">
                            <a href="{{ route('admin.edit', $a->id_admin) }}" class="px-2.5 py-1 bg-amber-50 hover:bg-amber-100 text-amber-700 border border-amber-200 rounded-lg font-bold text-[10px] transition-all">
                                Edit
                            </a>
                            
                            <form action="{{ route('admin.destroy', $a->id_admin) }}" method="POST" onsubmit="return confirm('Hapus data staff admin ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="px-2.5 py-1 bg-rose-50 hover:bg-rose-100 text-rose-700 border border-rose-200 rounded-lg font-bold text-[10px] transition-all">
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
        <div class="w-12 h-12 rounded-full bg-slate-100 flex items-center justify-center mx-auto text-slate-400">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
            </svg>
        </div>
        <h4 class="font-bold text-lg text-slate-800">Daftar Staff Kosong</h4>
        <p class="text-sm font-semibold text-slate-500 max-w-sm mx-auto">Belum ada staff administrative terdaftar.</p>
        <a href="{{ route('admin.create') }}" class="inline-block px-6 py-2.5 bg-gradient-to-tr from-indigo-600 to-violet-600 hover:from-indigo-700 hover:to-violet-700 text-white font-bold text-xs rounded-xl shadow-sm">
            Tambah Staff Sekarang
        </a>
    </div>
    @endif
</div>
@endsection

