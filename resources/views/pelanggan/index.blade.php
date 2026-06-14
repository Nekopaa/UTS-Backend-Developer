@extends('layouts.admin')

@section('title', 'Kelola Pelanggan')

@section('content')
<div class="space-y-6">
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <p class="text-sm font-semibold text-slate-700">Daftar lengkap pelanggan Rindu Water baik kategori Individu maupun Lembaga/Instansi.</p>
            <p class="text-xs text-slate-500 mt-1.5">
                <strong>Info Perbedaan:</strong> Profil Pelanggan (Pelanggan) berisi rincian bisnis dan alamat pengiriman (seperti kategori Individu vs Lembaga/Instansi), sedangkan Akun Pengguna (User) berisi detail otentikasi dan kredensial login.
            </p>
        </div>
        <div class="flex items-center gap-3 shrink-0">
            <span class="px-4 py-3 bg-white border border-slate-200 rounded-xl font-bold text-xs text-slate-700 shadow-sm">
                Total: {{ $pelanggan->count() }}
            </span>
            <a href="{{ route('pelanggan.create') }}" class="inline-flex items-center justify-center px-5 py-3 bg-gradient-to-tr from-cyan-500 to-cyan-400 text-white rounded-xl font-bold text-sm shadow-md shadow-cyan-500/15 hover:scale-105 active:scale-95 transition-all text-center">
                Tambah Pelanggan Baru
            </a>
        </div>
    </div>

    <!-- Table Container -->
    <div class="neo-brutal-card p-6 bg-white space-y-6">
        <div class="border-b border-slate-100 pb-4 flex justify-between items-center">
            <h3 class="text-xl font-extrabold text-slate-850">Direktori Pelanggan</h3>
        </div>

        @if($pelanggan->count() > 0)
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="border-b border-slate-100 text-xs font-bold uppercase text-slate-500">
                        <th class="pb-3 pl-2">Jenis</th>
                        <th class="pb-3">Nama Pelanggan</th>
                        <th class="pb-3">Lembaga / Penanggung Jawab</th>
                        <th class="pb-3">Info Kontak</th>
                        <th class="pb-3">Alamat</th>
                        <th class="pb-3">Tanggal Daftar</th>
                        <th class="pb-3">Status</th>
                        <th class="pb-3 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @foreach($pelanggan as $p)
                    <tr class="hover:bg-slate-50 transition-colors">
                        <!-- Jenis Pelanggan -->
                        <td class="py-4 pl-2">
                            @if($p->jenis_pelanggan === 'lembaga')
                                <span class="px-2.5 py-1 bg-indigo-500 text-white rounded-lg text-[10px] font-bold uppercase shadow-sm">
                                    Lembaga
                                </span>
                            @else
                                <span class="px-2.5 py-1 bg-yellow-400 text-slate-850 rounded-lg text-[10px] font-bold uppercase shadow-sm">
                                    Individu
                                </span>
                            @endif
                        </td>

                        <!-- Nama Pelanggan -->
                        <td class="py-4 font-extrabold text-sm text-slate-805">
                            {{ $p->nama_pelanggan }}
                        </td>

                        <!-- Lembaga / PJ -->
                        <td class="py-4 font-semibold text-xs text-slate-700">
                            @if($p->jenis_pelanggan === 'lembaga')
                                <div class="font-extrabold text-slate-800">{{ $p->nama_lembaga ?? '-' }}</div>
                                <div class="text-[10px] text-slate-400">PJ: {{ $p->penanggung_jawab }}</div>
                            @else
                                <span class="text-slate-400">Personal (PJ: {{ $p->penanggung_jawab }})</span>
                            @endif
                        </td>

                        <!-- Info Kontak -->
                        <td class="py-4 font-semibold text-xs text-slate-600 space-y-0.5">
                            <div>{{ $p->no_telepon }}</div>
                            @if($p->email)
                                <div class="text-[10px] text-slate-400 truncate">{{ $p->email }}</div>
                            @endif
                        </td>

                        <!-- Alamat -->
                        <td class="py-4 font-semibold text-xs text-slate-500 max-w-xs truncate">
                            {{ $p->alamat ?? '-' }}
                        </td>

                        <!-- Tanggal Daftar -->
                        <td class="py-4 font-semibold text-xs text-slate-600">
                            {{ $p->tanggal_daftar ? \Carbon\Carbon::parse($p->tanggal_daftar)->translatedFormat('d M Y') : '-' }}
                        </td>

                        <!-- Status -->
                        <td class="py-4">
                            @if($p->status_pelanggan === 'aktif')
                                <span class="px-2.5 py-1 bg-emerald-500 text-white rounded-lg text-[10px] font-bold uppercase shadow-sm">
                                    Aktif
                                </span>
                            @else
                                <span class="px-2.5 py-1 bg-rose-500 text-white rounded-lg text-[10px] font-bold uppercase shadow-sm">
                                    Nonaktif
                                </span>
                            @endif
                        </td>

                        <!-- Actions -->
                        <td class="py-4 text-center">
                            <div class="flex items-center justify-center gap-2">
                                <a href="{{ route('pelanggan.edit', $p->id_pelanggan) }}" class="inline-flex items-center px-2.5 py-1.5 bg-gradient-to-tr from-amber-400 to-amber-300 text-slate-805 rounded-lg text-[10px] font-bold shadow-sm hover:scale-105 active:scale-95 transition-all">
                                    Edit
                                </a>
                                
                                <form action="{{ route('pelanggan.destroy', $p->id_pelanggan) }}" method="POST" onsubmit="return confirm('Hapus data pelanggan ini?')">
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
            <h4 class="font-extrabold text-lg text-slate-800">Direktori Pelanggan Kosong</h4>
            <p class="text-sm font-semibold text-slate-500 max-w-sm mx-auto">Belum ada pelanggan terdaftar di dalam sistem.</p>
            <a href="{{ route('pelanggan.create') }}" class="inline-flex items-center px-5 py-2.5 bg-gradient-to-tr from-cyan-500 to-cyan-400 text-white rounded-xl font-bold text-xs shadow-md shadow-cyan-500/15 hover:scale-105 active:scale-95 transition-all">
                Tambah Pelanggan Sekarang
            </a>
        </div>
        @endif
    </div>
</div>
@endsection
