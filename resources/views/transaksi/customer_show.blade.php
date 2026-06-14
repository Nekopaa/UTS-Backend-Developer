<x-app-layout>
    <x-slot name="header">
        <h2 class="font-extrabold text-2xl text-slate-800 leading-tight">
            {{ __('Detail Invoice') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-50/50">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">
            
            <!-- Actions -->
            <div class="flex justify-between items-center">
                <a href="{{ route('transaksi.index') }}" class="neo-brutal-btn px-4 py-2 text-xs gap-2 text-slate-700">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-4 h-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
                    </svg>
                    Kembali ke Riwayat
                </a>
                <button onclick="window.print()" class="neo-brutal-btn neo-brutal-btn-cyan text-white px-4 py-2 text-xs gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6.72 13.829c-.24.03-.48.062-.72.096m.72-.096a42.415 42.415 0 0110.56 0m-10.56 0L6.34 18m10.94-4.171c.24.03.48.062.72.096m-.72-.096L17.66 18m0 0l.229 2.523a1.125 1.125 0 01-1.12 1.227H7.231c-.617 0-1.11-.497-1.12-1.115L6.34 18m11.32 0h-11.32m9.493-9.074a3 3 0 11-6.666 0 3 3 0 016.666 0zM12 11.25a1.125 1.125 0 100-2.25 1.125 1.125 0 000 2.25z" />
                    </svg>
                    Cetak Invoice
                </button>
            </div>

            <!-- Invoice Sheet -->
            <div class="neo-brutal-card p-8 space-y-8 bg-white/95 backdrop-blur-md border border-slate-200/80 shadow-md" id="printable-area">
                
                <!-- Header -->
                <div class="flex flex-col md:flex-row justify-between gap-6 border-b border-slate-100 pb-6">
                    <div class="space-y-2">
                        <span class="px-3 py-1 bg-amber-100 border border-amber-200 text-amber-800 rounded-full text-[10px] font-bold uppercase tracking-wider">
                            Rindu Water Delivery
                        </span>
                        <h2 class="text-3xl font-extrabold text-slate-800">INVOICE</h2>
                        <p class="text-sm font-extrabold text-indigo-600">{{ $transaksi->kode_invoice }}</p>
                    </div>
                    
                    <div class="text-left md:text-right space-y-1">
                        <p class="text-xs font-bold text-slate-400 uppercase">Tanggal Transaksi</p>
                        <p class="text-sm font-black text-slate-800">
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
                        <h4 class="text-xs font-black text-slate-400 uppercase tracking-wider">Ditagihkan Kepada:</h4>
                        <div class="space-y-1">
                            <p class="font-extrabold text-base text-slate-800">{{ $transaksi->pelanggan->nama_pelanggan ?? 'Umum' }}</p>
                            <p class="text-xs font-semibold text-slate-600"><span class="text-slate-400 font-normal">Telp:</span> {{ $transaksi->pelanggan->no_telepon ?? '' }}</p>
                            <p class="text-xs font-semibold text-slate-600"><span class="text-slate-400 font-normal">Email:</span> {{ $transaksi->pelanggan->email ?? '-' }}</p>
                            <p class="text-xs font-bold text-slate-500 leading-relaxed pt-1">
                                <span class="text-slate-400 font-normal">Alamat:</span> {{ $transaksi->pelanggan->alamat ?? '-' }}
                            </p>
                        </div>
                    </div>

                    <!-- Payment Details -->
                    <div class="space-y-3 sm:w-1/2">
                        <h4 class="text-xs font-black text-slate-400 uppercase tracking-wider">Rincian Pembayaran:</h4>
                        <div class="space-y-1.5">
                            <div class="flex justify-between text-xs">
                                <span class="font-semibold text-slate-500">Metode Pembayaran:</span>
                                <span class="font-black text-slate-800 capitalize">{{ $transaksi->metode_pembayaran }}</span>
                            </div>
                            <div class="flex justify-between text-xs">
                                <span class="font-semibold text-slate-500">Siklus Transaksi:</span>
                                <span class="font-black text-slate-800">
                                    {{ $transaksi->id_langganan ? 'Paket Berlangganan' : 'Pemesanan Sekali Beli' }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Itemized Table -->
                <div class="space-y-4">
                    <h4 class="text-xs font-black text-slate-400 uppercase tracking-wider">Item Pesanan:</h4>
                    
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
                                <tr class="font-semibold text-sm text-slate-800">
                                    <td class="py-4">
                                        <div class="font-extrabold text-slate-800">{{ $transaksi->detailPesanan->produk->nama_produk ?? 'Produk Air Mineral' }}</div>
                                        <div class="text-[10px] font-bold text-slate-400 uppercase">
                                            {{ $transaksi->detailPesanan->produk->jenis_kemasan ?? '' }} ({{ $transaksi->detailPesanan->produk->kapasitas ?? '' }})
                                        </div>
                                    </td>
                                    <td class="py-4 text-center font-bold text-slate-800">
                                        {{ $transaksi->detailPesanan->jumlah }} Unit
                                    </td>
                                    <td class="py-4 text-right text-slate-600">
                                        Rp {{ number_format($transaksi->detailPesanan->harga_satuan, 0, ',', '.') }}
                                    </td>
                                    <td class="py-4 text-right font-black text-slate-800 pl-4">
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
                                <span class="font-bold text-emerald-500 uppercase text-[10px] pl-2">Gratis Ongkir</span>
                            </div>
                            <div class="h-px bg-slate-200 my-2"></div>
                            <div class="flex justify-between items-center">
                                <span class="font-black text-sm text-slate-800">Total Pembayaran:</span>
                                <span class="font-black text-lg text-slate-800">
                                    Rp {{ number_format($transaksi->total_bayar, 0, ',', '.') }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Notes -->
                @if($transaksi->catatan)
                <div class="p-4 bg-slate-50/50 border border-slate-200 rounded-xl space-y-1">
                    <h5 class="text-xs font-black text-slate-800">Catatan Pembeli:</h5>
                    <p class="text-xs font-semibold text-slate-600 leading-relaxed">{{ $transaksi->catatan }}</p>
                </div>
                @endif
            </div>
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
</x-app-layout>
