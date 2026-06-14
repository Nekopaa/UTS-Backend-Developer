@extends('layouts.admin')

@section('title', 'Detail Laporan Penjualan')

@section('content')
<div class="max-w-3xl mx-auto space-y-6">
    <div>
        <a href="{{ route('laporan-penjualan.index') }}" class="inline-flex items-center px-4 py-2 bg-white text-slate-700 font-bold text-xs rounded-xl border border-slate-200 shadow-sm hover:bg-slate-50 transition-all gap-2">
            Kembali ke Daftar Laporan
        </a>
    </div>

    <div class="neo-brutal-card p-8 bg-white space-y-6">
        <div class="border-b border-slate-100 pb-4">
            <span class="text-xs font-bold uppercase text-indigo-500 tracking-wider">Laporan Penjualan</span>
            <h3 class="text-2xl font-bold text-slate-800">{{ $laporan->periode_laporan }}</h3>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="space-y-1">
                <p class="text-xs font-bold text-slate-400 uppercase tracking-wider">Total Transaksi</p>
                <p class="text-sm font-bold text-slate-800">{{ $laporan->total_transaksi }}</p>
            </div>

            <div class="space-y-1">
                <p class="text-xs font-bold text-slate-400 uppercase tracking-wider">Total Pendapatan</p>
                <p class="text-lg font-bold text-emerald-600">Rp {{ number_format($laporan->total_pendapatan, 0, ',', '.') }}</p>
            </div>

            <div class="space-y-1">
                <p class="text-xs font-bold text-slate-400 uppercase tracking-wider">Produk Terlaris</p>
                <p class="text-sm font-bold text-slate-800">{{ $laporan->produk_terlaris ?? '-' }}</p>
            </div>

            <div class="space-y-1">
                <p class="text-xs font-bold text-slate-400 uppercase tracking-wider">Tanggal Dibuat</p>
                <p class="text-sm font-bold text-slate-800">{{ $laporan->tanggal_dibuat }}</p>
            </div>
        </div>
    </div>
</div>
@endsection

