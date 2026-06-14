@extends('layouts.admin')

@section('title', 'Siklus Paket Langganan')

@section('content')
<div class="space-y-6">
    <p class="text-sm font-semibold text-slate-700">Daftar pelanggan Rindu Water yang mengaktifkan siklus pengantaran otomatis secara berkala.</p>

    <!-- Table Container -->
    <div class="neo-brutal-card p-6 bg-white space-y-6">
        <div class="border-b border-slate-100 pb-4 flex flex-col sm:flex-row sm:justify-between sm:items-center gap-4">
            <h3 class="text-xl font-extrabold text-slate-850">Aktivitas Paket Langganan</h3>
            <div class="flex gap-2">
                <span class="px-3 py-1.5 bg-gradient-to-tr from-cyan-500 to-cyan-400 text-white rounded-lg text-xs font-bold shadow-sm shadow-cyan-500/10">
                    Langganan Aktif: {{ $langganan->where('status_langganan', 'aktif')->count() }}
                </span>
            </div>
        </div>

        @if($langganan->count() > 0)
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="border-b border-slate-100 text-xs font-bold uppercase text-slate-500">
                        <th class="pb-3 pl-2">Pelanggan</th>
                        <th class="pb-3">Produk Air</th>
                        <th class="pb-3 text-center">Siklus</th>
                        <th class="pb-3 text-center">Qty / Pengiriman</th>
                        <th class="pb-3">Rentang Tanggal</th>
                        <th class="pb-3">Status</th>
                        <th class="pb-3 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @foreach($langganan as $lang)
                    <tr class="hover:bg-slate-50 transition-colors">
                        <!-- Pelanggan -->
                        <td class="py-4 pl-2">
                            <div class="font-extrabold text-sm text-slate-800">{{ $lang->pelanggan->nama_pelanggan ?? 'Umum' }}</div>
                            <div class="text-[10px] font-bold text-slate-400">{{ $lang->pelanggan->no_telepon ?? '' }}</div>
                        </td>

                        <!-- Produk Air -->
                        <td class="py-4">
                            <div class="font-extrabold text-sm text-slate-800">{{ $lang->produk->nama_produk ?? 'Air Mineral' }}</div>
                            <div class="text-[10px] font-bold text-slate-400 uppercase">
                                {{ $lang->produk->jenis_kemasan ?? '' }} ({{ $lang->produk->kapasitas ?? '' }})
                            </div>
                        </td>

                        <!-- Siklus Periode -->
                        <td class="py-4 text-center">
                            @if(strtolower($lang->periode_pengantaran) === 'mingguan')
                                <span class="px-2.5 py-1 bg-yellow-400 text-slate-800 rounded-lg text-[10px] font-bold uppercase shadow-sm shadow-yellow-400/10">
                                    Mingguan
                                </span>
                            @elseif(strtolower($lang->periode_pengantaran) === 'bulanan')
                                <span class="px-2.5 py-1 bg-indigo-500 text-white rounded-lg text-[10px] font-bold uppercase shadow-sm shadow-indigo-500/10">
                                    Bulanan
                                </span>
                            @else
                                <span class="px-2.5 py-1 bg-slate-100 text-slate-650 rounded-lg text-[10px] font-bold uppercase shadow-sm">
                                    {{ $lang->periode_pengantaran }}
                                </span>
                            @endif
                        </td>

                        <!-- Qty -->
                        <td class="py-4 text-center font-bold text-sm text-slate-800">
                            {{ $lang->jumlah_pesanan }} {{ ucfirst($lang->produk->jenis_kemasan ?? 'Unit') }}
                        </td>

                        <!-- Rentang Tanggal -->
                        <td class="py-4 font-semibold text-xs text-slate-600">
                            <div>Mulai: {{ \Carbon\Carbon::parse($lang->tanggal_mulai)->translatedFormat('d M Y') }}</div>
                            <div class="text-[10px] font-bold text-slate-400 mt-0.5">Selesai: {{ \Carbon\Carbon::parse($lang->tanggal_berakhir)->translatedFormat('d M Y') }}</div>
                        </td>

                        <!-- Status Badge -->
                        <td class="py-4">
                            @if(strtolower($lang->status_langganan) === 'aktif')
                                <span class="px-2.5 py-1 bg-emerald-500 text-white rounded-lg text-[10px] font-bold uppercase shadow-sm">
                                    Aktif
                                </span>
                            @elseif(strtolower($lang->status_langganan) === 'selesai')
                                <span class="px-2.5 py-1 bg-cyan-500 text-white rounded-lg text-[10px] font-bold uppercase shadow-sm">
                                    Selesai
                                </span>
                            @else
                                <span class="px-2.5 py-1 bg-rose-500 text-white rounded-lg text-[10px] font-bold uppercase shadow-sm">
                                    Tidak Aktif
                                </span>
                            @endif
                        </td>

                        <!-- Aksi -->
                        <td class="py-4 text-center whitespace-nowrap space-x-1">
                            <a href="{{ route('langganan.show', $lang->id_langganan) }}" class="inline-flex items-center px-2.5 py-1.5 bg-gradient-to-tr from-cyan-500 to-cyan-400 text-white rounded-lg text-[10px] font-bold shadow-sm hover:scale-105 active:scale-95 transition-all">
                                Detail
                            </a>
                            <a href="{{ route('langganan.edit', $lang->id_langganan) }}" class="inline-flex items-center px-2.5 py-1.5 bg-gradient-to-tr from-amber-400 to-amber-300 text-slate-800 rounded-lg text-[10px] font-bold shadow-sm hover:scale-105 active:scale-95 transition-all">
                                Edit
                            </a>
                            <form action="{{ route('langganan.destroy', $lang->id_langganan) }}" method="POST" class="inline-block" onsubmit="return confirm('Apakah Anda yakin ingin menghapus langganan ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="inline-flex items-center px-2.5 py-1.5 bg-gradient-to-tr from-rose-500 to-rose-400 text-white rounded-lg text-[10px] font-bold shadow-sm hover:scale-105 active:scale-95 transition-all">
                                    Hapus
                                </button>
                            </form>
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
                    <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
            </div>
            <h4 class="font-extrabold text-lg text-slate-800">Daftar Langganan Kosong</h4>
            <p class="text-sm font-semibold text-slate-500 max-w-sm mx-auto">Belum ada pelanggan yang membeli paket langganan air mineral mingguan atau bulanan.</p>
        </div>
        @endif
    </div>
</div>
@endsection
