<x-app-layout>
    <style>
        .neo-brutal-input-error {
            border-color: #f43f5e !important;
            box-shadow: 4px 4px 0px #f43f5e !important;
        }
        .neo-brutal-input-error:focus, .neo-brutal-input-error:hover {
            box-shadow: 5px 5px 0px #f43f5e !important;
        }
    </style>
    <x-slot name="header">
        <h2 class="font-extrabold text-3xl text-black leading-tight">
            {{ __('Dashboard Pelanggan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
            
            <!-- Success/Error Alerts -->
            @if(session('success'))
                <div id="success-popup" class="fixed inset-0 flex items-center justify-center bg-black/60 z-[9999] transition-all duration-300">
                    <div class="bg-white border border-slate-200 p-8 rounded-[24px] shadow-xl max-w-sm w-full mx-4 text-center transform scale-100 transition-all duration-300 space-y-6">
                        <!-- Success Checkmark Graphic (SaaS style) -->
                        <div class="w-16 h-16 bg-emerald-500 text-white rounded-2xl flex items-center justify-center mx-auto text-3xl font-bold shadow-md">
                            ✓
                        </div>
                        
                        <div class="space-y-2">
                            <h3 class="text-2xl font-black text-slate-800">Transaksi Berhasil</h3>
                            <p class="text-sm font-bold text-slate-500 leading-relaxed">
                                Pesanan air mineral Anda telah berhasil ditempatkan dan sedang diproses oleh kurir kami.
                            </p>
                        </div>
                        
                        <!-- Progress indicator line -->
                        <div class="w-full bg-slate-100 h-2 border border-slate-200/50 rounded-full overflow-hidden">
                            <div class="bg-emerald-500 h-full rounded-full transition-all duration-[3000ms] ease-linear w-full" id="popup-progress"></div>
                        </div>
                    </div>
                </div>

                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        const popup = document.getElementById('success-popup');
                        const progress = document.getElementById('popup-progress');
                        
                        // Start progress bar animation by resetting and transitioning
                        if (progress) {
                            progress.style.width = '100%';
                            setTimeout(() => {
                                progress.style.transition = 'width 3s linear';
                                progress.style.width = '0%';
                            }, 50);
                        }
                        
                        // Auto-hide popup after 3 seconds
                        setTimeout(() => {
                            if (popup) {
                                popup.classList.add('opacity-0', 'pointer-events-none');
                                setTimeout(() => {
                                    popup.remove();
                                }, 300);
                            }
                        }, 3000);
                    });
                </script>
            @endif

            @if(session('error'))
                <div class="p-5 bg-rose-500 rounded-xl text-white font-extrabold flex items-center space-x-3 shadow-md">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor" class="w-6 h-6 shrink-0">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z" />
                    </svg>
                    <span>{{ session('error') }}</span>
                </div>
            @endif

            <!-- Main Stats Overview -->
            <div class="neo-brutal-card p-8 space-y-6 bg-white/95 backdrop-blur-md border border-slate-200 shadow-sm">
                <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">
                    <div class="flex items-center space-x-4">
                        <div class="w-14 h-14 rounded-xl bg-indigo-50 border border-indigo-100 shadow-sm flex items-center justify-center text-indigo-600">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-2xl font-black text-slate-800">Selamat Datang, {{ Auth::user()->name }}!</h3>
                            <p class="text-sm font-semibold text-slate-500">Kelola pemesanan air mineral dan jadwal langganan otomatis Anda di sini.</p>
                        </div>
                    </div>
                </div>
                
                <div class="h-px bg-slate-200 rounded-full"></div>
                
                <!-- Stats Row -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <!-- Stat Card 1 -->
                    <div class="p-6 bg-cyan-50/70 border border-cyan-100/70 rounded-2xl shadow-sm hover:shadow-md hover:-translate-y-0.5 transition-all flex flex-col justify-between">
                        <span class="text-xs font-bold uppercase tracking-wider text-cyan-700 bg-white px-2 py-1 rounded-full border border-cyan-200 self-start">Total Belanja</span>
                        <span class="text-3xl font-black text-slate-800 mt-4">
                            Rp {{ number_format($myTransactions->where('status_transaksi', 'dibayar')->sum('total_bayar'), 0, ',', '.') }}
                        </span>
                        <p class="text-xs font-semibold text-slate-500 mt-2">Akumulasi seluruh pembayaran pesanan air mineral murni Anda.</p>
                    </div>
                    
                    <!-- Stat Card 2 -->
                    <div class="p-6 bg-amber-50/70 border border-amber-100/70 rounded-2xl shadow-sm hover:shadow-md hover:-translate-y-0.5 transition-all flex flex-col justify-between">
                        <span class="text-xs font-bold uppercase tracking-wider text-amber-700 bg-white px-2 py-1 rounded-full border border-amber-200 self-start">Langganan Aktif</span>
                        <span class="text-3xl font-black text-slate-800 mt-4">
                            {{ $mySubscriptions->where('status_langganan', 'aktif')->count() }} Paket
                        </span>
                        <p class="text-xs font-semibold text-slate-500 mt-2">Jumlah siklus pengiriman terjadwal otomatis yang sedang aktif.</p>
                    </div>
                    
                    <!-- Stat Card 3 -->
                    <div class="p-6 bg-indigo-50/70 border border-indigo-100/70 rounded-2xl shadow-sm hover:shadow-md hover:-translate-y-0.5 transition-all flex flex-col justify-between">
                        <span class="text-xs font-bold uppercase tracking-wider text-indigo-700 bg-white px-2 py-1 rounded-full border border-indigo-200 self-start">Metode Pengiriman</span>
                        <span class="text-3xl font-black text-slate-800 mt-4">Kurir Kilat</span>
                        <p class="text-xs font-semibold text-slate-500 mt-2">Pengantaran otomatis dari mata air pegunungan langsung ke rumah.</p>
                    </div>
                </div>
            </div>            <!-- PHP block to fetch shipments -->
            @php
                $myShipments = collect();
                if ($pelanggan) {
                    $myShipments = \App\Models\Pengiriman::with(['transaksi.detailPesanan.produk', 'kurir'])
                        ->whereIn('id_transaksi', $myTransactions->pluck('id_transaksi'))
                        ->latest()
                        ->get();
                }
            @endphp

            <!-- Main Interactive Section: Tabs & Profile side-by-side -->
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
                
                <!-- Column 1: Tabs & Content (8 Columns) -->
                <div class="lg:col-span-8 space-y-6">
                    
                    <!-- Tabs Navigation -->
                    <div class="flex flex-wrap border border-slate-200/80 bg-white rounded-[20px] shadow-sm overflow-hidden">
                        <button onclick="switchTab('catalog')" id="tab-btn-catalog" class="tab-btn flex-1 py-4 px-6 font-extrabold text-sm border-r border-slate-200/80 bg-indigo-600 text-white transition-all">
                            Katalog & Pesan Instan
                        </button>
                        <button onclick="switchTab('subscription')" id="tab-btn-subscription" class="tab-btn flex-1 py-4 px-6 font-extrabold text-sm border-r border-slate-200/80 bg-white text-slate-600 hover:bg-slate-50 transition-all">
                            Langganan Air Cerdas
                        </button>
                        <button onclick="switchTab('deliveries')" id="tab-btn-deliveries" class="tab-btn flex-1 py-4 px-6 font-extrabold text-sm border-r border-slate-200/80 bg-white text-slate-600 hover:bg-slate-50 transition-all">
                            Lacak Pengiriman
                        </button>
                        <button onclick="switchTab('transactions')" id="tab-btn-transactions" class="tab-btn flex-1 py-4 px-6 font-extrabold text-sm bg-white text-slate-600 hover:bg-slate-50 transition-all">
                            Riwayat Transaksi
                        </button>
                    </div>                    <!-- Tab Content: Catalog -->
                    <div id="tab-content-catalog" class="tab-pane space-y-8">
                        <div class="neo-brutal-card p-8 space-y-6">
                            <div class="flex items-center space-x-3">
                                <span class="p-2 bg-indigo-50 border border-indigo-100 rounded-full text-indigo-600 shadow-sm flex items-center justify-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-5 h-5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.105-6 11.25-6 11.25S7.5 17.605 7.5 10.5a6 6 0 1112 0z" />
                                    </svg>
                                </span>
                                <h3 class="text-2xl font-black text-slate-800">Pilih Air Mineral Murni Anda</h3>
                            </div>
                            <p class="text-sm font-semibold text-slate-500">Klik "Pesan Instan" pada varian air mineral pilihan Anda untuk memesan langsung dengan alur 3-Klik.</p>
                            <div class="h-px bg-slate-200 rounded-full"></div>
 
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                @foreach($availableProducts as $prod)
                                    <div class="neo-brutal-card p-6 flex flex-col justify-between @if($prod->stok == 0) bg-slate-100/60 opacity-60 grayscale pointer-events-none shadow-sm @endif">
                                        <div class="space-y-4">
                                            <!-- Image -->
                                            <div class="h-40 bg-slate-100/50 border border-slate-200 rounded-xl overflow-hidden relative shadow-sm">
                                                @if($prod->foto_produk)
                                                    <img src="{{ asset('storage/' . $prod->foto_produk) }}" alt="{{ $prod->nama_produk }}" class="w-full h-full object-cover">
                                                @else
                                                    @if($prod->jenis_kemasan === 'botol')
                                                        <img src="{{ asset('images/produk_botol.jpg') }}" alt="{{ $prod->nama_produk }}" class="w-full h-full object-cover">
                                                    @elseif($prod->jenis_kemasan === 'gelas')
                                                        <img src="{{ asset('images/produk_gelas.jpg') }}" alt="{{ $prod->nama_produk }}" class="w-full h-full object-cover">
                                                    @else
                                                        <img src="{{ asset('images/produk_galon.jpg') }}" alt="{{ $prod->nama_produk }}" class="w-full h-full object-cover">
                                                    @endif
                                                @endif
                                                <span class="absolute top-2 right-2 px-2.5 py-0.5 bg-white/95 backdrop-blur-sm border border-slate-200 rounded-lg text-[10px] font-bold text-slate-700 shadow-sm">
                                                    Stok: {{ $prod->stok }}
                                                </span>
                                            </div>
                                            
                                            <div>
                                                <span class="inline-block text-[9px] font-bold uppercase tracking-wider bg-indigo-50 border border-indigo-100 text-indigo-700 px-1.5 py-0.5 rounded-full mb-1">
                                                    {{ $prod->kapasitas }} | {{ $prod->jenis_kemasan }}
                                                </span>
                                                <h4 class="text-lg font-black text-slate-800 leading-tight">{{ $prod->nama_produk }}</h4>
                                                <p class="text-xs font-semibold text-slate-500 mt-1 leading-relaxed">{{ Str::limit($prod->deskripsi, 80) }}</p>
                                            </div>
                                        </div>
                                        
                                        <div class="pt-4 border-t border-slate-100 mt-4 flex justify-between items-center">
                                            <div>
                                                <span class="text-[9px] font-extrabold text-slate-400 block uppercase tracking-wider">Harga</span>
                                                <span class="text-base font-black text-slate-800">Rp {{ number_format($prod->harga, 0, ',', '.') }}</span>
                                            </div>
                                            @if($prod->stok == 0)
                                                <button type="button" disabled
                                                        class="px-3 py-1.5 bg-slate-100 border border-slate-200 rounded-xl font-bold text-xs text-slate-400 shadow-none cursor-not-allowed">
                                                    Habis
                                                </button>
                                            @else
                                                <button type="button" 
                                                        onclick="openCheckoutModal({{ $prod->id_produk }}, '{{ addslashes($prod->nama_produk) }}', {{ $prod->harga }}, '{{ $prod->kapasitas }}', '{{ $prod->jenis_kemasan }}', {{ $prod->stok }})"
                                                        class="neo-brutal-btn neo-brutal-btn-cyan text-white px-3 py-1.5 text-xs">
                                                    Pesan Instan
                                                </button>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <!-- Tab Content: Subscription -->
                    <div id="tab-content-subscription" class="tab-pane hidden">
                        <div class="neo-brutal-card p-8 space-y-6">
                            <div class="flex items-center space-x-3">
                                <span class="p-2 bg-indigo-50 border border-indigo-100 rounded-full text-indigo-600 shadow-sm flex items-center justify-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-5 h-5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5m-9-6h.008v.008H12v-.008zM12 15h.008v.008H12V15zm0 2.25h.008v.008H12v-.008zM9.75 15h.008v.008H9.75V15zm0 2.25h.008v.008H9.75v-.008zM7.5 15h.008v.008H7.5V15zm0 2.25h.008v.008H7.5v-.008zm6.75-4.5h.008v.008h-.008v-.008zm0 2.25h.008v.008h-.008V15zm0 2.25h.008v.008h-.008v-.008zm2.25-4.5h.008v.008H16.5v-.008zm0 2.25h.008v.008H16.5V15z" />
                                    </svg>
                                </span>
                                <h3 class="text-2xl font-black text-slate-800">Jadwalkan Langganan Air Cerdas</h3>
                            </div>
                            <p class="text-sm font-semibold text-slate-500">Pilih jadwal pengantaran berkala dan durasi langganan. Kami akan menjadwalkan kurir secara otomatis.</p>
                            <div class="h-px bg-slate-200 rounded-full"></div>
                            
                            <form action="{{ route('pelanggan.langganan.store') }}" method="POST" id="sub-form" class="space-y-6">
                                @csrf
                                
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div>
                                        <label for="sub-id-produk" class="block text-xs font-bold text-slate-700 mb-1">Pilih Varian Air Mineral</label>
                                        <select name="id_produk" id="sub-id-produk" required class="neo-brutal-input w-full" onchange="calculateSubTotal()">
                                            <option value="" disabled selected>-- Pilih Produk --</option>
                                            @foreach($availableProducts as $prod)
                                                @if($prod->stok > 0)
                                                    <option value="{{ $prod->id_produk }}" data-harga="{{ $prod->harga }}">
                                                        {{ $prod->nama_produk }} ({{ $prod->kapasitas }}) - Rp {{ number_format($prod->harga, 0, ',', '.') }} (Stok: {{ $prod->stok }})
                                                    </option>
                                                @else
                                                    <option value="{{ $prod->id_produk }}" data-harga="{{ $prod->harga }}" disabled>
                                                        {{ $prod->nama_produk }} ({{ $prod->kapasitas }}) - Rp {{ number_format($prod->harga, 0, ',', '.') }} (Stok: Habis)
                                                    </option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                    
                                    <div>
                                        <label for="sub-jumlah-pesanan" class="block text-xs font-bold text-slate-700 mb-1">Jumlah Unit Per Pengiriman</label>
                                        <input type="number" name="jumlah_pesanan" id="sub-jumlah-pesanan" value="2" required class="neo-brutal-input w-full" oninput="calculateSubTotal()">
                                        <div id="sub-jumlah-warning" class="text-[10px] font-bold text-rose-500 mt-1 hidden">Jumlah unit harus minimal 1!</div>
                                    </div>
                                </div>
                                
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div>
                                        <label class="block text-xs font-bold text-slate-700 mb-1">Jadwal Hari Pengiriman (Bisa pilih > 1)</label>
                                        <div class="grid grid-cols-2 gap-2 p-3 bg-slate-50/50 border border-slate-200 rounded-xl shadow-sm">
                                            @foreach(['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'] as $day)
                                                <label class="flex items-center space-x-1.5 font-bold cursor-pointer text-xs">
                                                    <input type="checkbox" name="hari_pengantaran[]" value="{{ $day }}" class="w-4 h-4 border border-slate-300 text-indigo-600 focus:ring-0 rounded cursor-pointer" onchange="calculateSubTotal()">
                                                    <span>{{ $day }}</span>
                                                </label>
                                            @endforeach
                                        </div>
                                    </div>
                                    
                                    <div class="space-y-3">
                                        <div>
                                            <label for="sub-jam-pengantaran" class="block text-xs font-bold text-slate-700 mb-1">Waktu Pengiriman</label>
                                            <select name="jam_pengantaran" id="sub-jam-pengantaran" required class="neo-brutal-input w-full">
                                                <option value="09:00" selected>Pagi Hari (09.00)</option>
                                                <option value="13:00">Siang Hari (13.00)</option>
                                                <option value="16:00">Sore Hari (16.00)</option>
                                            </select>
                                        </div>
                                        
                                        <div>
                                            <label for="sub-durasi-bulan" class="block text-xs font-bold text-slate-700 mb-1">Durasi Langganan</label>
                                            <select name="durasi_bulan" id="sub-durasi-bulan" required class="neo-brutal-input w-full" onchange="calculateSubTotal()">
                                                <option value="1" selected>1 Bulan</option>
                                                <option value="3">3 Bulan</option>
                                                <option value="6">6 Bulan</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div>
                                        <label for="sub-no-telepon" class="block text-xs font-bold text-slate-700 mb-1">Nomor Telepon / WhatsApp</label>
                                        <input type="text" name="no_telepon" id="sub-no-telepon" value="{{ $pelanggan->no_telepon ?? '' }}" required class="neo-brutal-input w-full">
                                    </div>
                                    <div>
                                        <label for="sub-alamat" class="block text-xs font-bold text-slate-700 mb-1">Alamat Lengkap Pengiriman</label>
                                        <textarea name="alamat" id="sub-alamat" rows="1" required class="neo-brutal-input w-full">{{ $pelanggan->alamat ?? '' }}</textarea>
                                    </div>
                                </div>
                                
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div>
                                        <label for="sub-metode-pembayaran" class="block text-xs font-bold text-slate-700 mb-1">Metode Pembayaran</label>
                                        <select name="metode_pembayaran" id="sub-metode-pembayaran" required class="neo-brutal-input w-full">
                                            <option value="transfer" selected>Transfer Bank (Upfront)</option>
                                            <option value="tunai">Bayar di Tempat (COD)</option>
                                            <option value="e-wallet">E-Wallet</option>
                                        </select>
                                    </div>
                                    
                                    <div class="p-4 bg-indigo-50/50 border border-indigo-100 rounded-xl shadow-sm flex flex-col justify-between space-y-3">
                                        <div class="flex justify-between items-center text-xs">
                                            <div>
                                                <span class="font-bold text-slate-400 uppercase block">Total Pengiriman</span>
                                                <span id="sub-total-deliveries" class="font-extrabold text-slate-800 text-sm">0x pengiriman</span>
                                            </div>
                                            <div class="text-right">
                                                <span class="font-bold text-slate-400 uppercase block">Estimasi Tagihan</span>
                                                <span id="sub-total-tagihan" class="font-extrabold text-slate-800 text-base">Rp 0</span>
                                            </div>
                                        </div>
                                        <button type="submit" class="w-full py-2.5 neo-brutal-btn neo-brutal-btn-blue text-white text-xs">
                                            Aktifkan Langganan
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Tab Content: Deliveries -->
                    <div id="tab-content-deliveries" class="tab-pane hidden">
                        <div class="neo-brutal-card p-8 space-y-6">
                            <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                                <div class="flex items-center space-x-3">
                                    <span class="p-2 bg-indigo-50 border border-indigo-100 rounded-full text-indigo-600 shadow-sm flex items-center justify-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-5 h-5">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 18.75a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM19.5 18.75a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM2.25 15h13.5m-10.5-3h10.5m-10.5-3h10.5m-3.75-3H6.75A2.25 2.25 0 004.5 8.25V15h15V8.25A2.25 2.25 0 0017.25 6h-3.75Z" />
                                        </svg>
                                    </span>
                                    <h3 class="text-2xl font-black text-slate-800">Lacak Pengiriman Anda</h3>
                                </div>
                                
                                <!-- Sub-tabs toggle -->
                                <div class="flex space-x-2 p-1 bg-slate-50 border border-slate-200 rounded-xl w-full md:w-auto">
                                    <button type="button" onclick="switchDeliveryType('instant')" id="btn-delivery-instant" class="flex-1 md:flex-none py-1.5 px-4 rounded-lg font-bold text-xs transition-all bg-indigo-600 text-white shadow-sm">
                                        Pesanan Instan
                                    </button>
                                    <button type="button" onclick="switchDeliveryType('sub')" id="btn-delivery-sub" class="flex-1 md:flex-none py-1.5 px-4 rounded-lg font-bold text-xs transition-all bg-white text-slate-600 border border-slate-200/60 hover:bg-slate-50">
                                        Jadwal Berlangganan
                                    </button>
                                </div>
                            </div>
                            <p class="text-sm font-semibold text-slate-500">Seluruh jadwal pengantaran air mineral murni dari pesanan manual maupun otomatis langganan Anda.</p>
                            <div class="h-px bg-slate-200 rounded-full"></div>
                            
                            @php
                                $instantShipments = $myShipments->filter(fn($ship) => is_null($ship->transaksi->id_langganan));
                                $subscriptionShipments = $myShipments->filter(fn($ship) => !is_null($ship->transaksi->id_langganan));
                            @endphp

                            <!-- Instant Deliveries -->
                            <div id="delivery-instant-container" class="space-y-6">
                                @if($instantShipments->isNotEmpty())
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                        @foreach($instantShipments as $ship)
                                            <div class="p-5 bg-white border border-slate-200 rounded-2xl shadow-sm hover:shadow-md transition-all space-y-4">
                                                <div class="flex justify-between items-start">
                                                    <span class="px-2.5 py-0.5 bg-amber-50 border border-amber-200 rounded text-[10px] font-bold text-amber-800">
                                                        {{ $ship->transaksi->kode_invoice }}
                                                    </span>
                                                    
                                                    @if($ship->status_pengiriman === 'terkirim')
                                                        <span class="px-2.5 py-0.5 bg-emerald-500 text-white rounded-lg text-[9px] font-bold uppercase shadow-sm">Tiba</span>
                                                    @elseif($ship->status_pengiriman === 'dalam perjalanan')
                                                        <span class="px-2.5 py-0.5 bg-cyan-500 text-white rounded-lg text-[9px] font-bold uppercase shadow-sm animate-pulse">Jalan</span>
                                                    @elseif($ship->status_pengiriman === 'gagal')
                                                        <span class="px-2.5 py-0.5 bg-rose-500 text-white rounded-lg text-[9px] font-bold uppercase shadow-sm">Gagal</span>
                                                    @else
                                                        <span class="px-2.5 py-0.5 bg-slate-100 border border-slate-200 text-slate-600 rounded-lg text-[9px] font-bold uppercase shadow-sm">Jadwal</span>
                                                    @endif
                                                </div>
                                                
                                                <div class="space-y-1">
                                                    <h4 class="font-extrabold text-base text-slate-800 leading-tight">{{ $ship->transaksi->detailPesanan->produk->nama_produk ?? 'Air Mineral Rindu' }}</h4>
                                                    <p class="text-xs font-semibold text-slate-400">Jumlah: {{ $ship->transaksi->detailPesanan->jumlah ?? 1 }} Unit ({{ $ship->transaksi->detailPesanan->produk->kapasitas ?? '-' }})</p>
                                                </div>
                                                
                                                <div class="pt-3 border-t border-slate-100 text-xs font-bold text-slate-500 space-y-1">
                                                    <div>📅 Tanggal: {{ \Carbon\Carbon::parse($ship->tanggal_pengiriman)->translatedFormat('d M Y - H:i') }}</div>
                                                    <div>🚴 Kurir: {{ $ship->kurir->nama_kurir ?? 'Mencari kurir terdekat...' }}</div>
                                                    @if($ship->kurir && $ship->kurir->no_hp)
                                                        <div class="text-[10px] text-slate-400">📞 WhatsApp: {{ $ship->kurir->no_hp }}</div>
                                                    @endif
                                                    <div class="truncate">📍 Tujuan: {{ $ship->alamat_tujuan }}</div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @else
                                    <div class="text-center py-12 bg-slate-50 border border-slate-200 rounded-xl">
                                        <p class="text-slate-500 font-extrabold text-sm">Belum ada pengantaran pesanan instan yang dijadwalkan.</p>
                                    </div>
                                @endif
                            </div>

                            <!-- Subscription Deliveries -->
                            <div id="delivery-sub-container" class="hidden space-y-6">
                                @php
                                    $activeSubscriptions = $mySubscriptions->where('status_langganan', 'aktif');
                                @endphp
                                @if($activeSubscriptions->isNotEmpty())
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                        @foreach($activeSubscriptions as $sub)
                                            <div class="p-5 bg-white/90 border border-slate-200/80 rounded-2xl shadow-sm hover:shadow-md hover:translate-y-[-1px] transition-all flex flex-col justify-between">
                                                <div class="space-y-3">
                                                    <div class="flex justify-between items-start">
                                                        <span class="px-2.5 py-0.5 bg-indigo-50 text-indigo-700 border border-indigo-100 rounded text-[10px] font-bold">
                                                            SUB-{{ $sub->id_langganan }}
                                                        </span>
                                                        <span class="px-2 py-0.5 bg-emerald-50 text-emerald-700 border border-emerald-100 rounded text-[9px] font-bold uppercase">
                                                            {{ $sub->status_langganan }}
                                                        </span>
                                                    </div>
                                                    
                                                    <div class="space-y-1">
                                                        <h4 class="font-bold text-base text-slate-800 leading-tight">{{ $sub->produk->nama_produk ?? 'Air Mineral Rindu' }}</h4>
                                                        <p class="text-xs font-medium text-slate-500">Jumlah: {{ $sub->jumlah_pesanan }} Unit ({{ $sub->produk->kapasitas ?? '-' }})</p>
                                                    </div>
                                                    
                                                    <div class="pt-3 border-t border-slate-100 text-xs font-medium text-slate-600 space-y-1">
                                                        <div>📅 Periode: {{ \Carbon\Carbon::parse($sub->tanggal_mulai)->format('d M Y') }} - {{ \Carbon\Carbon::parse($sub->tanggal_berakhir)->format('d M Y') }}</div>
                                                        <div>⏰ Jadwal: {{ $sub->hari_pengantaran }} @ {{ $sub->jam_pengantaran }}</div>
                                                        <div>📦 Total Pengiriman: {{ $sub->transaksi->count() }}x pengantaran</div>
                                                    </div>
                                                </div>
                                                
                                                <div class="pt-3 border-t border-slate-100">
                                                    <button type="button" onclick="openTrackingModal({{ $sub->id_langganan }})" class="w-full py-2 bg-gradient-to-r from-amber-400 to-yellow-400 border border-amber-300 rounded-xl font-bold text-xs text-slate-800 shadow-sm hover:from-amber-500 hover:to-yellow-500 hover:shadow active:scale-[0.98] transition-all text-center">
                                                         Detail Pengiriman
                                                    </button>
                                                </div>
                                                                          <!-- Modern Tracking Modal -->
                                            <div id="tracking-modal-{{ $sub->id_langganan }}" class="fixed inset-0 bg-black/60 z-[999] flex items-center justify-center hidden opacity-0 transition-opacity duration-300">
                                                <div class="bg-white/95 backdrop-blur-md border border-slate-200 p-8 rounded-[24px] shadow-2xl max-w-lg w-full mx-4 relative transform scale-95 transition-transform duration-300 max-h-[85vh] overflow-y-auto">
                                                    <button onclick="closeTrackingModal({{ $sub->id_langganan }})" class="absolute top-4 right-4 w-8 h-8 rounded-lg bg-slate-100 hover:bg-slate-200 text-slate-500 hover:text-slate-800 flex items-center justify-center font-bold transition-all text-xs text-center">
                                                        ✕
                                                    </button>
                                                    
                                                    <h3 class="text-xl font-bold text-slate-800 mb-2">Detail Pengiriman Langganan</h3>
                                                    <p class="text-xs font-semibold text-slate-500 mb-4">SUB-{{ $sub->id_langganan }} | {{ $sub->produk->nama_produk ?? 'Air Mineral Rindu' }}</p>
                                                    <div class="h-px bg-slate-100 mb-6"></div>
                                                    
                                                    <div class="space-y-4">
                                                        @php
                                                            $sortedDeliveries = $sub->transaksi->sortBy('tanggal_transaksi');
                                                        @endphp
                                                        @if($sortedDeliveries->isNotEmpty())
                                                            <div class="relative border-l border-slate-200 ml-4 pl-6 space-y-6 text-left">
                                                                @foreach($sortedDeliveries as $tx)
                                                                    @php
                                                                        $ship = $tx->pengiriman;
                                                                        $status = $ship ? $ship->status_pengiriman : 'dijadwalkan';
                                                                        $bgCircle = 'bg-slate-300';
                                                                        if ($status === 'terkirim') {
                                                                            $bgCircle = 'bg-emerald-500';
                                                                        } elseif ($status === 'dalam perjalanan') {
                                                                            $bgCircle = 'bg-sky-500';
                                                                        } elseif ($status === 'gagal') {
                                                                            $bgCircle = 'bg-rose-500';
                                                                        } else {
                                                                            $bgCircle = 'bg-amber-500';
                                                                        }
                                                                    @endphp
                                                                    <div class="relative">
                                                                        <!-- Timeline Dot -->
                                                                        <span class="absolute -left-[31px] top-1.5 w-4 h-4 rounded-full border border-white {{ $bgCircle }} shadow-sm flex items-center justify-center">
                                                                        </span>
                                                                        
                                                                        <!-- Card content -->
                                                                        <div class="p-4 bg-white border border-slate-200/80 rounded-xl shadow-sm space-y-2">
                                                                            <div class="flex justify-between items-center">
                                                                                <span class="px-2 py-0.5 bg-slate-100 text-slate-700 border border-slate-200 rounded text-[9px] font-bold">
                                                                                    {{ $tx->kode_invoice }}
                                                                                </span>
                                                                                <span class="px-2 py-0.5 border rounded text-[8px] font-bold uppercase 
                                                                                    @if($status === 'terkirim') bg-emerald-50 text-emerald-700 border-emerald-100
                                                                                    @elseif($status === 'dalam perjalanan') bg-sky-50 text-sky-700 border-sky-100
                                                                                    @elseif($status === 'gagal') bg-rose-50 text-rose-700 border-rose-100
                                                                                    @else bg-amber-50 text-amber-700 border-amber-100 @endif">
                                                                                    {{ $status }}
                                                                                </span>
                                                                            </div>
                                                                            <div class="text-[11px] font-semibold text-slate-600 space-y-1">
                                                                                <div>Tanggal: {{ \Carbon\Carbon::parse($tx->tanggal_transaksi)->translatedFormat('d M Y - H:i') }}</div>
                                                                                <div>Kurir: {{ $ship && $ship->kurir ? $ship->kurir->nama_kurir : 'Mencari kurir terdekat...' }}</div>
                                                                                @if($ship && $ship->kurir && $ship->kurir->no_hp)
                                                                                    <div class="text-[10px] text-slate-400">WhatsApp: {{ $ship->kurir->no_hp }}</div>
                                                                                @endif
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                @endforeach
                                                            </div>
                                                        @else
                                                            <p class="text-xs font-bold text-slate-500 text-center py-4">Belum ada detail pengiriman untuk langganan ini.</p>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @else
                                    <div class="text-center py-12 bg-white/80 border border-slate-200/80 rounded-xl">
                                        <p class="text-slate-500 font-bold text-sm">Belum ada jadwal langganan aktif yang berjalan.</p>
                                    </div>
                                 @endif
                             </div>
                         </div>
                     </div>

                    <!-- Tab Content: Transactions -->
                    <div id="tab-content-transactions" class="tab-pane hidden">
                        <div class="neo-brutal-card p-8 bg-white space-y-6">
                            <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                                <div class="flex items-center space-x-3">
                                    <div class="p-2 bg-sky-50 text-sky-600 rounded-full border border-sky-100 flex items-center justify-center shrink-0">
                                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 002-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                                        </svg>
                                    </div>
                                    <h3 class="text-2xl font-bold text-slate-800">Riwayat Transaksi & Pembelian</h3>
                                </div>
                                
                                <!-- Sub-tabs toggle -->
                                <div class="flex space-x-2 p-1 bg-slate-50 border border-slate-200 rounded-xl w-full md:w-auto">
                                    <button type="button" onclick="switchTxType('instant')" id="btn-tx-instant" class="flex-1 md:flex-none py-1.5 px-4 rounded-lg font-bold text-xs transition-all bg-indigo-600 text-white shadow-sm">
                                        Pesan Instan
                                    </button>
                                    <button type="button" onclick="switchTxType('sub')" id="btn-tx-sub" class="flex-1 md:flex-none py-1.5 px-4 rounded-lg font-bold text-xs transition-all bg-white text-slate-600 border border-slate-200/60 hover:bg-slate-50">
                                        Riwayat Berlangganan
                                    </button>
                                </div>
                            </div>
                            <div class="h-px bg-slate-100"></div>
                            
                            @php
                                $instantTransactions = $myTransactions->filter(fn($tx) => is_null($tx->id_langganan));
                                $subscriptionTransactions = $myTransactions->filter(fn($tx) => !is_null($tx->id_langganan));
                            @endphp

                            <!-- Instant Transactions Container -->
                            <div id="tx-instant-container" class="space-y-6">
                                @if($instantTransactions->isNotEmpty())
                                    <div class="overflow-x-auto border border-slate-200 rounded-xl shadow-sm">
                                        <table class="w-full text-left border-collapse bg-white">
                                            <thead>
                                                <tr class="bg-slate-50 border-b border-slate-200 text-slate-700 font-bold text-xs">
                                                    <th class="p-4 border-r border-slate-100">Invoice</th>
                                                    <th class="p-4 border-r border-slate-100">Tanggal</th>
                                                    <th class="p-4 border-r border-slate-100">Produk</th>
                                                    <th class="p-4 border-r border-slate-100 text-center">Jumlah</th>
                                                    <th class="p-4 border-r border-slate-100 text-right">Total</th>
                                                    <th class="p-4 border-r border-slate-100">Metode</th>
                                                    <th class="p-4">Status</th>
                                                </tr>
                                            </thead>
                                            <tbody class="text-xs font-semibold text-slate-600">
                                                @foreach($instantTransactions as $tx)
                                                    <tr class="border-b border-slate-100 hover:bg-slate-50/50 transition-colors">
                                                        <td class="p-4 border-r border-slate-100">
                                                             <span class="px-2 py-0.5 bg-slate-100 text-slate-700 border border-slate-200 rounded text-[10px] font-bold">
                                                                 {{ $tx->kode_invoice }}
                                                             </span>
                                                        </td>
                                                        <td class="p-4 border-r border-slate-100 text-slate-500">
                                                             {{ \Carbon\Carbon::parse($tx->tanggal_transaksi)->format('d M Y - H:i') }}
                                                        </td>
                                                        <td class="p-4 border-r border-slate-100 text-slate-800">
                                                             {{ $tx->detailPesanan->produk->nama_produk ?? 'Air Mineral Rindu' }}
                                                             <span class="text-[10px] font-medium text-slate-400 block">({{ $tx->detailPesanan->produk->kapasitas ?? '-' }})</span>
                                                        </td>
                                                        <td class="p-4 border-r border-slate-100 text-center font-bold">
                                                             {{ $tx->detailPesanan->jumlah ?? 1 }} Unit
                                                        </td>
                                                        <td class="p-4 border-r border-slate-100 text-right font-bold text-slate-800">
                                                             Rp {{ number_format($tx->total_bayar, 0, ',', '.') }}
                                                        </td>
                                                        <td class="p-4 border-r border-slate-100 uppercase text-[10px] font-bold">
                                                             {{ $tx->metode_pembayaran }}
                                                        </td>
                                                        <td class="p-4">
                                                             @if($tx->status_transaksi === 'dibayar' || $tx->status_transaksi === 'selesai')
                                                                 <span class="px-2 py-0.5 bg-emerald-50 text-emerald-700 border border-emerald-100 rounded text-[9px] font-bold uppercase">
                                                                     {{ $tx->status_transaksi }}
                                                                 </span>
                                                             @elseif($tx->status_transaksi === 'menunggu')
                                                                 <span class="px-2 py-0.5 bg-amber-50 text-amber-700 border border-amber-100 rounded text-[9px] font-bold uppercase">
                                                                     {{ $tx->status_transaksi }}
                                                                 </span>
                                                             @else
                                                                 <span class="px-2 py-0.5 bg-rose-50 text-rose-700 border border-rose-100 rounded text-[9px] font-bold uppercase">
                                                                     {{ $tx->status_transaksi }}
                                                                 </span>
                                                             @endif
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                @else
                                    <div class="text-center py-10 bg-white/80 border border-slate-200/80 rounded-xl">
                                        <p class="text-slate-500 font-bold text-sm">Belum ada riwayat transaksi instan.</p>
                                    </div>
                                @endif
                             </div>

                            <!-- Subscription Transactions Container -->
                            <div id="tx-sub-container" class="hidden space-y-6">
                                @if($mySubscriptions->isNotEmpty())
                                    <div class="overflow-x-auto border border-slate-200 rounded-xl shadow-sm">
                                        <table class="w-full text-left border-collapse bg-white">
                                            <thead>
                                                <tr class="bg-slate-50 border-b border-slate-200 text-slate-700 font-bold text-xs">
                                                    <th class="p-4 border-r border-slate-100">Kode Sub</th>
                                                    <th class="p-4 border-r border-slate-100">Tanggal Mulai</th>
                                                    <th class="p-4 border-r border-slate-100">Produk & Qty</th>
                                                    <th class="p-4 border-r border-slate-100">Jadwal</th>
                                                    <th class="p-4 border-r border-slate-100">Periode</th>
                                                    <th class="p-4 border-r border-slate-100 text-right">Total Tagihan</th>
                                                    <th class="p-4 border-r border-slate-100">Metode</th>
                                                    <th class="p-4">Status</th>
                                                </tr>
                                            </thead>
                                            <tbody class="text-xs font-semibold text-slate-600">
                                                @foreach($mySubscriptions as $sub)
                                                    <tr class="border-b border-slate-100 hover:bg-slate-50/50 transition-colors">
                                                        <td class="p-4 border-r border-slate-100">
                                                             <span class="px-2 py-0.5 bg-indigo-50 text-indigo-700 border border-indigo-100 rounded text-[10px] font-bold">
                                                                 SUB-{{ $sub->id_langganan }}
                                                             </span>
                                                        </td>
                                                        <td class="p-4 border-r border-slate-100 text-slate-500">
                                                             {{ \Carbon\Carbon::parse($sub->tanggal_mulai)->format('d M Y') }}
                                                        </td>
                                                        <td class="p-4 border-r border-slate-100 text-slate-800">
                                                             {{ $sub->produk->nama_produk ?? 'Air Mineral Rindu' }}
                                                             <span class="text-[10px] font-medium text-slate-400 block">({{ $sub->jumlah_pesanan }} Unit | {{ $sub->produk->kapasitas ?? '-' }})</span>
                                                        </td>
                                                        <td class="p-4 border-r-slate-100 text-slate-600">
                                                             {{ $sub->hari_pengantaran }} @ {{ $sub->jam_pengantaran }}
                                                        </td>
                                                        <td class="p-4 border-r border-slate-100 text-slate-500 text-[10px]">
                                                             {{ \Carbon\Carbon::parse($sub->tanggal_mulai)->format('d M Y') }} - {{ \Carbon\Carbon::parse($sub->tanggal_berakhir)->format('d M Y') }}
                                                        </td>
                                                        <td class="p-4 border-r border-slate-100 text-right font-bold text-slate-800">
                                                             Rp {{ number_format($sub->jumlah_pesanan * ($sub->produk->harga ?? 0) * $sub->transaksi->count(), 0, ',', '.') }}
                                                        </td>
                                                        <td class="p-4 border-r border-slate-100 uppercase text-[10px] font-bold">
                                                             {{ optional($sub->transaksi->first())->metode_pembayaran ?? '-' }}
                                                        </td>
                                                        <td class="p-4">
                                                             @if($sub->status_langganan === 'aktif')
                                                                 <span class="px-2 py-0.5 bg-emerald-50 text-emerald-700 border border-emerald-100 rounded text-[9px] font-bold uppercase">
                                                                     {{ $sub->status_langganan }}
                                                                 </span>
                                                             @elseif($sub->status_langganan === 'tertunda')
                                                                 <span class="px-2 py-0.5 bg-amber-50 text-amber-700 border border-amber-100 rounded text-[9px] font-bold uppercase">
                                                                     {{ $sub->status_langganan }}
                                                                 </span>
                                                             @else
                                                                 <span class="px-2 py-0.5 bg-rose-50 text-rose-700 border border-rose-100 rounded text-[9px] font-bold uppercase">
                                                                     {{ $sub->status_langganan }}
                                                                 </span>
                                                             @endif
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                @else
                                    <div class="text-center py-10 bg-white/80 border border-slate-200/80 rounded-xl">
                                        <p class="text-slate-500 font-bold text-sm">Belum ada riwayat transaksi langganan.</p>
                                    </div>
                                @endif
                            </div>

                        </div>
                    </div>
                    </div>
                </div>

                <!-- Column 2: Customer Profile & Info (4 Columns) -->
                <div class="lg:col-span-4 space-y-8">
                    <!-- Profile Card -->
                    <div class="neo-brutal-card p-8 bg-white space-y-6">
                        <div class="flex items-center space-x-3">
                            <div class="p-2 bg-indigo-50 text-indigo-600 rounded-full border border-indigo-100 flex items-center justify-center shrink-0">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-5 h-5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 9h3.75M15 12h3.75M15 15h3.75M4.5 19.5h15a2.25 2.25 0 002.25-2.25V6.75A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25v10.5A2.25 2.25 0 004.5 19.5zm6-10.125a1.875 1.875 0 11-3.75 0 1.875 1.875 0 013.75 0zm1.294 6.336a6.721 6.721 0 01-3.17.789 6.721 6.721 0 01-3.168-.789 3.376 3.376 0 016.338 0z" />
                                </svg>
                            </div>
                            <h3 class="text-xl font-bold text-slate-800">Profil Pelanggan</h3>
                        </div>
                        <div class="h-px bg-slate-100"></div>

                        @if($pelanggan)
                            <div class="space-y-4 text-xs font-semibold text-slate-600">
                                <div>
                                    <span class="block text-[10px] text-slate-400 uppercase tracking-wider">Nama Pelanggan</span>
                                    <span class="text-sm font-bold text-slate-800">{{ $pelanggan->nama_pelanggan }}</span>
                                </div>
                                <div>
                                    <span class="block text-[10px] text-slate-400 uppercase tracking-wider">Email Akun</span>
                                    <span class="text-sm text-slate-600 truncate block">{{ $pelanggan->email }}</span>
                                </div>
                                <div>
                                    <span class="block text-[10px] text-slate-400 uppercase tracking-wider">Nomor Telepon</span>
                                    <span class="text-sm font-bold text-slate-800">{{ $pelanggan->no_telepon }}</span>
                                </div>
                                <div class="space-y-2">
                                    <span class="block text-[10px] text-slate-400 uppercase tracking-wider">Alamat Pengiriman Utama</span>
                                    <p class="text-xs text-slate-700 bg-slate-50/50 p-3 border border-slate-200 rounded-lg leading-relaxed font-semibold">
                                        {{ $pelanggan->alamat }}
                                    </p>
                                    <button type="button" onclick="useProfileContactInfo('{{ addslashes($pelanggan->alamat) }}', '{{ addslashes($pelanggan->no_telepon) }}')" class="w-full py-2 bg-gradient-to-r from-amber-400 to-yellow-400 border border-amber-300 rounded-xl font-bold text-[10px] text-slate-800 shadow-sm hover:from-amber-500 hover:to-yellow-500 hover:shadow active:scale-[0.98] transition-all text-center">
                                        Gunakan Kontak & Alamat Ini
                                    </button>
                                </div>
                                <div>
                                    <span class="block text-[10px] text-slate-400 uppercase tracking-wider">Status Akun</span>
                                    <span class="inline-block text-[10px] font-bold text-emerald-700 bg-emerald-50 px-2 py-0.5 border border-emerald-100 rounded mt-1">
                                        {{ strtoupper($pelanggan->status_pelanggan) }}
                                    </span>
                                </div>
                            </div>
                        @else
                            <div class="text-center py-6 space-y-4">
                                <div class="inline-flex items-center justify-center p-3 bg-amber-50 text-amber-600 rounded-full border border-amber-100 mx-auto">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 18a3.75 3.75 0 00.495-7.467 5.99 5.99 0 00-1.925 3.546 5.974 5.974 0 01-2.133-1A3.75 3.75 0 0012 18z" />
                                    </svg>
                                </div>
                                <p class="text-xs font-semibold text-slate-500 leading-relaxed">Anda belum menempatkan pesanan pertama Anda. Profil Anda akan terisi otomatis setelah pesanan pertama ditempatkan.</p>
                            </div>
                        @endif
                    </div>

                    <!-- Subscription Info Card -->
                    <div class="bg-gradient-to-tr from-amber-400 to-amber-300 p-6 rounded-[20px] shadow-sm shadow-amber-400/10 space-y-4 text-slate-800">
                        <div class="flex items-center space-x-3 mb-2">
                            <div class="p-2 bg-white/40 backdrop-blur-sm rounded-full text-slate-800 flex items-center justify-center border border-white/20">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9.813 15.904L9 21l8.982-11.795m-8.982 6.705l6.5-6.5a1.5 1.5 0 00-2.122-2.122l-6.5 6.5M19.5 10.5a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <h3 class="text-lg font-bold text-slate-800">Info Siklus Langganan</h3>
                        </div>
                        <div class="h-px bg-white/20 mb-4"></div>
                        <div class="space-y-4 text-xs font-semibold text-slate-700">
                            <div class="p-4 bg-white/80 backdrop-blur-sm border border-white/30 rounded-xl shadow-sm transition-all hover:translate-y-[-1px]">
                                <span class="inline-block px-1.5 py-0.5 bg-indigo-100 text-indigo-700 border border-indigo-200 rounded-md text-[9px] font-bold uppercase tracking-wider mb-2">Simpel & Transparan</span>
                                <p class="leading-relaxed">Cukup tentukan hari pengantaran dan durasi langganan. Seluruh jadwal pengantaran akan pre-generated untuk kenyamanan pemantauan Anda.</p>
                            </div>
                            <div class="p-4 bg-white/80 backdrop-blur-sm border border-white/30 rounded-xl shadow-sm transition-all hover:translate-y-[-1px]">
                                <span class="inline-block px-1.5 py-0.5 bg-emerald-100 text-emerald-700 border border-emerald-200 rounded-md text-[9px] font-bold uppercase tracking-wider mb-2">Pembayaran</span>
                                <p class="leading-relaxed">Metode transfer melunasi di awal seluruh nominal langganan. Metode COD membebankan tagihan secara terpisah saat air diantarkan kurir.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Checkout Modal -->
            <div id="checkout-modal" class="fixed inset-0 bg-black/60 z-[999] flex items-center justify-center hidden opacity-0 transition-opacity duration-300">
                <div class="bg-white/95 backdrop-blur-md border border-slate-200 p-8 rounded-[24px] shadow-2xl max-w-md w-full mx-4 relative transform scale-95 transition-transform duration-300 max-h-[95vh] overflow-y-auto">
                    <button onclick="closeCheckoutModal()" class="absolute top-4 right-4 w-8 h-8 rounded-lg bg-slate-100 hover:bg-slate-200 text-slate-500 hover:text-slate-800 flex items-center justify-center font-bold transition-all text-xs">
                        ✕
                    </button>
                    
                    <h3 class="text-xl font-bold text-slate-800 mb-2">Checkout Pemesanan Instan</h3>
                    <div class="h-px bg-slate-100 mb-4"></div>
                    
                    <form action="{{ route('orders.store') }}" method="POST" id="checkout-form" class="space-y-4" novalidate>
                        @csrf
                        <input type="hidden" name="id_produk" id="modal-id-produk">
                        <input type="hidden" name="berlangganan" value="sekali">
                        
                        <!-- Product Info Box -->
                        <div class="p-4 bg-indigo-50/50 border border-indigo-100 rounded-xl flex justify-between items-center">
                            <div>
                                <span id="modal-product-badge" class="inline-block text-[9px] font-bold uppercase bg-indigo-100 text-indigo-700 border border-indigo-200 px-1.5 py-0.5 rounded mb-1">BOTOL</span>
                                <h4 id="modal-product-name" class="font-bold text-base text-slate-800">Rindu Pure Botol</h4>
                            </div>
                            <div class="text-right">
                                <span class="text-[9px] font-bold text-slate-400 block uppercase">Harga</span>
                                <span id="modal-product-price-text" class="font-bold text-slate-800 text-sm">Rp 0</span>
                            </div>
                        </div>
                        
                        <!-- Contact Details -->
                        <div class="space-y-3">
                            <div>
                                <label for="modal-no-telepon" class="block text-[10px] font-bold text-slate-700 mb-1">Nomor Telepon / WhatsApp</label>
                                <input type="text" name="no_telepon" id="modal-no-telepon" value="{{ $pelanggan->no_telepon ?? '' }}" required class="neo-brutal-input w-full">
                            </div>
                            <div>
                                <label for="modal-alamat" class="block text-[10px] font-bold text-slate-700 mb-1">Alamat Lengkap Pengiriman</label>
                                <textarea name="alamat" id="modal-alamat" rows="2" required class="neo-brutal-input w-full">{{ $pelanggan->alamat ?? '' }}</textarea>
                            </div>
                        </div>
                        
                        <!-- Qty & Payment Method -->
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label for="modal-jumlah" class="block text-[10px] font-bold text-slate-700 mb-1">Jumlah Unit (Qty)</label>
                                <input type="number" name="jumlah" id="modal-jumlah" value="1" oninput="calculateModalTotal()" required class="neo-brutal-input w-full">
                                <div id="modal-jumlah-warning" class="text-[10px] font-bold text-rose-600 mt-1 hidden">⚠️ Jumlah unit harus minimal 1!</div>
                            </div>
                            <div>
                                <label for="modal-metode-pembayaran" class="block text-[10px] font-bold text-slate-700 mb-1">Metode Pembayaran</label>
                                <select name="metode_pembayaran" id="modal-metode-pembayaran" required class="neo-brutal-input w-full">
                                    <option value="transfer" selected>Transfer Bank</option>
                                    <option value="tunai">Tunai / COD</option>
                                    <option value="e-wallet">E-Wallet</option>
                                </select>
                            </div>
                        </div>

                        <!-- Shipping Method -->
                        <div>
                            <label for="modal-metode-pengiriman" class="block text-[10px] font-bold text-slate-700 mb-1">Metode Pengiriman</label>
                            <select name="metode_pengiriman" id="modal-metode-pengiriman" onchange="calculateModalTotal()" required class="neo-brutal-input w-full">
                                <option value="standart" data-biaya="5000">Standard (1-2 Hari) - Rp 5.000</option>
                                <option value="sameday" data-biaya="15000">Sameday (Hari Ini) - Rp 15.000</option>
                                <option value="instant" data-biaya="25000" selected>Instant (3-4 Jam) - Rp 25.000</option>
                            </select>
                        </div>
                        
                        <!-- Notes -->
                        <div>
                            <label for="modal-catatan" class="block text-[10px] font-bold text-slate-700 mb-1">Catatan Tambahan (Opsional)</label>
                            <input type="text" name="catatan" id="modal-catatan" placeholder="Contoh: Depan pagar warna putih" class="neo-brutal-input w-full">
                        </div>

                        <!-- Detail Pesanan Breakdown -->
                        <div class="p-4 bg-slate-50 border border-slate-200/80 rounded-xl space-y-2 mt-4">
                            <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest block">Detail Pesanan</span>
                            <div class="flex justify-between text-xs font-semibold text-slate-700">
                                <span>Biaya Air Mineral (<span id="modal-breakdown-qty">1</span>x):</span>
                                <span id="modal-breakdown-produk">Rp 0</span>
                            </div>
                            <div class="flex justify-between text-xs font-semibold text-slate-700">
                                <span>Biaya Pengiriman:</span>
                                <span id="modal-breakdown-ongkir">Rp 0</span>
                            </div>
                            <div class="h-px bg-slate-200 my-1"></div>
                            <div class="flex justify-between text-xs font-bold text-slate-800">
                                <span>Total Keseluruhan:</span>
                                <span id="modal-breakdown-total">Rp 0</span>
                            </div>
                        </div>
                        
                        <!-- Price Box & Submit -->
                        <div class="p-4 bg-emerald-50/50 border border-emerald-100 rounded-xl flex justify-between items-center mt-6">
                            <div>
                                <span class="text-[9px] font-bold text-slate-400 uppercase tracking-widest block">Total Bayar</span>
                                <span id="modal-total-tagihan-text" class="text-xl font-bold text-slate-800">Rp 0</span>
                                <button type="button" onclick="document.getElementById('modal-breakdown-container').classList.toggle('hidden')" class="text-[10px] text-indigo-600 font-bold mt-1 underline block">Lihat Detail Pesanan</button>
                            </div>
                            <button type="submit" class="px-5 py-3 bg-gradient-to-tr from-emerald-600 to-teal-600 hover:from-emerald-700 hover:to-teal-700 text-white font-bold text-xs rounded-xl shadow-sm transition-all">
                                Konfirmasi Pesanan
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- JavaScript Logic -->
            <script>
                // Tab switching logic
                function switchTab(tabId) {
                    document.querySelectorAll('.tab-pane').forEach(pane => pane.classList.add('hidden'));
                    document.querySelectorAll('.tab-btn').forEach(btn => {
                        btn.classList.remove('bg-indigo-600', 'text-white');
                        btn.classList.add('bg-white', 'text-slate-600', 'hover:bg-slate-50');
                    });
                    
                    document.getElementById('tab-content-' + tabId).classList.remove('hidden');
                    
                    const activeBtn = document.getElementById('tab-btn-' + tabId);
                    activeBtn.classList.add('bg-indigo-600', 'text-white');
                    activeBtn.classList.remove('bg-white', 'text-slate-600', 'hover:bg-slate-50');
                }

                // Delivery sub-tabs toggling
                function switchDeliveryType(type) {
                    const btnInstant = document.getElementById('btn-delivery-instant');
                    const btnSub = document.getElementById('btn-delivery-sub');
                    const containerInstant = document.getElementById('delivery-instant-container');
                    const containerSub = document.getElementById('delivery-sub-container');

                    if (type === 'instant') {
                        btnInstant.classList.add('bg-indigo-600', 'text-white', 'shadow-sm');
                        btnInstant.classList.remove('bg-white', 'text-slate-600', 'border', 'border-slate-200/60', 'hover:bg-slate-50');
                        btnSub.classList.remove('bg-indigo-600', 'text-white', 'shadow-sm');
                        btnSub.classList.add('bg-white', 'text-slate-600', 'border', 'border-slate-200/60', 'hover:bg-slate-50');
                        containerInstant.classList.remove('hidden');
                        containerSub.classList.add('hidden');
                    } else {
                        btnSub.classList.add('bg-indigo-600', 'text-white', 'shadow-sm');
                        btnSub.classList.remove('bg-white', 'text-slate-600', 'border', 'border-slate-200/60', 'hover:bg-slate-50');
                        btnInstant.classList.remove('bg-indigo-600', 'text-white', 'shadow-sm');
                        btnInstant.classList.add('bg-white', 'text-slate-600', 'border', 'border-slate-200/60', 'hover:bg-slate-50');
                        containerSub.classList.remove('hidden');
                        containerInstant.classList.add('hidden');
                    }
                }

                // Transaction sub-tabs toggling
                function switchTxType(type) {
                    const btnInstant = document.getElementById('btn-tx-instant');
                    const btnSub = document.getElementById('btn-tx-sub');
                    const containerInstant = document.getElementById('tx-instant-container');
                    const containerSub = document.getElementById('tx-sub-container');

                    if (type === 'instant') {
                        btnInstant.classList.add('bg-indigo-600', 'text-white', 'shadow-sm');
                        btnInstant.classList.remove('bg-white', 'text-slate-600', 'border', 'border-slate-200/60', 'hover:bg-slate-50');
                        btnSub.classList.remove('bg-indigo-600', 'text-white', 'shadow-sm');
                        btnSub.classList.add('bg-white', 'text-slate-600', 'border', 'border-slate-200/60', 'hover:bg-slate-50');
                        containerInstant.classList.remove('hidden');
                        containerSub.classList.add('hidden');
                    } else {
                        btnSub.classList.add('bg-indigo-600', 'text-white', 'shadow-sm');
                        btnSub.classList.remove('bg-white', 'text-slate-600', 'border', 'border-slate-200/60', 'hover:bg-slate-50');
                        btnInstant.classList.remove('bg-indigo-600', 'text-white', 'shadow-sm');
                        btnInstant.classList.add('bg-white', 'text-slate-600', 'border', 'border-slate-200/60', 'hover:bg-slate-50');
                        containerSub.classList.remove('hidden');
                        containerInstant.classList.add('hidden');
                    }
                }

                // Tracking modal controls
                function openTrackingModal(subId) {
                    const modal = document.getElementById('tracking-modal-' + subId);
                    if (modal) {
                        modal.classList.remove('hidden');
                        setTimeout(() => {
                            modal.classList.remove('opacity-0');
                            modal.querySelector('.transform').classList.remove('scale-95');
                        }, 50);
                    }
                }

                function closeTrackingModal(subId) {
                    const modal = document.getElementById('tracking-modal-' + subId);
                    if (modal) {
                        modal.classList.add('opacity-0');
                        modal.querySelector('.transform').classList.add('scale-95');
                        setTimeout(() => {
                            modal.classList.add('hidden');
                        }, 300);
                    }
                }

                // Modal checkout prefill and control
                function openCheckoutModal(id, name, price, kapasitas, kemasan, stok) {
                    document.getElementById('modal-id-produk').value = id;
                    document.getElementById('modal-product-name').textContent = name;
                    document.getElementById('modal-product-badge').textContent = kemasan.toUpperCase() + ' | ' + kapasitas;
                    document.getElementById('modal-product-price-text').textContent = 'Rp ' + price.toLocaleString('id-ID');
                    
                    const qtyInput = document.getElementById('modal-jumlah');
                    qtyInput.value = 1;
                    qtyInput.max = stok;
                    qtyInput.dataset.price = price;
                    
                    calculateModalTotal();
                    
                    const modal = document.getElementById('checkout-modal');
                    modal.classList.remove('hidden');
                    setTimeout(() => {
                        modal.classList.remove('opacity-0');
                        modal.querySelector('.transform').classList.remove('scale-95');
                    }, 50);
                }

                function closeCheckoutModal() {
                    const modal = document.getElementById('checkout-modal');
                    modal.classList.add('opacity-0');
                    modal.querySelector('.transform').classList.add('scale-95');
                    setTimeout(() => {
                        modal.classList.add('hidden');
                    }, 300);
                }

                function calculateModalTotal() {
                    const qtyInput = document.getElementById('modal-jumlah');
                    const warning = document.getElementById('modal-jumlah-warning');
                    const price = parseFloat(qtyInput.dataset.price) || 0;
                    const qty = parseInt(qtyInput.value);
                    
                    if (isNaN(qty) || qty <= 0) {
                        warning.classList.remove('hidden');
                    } else {
                        warning.classList.add('hidden');
                    }

                    const shipSelect = document.getElementById('modal-metode-pengiriman');
                    let shipCost = 0;
                    if (shipSelect && shipSelect.selectedIndex >= 0) {
                        const selectedOption = shipSelect.options[shipSelect.selectedIndex];
                        shipCost = parseFloat(selectedOption.getAttribute('data-biaya')) || 0;
                    }

                    const calculateQty = isNaN(qty) || qty < 0 ? 0 : qty;
                    const productCost = price * calculateQty;
                    const total = productCost + shipCost;

                    // Update main total text
                    document.getElementById('modal-total-tagihan-text').textContent = 'Rp ' + total.toLocaleString('id-ID');

                    // Update breakdown text
                    document.getElementById('modal-breakdown-qty').textContent = calculateQty;
                    document.getElementById('modal-breakdown-produk').textContent = 'Rp ' + productCost.toLocaleString('id-ID');
                    document.getElementById('modal-breakdown-ongkir').textContent = 'Rp ' + shipCost.toLocaleString('id-ID');
                    document.getElementById('modal-breakdown-total').textContent = 'Rp ' + total.toLocaleString('id-ID');
                }

                // Subscription pricing and delivery date calculation
                function calculateSubTotal() {
                    const select = document.getElementById('sub-id-produk');
                    const qtyInput = document.getElementById('sub-jumlah-pesanan');
                    const warning = document.getElementById('sub-jumlah-warning');
                    const qty = parseInt(qtyInput.value);

                    if (isNaN(qty) || qty <= 0) {
                        warning.classList.remove('hidden');
                    } else {
                        warning.classList.add('hidden');
                    }

                    if (!select || select.value === '') {
                        document.getElementById('sub-total-deliveries').textContent = '0x pengiriman';
                        document.getElementById('sub-total-tagihan').textContent = 'Rp 0';
                        return;
                    }
                    
                    const selectedOption = select.options[select.selectedIndex];
                    const harga = parseFloat(selectedOption.getAttribute('data-harga')) || 0;
                    const durasiBulan = parseInt(document.getElementById('sub-durasi-bulan').value) || 1;
                    
                    const checkedDays = Array.from(document.querySelectorAll('input[name="hari_pengantaran[]"]:checked')).map(el => el.value);
                    const calculateQty = isNaN(qty) || qty < 0 ? 0 : qty;

                    if (checkedDays.length === 0 || calculateQty <= 0) {
                        document.getElementById('sub-total-deliveries').textContent = '0x pengiriman';
                        document.getElementById('sub-total-tagihan').textContent = 'Rp 0';
                        return;
                    }
                    
                    // 1 month = 4 deliveries per day-of-week selected
                    const totalDeliveries = checkedDays.length * 4 * durasiBulan;
                    
                    const total = harga * calculateQty * totalDeliveries;
                    document.getElementById('sub-total-deliveries').textContent = totalDeliveries + 'x pengiriman';
                    document.getElementById('sub-total-tagihan').textContent = 'Rp ' + total.toLocaleString('id-ID');
                }

                // Profile copy helper
                function useProfileContactInfo(alamat, noTelepon) {
                    const subNoTelp = document.getElementById('sub-no-telepon');
                    const subAlamat = document.getElementById('sub-alamat');
                    if (subNoTelp) subNoTelp.value = noTelepon;
                    if (subAlamat) subAlamat.value = alamat;
                    
                    const modalNoTelp = document.getElementById('modal-no-telepon');
                    const modalAlamat = document.getElementById('modal-alamat');
                    if (modalNoTelp) modalNoTelp.value = noTelepon;
                    if (modalAlamat) modalAlamat.value = alamat;
                    
                    [subNoTelp, subAlamat, modalNoTelp, modalAlamat].forEach(el => {
                        if (el) {
                            el.classList.add('bg-green-50');
                            setTimeout(() => el.classList.remove('bg-green-50'), 600);
                        }
                    });
                }

                // Custom validation overlays
                document.addEventListener('DOMContentLoaded', function() {
                    const clearErrors = (form) => {
                        form.querySelectorAll('.neo-brutal-input-error').forEach(el => el.classList.remove('neo-brutal-input-error'));
                        form.querySelectorAll('.error-msg').forEach(el => el.remove());
                    };

                    const forms = ['checkout-form', 'sub-form'];
                    forms.forEach(formId => {
                        const form = document.getElementById(formId);
                        if (form) {
                            form.addEventListener('submit', function(e) {
                                clearErrors(form);
                                let hasErrors = false;
                                let firstInvalidEl = null;

                                const setError = (inputEl, message) => {
                                    inputEl.classList.add('neo-brutal-input-error');
                                    const err = document.createElement('p');
                                    err.className = 'error-msg text-[10px] font-black text-[#f43f5e] mt-1';
                                    err.textContent = message;
                                    inputEl.parentNode.appendChild(err);
                                    
                                    hasErrors = true;
                                    if (!firstInvalidEl) firstInvalidEl = inputEl;
                                };

                                if (formId === 'checkout-form') {
                                    const qty = parseInt(document.getElementById('modal-jumlah').value);
                                    if (isNaN(qty) || qty < 1) {
                                        setError(document.getElementById('modal-jumlah'), 'Jumlah minimal 1 unit!');
                                    }
                                    const tel = document.getElementById('modal-no-telepon').value.trim();
                                    if (!tel) {
                                        setError(document.getElementById('modal-no-telepon'), 'Nomor telepon wajib diisi!');
                                    }
                                    const addr = document.getElementById('modal-alamat').value.trim();
                                    if (!addr) {
                                        setError(document.getElementById('modal-alamat'), 'Alamat pengiriman wajib diisi!');
                                    }
                                } else if (formId === 'sub-form') {
                                    const prod = document.getElementById('sub-id-produk').value;
                                    if (!prod) {
                                        setError(document.getElementById('sub-id-produk'), 'Pilih varian air mineral!');
                                    }
                                    const qty = parseInt(document.getElementById('sub-jumlah-pesanan').value);
                                    if (isNaN(qty) || qty < 1) {
                                        setError(document.getElementById('sub-jumlah-pesanan'), 'Jumlah unit minimal 1!');
                                    }
                                    const checkedDays = document.querySelectorAll('input[name="hari_pengantaran[]"]:checked');
                                    if (checkedDays.length === 0) {
                                        const container = document.querySelector('input[name="hari_pengantaran[]"]').parentNode.parentNode;
                                        container.classList.add('neo-brutal-input-error');
                                        const err = document.createElement('p');
                                        err.className = 'error-msg text-[10px] font-black text-[#f43f5e] mt-1';
                                        err.textContent = 'Pilih minimal satu hari pengantaran!';
                                        container.parentNode.appendChild(err);
                                        
                                        hasErrors = true;
                                        if (!firstInvalidEl) firstInvalidEl = container;
                                    }
                                    const tel = document.getElementById('sub-no-telepon').value.trim();
                                    if (!tel) {
                                        setError(document.getElementById('sub-no-telepon'), 'Nomor telepon wajib diisi!');
                                    }
                                    const addr = document.getElementById('sub-alamat').value.trim();
                                    if (!addr) {
                                        setError(document.getElementById('sub-alamat'), 'Alamat pengiriman wajib diisi!');
                                    }
                                }

                                if (hasErrors) {
                                    e.preventDefault();
                                    if (firstInvalidEl) {
                                        firstInvalidEl.scrollIntoView({ behavior: 'smooth', block: 'center' });
                                        setTimeout(() => firstInvalidEl.focus(), 300);
                                    }
                                }
                            });
                        }
                    });
                });
            </script>
        </div>
    </div>
</x-app-layout>
