<div class="kanban-card bg-white border border-slate-200/80 rounded-xl p-4 shadow-sm hover:translate-y-[-1.5px] hover:shadow-md transition-all cursor-grab active:cursor-grabbing space-y-3" 
     draggable="true" 
     ondragstart="handleDragStart(event, {{ $ship->id_pengiriman }})"
     id="ship-card-{{ $ship->id_pengiriman }}">
    
    <div class="flex justify-between items-center text-[9px]">
        <span class="font-bold uppercase text-indigo-600">INV: {{ $ship->transaksi->kode_invoice }}</span>
        @if($ship->transaksi->id_langganan)
            <span class="px-1.5 py-0.5 bg-purple-50 text-purple-700 rounded-md font-bold uppercase text-[8px]">Langganan</span>
        @endif
    </div>
    
    <div>
        <h5 class="font-bold text-xs text-slate-800 leading-tight">{{ $ship->transaksi->detailPesanan->produk->nama_produk ?? 'Air Mineral Rindu' }}</h5>
        <p class="text-[9px] font-bold text-slate-500 mt-0.5">Jumlah: {{ $ship->transaksi->detailPesanan->jumlah ?? 1 }} Unit ({{ $ship->transaksi->detailPesanan->produk->kapasitas ?? '-' }})</p>
    </div>
    
    <div class="text-[9px] font-semibold text-slate-600 border-t border-slate-100 pt-2 space-y-1">
        <div>
            <span class="inline-flex items-center gap-1">
                <svg class="w-3.5 h-3.5 text-slate-400 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                </svg>
                <span>Pelanggan: <strong>{{ $ship->transaksi->pelanggan->nama_pelanggan }}</strong></span>
            </span>
        </div>
        <div class="truncate" title="{{ $ship->alamat_tujuan }}">
            <span class="inline-flex items-center gap-1 max-w-full">
                <svg class="w-3.5 h-3.5 text-slate-400 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.105-7.5 11.25-7.5 11.25S4.5 17.605 4.5 10.5a7.5 7.5 0 1 1 15 0Z" />
                </svg>
                <span class="truncate">Tujuan: {{ $ship->alamat_tujuan }}</span>
            </span>
        </div>
        @if($ship->kurir)
            <div class="flex items-center space-x-1 mt-1 bg-indigo-50/50 p-1.5 rounded-md text-indigo-700 font-bold text-[8px] w-fit">
                <svg class="w-3 h-3 text-indigo-600 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 18.75a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m3 0h6m-9 0H3.375a1.125 1.125 0 0 1-1.125-1.125V14.25m17.25 4.5a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m3 0h1.125c.621 0 1.129-.504 1.129-1.125V11.25c0-.447-.267-.852-.68-1.01l-2.902-1.09A1.125 1.125 0 0 0 17.25 9.75H13.5v9M13.5 9v11.25m-10.5-6h10.5" />
                </svg>
                <span>{{ $ship->kurir->nama_kurir }}</span>
            </div>
        @endif
    </div>

    <!-- Quick actions -->
    @if($ship->status_pengiriman === 'dijadwalkan' && is_null($ship->id_kurir))
        <div class="pt-2 border-t border-slate-100 space-y-1">
            <label class="block text-[8px] font-bold text-slate-400 uppercase">Tugaskan Kurir:</label>
            <select onchange="assignCourier({{ $ship->id_pengiriman }}, this.value)" class="w-full text-[10px] font-bold border border-slate-200 rounded-md p-1.5 bg-white focus:outline-none focus:border-indigo-500/80">
                <option value="">-- Pilih Kurir --</option>
                @foreach($activeCouriers as $k)
                    <option value="{{ $k->id_kurir }}">{{ $k->nama_kurir }}</option>
                @endforeach
            </select>
        </div>
    @elseif($ship->status_pengiriman === 'dijadwalkan' && !is_null($ship->id_kurir))
        <button type="button" onclick="updateStatus({{ $ship->id_pengiriman }}, 'dalam perjalanan')" class="w-full py-1.5 bg-gradient-to-tr from-cyan-500 to-cyan-400 text-white rounded-lg font-bold text-[9px] shadow-sm shadow-cyan-500/10 hover:scale-[1.02] active:scale-95 transition-all text-center flex items-center justify-center gap-1.5">
            <svg class="w-3.5 h-3.5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 12 3.269 3.125A59.769 59.769 0 0 1 21.485 12 59.768 59.768 0 0 1 3.27 20.875L5.999 12Zm0 0h7.5" />
            </svg>
            Kirim Air
        </button>
    @elseif($ship->status_pengiriman === 'dalam perjalanan')
        <button type="button" onclick="updateStatus({{ $ship->id_pengiriman }}, 'terkirim')" class="w-full py-1.5 bg-gradient-to-tr from-emerald-500 to-emerald-400 text-white rounded-lg font-bold text-[9px] shadow-sm shadow-emerald-500/10 hover:scale-[1.02] active:scale-95 transition-all text-center flex items-center justify-center gap-1.5">
            <svg class="w-3.5 h-3.5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
            </svg>
            Selesai Antar
        </button>
    @elseif($ship->status_pengiriman === 'terkirim')
        <div class="text-[9px] font-bold text-emerald-600 text-center border-t border-slate-100 pt-2 flex items-center justify-center space-x-1">
            <svg class="w-3.5 h-3.5 text-emerald-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
            </svg>
            <span>Diterima Pelanggan</span>
        </div>
    @endif
</div>
