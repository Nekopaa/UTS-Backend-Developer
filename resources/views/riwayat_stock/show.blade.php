@extends('layouts.admin')

@section('title', 'Detail Riwayat Stock')

@section('content')
<div class="max-w-3xl mx-auto space-y-6">
    <div>
        <a href="{{ route('riwayat-stock.index') }}" class="inline-flex items-center px-4 py-2 bg-white border border-slate-200 rounded-xl font-bold text-xs text-slate-700 shadow-sm hover:translate-y-[-1px] transition-all mb-6">
            Kembali ke Riwayat Stock
        </a>
    </div>

    <div class="neo-brutal-card p-8 bg-white space-y-6">
        <div class="border-b border-slate-100 pb-4">
            <span class="text-xs font-bold uppercase text-indigo-600 tracking-wider">Riwayat Perubahan Stok</span>
            <h3 class="text-2xl font-extrabold text-slate-800">Riwayat #{{ $riwayat->id_riwayat }}</h3>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="space-y-1">
                <p class="text-xs font-bold text-slate-400 uppercase tracking-wider">Produk</p>
                <p class="text-sm font-extrabold text-slate-700">{{ $riwayat->produk->nama_produk ?? 'ID: ' . $riwayat->id_produk }}</p>
            </div>

            <div class="space-y-1">
                <p class="text-xs font-bold text-slate-400 uppercase tracking-wider">Jenis Perubahan</p>
                <div>
                    @if(strtolower($riwayat->jenis_perubahan) === 'masuk')
                        <span class="px-2.5 py-1 bg-emerald-500 text-white rounded-lg text-[10px] font-bold uppercase shadow-sm">Masuk</span>
                    @else
                        <span class="px-2.5 py-1 bg-rose-500 text-white rounded-lg text-[10px] font-bold uppercase shadow-sm">Keluar</span>
                    @endif
                </div>
            </div>

            <div class="space-y-1">
                <p class="text-xs font-bold text-slate-400 uppercase tracking-wider">Jumlah</p>
                <p class="text-lg font-extrabold text-slate-800">{{ $riwayat->jumlah }} Unit</p>
            </div>

            <div class="space-y-1">
                <p class="text-xs font-bold text-slate-400 uppercase tracking-wider">Tanggal Perubahan</p>
                <p class="text-sm font-extrabold text-slate-700">{{ $riwayat->tanggal_perubahan }}</p>
            </div>
        </div>

        <div class="space-y-1 border-t border-slate-100 pt-4">
            <p class="text-xs font-bold text-slate-400 uppercase tracking-wider">Keterangan</p>
            <p class="text-sm font-semibold text-slate-600 leading-relaxed">{{ $riwayat->keterangan ?? 'Tidak ada keterangan' }}</p>
        </div>
    </div>
</div>
@endsection
