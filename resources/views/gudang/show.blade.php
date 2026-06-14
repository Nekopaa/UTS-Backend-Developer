@extends('layouts.admin')

@section('title', 'Detail Gudang')

@section('content')
<div class="max-w-3xl mx-auto space-y-6">
    <div>
        <a href="{{ route('gudang.index') }}" class="inline-flex items-center px-4 py-2 bg-white border border-slate-200 rounded-xl font-bold text-xs text-slate-700 shadow-sm hover:translate-y-[-1px] transition-all gap-2">
            Kembali ke Gudang
        </a>
    </div>

    <div class="neo-brutal-card p-8 bg-white space-y-6">
        <div class="border-b border-slate-100 pb-4">
            <span class="text-xs font-bold uppercase text-indigo-600 tracking-wider">Gudang Penyimpanan</span>
            <h3 class="text-2xl font-extrabold text-slate-800">{{ $gudang->nama_gudang }}</h3>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="space-y-1">
                <p class="text-xs font-bold text-slate-400 uppercase tracking-wider">Lokasi</p>
                <p class="text-sm font-extrabold text-slate-700">{{ $gudang->lokasi }}</p>
            </div>

            <div class="space-y-1">
                <p class="text-xs font-bold text-slate-400 uppercase tracking-wider">Kapasitas Total</p>
                <p class="text-sm font-extrabold text-slate-700">{{ $gudang->kapasitas_total }} Unit</p>
            </div>

            <div class="space-y-1">
                <p class="text-xs font-bold text-slate-400 uppercase tracking-wider">Stok Saat Ini</p>
                <p class="text-sm font-extrabold text-slate-700">{{ $gudang->stok_saat_ini }} Unit</p>
            </div>

            <div class="space-y-1">
                <p class="text-xs font-bold text-slate-400 uppercase tracking-wider">Status</p>
                <p class="mt-1">
                    @if($gudang->status_gudang === 'aktif')
                        <span class="px-2.5 py-1 bg-emerald-500 text-white rounded-lg text-[10px] font-bold uppercase shadow-sm">Aktif</span>
                    @elseif($gudang->status_gudang === 'penuh')
                        <span class="px-2.5 py-1 bg-rose-500 text-white rounded-lg text-[10px] font-bold uppercase shadow-sm">Penuh</span>
                    @else
                        <span class="px-2.5 py-1 bg-slate-400 text-white rounded-lg text-[10px] font-bold uppercase shadow-sm">Nonaktif</span>
                    @endif
                </p>
            </div>
        </div>

        {{-- Capacity Bar --}}
        @php
            $percent = $gudang->kapasitas_total > 0 ? round(($gudang->stok_saat_ini / $gudang->kapasitas_total) * 100) : 0;
        @endphp
        <div class="space-y-2">
            <div class="flex justify-between items-center">
                <p class="text-xs font-bold text-slate-400 uppercase tracking-wider">Kapasitas Terpakai</p>
                <span class="text-xs font-bold text-slate-700">{{ $percent }}%</span>
            </div>
            <div class="w-full h-2.5 bg-slate-100 rounded-full overflow-hidden shadow-sm">
                <div class="h-full {{ $percent >= 90 ? 'bg-rose-500' : ($percent >= 60 ? 'bg-amber-400' : 'bg-emerald-500') }} transition-all"
                     style="width: {{ $percent }}%"></div>
            </div>
        </div>
    </div>
</div>
@endsection
