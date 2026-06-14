@extends('layouts.admin')

@section('title', 'Detail Kurir')

@section('content')
<div class="max-w-3xl mx-auto space-y-6">
    <div>
        <a href="{{ route('kurir.index') }}" class="inline-flex items-center px-4 py-2 border border-slate-200 rounded-xl bg-white font-bold text-xs text-slate-700 shadow-sm hover:translate-y-[-1px] transition-all gap-2">
            Kembali ke Armada
        </a>
    </div>

    <div class="neo-brutal-card p-8 bg-white space-y-6">
        <div class="border-b border-slate-100 pb-4">
            <span class="text-xs font-bold uppercase text-indigo-600 tracking-wider">Profil Kurir</span>
            <h3 class="text-2xl font-extrabold text-slate-850">{{ $kurir->nama_kurir }}</h3>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="space-y-1">
                <p class="text-xs font-bold text-slate-400 uppercase tracking-wider">No HP</p>
                <p class="text-sm font-extrabold text-slate-800">{{ $kurir->no_hp }}</p>
            </div>

            <div class="space-y-1">
                <p class="text-xs font-bold text-slate-400 uppercase tracking-wider">Status</p>
                <p class="mt-1">
                    @if($kurir->status_kurir === 'aktif')
                        <span class="px-2.5 py-1 bg-emerald-500 text-white rounded-lg text-xs font-bold uppercase shadow-sm">Aktif</span>
                    @elseif($kurir->status_kurir === 'istirahat')
                        <span class="px-2.5 py-1 bg-yellow-400 text-slate-800 rounded-lg text-xs font-bold uppercase shadow-sm">Istirahat</span>
                    @else
                        <span class="px-2.5 py-1 bg-rose-500 text-white rounded-lg text-xs font-bold uppercase shadow-sm">Tidak Aktif</span>
                    @endif
                </p>
            </div>

            <div class="space-y-1">
                <p class="text-xs font-bold text-slate-400 uppercase tracking-wider">Kendaraan</p>
                <p class="text-sm font-extrabold text-slate-800 capitalize">{{ $kurir->kendaraan }}</p>
            </div>

            <div class="space-y-1">
                <p class="text-xs font-bold text-slate-400 uppercase tracking-wider">Plat Nomor</p>
                <p class="mt-1">
                    <span class="inline-block px-3 py-1.5 bg-slate-100 border border-slate-200 rounded-lg text-slate-700 font-bold text-sm shadow-sm tracking-wider">
                        {{ $kurir->plat_nomor }}
                    </span>
                </p>
            </div>

            <div class="space-y-1 md:col-span-2">
                <p class="text-xs font-bold text-slate-400 uppercase tracking-wider">Alamat</p>
                <p class="text-sm font-extrabold text-slate-850">{{ $kurir->alamat }}</p>
            </div>

            <div class="space-y-1 md:col-span-2">
                <p class="text-xs font-bold text-slate-400 uppercase tracking-wider">Catatan</p>
                <p class="text-sm font-semibold text-slate-650">{{ $kurir->catatan ?? 'Tidak ada catatan' }}</p>
            </div>
        </div>
    </div>
</div>
@endsection
