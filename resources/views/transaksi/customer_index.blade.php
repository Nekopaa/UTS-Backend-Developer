<x-app-layout>
    <x-slot name="header">
        <h2 class="font-extrabold text-2xl text-slate-800 leading-tight">
            {{ __('Riwayat Transaksi') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-50/50">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="neo-brutal-card overflow-hidden p-8">
                <div class="space-y-4">
                    @forelse($transaksi as $t)
                        <div class="bg-white/80 border border-slate-200/80 rounded-2xl p-6 shadow-sm hover:shadow-md transition-all flex justify-between items-center backdrop-blur-sm">
                            <div>
                                <h3 class="font-black text-slate-800 text-lg flex items-center gap-2">
                                    Invoice: {{ $t->kode_invoice }}
                                    @if($t->id_langganan)
                                        <span class="px-2 py-0.5 bg-purple-100 border border-purple-200 rounded text-[9px] font-bold uppercase text-purple-800">Berlangganan</span>
                                    @else
                                        <span class="px-2 py-0.5 bg-blue-50 border border-blue-100 rounded text-[9px] font-bold uppercase text-blue-800">Reguler</span>
                                    @endif
                                </h3>
                                <p class="text-sm font-semibold text-slate-500 mt-1">Total: Rp {{ number_format($t->total_bayar, 0, ',', '.') }}</p>
                                <p class="text-xs font-bold text-slate-400 mt-1">Tanggal: {{ $t->tanggal_transaksi ? \Carbon\Carbon::parse($t->tanggal_transaksi)->translatedFormat('d M Y, H:i') : '-' }}</p>
                            </div>
                            <div class="flex items-center space-x-4">
                                @if($t->status_transaksi === 'selesai')
                                    <span class="px-2.5 py-1 bg-emerald-500 text-white rounded-lg text-[10px] font-bold uppercase shadow-sm">Selesai</span>
                                @elseif($t->status_transaksi === 'dikirim')
                                    <span class="px-2.5 py-1 bg-cyan-500 text-white rounded-lg text-[10px] font-bold uppercase shadow-sm">Dikirim</span>
                                @elseif($t->status_transaksi === 'dibayar')
                                    <span class="px-2.5 py-1 bg-amber-400 text-slate-800 rounded-lg text-[10px] font-bold uppercase shadow-sm">Dibayar</span>
                                @elseif($t->status_transaksi === 'dibatalkan')
                                    <span class="px-2.5 py-1 bg-rose-500 text-white rounded-lg text-[10px] font-bold uppercase shadow-sm">Batal</span>
                                @else
                                    <span class="px-2.5 py-1 bg-slate-100 border border-slate-200 text-slate-600 rounded-lg text-[10px] font-bold uppercase shadow-sm">Menunggu</span>
                                @endif
                                <a href="{{ route('transaksi.show', $t->id_transaksi) }}" class="neo-brutal-btn neo-brutal-btn-cyan text-white px-4 py-2 text-xs">
                                    Detail Invoice
                                </a>
                            </div>
                        </div>
                    @empty
                        <p class="text-slate-500 font-bold text-center py-6">Belum ada transaksi pembelian air mineral.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
