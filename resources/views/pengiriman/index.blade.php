@extends('layouts.admin')

@section('title', 'Status Pengiriman')

@section('content')
<div class="space-y-6">
    <p class="text-sm font-semibold text-slate-700">Pantau proses pengiriman pesanan air mineral dan tugaskan kurir pengantar.</p>

    <!-- Table Container -->
    <div class="neo-brutal-card p-6 bg-white space-y-6">
        <div class="border-b border-slate-100 pb-4 flex flex-col sm:flex-row sm:justify-between sm:items-center gap-4">
            <h3 class="text-xl font-extrabold text-slate-850">Registry Pengiriman Barang</h3>
            <div class="flex gap-2">
                <span class="px-3 py-1.5 bg-gradient-to-tr from-indigo-500 to-indigo-400 text-white rounded-lg text-xs font-bold shadow-sm shadow-indigo-500/10">
                    Dalam Pengiriman: {{ $pengiriman->where('status_pengiriman', 'dalam perjalanan')->count() }}
                </span>
                <span class="px-3 py-1.5 bg-slate-100 border border-slate-200 text-slate-700 rounded-lg text-xs font-bold shadow-sm">
                    Total Catatan: {{ $pengiriman->count() }}
                </span>
            </div>
        </div>

        @if($pengiriman->count() > 0)
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="border-b border-slate-100 text-xs font-bold uppercase text-slate-500">
                        <th class="pb-3 pl-2">Invoice / Ref</th>
                        <th class="pb-3">Kurir Ditugaskan</th>
                        <th class="pb-3">Alamat Tujuan</th>
                        <th class="pb-3">Tanggal Kirim</th>
                        <th class="pb-3">Status Pengiriman</th>
                        <th class="pb-3">Bukti</th>
                        <th class="pb-3 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @foreach($pengiriman as $ship)
                    <tr class="hover:bg-slate-50 transition-colors">
                        <!-- Ref / Invoice -->
                        <td class="py-4 pl-2 font-bold text-sm">
                            <a href="{{ route('pengiriman.show', $ship->id_pengiriman) }}" class="text-indigo-650 hover:text-indigo-850 hover:underline">
                                {{ $ship->transaksi->kode_invoice ?? 'REF-' . $ship->id_pengiriman }}
                            </a>
                            @if(isset($ship->transaksi->pelanggan))
                                <div class="text-[10px] font-bold text-slate-500 mt-0.5">Pelanggan: {{ $ship->transaksi->pelanggan->nama_pelanggan }}</div>
                            @endif
                        </td>

                        <!-- Kurir -->
                        <td class="py-4">
                            @if($ship->kurir)
                                <div class="font-extrabold text-sm text-slate-800 flex items-center gap-1.5">
                                    <span>{{ $ship->kurir->nama_kurir }}</span>
                                </div>
                                <div class="text-[10px] font-bold text-slate-400 mt-0.5">{{ $ship->kurir->kendaraan }} ({{ $ship->kurir->plat_nomor }})</div>
                            @else
                                <span class="px-2 py-0.5 bg-rose-50 border border-rose-100 rounded text-[10px] font-bold text-rose-600">Belum Ditugaskan</span>
                            @endif
                        </td>

                        <!-- Alamat -->
                        <td class="py-4 font-semibold text-xs text-slate-700 max-w-xs truncate">
                            {{ $ship->alamat_tujuan }}
                        </td>

                        <!-- Tanggal -->
                        <td class="py-4 font-bold text-xs text-slate-500">
                            {{ $ship->tanggal_pengiriman ? \Carbon\Carbon::parse($ship->tanggal_pengiriman)->translatedFormat('d M Y') : '-' }}
                        </td>

                        <!-- Status Badge -->
                        <td class="py-4">
                            @if($ship->status_pengiriman === 'terkirim')
                                <span class="px-2.5 py-1 bg-emerald-500 text-white rounded-lg text-[10px] font-bold uppercase shadow-sm">Tiba</span>
                            @elseif($ship->status_pengiriman === 'dalam perjalanan')
                                <span class="px-2.5 py-1 bg-cyan-500 text-white rounded-lg text-[10px] font-bold uppercase shadow-sm">Jalan</span>
                            @elseif($ship->status_pengiriman === 'gagal')
                                <span class="px-2.5 py-1 bg-rose-500 text-white rounded-lg text-[10px] font-bold uppercase shadow-sm">Gagal</span>
                            @else
                                <span class="px-2.5 py-1 bg-slate-100 border border-slate-200 text-slate-650 rounded-lg text-[10px] font-bold uppercase shadow-sm">Proses</span>
                            @endif
                        </td>

                        <!-- Bukti Foto -->
                        <td class="py-4">
                            @if($ship->foto_bukti_pengiriman)
                                <a href="{{ asset('storage/' . $ship->foto_bukti_pengiriman) }}" target="_blank" class="text-xs font-bold text-indigo-650 hover:text-indigo-850 hover:underline inline-flex items-center gap-1">
                                    <svg class="w-3.5 h-3.5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6.827 6.175A2.31 2.31 0 0 1 5.186 7.23c-.38.054-.757.112-1.134.175C2.999 7.58 2.25 8.507 2.25 9.574V18a2.25 2.25 0 0 0 2.25 2.25h15A2.25 2.25 0 0 0 21.75 18V9.574c0-1.067-.75-1.994-1.802-2.169a47.865 47.865 0 0 0-1.134-.175 2.31 2.31 0 0 1-1.64-1.055l-.822-1.316a2.192 2.192 0 0 0-1.736-1.039 48.774 48.774 0 0 0-5.232 0 2.192 2.192 0 0 0-1.736 1.039l-.821 1.316Z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 12.75a4.5 4.5 0 1 1-9 0 4.5 4.5 0 0 1 9 0ZM18.75 10.5h.008v.008h-.008V10.5Z" />
                                    </svg>
                                    <span>Lihat Foto</span>
                                </a>
                            @else
                                <span class="text-xs font-semibold text-slate-400">Tidak Ada</span>
                            @endif
                        </td>

                        <!-- Actions Link -->
                        <td class="py-4 text-center">
                            <a href="{{ route('pengiriman.show', $ship->id_pengiriman) }}" class="inline-flex items-center px-2.5 py-1.5 bg-gradient-to-tr from-cyan-500 to-cyan-400 text-white rounded-lg text-[10px] font-bold shadow-sm hover:scale-105 active:scale-95 transition-all gap-1">
                                <svg class="w-3.5 h-3.5 text-white shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                </svg>
                                <span>Detail</span>
                            </a>
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
                    <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 7.5l-.625 10.632a2.25 2.25 0 0 1-2.247 2.118H6.622a2.25 2.25 0 0 1-2.247-2.118L3.75 7.5M10 11.25h4M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125Z" />
                </svg>
            </div>
            <h4 class="font-extrabold text-lg text-slate-800">Aktivitas Pengiriman Kosong</h4>
            <p class="text-sm font-semibold text-slate-500 max-w-sm mx-auto">Belum ada pengiriman barang yang sedang dijadwalkan.</p>
        </div>
        @endif
    </div>
</div>
@endsection
