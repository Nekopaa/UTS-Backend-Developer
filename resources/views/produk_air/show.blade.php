@extends('layouts.admin')

@section('title', 'Detail Produk Air')

@section('content')
<div class="max-w-3xl mx-auto space-y-6">
    <div>
        <a href="{{ route('produk-air.index') }}" class="inline-flex items-center px-4 py-2 bg-white border border-slate-200 rounded-xl font-bold text-xs text-slate-700 shadow-sm hover:translate-y-[-1px] transition-all gap-2">
            Kembali ke Daftar Produk
        </a>
    </div>

    <div class="neo-brutal-card p-8 bg-white space-y-6">
        <div class="border-b border-slate-100 pb-4">
            <span class="text-xs font-bold uppercase text-indigo-600 tracking-wider">Produk Air Mineral</span>
            <h3 class="text-2xl font-extrabold text-slate-800">{{ $produk->nama_produk }}</h3>
        </div>

        <div>
            @if($produk->foto_produk)
                <img src="{{ asset('storage/' . $produk->foto_produk) }}" alt="{{ $produk->nama_produk }}" class="w-full h-48 object-cover border border-slate-200 rounded-xl shadow-sm">
            @else
                @if($produk->jenis_kemasan === 'botol')
                    <img src="{{ asset('images/produk_botol.jpg') }}" alt="{{ $produk->nama_produk }}" class="w-full h-48 object-cover border border-slate-200 rounded-xl shadow-sm">
                @elseif($produk->jenis_kemasan === 'gelas')
                    <img src="{{ asset('images/produk_gelas.jpg') }}" alt="{{ $produk->nama_produk }}" class="w-full h-48 object-cover border border-slate-200 rounded-xl shadow-sm">
                @else
                    <img src="{{ asset('images/produk_galon.jpg') }}" alt="{{ $produk->nama_produk }}" class="w-full h-48 object-cover border border-slate-200 rounded-xl shadow-sm">
                @endif
            @endif
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="space-y-1">
                <p class="text-xs font-bold text-slate-400 uppercase tracking-wider">Jenis Kemasan</p>
                <p class="text-sm font-extrabold text-slate-700 capitalize">{{ $produk->jenis_kemasan }}</p>
            </div>

            <div class="space-y-1">
                <p class="text-xs font-bold text-slate-400 uppercase tracking-wider">Kapasitas</p>
                <p class="text-sm font-extrabold text-slate-700">{{ $produk->kapasitas }}</p>
            </div>

            <div class="space-y-1">
                <p class="text-xs font-bold text-slate-400 uppercase tracking-wider">Harga</p>
                <p class="text-sm font-extrabold text-slate-700">Rp {{ number_format($produk->harga, 0, ',', '.') }}</p>
            </div>

            <div class="space-y-1">
                <p class="text-xs font-bold text-slate-400 uppercase tracking-wider">Stok</p>
                <p class="text-sm font-extrabold text-slate-700">{{ $produk->stok }} Unit</p>
            </div>

            <div class="space-y-1">
                <p class="text-xs font-bold text-slate-400 uppercase tracking-wider">Status</p>
                <p class="mt-1">
                    @if($produk->status_produk === 'tersedia')
                        <span class="px-2.5 py-1 bg-emerald-500 text-white rounded-lg text-[10px] font-bold uppercase shadow-sm">Tersedia</span>
                    @else
                        <span class="px-2.5 py-1 bg-rose-500 text-white rounded-lg text-[10px] font-bold uppercase shadow-sm">{{ $produk->status_produk }}</span>
                    @endif
                </p>
            </div>

            <div class="space-y-1">
                <p class="text-xs font-bold text-slate-400 uppercase tracking-wider">Tanggal Ditambahkan</p>
                <p class="text-sm font-extrabold text-slate-700">{{ $produk->tanggal_ditambahkan }}</p>
            </div>

            <div class="space-y-1 md:col-span-2">
                <p class="text-xs font-bold text-slate-400 uppercase tracking-wider">Deskripsi</p>
                <p class="text-sm font-semibold text-slate-600">{{ $produk->deskripsi ?? '-' }}</p>
            </div>
        </div>
    </div>
</div>
@endsection
