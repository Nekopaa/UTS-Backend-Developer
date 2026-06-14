<x-app-layout>
    <x-slot name="header">
        <h2 class="font-extrabold text-2xl text-slate-800 leading-tight">
            {{ __('Status Pengiriman Anda') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="neo-brutal-card p-8">
                <div class="space-y-6">
                    @forelse($pengiriman as $p)
                        <div class="bg-white/80 border border-slate-200/60 rounded-2xl p-6 shadow-sm hover:translate-y-[-2px] hover:shadow-md transition-all duration-300 flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
                            <div class="space-y-2">
                                <div class="flex flex-wrap items-center gap-3">
                                    <h3 class="font-extrabold text-slate-800 text-lg">Pengiriman #{{ $p->id_pengiriman }}</h3>
                                    @if($p->transaksi)
                                        <span class="px-2.5 py-0.5 bg-amber-100 border border-amber-200/30 rounded text-xs font-bold text-amber-800">
                                            {{ $p->transaksi->kode_invoice }}
                                        </span>
                                        @if($p->transaksi->id_langganan)
                                            <span class="px-2 py-0.5 bg-purple-50 text-purple-800 rounded text-[9px] font-bold uppercase tracking-wider">Berlangganan</span>
                                        @else
                                            <span class="px-2 py-0.5 bg-blue-50 text-blue-800 rounded text-[9px] font-bold uppercase tracking-wider">Reguler</span>
                                        @endif
                                    @endif
                                </div>
                                <p class="text-sm font-semibold text-slate-600 flex items-center gap-1.5">
                                    <svg class="w-4 h-4 text-slate-500 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.105-7.5 11.25-7.5 11.25S4.5 17.605 4.5 10.5a7.5 7.5 0 1 1 15 0Z" />
                                    </svg>
                                    <span><strong>Alamat Tujuan:</strong> {{ $p->alamat_tujuan }}</span>
                                </p>
                                @if($p->kurir)
                                    <p class="text-xs font-extrabold text-slate-700 flex items-center gap-1.5">
                                        <svg class="h-4 w-4 text-slate-500 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 18.75a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m3 0h6m-9 0H3.375a1.125 1.125 0 0 1-1.125-1.125V14.25m17.25 4.5a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m3 0h1.125c.621 0 1.129-.504 1.129-1.125V11.25c0-.447-.267-.852-.68-1.01l-2.902-1.09A1.125 1.125 0 0 0 17.25 9.75H13.5v9M13.5 9v11.25m-10.5-6h10.5" />
                                        </svg>
                                        <span><strong>Kurir:</strong> {{ $p->kurir->nama_kurir }} ({{ $p->kurir->kendaraan }} - {{ $p->kurir->plat_nomor }})</span>
                                    </p>
                                @else
                                    <p class="text-xs font-extrabold text-rose-500 flex items-center gap-1.5">
                                        <svg class="h-4 w-4 text-rose-500 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 18.75a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m3 0h6m-9 0H3.375a1.125 1.125 0 0 1-1.125-1.125V14.25m17.25 4.5a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m3 0h1.125c.621 0 1.129-.504 1.129-1.125V11.25c0-.447-.267-.852-.68-1.01l-2.902-1.09A1.125 1.125 0 0 0 17.25 9.75H13.5v9M13.5 9v11.25m-10.5-6h10.5" />
                                        </svg>
                                        <span>Belum ditugaskan kurir</span>
                                    </p>
                                @endif
                                @if($p->tanggal_pengiriman)
                                    <p class="text-xs font-bold text-slate-500 flex items-center gap-1.5">
                                        <svg class="w-4 h-4 text-slate-500 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5" />
                                        </svg>
                                        <span>Tanggal Kirim: {{ \Carbon\Carbon::parse($p->tanggal_pengiriman)->translatedFormat('d M Y') }}</span>
                                    </p>
                                @endif
                                @if($p->catatan_kurir)
                                    <div class="p-3 bg-slate-50 border border-slate-205 rounded-lg mt-2 text-xs font-semibold text-slate-700 flex items-start gap-1.5">
                                        <svg class="w-4 h-4 text-slate-500 shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M7.5 8.25h9m-9 3H12m-9.75 1.51c0 1.6 1.123 2.994 2.707 3.227 1.129.166 2.27.293 3.423.379.35.026.67.21.865.501L12 21l2.755-4.133a1.14 1.14 0 0 1 .865-.501 48.172 48.172 0 0 0 3.423-.379c1.584-.233 2.707-1.626 2.707-3.228V6.741c0-1.602-1.123-2.995-2.707-3.228A48.394 48.394 0 0 0 12 3c-2.392 0-4.744.175-7.043.513C3.373 3.746 2.25 5.14 2.25 6.741v5.772Z" />
                                        </svg>
                                        <span><strong>Catatan Kurir:</strong> {{ $p->catatan_kurir }}</span>
                                    </div>
                                @endif
                            </div>
                            
                            <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-3 w-full md:w-auto justify-between md:justify-end">
                                @if($p->status_pengiriman === 'terkirim')
                                    <span class="px-3 py-1 bg-emerald-500 text-white rounded-lg text-xs font-bold uppercase text-center shadow-sm">Tiba</span>
                                @elseif($p->status_pengiriman === 'dalam perjalanan')
                                    <span class="px-3 py-1 bg-cyan-500 text-white rounded-lg text-xs font-bold uppercase text-center shadow-sm">Jalan</span>
                                @elseif($p->status_pengiriman === 'gagal')
                                    <span class="px-3 py-1 bg-rose-500 text-white rounded-lg text-xs font-bold uppercase text-center shadow-sm">Gagal</span>
                                @else
                                    <span class="px-3 py-1 bg-slate-100 border border-slate-200 text-slate-650 rounded-lg text-xs font-bold uppercase text-center shadow-sm">Proses</span>
                                @endif

                                @if($p->foto_bukti_pengiriman)
                                    <a href="{{ asset('storage/' . $p->foto_bukti_pengiriman) }}" target="_blank" class="inline-flex items-center justify-center px-4 py-2 bg-gradient-to-tr from-amber-400 to-amber-300 text-slate-805 rounded-xl font-bold text-xs shadow-sm hover:scale-105 active:scale-95 transition-all gap-1">
                                        <svg class="w-3.5 h-3.5 text-slate-700 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M6.827 6.175A2.31 2.31 0 0 1 5.186 7.23c-.38.054-.757.112-1.134.175C2.999 7.58 2.25 8.507 2.25 9.574V18a2.25 2.25 0 0 0 2.25 2.25h15A2.25 2.25 0 0 0 21.75 18V9.574c0-1.067-.75-1.994-1.802-2.169a47.865 47.865 0 0 0-1.134-.175 2.31 2.31 0 0 1-1.64-1.055l-.822-1.316a2.192 2.192 0 0 0-1.736-1.039 48.774 48.774 0 0 0-5.232 0 2.192 2.192 0 0 0-1.736 1.039l-.821 1.316Z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 12.75a4.5 4.5 0 1 1-9 0 4.5 4.5 0 0 1 9 0ZM18.75 10.5h.008v.008h-.008V10.5Z" />
                                        </svg>
                                        <span>Lihat Bukti Foto</span>
                                    </a>
                                @endif
                                
                                @if($p->transaksi)
                                    <a href="{{ route('transaksi.show', $p->id_transaksi) }}" class="inline-flex items-center justify-center px-4 py-2 bg-gradient-to-tr from-cyan-500 to-cyan-400 text-white rounded-xl font-bold text-xs shadow-sm hover:scale-105 active:scale-95 transition-all">
                                        Detail Invoice
                                    </a>
                                @endif
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-10 bg-slate-50 border border-slate-200/80 rounded-2xl">
                            <p class="text-slate-500 font-semibold text-sm">Belum ada data pengiriman aktif untuk pesanan Anda.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-app-layout>