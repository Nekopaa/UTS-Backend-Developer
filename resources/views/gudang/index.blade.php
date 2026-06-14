@extends('layouts.admin')

@section('title', 'Inventaris Gudang')

@section('content')
<!-- Header Actions -->
<div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
    <p class="text-sm font-semibold text-slate-700">Daftar lokasi pusat penyimpanan (gudang) beserta status kapasitas daya tampung.</p>
    <a href="{{ route('gudang.create') }}" class="px-5 py-3 border-3 border-black rounded-xl bg-[#facc15] font-black text-sm shadow-[4px_4px_0px_#000000] hover:-translate-y-0.5 hover:shadow-[5px_5px_0px_#000000] active:translate-y-0.5 active:shadow-[2px_2px_0px_#000000] transition-all shrink-0 text-center">
        ➕ Tambah Gudang Baru
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
                    <span class="text-xs font-black uppercase text-indigo-500 tracking-wider">Gudang Penyimpanan</span>
                    <h3 class="text-xl font-black text-black leading-tight">{{ $g->nama_gudang }}</h3>
                </div>
                <div>
                    @if(strtolower($g->status_gudang) === 'aktif')
                        <span class="px-2.5 py-1 bg-[#4ade80] border-2 border-black rounded-lg text-[10px] font-black uppercase shadow-[1.5px_1.5px_0px_#000000]">
                            Aktif
                        </span>
                    @elseif(strtolower($g->status_gudang) === 'penuh')
                        <span class="px-2.5 py-1 bg-[#f43f5e] text-white border-2 border-black rounded-lg text-[10px] font-black uppercase shadow-[1.5px_1.5px_0px_#000000]">
                            Penuh
                        </span>
                    @else
                        <span class="px-2.5 py-1 bg-slate-200 border-2 border-black rounded-lg text-[10px] font-black uppercase shadow-[1.5px_1.5px_0px_#000000]">
                            Nonaktif
                        </span>
                    @endif
                </div>
            </div>

            <!-- Location -->
            <p class="text-xs font-bold text-slate-500 leading-relaxed">
                📍 {{ $g->lokasi }}
            </p>

            <!-- Capacity Util -->
            <div class="space-y-2 border-t-2 border-black/5 pt-4">
                @php
                    $percent = $g->kapasitas_total > 0 ? min(100, max(0, ($g->stok_saat_ini / $g->kapasitas_total) * 100)) : 0;
                    $barColor = $percent > 90 ? 'bg-[#f43f5e]' : ($percent > 70 ? 'bg-[#facc15]' : 'bg-[#06b6d4]');
                @endphp
                <div class="flex justify-between items-center text-xs">
                    <span class="font-bold text-slate-500">Pemanfaatan Kapasitas:</span>
                    <span class="font-black text-black">
                        {{ number_format($percent, 1) }}% ({{ $g->stok_saat_ini }} / {{ $g->kapasitas_total }} Unit)
                    </span>
                </div>
                
                <div class="w-full h-4 bg-slate-100 border-2 border-black rounded-full overflow-hidden">
                    <div class="{{ $barColor }} h-full border-r-2 border-black rounded-full transition-all duration-300" style="width: {{ $percent }}%"></div>
                </div>
            </div>
        </div>

        <!-- Action Links -->
        <div class="flex items-center gap-3 border-t-2 border-black/5 pt-4">
            <a href="{{ route('gudang.edit', $g->id_gudang) }}" class="flex-1 px-4 py-2 border-2 border-black rounded-xl bg-[#facc15] font-black text-xs text-center shadow-[3px_3px_0px_#000000] hover:scale-105 active:scale-95 transition-all">
                ✏️ Edit Info
            </a>

            <form action="{{ route('gudang.destroy', $g->id_gudang) }}" method="POST" class="flex-1" onsubmit="return confirm('Hapus gudang ini?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="w-full px-4 py-2 border-2 border-black rounded-xl bg-[#f43f5e] text-white font-black text-xs shadow-[3px_3px_0px_#000000] hover:scale-105 active:scale-95 transition-all">
                    🗑️ Hapus
                </button>
            </form>
        </div>

    </div>
    @empty
    <div class="neo-brutal-card p-12 text-center lg:col-span-2 space-y-4">
        <span class="text-6xl">🏢</span>
        <h4 class="font-extrabold text-lg text-black">Pusat Gudang Kosong</h4>
        <p class="text-sm font-semibold text-slate-500 max-w-sm mx-auto">Silakan daftarkan lokasi gudang penyimpanan air mineral pertama Anda.</p>

    </div>
    @endforelse
</div>
@endsection


