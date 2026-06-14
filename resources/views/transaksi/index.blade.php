@extends('layouts.admin')

@section('title', 'Riwayat Transaksi')

@section('content')
<div class="space-y-6">
    <p class="text-sm font-semibold text-slate-700">Pantau seluruh catatan transaksi, pembayaran, dan atur status pemrosesan pesanan pelanggan.</p>

    <!-- Table Container -->
    <div class="neo-brutal-card p-6 bg-white space-y-6">
        <div class="border-b-3 border-black pb-4 flex flex-col sm:flex-row sm:justify-between sm:items-center gap-4">
            <h3 class="text-xl font-black text-black">Daftar Transaksi Pelanggan</h3>
            <div class="flex gap-2">
                <span class="px-3 py-1 bg-[#4ade80] border-2 border-black rounded-lg text-xs font-black shadow-[1.5px_1.5px_0px_#000000]">
                    Berhasil: Rp {{ number_format($transaksi->whereIn('status_transaksi', ['dibayar', 'dikirim', 'selesai'])->sum('total_bayar'), 0, ',', '.') }}
                </span>
                <span class="px-3 py-1 bg-[#facc15] border-2 border-black rounded-lg text-xs font-black shadow-[1.5px_1.5px_0px_#000000]">
                    Total Catatan: {{ $transaksi->count() }}
                </span>
            </div>
        </div>

        @if($transaksi->count() > 0)
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="border-b-3 border-black text-xs font-black uppercase text-slate-400">
                        <th class="pb-3 pl-2">Invoice</th>
                        <th class="pb-3">Pelanggan</th>
                        <th class="pb-3">Tanggal</th>
                        <th class="pb-3">Total Bayar</th>
                        <th class="pb-3">Metode</th>
                        <th class="pb-3">Status Transaksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y-2 divide-black/10">
                    @foreach($transaksi as $tx)
                    <tr class="hover:bg-slate-50 transition-colors">
                        <!-- Invoice -->
                        <td class="py-4 pl-2 font-black text-sm">
                            <a href="{{ route('transaksi.show', $tx->id_transaksi) }}" class="text-blue-600 hover:underline">
                                {{ $tx->kode_invoice }}
                            </a>
                        </td>
                        
                        <!-- Pelanggan -->
                        <td class="py-4">
                            <div class="font-extrabold text-sm text-black">{{ $tx->pelanggan->nama_pelanggan ?? 'Umum' }}</div>
                            <div class="text-xs font-semibold text-slate-500">{{ $tx->pelanggan->no_telepon ?? '' }}</div>
                        </td>

                        <!-- Tanggal -->
                        <td class="py-4 font-semibold text-xs text-slate-600">
                            {{ $tx->tanggal_transaksi ? \Carbon\Carbon::parse($tx->tanggal_transaksi)->translatedFormat('d M Y, H:i') : ($tx->created_at ? $tx->created_at->translatedFormat('d M Y, H:i') : '-') }}
                        </td>

                        <!-- Total Bayar -->
                        <td class="py-4 font-black text-sm text-black">
                            Rp {{ number_format($tx->total_bayar, 0, ',', '.') }}
                        </td>

                        <!-- Metode Pembayaran -->
                        <td class="py-4 font-bold text-xs capitalize text-black">
                            💳 {{ $tx->metode_pembayaran }}
                        </td>

                        <!-- Status Badge -->
                        <td class="py-4">
                            @if($tx->status_transaksi === 'selesai')
                                <span class="px-2.5 py-1 bg-[#4ade80] border-2 border-black rounded-lg text-[10px] font-black uppercase shadow-[1.5px_1.5px_0px_#000000]">Selesai</span>
                            @elseif($tx->status_transaksi === 'dikirim')
                                <span class="px-2.5 py-1 bg-[#06b6d4] border-2 border-black rounded-lg text-[10px] font-black uppercase shadow-[1.5px_1.5px_0px_#000000]">Dikirim</span>
                            @elseif($tx->status_transaksi === 'dibayar')
                                <span class="px-2.5 py-1 bg-[#facc15] border-2 border-black rounded-lg text-[10px] font-black uppercase shadow-[1.5px_1.5px_0px_#000000]">Dibayar</span>
                            @elseif($tx->status_transaksi === 'dibatalkan')
                                <span class="px-2.5 py-1 bg-[#f43f5e] border-2 border-black rounded-lg text-[10px] font-black uppercase text-white shadow-[1.5px_1.5px_0px_#000000]">Batal</span>
                            @else
                                <span class="px-2.5 py-1 bg-slate-200 border-2 border-black rounded-lg text-[10px] font-black uppercase shadow-[1.5px_1.5px_0px_#000000]">Menunggu</span>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @else
        <div class="text-center py-12 space-y-4">
            <span class="text-6xl">🏜️</span>
            <h4 class="font-extrabold text-lg text-black">Aktivitas Transaksi Kosong</h4>
            <p class="text-sm font-semibold text-slate-500 max-w-sm mx-auto">Belum ada transaksi pembelian air mineral yang terdata.</p>
        </div>
        @endif
    </div>
</div>
@endsection