@extends('layouts.admin')

@section('title', 'Riwayat Transaksi')

@section('content')
<div class="space-y-6">
    <p class="text-sm font-semibold text-slate-700">Pantau seluruh catatan transaksi, pembayaran, dan atur status pemrosesan pesanan pelanggan.</p>

    <!-- Table Container -->
    <div class="neo-brutal-card p-6 bg-white space-y-6">
        <div class="border-b border-slate-100 pb-4 flex flex-col sm:flex-row sm:justify-between sm:items-center gap-4">
            <h3 class="text-xl font-extrabold text-slate-800">Daftar Transaksi Pelanggan</h3>
            <div class="flex gap-2">
                <span class="px-3 py-1.5 bg-emerald-500 text-white rounded-lg text-xs font-bold shadow-sm shadow-emerald-500/10">
                    Berhasil: Rp {{ number_format($transaksi->whereIn('status_transaksi', ['dibayar', 'dikirim', 'selesai'])->sum('total_bayar'), 0, ',', '.') }}
                </span>
                <span class="px-3 py-1.5 bg-gradient-to-tr from-yellow-400 to-yellow-300 text-slate-800 rounded-lg text-xs font-bold shadow-sm shadow-yellow-400/10">
                    Total Catatan: {{ $transaksi->count() }}
                </span>
            </div>
        </div>

        @if($transaksi->count() > 0)
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="border-b border-slate-100 text-xs font-bold uppercase text-slate-500">
                        <th class="pb-3 pl-2">Invoice</th>
                        <th class="pb-3">Pelanggan</th>
                        <th class="pb-3">Tanggal</th>
                        <th class="pb-3">Total Bayar</th>
                        <th class="pb-3">Metode</th>
                        <th class="pb-3">Status Transaksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @foreach($transaksi as $tx)
                    <tr class="hover:bg-slate-50 transition-colors">
                        <!-- Invoice -->
                        <td class="py-4 pl-2 font-bold text-sm">
                            <a href="{{ route('transaksi.show', $tx->id_transaksi) }}" class="text-indigo-600 hover:text-indigo-800 hover:underline">
                                {{ $tx->kode_invoice }}
                            </a>
                        </td>
                        
                        <!-- Pelanggan -->
                        <td class="py-4">
                            <div class="font-extrabold text-sm text-slate-800">{{ $tx->pelanggan->nama_pelanggan ?? 'Umum' }}</div>
                            <div class="text-xs font-semibold text-slate-500">{{ $tx->pelanggan->no_telepon ?? '' }}</div>
                        </td>

                        <!-- Tanggal -->
                        <td class="py-4 font-semibold text-xs text-slate-600">
                            {{ $tx->tanggal_transaksi ? \Carbon\Carbon::parse($tx->tanggal_transaksi)->translatedFormat('d M Y, H:i') : ($tx->created_at ? $tx->created_at->translatedFormat('d M Y, H:i') : '-') }}
                        </td>

                        <!-- Total Bayar -->
                        <td class="py-4 font-bold text-sm text-slate-800">
                            Rp {{ number_format($tx->total_bayar, 0, ',', '.') }}
                        </td>

                        <!-- Metode Pembayaran -->
                        <td class="py-4 font-bold text-xs capitalize text-slate-700">
                            {{ $tx->metode_pembayaran }}
                        </td>

                        <!-- Status Badge -->
                        <td class="py-4">
                            @if($tx->status_transaksi === 'selesai')
                                <span class="px-2.5 py-1 bg-emerald-500 text-white rounded-lg text-[10px] font-bold uppercase shadow-sm">Selesai</span>
                            @elseif($tx->status_transaksi === 'dikirim')
                                <span class="px-2.5 py-1 bg-cyan-500 text-white rounded-lg text-[10px] font-bold uppercase shadow-sm">Dikirim</span>
                            @elseif($tx->status_transaksi === 'dibayar')
                                <span class="px-2.5 py-1 bg-amber-400 text-slate-800 rounded-lg text-[10px] font-bold uppercase shadow-sm">Dibayar</span>
                            @elseif($tx->status_transaksi === 'dibatalkan')
                                <span class="px-2.5 py-1 bg-rose-500 text-white rounded-lg text-[10px] font-bold uppercase shadow-sm">Batal</span>
                            @else
                                <span class="px-2.5 py-1 bg-slate-100 border border-slate-200 text-slate-600 rounded-lg text-[10px] font-bold uppercase shadow-sm">Menunggu</span>
                            @endif
                        </td>

                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @else
        <div class="text-center py-12 space-y-4">
            <div class="flex justify-center text-slate-400">
                <svg class="w-16 h-16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                </svg>
            </div>
            <h4 class="font-extrabold text-lg text-slate-800">Aktivitas Transaksi Kosong</h4>
            <p class="text-sm font-semibold text-slate-500 max-w-sm mx-auto">Belum ada transaksi pembelian air mineral yang terdata.</p>
        </div>
        @endif
    </div>
</div>
@endsection
