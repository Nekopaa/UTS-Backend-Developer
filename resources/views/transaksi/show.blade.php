@extends('layouts.admin')

@section('title', 'Detail Invoice')

@section('content')
<div class="max-w-3xl mx-auto space-y-6">
    
    <!-- Actions -->
    <div class="flex justify-between items-center">
        <a href="{{ route('transaksi.index') }}" class="inline-flex items-center px-4 py-2 bg-white border border-slate-200 rounded-xl font-bold text-xs text-slate-700 shadow-sm hover:translate-y-[-1px] transition-all gap-2">
            Daftar Transaksi
        </a>
        <button onclick="window.print()" class="inline-flex items-center px-4 py-2 bg-gradient-to-tr from-cyan-500 to-cyan-400 text-white rounded-xl font-bold text-xs shadow-sm hover:translate-y-[-1px] transition-all gap-2">
            Cetak Invoice
        </button>
    </div>

    <!-- Invoice Sheet -->
    <div class="neo-brutal-card p-8 bg-white border border-slate-200/80 space-y-8" id="printable-area">
        
        <!-- Header -->
        <div class="flex flex-col md:flex-row justify-between gap-6 border-b border-slate-100 pb-6">
            <div class="space-y-2">
                <span class="px-3 py-1 bg-amber-100 text-amber-800 rounded-md text-[10px] font-bold uppercase shadow-sm border border-amber-200/30">
                    Rindu Water Delivery
                </span>
                <h2 class="text-3xl font-extrabold text-slate-800">INVOICE</h2>
                <p class="text-sm font-bold text-indigo-600">{{ $transaksi->kode_invoice }}</p>
            </div>
            
            <div class="text-left md:text-right space-y-1">
                <p class="text-xs font-bold text-slate-400 uppercase">Tanggal Transaksi</p>
                <p class="text-sm font-extrabold text-slate-800">
                    {{ $transaksi->tanggal_transaksi ? \Carbon\Carbon::parse($transaksi->tanggal_transaksi)->translatedFormat('d F Y, H:i') : ($transaksi->created_at ? $transaksi->created_at->translatedFormat('d F Y, H:i') : '-') }}
                </p>
                <div class="pt-2">
                    @if($transaksi->status_transaksi === 'selesai')
                        <span class="px-2.5 py-1 bg-emerald-500 text-white rounded-lg text-xs font-bold uppercase shadow-sm">Selesai</span>
                    @elseif($transaksi->status_transaksi === 'dikirim')
                        <span class="px-2.5 py-1 bg-cyan-500 text-white rounded-lg text-xs font-bold uppercase shadow-sm">Dikirim</span>
                    @elseif($transaksi->status_transaksi === 'dibayar')
                        <span class="px-2.5 py-1 bg-amber-400 text-slate-800 rounded-lg text-xs font-bold uppercase shadow-sm">Dibayar</span>
                    @elseif($transaksi->status_transaksi === 'dibatalkan')
                        <span class="px-2.5 py-1 bg-rose-500 text-white rounded-lg text-xs font-bold uppercase shadow-sm">Batal</span>
                    @else
                        <span class="px-2.5 py-1 bg-slate-100 border border-slate-200 text-slate-600 rounded-lg text-xs font-bold uppercase shadow-sm">Menunggu</span>
                    @endif
                </div>
            </div>
        </div>

        <!-- Profiles Split -->
        <div class="flex flex-col sm:flex-row justify-between gap-8 border-b border-slate-100 pb-6">
            <!-- Pelanggan Info -->
            <div class="space-y-3 sm:w-1/2">
                <h4 class="text-xs font-bold text-slate-400 uppercase tracking-wider">Ditagihkan Kepada:</h4>
                <div class="space-y-1">
                    <p class="font-extrabold text-base text-slate-800">{{ $transaksi->pelanggan->nama_pelanggan ?? 'Umum' }}</p>
                    <p class="text-xs font-semibold text-slate-600">No. Telepon: {{ $transaksi->pelanggan->no_telepon ?? '' }}</p>
                    <p class="text-xs font-semibold text-slate-600">Email: {{ $transaksi->pelanggan->email ?? '-' }}</p>
                    <p class="text-xs font-bold text-slate-500 leading-relaxed pt-1">
                        Alamat: {{ $transaksi->pelanggan->alamat ?? '-' }}
                    </p>
                </div>
            </div>

            <!-- Payment Details -->
            <div class="space-y-3 sm:w-1/2">
                <h4 class="text-xs font-bold text-slate-400 uppercase tracking-wider">Rincian Pembayaran:</h4>
                <div class="space-y-1.5">
                    <div class="flex justify-between text-xs">
                        <span class="font-semibold text-slate-500">Metode Pembayaran:</span>
                        <span class="font-bold text-slate-800 capitalize">{{ $transaksi->metode_pembayaran }}</span>
                    </div>
                    <div class="flex justify-between text-xs">
                        <span class="font-semibold text-slate-500">Siklus Transaksi:</span>
                        <span class="font-bold text-slate-800">
                            {{ $transaksi->id_langganan ? 'Paket Berlangganan' : 'Pemesanan Sekali Beli' }}
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Itemized Table -->
        <div class="space-y-4">
            <h4 class="text-xs font-bold text-slate-400 uppercase tracking-wider">Item Pesanan:</h4>
            
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="border-b border-slate-200 text-xs font-bold text-slate-500 pb-2">
                            <th>Deskripsi Produk</th>
                            <th class="text-center">Jumlah</th>
                            <th class="text-right">Harga Satuan</th>
                            <th class="text-right pl-4">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($transaksi->detailPesanan)
                        <tr class="font-semibold text-sm">
                            <td class="py-4">
                                <div class="font-extrabold text-slate-800">{{ $transaksi->detailPesanan->produk->nama_produk ?? 'Produk Air Mineral' }}</div>
                                <div class="text-[10px] font-bold text-slate-400 uppercase">
                                    {{ $transaksi->detailPesanan->produk->jenis_kemasan ?? '' }} ({{ $transaksi->detailPesanan->produk->kapasitas ?? '' }})
                                </div>
                            </td>
                            <td class="py-4 text-center font-bold text-slate-700">
                                {{ $transaksi->detailPesanan->jumlah }} Unit
                            </td>
                            <td class="py-4 text-right text-slate-600">
                                Rp {{ number_format($transaksi->detailPesanan->harga_satuan, 0, ',', '.') }}
                            </td>
                            <td class="py-4 text-right font-extrabold text-slate-800 pl-4">
                                Rp {{ number_format($transaksi->detailPesanan->jumlah * $transaksi->detailPesanan->harga_satuan, 0, ',', '.') }}
                            </td>
                        </tr>
                        @else
                        <tr>
                            <td colspan="4" class="py-4 text-center text-xs font-bold text-slate-400">Tidak ada rincian item untuk pesanan ini.</td>
                        </tr>
                        @endif
                    </tbody>
                </table>
            </div>

            <!-- Total Sheet -->
            <div class="flex justify-end pt-4 border-t border-slate-100">
                <div class="w-full md:w-80 space-y-2">
                    <div class="flex justify-between items-center text-xs">
                        <span class="font-semibold text-slate-500">Subtotal:</span>
                        <span class="font-bold text-slate-800">
                            Rp {{ number_format($transaksi->total_bayar, 0, ',', '.') }}
                        </span>
                    </div>
                    <div class="flex justify-between items-center text-xs">
                        <span class="font-semibold text-slate-500">Biaya Pengiriman:</span>
                        <span class="font-bold text-emerald-600 uppercase text-[10px] pl-2">Gratis Ongkir</span>
                    </div>
                    <div class="h-px bg-slate-200 my-2"></div>
                    <div class="flex justify-between items-center">
                        <span class="font-extrabold text-sm text-slate-800">Total Pembayaran:</span>
                        <span class="font-extrabold text-lg text-slate-850">
                            Rp {{ number_format($transaksi->total_bayar, 0, ',', '.') }}
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Notes -->
        @if($transaksi->catatan)
        <div class="p-4 bg-slate-50 border border-slate-200 rounded-xl space-y-1">
            <h5 class="text-xs font-bold text-slate-700">Catatan Pembeli:</h5>
            <p class="text-xs font-semibold text-slate-600 leading-relaxed">{{ $transaksi->catatan }}</p>
        </div>
        @endif
    </div>

    <!-- Status Process Card for Admin -->
    <div class="neo-brutal-card p-6 bg-white space-y-4">
        <h4 class="font-extrabold text-sm text-slate-800">Perbarui Status Pemrosesan</h4>
        <form action="{{ route('transaksi.update', $transaksi->id_transaksi) }}" method="POST" class="flex flex-col sm:flex-row gap-4">
            @csrf
            @method('PUT')
            
            <div class="flex-1">
                <select name="status_transaksi" class="neo-brutal-input py-3">
                    <option value="menunggu" {{ $transaksi->status_transaksi === 'menunggu' ? 'selected' : '' }}>Menunggu Pembayaran</option>
                    <option value="dibayar" {{ $transaksi->status_transaksi === 'dibayar' ? 'selected' : '' }}>Sudah Dibayar (Proses)</option>
                    <option value="dikirim" {{ $transaksi->status_transaksi === 'dikirim' ? 'selected' : '' }}>Sedang Dikirim</option>
                    <option value="selesai" {{ $transaksi->status_transaksi === 'selesai' ? 'selected' : '' }}>Selesai Terkirim</option>
                    <option value="dibatalkan" {{ $transaksi->status_transaksi === 'dibatalkan' ? 'selected' : '' }}>Dibatalkan</option>
                </select>
            </div>
            
            <button type="submit" class="px-6 py-3 bg-gradient-to-tr from-emerald-500 to-emerald-400 text-white rounded-xl font-bold text-sm shadow-md shadow-emerald-500/15 hover:scale-105 active:scale-95 transition-all shrink-0">
                Simpan Perubahan
            </button>
        </form>
    </div>
</div>

<style>
    @media print {
        body * {
            visibility: hidden;
        }
        #printable-area, #printable-area * {
            visibility: visible;
        }
        #printable-area {
            position: absolute;
            left: 0;
            top: 0;
            width: 100%;
            border: none !important;
            box-shadow: none !important;
        }
    }
</style>
@endsection
