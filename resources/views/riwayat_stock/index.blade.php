@extends('layouts.admin')

@section('title', 'Log Mutasi Stok')

@section('content')
<div class="space-y-6">
    <p class="text-sm font-semibold text-slate-700">Audit trail riwayat penambahan atau pengurangan stok untuk setiap katalog air mineral.</p>

    <!-- Table Container -->
    <div class="neo-brutal-card p-6 bg-white space-y-6">
        <div class="border-b border-slate-100 pb-4 flex justify-between items-center">
            <h3 class="text-xl font-extrabold text-slate-800">Log Perubahan Inventaris</h3>
            <span class="px-3 py-1.5 bg-slate-100 border border-slate-200 text-slate-600 rounded-lg text-xs font-bold">
                Total Catatan: {{ $riwayat->count() }}
            </span>
        </div>

        @if($riwayat->count() > 0)
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="border-b border-slate-100 text-xs font-bold uppercase text-slate-500">
                        <th class="pb-3 pl-2">Tanggal</th>
                        <th class="pb-3">Produk</th>
                        <th class="pb-3 text-center">Tipe Perubahan</th>
                        <th class="pb-3 text-center">Jumlah</th>
                        <th class="pb-3">Keterangan</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @foreach($riwayat as $r)
                    <tr class="hover:bg-slate-50 transition-colors">
                        <td class="py-4 pl-2 font-extrabold text-sm text-slate-700">
                            {{ $r->tanggal_perubahan ? \Carbon\Carbon::parse($r->tanggal_perubahan)->translatedFormat('d M Y, H:i') : ($r->created_at ? $r->created_at->translatedFormat('d M Y, H:i') : '-') }}
                        </td>
                        <td class="py-4">
                            <div class="font-extrabold text-sm text-slate-800">{{ $r->produk->nama_produk ?? 'Produk Dihapus' }}</div>
                            <div class="text-[10px] font-bold text-slate-400 uppercase">{{ $r->produk->jenis_kemasan ?? '' }} ({{ $r->produk->kapasitas ?? '' }})</div>
                        </td>
                        <td class="py-4 text-center">
                            @if(in_array(strtolower($r->jenis_perubahan), ['penambahan', 'tambah', 'in']))
                                <span class="px-2.5 py-1 bg-emerald-500 text-white rounded-lg text-[10px] font-bold uppercase shadow-sm">
                                    Masuk
                                </span>
                            @else
                                <span class="px-2.5 py-1 bg-rose-500 text-white rounded-lg text-[10px] font-bold uppercase shadow-sm">
                                    Keluar
                                </span>
                            @endif
                        </td>
                        <td class="py-4 text-center font-bold text-sm text-slate-800">
                            {{ $r->jumlah }} Unit
                        </td>
                        <td class="py-4 font-semibold text-xs text-slate-600 leading-relaxed max-w-xs">
                            {{ $r->keterangan ?? '-' }}
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
            <h4 class="font-extrabold text-lg text-slate-800">Log Mutasi Kosong</h4>
            <p class="text-sm font-semibold text-slate-500 max-w-sm mx-auto">Belum ada aktivitas penambahan or pengurangan inventaris produk air mineral.</p>
        </div>
        @endif
    </div>
</div>
@endsection
