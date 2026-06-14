@extends('layouts.admin')

@section('title', 'Detail Pengiriman')

@section('content')
<div class="max-w-3xl mx-auto space-y-6">
    
    <!-- Actions -->
    <div>
        <a href="{{ route('pengiriman.index') }}" class="inline-flex items-center px-4 py-2 border border-slate-200 rounded-xl bg-white font-bold text-xs text-slate-700 shadow-sm hover:translate-y-[-1px] transition-all gap-2">
            Daftar Pengiriman
        </a>
    </div>

    <!-- Details Sheet -->
    <div class="neo-brutal-card p-8 bg-white border border-slate-200/80 space-y-8">
        
        <!-- Header -->
        <div class="flex flex-col md:flex-row justify-between gap-6 border-b border-slate-100 pb-6">
            <div class="space-y-2">
                <span class="px-3 py-1 bg-indigo-50 border border-indigo-100 text-indigo-600 rounded-md text-[10px] font-bold uppercase shadow-sm">
                    Pelacakan Logistik
                </span>
                <h2 class="text-3xl font-extrabold text-slate-800">PENGIRIMAN</h2>
                <p class="text-sm font-bold text-indigo-600">REF: {{ $pengiriman->transaksi->kode_invoice ?? 'REF-' . $pengiriman->id_pengiriman }}</p>
            </div>
            
            <div class="text-left md:text-right space-y-1">
                <p class="text-xs font-bold text-slate-400 uppercase">Jadwal Pengiriman</p>
                <p class="text-sm font-extrabold text-slate-850">
                    {{ $pengiriman->tanggal_pengiriman ? \Carbon\Carbon::parse($pengiriman->tanggal_pengiriman)->translatedFormat('d F Y') : '-' }}
                </p>
                <div class="pt-2">
                    @if($pengiriman->status_pengiriman === 'terkirim')
                        <span class="px-2.5 py-1 bg-emerald-500 text-white rounded-lg text-xs font-bold uppercase shadow-sm">Tiba</span>
                    @elseif($pengiriman->status_pengiriman === 'dalam perjalanan')
                        <span class="px-2.5 py-1 bg-cyan-500 text-white rounded-lg text-xs font-bold uppercase shadow-sm">Jalan</span>
                    @elseif($pengiriman->status_pengiriman === 'gagal')
                        <span class="px-2.5 py-1 bg-rose-500 text-white rounded-lg text-xs font-bold uppercase shadow-sm">Gagal</span>
                    @else
                        <span class="px-2.5 py-1 bg-slate-100 border border-slate-200 text-slate-600 rounded-lg text-xs font-bold uppercase shadow-sm">Proses</span>
                    @endif
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 border-b border-slate-100 pb-6">
            <!-- Kurir Info -->
            <div class="space-y-3">
                <h4 class="text-xs font-bold text-slate-400 uppercase tracking-wider">Kurir yang Mengirim:</h4>
                @if($pengiriman->kurir)
                <div class="space-y-1.5">
                    <p class="font-extrabold text-base text-slate-850 flex items-center gap-1.5">
                        <svg class="h-5 w-5 text-slate-700 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 18.75a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m3 0h6m-9 0H3.375a1.125 1.125 0 0 1-1.125-1.125V14.25m17.25 4.5a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m3 0h1.125c.621 0 1.129-.504 1.129-1.125V11.25c0-.447-.267-.852-.68-1.01l-2.902-1.09A1.125 1.125 0 0 0 17.25 9.75H13.5v9M13.5 9v11.25m-10.5-6h10.5" />
                        </svg>
                        <span>{{ $pengiriman->kurir->nama_kurir }}</span>
                    </p>
                    <p class="text-xs font-semibold text-slate-650 flex items-center gap-1.5">
                        <svg class="w-3.5 h-3.5 text-slate-500 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 0 0 2.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.387a12.035 12.035 0 0 1-7.108-7.108c-.155-.44.01-1.21.387-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 0 0-1.091-.852H4.5A2.25 2.25 0 0 0 2.25 4.5v2.25Z" />
                        </svg>
                        <span>{{ $pengiriman->kurir->no_hp }}</span>
                    </p>
                    <p class="text-xs font-bold text-slate-700 pt-1">
                        Armada: <span class="px-2 py-0.5 border border-slate-200 bg-slate-50 rounded text-[10px]">{{ $pengiriman->kurir->kendaraan }} ({{ $pengiriman->kurir->plat_nomor }})</span>
                    </p>
                </div>
                @else
                <p class="text-xs font-bold text-rose-500 flex items-center gap-1.5">
                    <svg class="w-4 h-4 text-rose-500 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z" />
                    </svg>
                    <span>Belum ada kurir ditugaskan untuk pengiriman ini.</span>
                </p>
                @endif
            </div>

            <!-- Alamat Info -->
            <div class="space-y-3">
                <h4 class="text-xs font-bold text-slate-400 uppercase tracking-wider">Tujuan Pengiriman:</h4>
                <div class="space-y-1">
                    <p class="font-extrabold text-base text-slate-850">{{ $pengiriman->transaksi->pelanggan->nama_pelanggan ?? 'Umum' }}</p>
                    <p class="text-xs font-semibold text-slate-605 flex items-center gap-1.5">
                        <svg class="w-3.5 h-3.5 text-slate-500 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 0 0 2.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.387a12.035 12.035 0 0 1-7.108-7.108c-.155-.44.01-1.21.387-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 0 0-1.091-.852H4.5A2.25 2.25 0 0 0 2.25 4.5v2.25Z" />
                        </svg>
                        <span>{{ $pengiriman->transaksi->pelanggan->no_telepon ?? '' }}</span>
                    </p>
                    <p class="text-xs font-semibold text-slate-650 leading-relaxed pt-1 flex items-center gap-1.5">
                        <svg class="w-3.5 h-3.5 text-slate-500 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.105-7.5 11.25-7.5 11.25S4.5 17.605 4.5 10.5a7.5 7.5 0 1 1 15 0Z" />
                        </svg>
                        <span>{{ $pengiriman->alamat_tujuan }}</span>
                    </p>
                </div>
            </div>
        </div>

        <!-- Detail Item -->
        @if($pengiriman->transaksi && $pengiriman->transaksi->detailPesanan)
        <div class="p-4 bg-slate-50 border border-slate-200/80 rounded-xl space-y-2">
            <h5 class="text-xs font-bold text-slate-700">Item yang Dikirim:</h5>
            <div class="flex justify-between items-center text-xs">
                <span class="font-extrabold text-slate-750 flex items-center gap-1.5">
                    <svg class="h-4 w-4 text-slate-600 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 7.5l-.625 10.632a2.25 2.25 0 0 1-2.247 2.118H6.622a2.25 2.25 0 0 1-2.247-2.118L3.75 7.5M10 11.25h4M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125Z" />
                    </svg>
                    <span>{{ $pengiriman->transaksi->detailPesanan->produk->nama_produk ?? 'Air Mineral' }}</span>
                </span>
                <span class="font-bold text-slate-800">
                    {{ $pengiriman->transaksi->detailPesanan->jumlah }} Unit
                </span>
            </div>
        </div>
        @endif

        <!-- Bukti Photo & Catatan Kurir -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 pt-4">
            <!-- Bukti Gambar -->
            <div class="space-y-2">
                <h4 class="text-xs font-bold text-slate-400 uppercase tracking-wider">Foto Bukti Pengiriman:</h4>
                @if($pengiriman->foto_bukti_pengiriman)
                <div class="w-full h-48 border border-slate-200 rounded-xl overflow-hidden shadow-sm">
                    <img src="{{ asset('storage/' . $pengiriman->foto_bukti_pengiriman) }}" alt="Bukti" class="w-full h-full object-cover">
                </div>
                @else
                <div class="w-full h-48 border border-dashed border-slate-300 rounded-xl flex flex-col items-center justify-center text-slate-400 font-bold text-xs gap-2">
                    <svg class="w-8 h-8 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6.827 6.175A2.31 2.31 0 0 1 5.186 7.23c-.38.054-.757.112-1.134.175C2.999 7.58 2.25 8.507 2.25 9.574V18a2.25 2.25 0 0 0 2.25 2.25h15A2.25 2.25 0 0 0 21.75 18V9.574c0-1.067-.75-1.994-1.802-2.169a47.865 47.865 0 0 0-1.134-.175 2.31 2.31 0 0 1-1.64-1.055l-.822-1.316a2.192 2.192 0 0 0-1.736-1.039 48.774 48.774 0 0 0-5.232 0 2.192 2.192 0 0 0-1.736 1.039l-.821 1.316Z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 12.75a4.5 4.5 0 1 1-9 0 4.5 4.5 0 0 1 9 0ZM18.75 10.5h.008v.008h-.008V10.5Z" />
                    </svg>
                    <span>Belum ada unggahan foto dari kurir</span>
                </div>
                @endif
            </div>

            <!-- Catatan Driver -->
            <div class="space-y-2">
                <h4 class="text-xs font-bold text-slate-400 uppercase tracking-wider">Catatan Petugas Kurir:</h4>
                <div class="p-4 bg-slate-50 border border-slate-200 rounded-xl h-48 overflow-y-auto">
                    <p class="text-xs font-semibold text-slate-700 leading-relaxed">
                        {{ $pengiriman->catatan_kurir ?? 'Tidak ada catatan khusus dari kurir pengantar.' }}
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Status Update Panel for Admin -->
    <div class="neo-brutal-card p-6 bg-white space-y-4">
        <h3 class="font-extrabold text-sm text-slate-800">Perbarui Status Logistik & Catatan</h3>
        
        <form action="{{ route('pengiriman.update', $pengiriman->id_pengiriman) }}" method="POST" class="space-y-4">
            @csrf
            @method('PUT')
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="space-y-2">
                    <label for="status_pengiriman" class="block font-bold text-xs text-slate-700 mb-2">Status Pengiriman</label>
                    <select id="status_pengiriman" name="status_pengiriman" class="neo-brutal-input py-2.5">
                        <option value="dijadwalkan" {{ $pengiriman->status_pengiriman === 'dijadwalkan' ? 'selected' : '' }}>Proses</option>
                        <option value="dalam perjalanan" {{ $pengiriman->status_pengiriman === 'dalam perjalanan' ? 'selected' : '' }}>Jalan</option>
                        <option value="terkirim" {{ $pengiriman->status_pengiriman === 'terkirim' ? 'selected' : '' }}>Tiba</option>
                        <option value="gagal" {{ $pengiriman->status_pengiriman === 'gagal' ? 'selected' : '' }}>Gagal</option>
                    </select>
                </div>

                <div class="space-y-2">
                    <label for="catatan_kurir" class="block font-bold text-xs text-slate-700 mb-2">Perbarui Catatan Kurir</label>
                    <input type="text" id="catatan_kurir" name="catatan_kurir" class="neo-brutal-input py-2.5" value="{{ old('catatan_kurir', $pengiriman->catatan_kurir) }}" placeholder="Contoh: Diterima oleh satpam setempat">
                </div>
            </div>

            <button type="submit" class="w-full py-3 bg-gradient-to-tr from-emerald-500 to-emerald-400 text-white rounded-xl font-bold text-sm shadow-md shadow-emerald-500/15 hover:scale-102 active:scale-98 transition-all flex items-center justify-center gap-2">
                <span>Simpan Perubahan Pengiriman</span>
            </button>
        </form>
    </div>
</div>
@endsection
