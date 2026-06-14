<x-app-layout>
    <x-slot name="header">
        <h2 class="font-extrabold text-2xl text-slate-800 leading-tight">
            {{ __('Dashboard Pelanggan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <!-- Welcome Section -->
            <div class="neo-brutal-card p-8">
                <div class="flex items-center space-x-4">
                    <div class="w-12 h-12 rounded-full bg-gradient-to-br from-indigo-500 to-indigo-600 shadow-sm shadow-indigo-500/15 flex items-center justify-center text-white">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM18.75 21H5.25A2.25 2.25 0 013 18.75V5.25A2.25 2.25 0 015.25 3h13.5A2.25 2.25 0 0121 5.25v13.5A2.25 2.25 0 0118.75 21z" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-xl font-extrabold text-slate-800">Selamat Datang, {{ Auth::user()->name }}!</h3>
                        <p class="text-sm font-semibold text-slate-500">Anda masuk sebagai Pelanggan Rindu Water.</p>
                    </div>
                </div>
            </div>

            <!-- Products Section -->
            <div class="neo-brutal-card p-8">
                <h3 class="text-lg font-extrabold text-slate-800 mb-6">Produk Air Mineral Tersedia</h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    @forelse(\App\Models\ProdukAir::where('status_produk', 'tersedia')->get() as $produk)
                        <div class="bg-white/90 border border-slate-200/60 rounded-2xl p-4 shadow-sm hover:translate-y-[-2px] hover:shadow-md transition-all duration-300 flex flex-col justify-between @if($produk->stok == 0) opacity-60 grayscale @endif">
                            <div>
                                @if($produk->foto_produk)
                                    <img src="{{ asset('storage/' . $produk->foto_produk) }}" alt="{{ $produk->nama_produk }}" class="w-full h-40 object-cover rounded-xl mb-4">
                                @else
                                    @if($produk->jenis_kemasan === 'botol')
                                        <img src="{{ asset('images/produk_botol.jpg') }}" alt="{{ $produk->nama_produk }}" class="w-full h-40 object-cover rounded-xl mb-4">
                                    @elseif($produk->jenis_kemasan === 'gelas')
                                        <img src="{{ asset('images/produk_gelas.jpg') }}" alt="{{ $produk->nama_produk }}" class="w-full h-40 object-cover rounded-xl mb-4">
                                    @else
                                        <img src="{{ asset('images/produk_galon.jpg') }}" alt="{{ $produk->nama_produk }}" class="w-full h-40 object-cover rounded-xl mb-4">
                                    @endif
                                @endif
                                <h4 class="font-extrabold text-base text-slate-800">{{ $produk->nama_produk }}</h4>
                                <p class="text-xs font-semibold text-slate-500 capitalize">{{ $produk->jenis_kemasan }} - {{ $produk->kapasitas }}</p>
                            </div>
                            <div class="mt-4 pt-3 border-t border-slate-100 flex justify-between items-center">
                                <div>
                                    <p class="text-xs font-bold text-slate-400">Harga Satuan</p>
                                    <p class="text-base font-extrabold text-indigo-600">Rp {{ number_format($produk->harga, 0, ',', '.') }}</p>
                                </div>
                                <span class="px-2 py-1 bg-slate-100 text-slate-600 rounded-lg text-[10px] font-bold uppercase">Stok: {{ $produk->stok }}</span>
                            </div>
                        </div>
                    @empty
                        <p class="text-slate-500 font-semibold text-sm">Tidak ada produk tersedia saat ini.</p>
                    @endforelse
                </div>
            </div>

            <!-- Customer Menu Grid -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Buat Langganan -->
                <a href="{{ route('pelanggan.langganan.create') }}" class="neo-brutal-card p-6 block">
                    <div class="flex items-center space-x-4">
                        <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-purple-500 to-purple-600 shadow-sm shadow-purple-500/15 flex items-center justify-center text-white shrink-0">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625c0-.66-.56-1.125-1.125-1.125h-12c-.56 0-1.125.465-1.125 1.125v2.625m16.5 0v5.25c0 .621-.504 1.125-1.125 1.125H4.5c-.621 0-1.125-.504-1.125-1.125v-5.25" />
                            </svg>
                        </div>
                        <div>
                            <h4 class="text-base font-extrabold text-slate-800">Buat Langganan</h4>
                            <p class="text-xs font-semibold text-slate-500">Pesan paket langganan air</p>
                        </div>
                    </div>
                </a>

                <!-- Status Pengiriman -->
                <a href="{{ route('pelanggan.pengiriman') }}" class="neo-brutal-card p-6 block">
                    <div class="flex items-center space-x-4">
                        <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-blue-500 to-blue-600 shadow-sm shadow-blue-500/15 flex items-center justify-center text-white shrink-0">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 18.75a3.75 3.75 0 117.5 0 3.75 3.75 0 01-7.5 0zm0-12.5a3.75 3.75 0 117.5 0 3.75 3.75 0 01-7.5 0z" />
                            </svg>
                        </div>
                        <div>
                            <h4 class="text-base font-extrabold text-slate-800">Status Pengiriman</h4>
                            <p class="text-xs font-semibold text-slate-500">Lacak pengiriman air</p>
                        </div>
                    </div>
                </a>

                <!-- Riwayat Pemesanan -->
                <a href="{{ route('transaksi.index') }}" class="neo-brutal-card p-6 block">
                    <div class="flex items-center space-x-4">
                        <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-emerald-500 to-emerald-600 shadow-sm shadow-emerald-500/15 flex items-center justify-center text-white shrink-0">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 13.5V9a2.25 2.25 0 012.25-2.25h6.75v12.75A2.25 2.25 0 018.25 21H4.5A2.25 2.25 0 012.25 18.75V9a2.25 2.25 0 012.25-2.25h6.75v1.5" />
                            </svg>
                        </div>
                        <div>
                            <h4 class="text-base font-extrabold text-slate-800">Riwayat Pemesanan</h4>
                            <p class="text-xs font-semibold text-slate-500">Lihat riwayat pembelian</p>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
</x-app-layout>