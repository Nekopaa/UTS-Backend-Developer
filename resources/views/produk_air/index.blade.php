@extends('layouts.admin')

@section('title', 'Kelola Produk & Stok Air')

@section('content')
<!-- Header Actions -->
<div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
    <p class="text-sm font-semibold text-slate-500">Daftar katalog produk air mineral beserta pemantauan stok saat ini.</p>
    <a href="{{ route('produk-air.create') }}" class="px-5 py-3 bg-gradient-to-tr from-yellow-400 to-yellow-300 hover:opacity-95 text-slate-800 rounded-xl font-bold text-sm shadow-md shadow-yellow-400/20 hover:translate-y-[-1px] active:translate-y-[1px] transition-all">
        Tambah Produk Baru
    </a>
</div>

<!-- Product Table Grid -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
    @forelse($produk as $p)
    <div class="neo-brutal-card p-6 flex flex-col justify-between space-y-6 @if($p->stok < 15) border-rose-200 bg-rose-50/20 @endif @if($p->stok == 0) opacity-60 grayscale @endif">
        
        <!-- Product Head -->
        <div class="space-y-4">
            <div class="w-full h-44 rounded-xl border border-slate-200 overflow-hidden bg-slate-50 shadow-sm">
                @if($p->foto_produk)
                    <img src="{{ asset('storage/' . $p->foto_produk) }}" alt="{{ $p->nama_produk }}" class="w-full h-full object-cover">
                @else
                    @if($p->jenis_kemasan === 'botol')
                        <img src="{{ asset('images/produk_botol.jpg') }}" alt="{{ $p->nama_produk }}" class="w-full h-full object-cover">
                    @elseif($p->jenis_kemasan === 'gelas')
                        <img src="{{ asset('images/produk_gelas.jpg') }}" alt="{{ $p->nama_produk }}" class="w-full h-full object-cover">
                    @else
                        <img src="{{ asset('images/produk_galon.jpg') }}" alt="{{ $p->nama_produk }}" class="w-full h-full object-cover">
                    @endif
                @endif
            </div>

            <div class="flex justify-between items-start pt-2">
                <div>
                    <h3 class="font-extrabold text-xl text-slate-800 leading-tight">{{ $p->nama_produk }}</h3>
                    <div class="flex items-center gap-2 mt-1">
                        <span class="px-2 py-0.5 border border-slate-200 rounded-md bg-slate-50 font-bold text-[10px] text-slate-600 uppercase">{{ $p->jenis_kemasan }}</span>
                        <span class="px-2 py-0.5 border border-slate-200 rounded-md bg-slate-50 font-bold text-[10px] text-slate-600 uppercase">{{ $p->kapasitas }}</span>
                    </div>
                </div>
                <div class="px-3 py-1.5 bg-emerald-500 text-white rounded-xl font-bold text-sm shadow-sm shadow-emerald-500/10">
                    Rp {{ number_format($p->harga, 0, ',', '.') }}
                </div>
            </div>

            <p class="text-xs font-semibold text-slate-600 leading-relaxed line-clamp-2">
                {{ $p->deskripsi ?? 'Tidak ada deskripsi untuk produk air mineral ini.' }}
            </p>
        </div>

        <!-- Stock Indicator -->
        <div class="space-y-2 border-t border-slate-100 pt-4">
            <div class="flex justify-between items-center text-xs">
                <span class="font-bold text-slate-500">Tingkat Stok Saat Ini:</span>
                <span class="font-bold @if($p->stok < 15) text-rose-600 @else text-slate-700 @endif">
                    {{ $p->stok }} Unit
                </span>
            </div>
            
            <!-- Progress Bar -->
            <div class="w-full h-2.5 bg-slate-100 rounded-full overflow-hidden">
                @php
                    $percent = min(100, max(0, ($p->stok / 200) * 100));
                    $barColor = $p->stok < 15 ? 'bg-rose-500' : ($p->stok < 50 ? 'bg-amber-400' : 'bg-emerald-500');
                @endphp
                <div class="{{ $barColor }} h-full rounded-full transition-all duration-300" style="width: {{ $percent }}%"></div>
            </div>

            <div class="flex justify-between items-center text-[10px] font-bold text-slate-400">
                <span>Kosong (0)</span>
                <span>Maks Ideal (200)</span>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="flex items-center gap-3 pt-2">
            <a href="{{ route('produk-air.edit', $p->id_produk) }}" class="flex-1 px-4 py-2.5 bg-gradient-to-tr from-yellow-400 to-yellow-300 text-slate-800 rounded-xl font-bold text-xs text-center shadow-sm hover:scale-105 active:scale-95 transition-all">
                Edit
            </a>
            
            <form action="{{ route('produk-air.destroy', $p->id_produk) }}" method="POST" class="flex-1" onsubmit="return confirm('Apakah Anda yakin ingin menghapus produk ini?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="w-full px-4 py-2.5 bg-gradient-to-tr from-rose-500 to-rose-400 text-white rounded-xl font-bold text-xs shadow-sm hover:scale-105 active:scale-95 transition-all">
                    Hapus
                </button>
            </form>
        </div>
    </div>
    @empty
    <div class="neo-brutal-card p-12 text-center lg:col-span-3 space-y-4">
        <div class="flex justify-center text-slate-400">
            <svg class="w-16 h-16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 7.5l-.625 10.632a2.25 2.25 0 0 1-2.247 2.118H6.622a2.25 2.25 0 0 1-2.247-2.118L3.75 7.5M10 11.25h4M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504 1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125Z" />
            </svg>
        </div>
        <h3 class="font-extrabold text-xl text-slate-800">Katalog Produk Kosong</h3>
        <p class="text-sm font-semibold text-slate-500 max-w-md mx-auto">Silakan tambahkan produk air mineral pertama Anda ke dalam sistem.</p>
        <a href="{{ route('produk-air.create') }}" class="inline-block px-6 py-3 bg-gradient-to-tr from-yellow-400 to-yellow-300 text-slate-800 rounded-xl font-bold text-sm shadow-sm hover:translate-y-[-1px] transition-all">
            Tambah Produk Sekarang
        </a>
    </div>
    @endforelse
</div>
@endsection
