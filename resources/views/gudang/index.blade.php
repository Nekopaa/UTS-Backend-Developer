@extends('layouts.admin')

@section('title', 'Inventaris Gudang')

@section('content')
<!-- Header Actions -->
<div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
    <p class="text-sm font-semibold text-slate-500">Daftar lokasi pusat penyimpanan (gudang) beserta status kapasitas daya tampung.</p>
    <a href="{{ route('gudang.create') }}" class="px-5 py-3 bg-gradient-to-tr from-yellow-400 to-yellow-300 hover:opacity-95 text-slate-800 rounded-xl font-bold text-sm shadow-md shadow-yellow-400/20 hover:translate-y-[-1px] active:translate-y-[1px] transition-all shrink-0 text-center">
        Tambah Gudang Baru
    </a>
</div>

<!-- Warehouse Grid -->
<div class="grid grid-cols-1 md:grid-cols-2 gap-8">
    @forelse($gudang as $g)
    <div class="neo-brutal-card p-6 bg-white space-y-6 flex flex-col justify-between">
        
        <div class="space-y-4">
            <!-- Header -->
            <div class="flex justify-between items-start">
                <div class="space-y-1">
                    <span class="text-xs font-bold uppercase text-indigo-600 tracking-wider">Gudang Penyimpanan</span>
                    <h3 class="text-xl font-extrabold text-slate-800 leading-tight">{{ $g->nama_gudang }}</h3>
                </div>
                <div>
                    @if(strtolower($g->status_gudang) === 'aktif')
                        <span class="px-2.5 py-1 bg-emerald-500 text-white rounded-lg text-[10px] font-bold uppercase shadow-sm">
                            Aktif
                        </span>
                    @elseif(strtolower($g->status_gudang) === 'penuh')
                        <span class="px-2.5 py-1 bg-rose-500 text-white rounded-lg text-[10px] font-bold uppercase shadow-sm">
                            Penuh
                        </span>
                    @else
                        <span class="px-2.5 py-1 bg-slate-100 text-slate-600 rounded-lg text-[10px] font-bold uppercase shadow-sm border border-slate-200">
                            Nonaktif
                        </span>
                    @endif
                </div>
            </div>

            <!-- Location -->
            <p class="text-xs font-bold text-slate-500 leading-relaxed">
                {{ $g->lokasi }}
            </p>

            <!-- Capacity Util -->
            <div class="space-y-2 border-t border-slate-100 pt-4">
                @php
                    $percent = $g->kapasitas_total > 0 ? min(100, max(0, ($g->stok_saat_ini / $g->kapasitas_total) * 100)) : 0;
                    $barColor = $percent > 90 ? 'bg-rose-500' : ($percent > 70 ? 'bg-amber-400' : 'bg-cyan-500');
                @endphp
                <div class="flex justify-between items-center text-xs">
                    <span class="font-bold text-slate-500">Pemanfaatan Kapasitas:</span>
                    <span class="font-bold text-slate-700">
                        {{ number_format($percent, 1) }}% ({{ $g->stok_saat_ini }} / {{ $g->kapasitas_total }} Unit)
                    </span>
                </div>
                
                <div class="w-full h-2.5 bg-slate-100 rounded-full overflow-hidden">
                    <div class="{{ $barColor }} h-full rounded-full transition-all duration-300" style="width: {{ $percent }}%"></div>
                </div>
            </div>
        </div>

        <!-- Action Links -->
        <div class="flex items-center gap-3 border-t border-slate-100 pt-4">
            <a href="{{ route('gudang.edit', $g->id_gudang) }}" class="flex-1 px-4 py-2 bg-gradient-to-tr from-yellow-400 to-yellow-300 text-slate-800 rounded-xl font-bold text-xs text-center shadow-sm hover:scale-105 active:scale-95 transition-all">
                Edit Info
            </a>

            <form action="{{ route('gudang.destroy', $g->id_gudang) }}" method="POST" class="flex-1" onsubmit="return confirm('Hapus gudang ini?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="w-full px-4 py-2 bg-gradient-to-tr from-rose-500 to-rose-400 text-white rounded-xl font-bold text-xs shadow-sm hover:scale-105 active:scale-95 transition-all">
                    Hapus
                </button>
            </form>
        </div>

    </div>
    @empty
    <div class="neo-brutal-card p-12 text-center lg:col-span-2 space-y-4">
        <div class="flex justify-center text-slate-400">
            <svg class="w-16 h-16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 21h19.5m-18-18v18m10.5-18v18m6-13.5V21M6.75 6.75h.75m-.75 3h.75m-.75 3h.75m3-6h.75m-.75 3h.75m-.75 3h.75M14 8.25h1.5m-1.5 3h1.5m-1.5 3h1.5M18.75 9.75h.75m-.75 3h.75" />
            </svg>
        </div>
        <h4 class="font-extrabold text-lg text-slate-800">Pusat Gudang Kosong</h4>
        <p class="text-sm font-semibold text-slate-500 max-w-sm mx-auto">Silakan daftarkan lokasi gudang penyimpanan air mineral pertama Anda.</p>
    </div>
    @endforelse
</div>
@endsection
