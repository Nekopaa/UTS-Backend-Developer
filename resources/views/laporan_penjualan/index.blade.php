@extends('layouts.admin')

@section('title', 'Laporan Keuangan & Penjualan')

@section('content')
<div class="space-y-6">
    <p class="text-sm font-semibold text-slate-500">Rangkuman performa penjualan air mineral Rindu Water berdasarkan periode pembukuan aktif.</p>

    <!-- Metrics row -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <!-- Sales Volume -->
        <div class="p-6 bg-gradient-to-tr from-pink-500 to-pink-400 text-white rounded-2xl shadow-sm shadow-pink-500/10 hover:translate-y-[-2px] transition-all duration-300 flex justify-between items-center min-h-[8rem]">
            <div>
                <span class="text-xs font-bold uppercase text-pink-100/90 tracking-wider">Total Volume Buku</span>
                <h3 class="text-2xl lg:text-3xl font-extrabold mt-2">{{ $laporan->count() }} Laporan</h3>
                <p class="text-[10px] font-medium text-pink-100/80 mt-1">Periode laporan keuangan tercatat</p>
            </div>
            <div class="p-2 rounded-lg bg-white/20 backdrop-blur-sm font-bold shrink-0 text-white flex items-center justify-center border border-white/10">
                <svg class="w-5 h-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                </svg>
            </div>
        </div>

        <!-- Accrued Revenue -->
        <div class="p-6 bg-gradient-to-tr from-emerald-500 to-emerald-400 text-white rounded-2xl shadow-sm shadow-emerald-500/10 hover:translate-y-[-2px] transition-all duration-300 flex justify-between items-center min-h-[8rem]">
            <div>
                <span class="text-xs font-bold uppercase text-emerald-100/90 tracking-wider">Akumulasi Omset Buku</span>
                <h3 class="text-2xl lg:text-3xl font-extrabold mt-2">Rp {{ number_format($laporan->sum('total_pendapatan'), 0, ',', '.') }}</h3>
                <p class="text-[10px] font-medium text-emerald-100/80 mt-1">Total seluruh pendapatan laporan</p>
            </div>
            <div class="p-2 rounded-lg bg-white/20 backdrop-blur-sm font-bold shrink-0 text-white flex items-center justify-center border border-white/10">
                <svg class="w-5 h-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M12 16v1" />
                </svg>
            </div>
        </div>

        <!-- Accrued Transactions -->
        <div class="p-6 bg-gradient-to-tr from-amber-400 to-amber-300 text-slate-800 rounded-2xl shadow-sm shadow-amber-400/10 hover:translate-y-[-2px] transition-all duration-300 flex justify-between items-center min-h-[8rem]">
            <div>
                <span class="text-xs font-bold uppercase text-slate-700/80 tracking-wider">Akumulasi Transaksi Buku</span>
                <h3 class="text-2xl lg:text-3xl font-extrabold mt-2">{{ $laporan->sum('total_transaksi') }} Order</h3>
                <p class="text-[10px] font-medium text-slate-700/80 mt-1">Total volume order tercatat</p>
            </div>
            <div class="p-2 rounded-lg bg-white/40 backdrop-blur-sm font-bold shrink-0 text-slate-800 flex items-center justify-center border border-white/20">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                </svg>
            </div>
        </div>
    </div>

    <!-- Table Container -->
    <div class="neo-brutal-card p-6 bg-white space-y-6">
        <div class="border-b border-slate-100 pb-4 flex justify-between items-center">
            <h3 class="text-xl font-bold text-slate-800">Arsip Laporan Penjualan</h3>
        </div>

        @if($laporan->count() > 0)
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="border-b border-slate-200 text-xs font-bold uppercase text-slate-400">
                        <th class="pb-3 pl-2">Periode Laporan</th>
                        <th class="pb-3">Tanggal Dibuat</th>
                        <th class="pb-3 text-center">Jumlah Transaksi</th>
                        <th class="pb-3">Total Pendapatan</th>
                        <th class="pb-3">Produk Terlaris</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @foreach($laporan as $lap)
                    <tr class="hover:bg-slate-50/50 transition-colors">
                        <!-- Periode -->
                        <td class="py-4 pl-2 font-bold text-sm text-slate-800">
                            {{ $lap->periode_laporan }}
                        </td>

                        <!-- Tanggal Dibuat -->
                        <td class="py-4 font-semibold text-xs text-slate-500">
                            {{ $lap->tanggal_dibuat ? \Carbon\Carbon::parse($lap->tanggal_dibuat)->translatedFormat('d M Y') : ($lap->created_at ? $lap->created_at->translatedFormat('d M Y') : '-') }}
                        </td>

                        <!-- Qty Transaksi -->
                        <td class="py-4 text-center font-bold text-sm text-slate-800">
                            {{ $lap->total_transaksi }} Order
                        </td>

                        <!-- Total Pendapatan -->
                        <td class="py-4 font-bold text-sm text-slate-800">
                            Rp {{ number_format($lap->total_pendapatan, 0, ',', '.') }}
                        </td>

                        <!-- Produk Terlaris -->
                        <td class="py-4 font-bold text-xs text-indigo-600">
                            {{ $lap->produk_terlaris ?? '-' }}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @else
        <div class="text-center py-12 space-y-4">
            <div class="w-12 h-12 rounded-full bg-slate-100 flex items-center justify-center mx-auto text-slate-400">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                </svg>
            </div>
            <h4 class="font-bold text-lg text-slate-800">Arsip Laporan Kosong</h4>
            <p class="text-sm font-semibold text-slate-500 max-w-sm mx-auto">Belum ada arsip laporan bulanan atau tahunan yang dibuat.</p>
        </div>
        @endif
    </div>
</div>
@endsection

