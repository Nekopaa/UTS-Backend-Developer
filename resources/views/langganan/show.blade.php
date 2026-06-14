@extends('layouts.admin')

@section('title', 'Detail Langganan')

@section('content')
<div class="max-w-3xl mx-auto space-y-6">
    <div>
        <a href="{{ route('langganan.index') }}"
           class="inline-flex items-center px-4 py-2 border border-slate-200 rounded-xl bg-white font-bold text-xs text-slate-700 shadow-sm hover:translate-y-[-1px] transition-all gap-2">
            Daftar Langganan
        </a>
    </div>

    <div class="neo-brutal-card p-8 bg-white space-y-6">
        <div class="border-b border-slate-100 pb-4">
            <span class="text-xs font-bold uppercase text-indigo-600 tracking-wider">Detail Langganan</span>
            <h3 class="text-2xl font-extrabold text-slate-850">Paket Langganan #{{ $langganan->id_langganan }}</h3>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="space-y-1">
                <p class="text-xs font-bold text-slate-400 uppercase tracking-wider">Pelanggan</p>
                <p class="text-sm font-extrabold text-slate-800">{{ $langganan->pelanggan->nama_pelanggan ?? 'ID: ' . $langganan->id_pelanggan }}</p>
            </div>

            <div class="space-y-1">
                <p class="text-xs font-bold text-slate-400 uppercase tracking-wider">Produk</p>
                <p class="text-sm font-extrabold text-slate-800">{{ $langganan->produk->nama_produk ?? 'ID: ' . $langganan->id_produk }}</p>
            </div>

            <div class="space-y-1">
                <p class="text-xs font-bold text-slate-400 uppercase tracking-wider">Periode</p>
                <p class="text-sm font-extrabold text-slate-800 capitalize">{{ $langganan->periode_pengantaran }}</p>
            </div>

            <div class="space-y-1">
                <p class="text-xs font-bold text-slate-400 uppercase tracking-wider">Jumlah Pesanan</p>
                <p class="text-sm font-extrabold text-slate-800">{{ $langganan->jumlah_pesanan }} Unit</p>
            </div>

            <div class="space-y-1">
                <p class="text-xs font-bold text-slate-400 uppercase tracking-wider">Tanggal Mulai</p>
                <p class="text-sm font-extrabold text-slate-800">{{ \Carbon\Carbon::parse($langganan->tanggal_mulai)->translatedFormat('d M Y') }}</p>
            </div>

            <div class="space-y-1">
                <p class="text-xs font-bold text-slate-400 uppercase tracking-wider">Tanggal Berakhir</p>
                <p class="text-sm font-extrabold text-slate-800">{{ \Carbon\Carbon::parse($langganan->tanggal_berakhir)->translatedFormat('d M Y') }}</p>
            </div>

            <div class="space-y-1">
                <p class="text-xs font-bold text-slate-400 uppercase tracking-wider">Status</p>
                <div>
                    @if($langganan->status_langganan === 'aktif')
                        <span class="px-2.5 py-1 bg-emerald-500 text-white rounded-lg text-xs font-bold uppercase shadow-sm">Aktif</span>
                    @else
                        <span class="px-2.5 py-1 bg-rose-500 text-white rounded-lg text-xs font-bold uppercase shadow-sm">{{ $langganan->status_langganan }}</span>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
