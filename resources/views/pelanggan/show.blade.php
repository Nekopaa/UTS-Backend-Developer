@extends('layouts.admin')

@section('title', 'Detail Pelanggan')

@section('content')
<div class="max-w-3xl mx-auto space-y-6">
    <div>
        <a href="{{ route('pelanggan.index') }}" class="inline-flex items-center px-4 py-2 border border-slate-200 rounded-xl bg-white font-bold text-xs text-slate-700 shadow-sm hover:translate-y-[-1px] transition-all gap-2">
            Kembali ke Daftar Pelanggan
        </a>
    </div>

    <div class="neo-brutal-card p-8 bg-white space-y-6">
        <div class="border-b border-slate-100 pb-4 flex justify-between items-start">
            <div>
                <span class="text-xs font-bold uppercase text-indigo-600 tracking-wider">Detail Pelanggan</span>
                <h3 class="text-2xl font-extrabold text-slate-850">{{ $pelanggan->nama_pelanggan }}</h3>
            </div>
            <div class="flex gap-2">
                @if($pelanggan->jenis_pelanggan === 'lembaga')
                    <span class="px-2.5 py-1 bg-indigo-500 text-white rounded-lg text-xs font-bold uppercase shadow-sm">Lembaga</span>
                @else
                    <span class="px-2.5 py-1 bg-yellow-400 text-slate-800 rounded-lg text-xs font-bold uppercase shadow-sm">Individu</span>
                @endif
                @if($pelanggan->status_pelanggan === 'aktif')
                    <span class="px-2.5 py-1 bg-emerald-500 text-white rounded-lg text-xs font-bold uppercase shadow-sm">Aktif</span>
                @else
                    <span class="px-2.5 py-1 bg-rose-500 text-white rounded-lg text-xs font-bold uppercase shadow-sm">Nonaktif</span>
                @endif
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            @if($pelanggan->jenis_pelanggan === 'lembaga')
            <div class="space-y-1">
                <p class="text-xs font-bold text-slate-400 uppercase tracking-wider">Nama Lembaga</p>
                <p class="text-sm font-extrabold text-slate-800">{{ $pelanggan->nama_lembaga ?? '-' }}</p>
            </div>
            @endif

            <div class="space-y-1">
                <p class="text-xs font-bold text-slate-400 uppercase tracking-wider">Penanggung Jawab</p>
                <p class="text-sm font-extrabold text-slate-800">{{ $pelanggan->penanggung_jawab }}</p>
            </div>

            <div class="space-y-1">
                <p class="text-xs font-bold text-slate-400 uppercase tracking-wider">No Telepon</p>
                <p class="text-sm font-extrabold text-slate-800">{{ $pelanggan->no_telepon }}</p>
            </div>

            <div class="space-y-1">
                <p class="text-xs font-bold text-slate-400 uppercase tracking-wider">Email</p>
                <p class="text-sm font-extrabold text-slate-800">{{ $pelanggan->email ?? '-' }}</p>
            </div>

            <div class="space-y-1">
                <p class="text-xs font-bold text-slate-400 uppercase tracking-wider">Tanggal Daftar</p>
                <p class="text-sm font-extrabold text-slate-800">{{ \Carbon\Carbon::parse($pelanggan->tanggal_daftar)->translatedFormat('d M Y') }}</p>
            </div>
        </div>

        <div class="space-y-1 border-t border-slate-100 pt-4">
            <p class="text-xs font-bold text-slate-400 uppercase tracking-wider">Alamat</p>
            <p class="text-sm font-semibold text-slate-700 leading-relaxed">{{ $pelanggan->alamat ?? '-' }}</p>
        </div>
    </div>
</div>
@endsection
