<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Rindu Water - Purity in Every Drop</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;800&display=swap" rel="stylesheet">

    <!-- Tailwind CSS (via Vite) -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <script src="https://cdn.tailwindcss.com"></script>
    @endif

    <!-- Soft Glassmorphic SaaS Design System Custom Styles -->
    <style>
        :root {
            --neo-bg: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 50%, #e2e8f0 100%);
            --neo-yellow: #facc15;
            --neo-blue: #4f46e5;
            --neo-cyan: #06b6d4;
            --neo-purple: #a78bfa;
            --neo-border-color: rgba(226, 232, 240, 0.8);
            --neo-radius: 20px;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: var(--neo-bg);
            color: #1e293b;
            scroll-behavior: smooth;
            min-height: 100vh;
        }

        /* Soft Glassmorphic Card */
        .neo-card {
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: 1px solid rgba(226, 232, 240, 0.8);
            border-radius: var(--neo-radius);
            box-shadow: 0 10px 30px -5px rgba(0, 0, 0, 0.03), 0 4px 12px -2px rgba(0, 0, 0, 0.02);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .neo-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 20px 40px -10px rgba(0, 0, 0, 0.06), 0 8px 20px -6px rgba(0, 0, 0, 0.03);
        }

        /* Interactive Buttons */
        .neo-btn {
            background: #ffffff;
            border: 1px solid rgba(226, 232, 240, 0.8);
            border-radius: 12px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -1px rgba(0, 0, 0, 0.03);
            color: #334155;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.2s ease;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        .neo-btn:hover {
            transform: translateY(-1px);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.08), 0 4px 6px -2px rgba(0, 0, 0, 0.04);
            background: #f8fafc;
        }

        .neo-btn:active {
            transform: translateY(1px);
            box-shadow: 0 2px 4px 0 rgba(0, 0, 0, 0.05);
        }

        .neo-btn-primary {
            background: linear-gradient(135deg, #6366f1 0%, #4f46e5 100%) !important;
            color: #ffffff !important;
            border: 0 !important;
            box-shadow: 0 4px 12px 0 rgba(79, 70, 229, 0.2) !important;
        }

        .neo-btn-primary:hover {
            box-shadow: 0 8px 20px 0 rgba(79, 70, 229, 0.3) !important;
            background: linear-gradient(135deg, #818cf8 0%, #4f46e5 100%) !important;
        }

        .neo-btn-yellow {
            background: var(--neo-yellow);
            color: #1e293b;
        }

        .neo-btn-cyan {
            background: linear-gradient(135deg, #06b6d4 0%, #0891b2 100%) !important;
            color: #ffffff !important;
            border: 0 !important;
            box-shadow: 0 4px 12px 0 rgba(6, 182, 212, 0.2) !important;
        }

        /* Micro Floating Animation */
        @keyframes float {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-8px) rotate(0.5deg); }
        }

        .floating-element {
            animation: float 6s ease-in-out infinite;
        }
    </style>
</head>
<body class="antialiased overflow-x-hidden">

    <!-- Header Navigation -->
    <header class="fixed top-0 left-0 w-full z-50 py-4 bg-transparent transition-all duration-300" id="main-header">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div id="main-nav-card" class="bg-white/80 border border-slate-200/80 shadow-md backdrop-blur-md rounded-2xl px-6 py-4 flex items-center justify-between transition-all duration-300">
                <!-- Brand Logo -->
                <a href="#" class="flex items-center space-x-2 group">
                    <span class="p-1.5 bg-indigo-50 border border-indigo-100 rounded-full text-indigo-600 group-hover:scale-105 transition-transform duration-300">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.105-6 11.25-6 11.25S7.5 17.605 7.5 10.5a6 6 0 1112 0z" />
                        </svg>
                    </span>
                    <span class="text-xl font-extrabold tracking-tight text-slate-800">Rindu <span class="text-indigo-600">Water</span></span>
                </a>

                <!-- Navigation Links -->
                <nav class="hidden md:flex items-center space-x-8 text-sm font-semibold text-slate-600">
                    <a href="#home" class="hover:text-indigo-600 transition-colors">Home</a>
                    <a href="#keunggulan" class="hover:text-indigo-600 transition-colors">Keunggulan</a>
                    <a href="#produk" class="hover:text-indigo-600 transition-colors">Produk Kami</a>
                    <a href="#layanan" class="hover:text-indigo-600 transition-colors">Jadwal Langganan</a>
                </nav>

                <!-- Authentication CTAs -->
                <div class="flex items-center space-x-4">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="neo-btn px-5 py-2.5 text-sm font-bold bg-[#facc15] border-transparent text-slate-800 shadow-sm">
                            Dashboard
                        </a>
                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button type="submit" class="neo-btn px-5 py-2.5 text-sm font-bold bg-rose-500 border-transparent text-white shadow-sm">
                                Keluar
                            </button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="text-sm font-bold text-slate-600 hover:text-indigo-600 transition-colors px-3 py-2">
                            Masuk
                        </a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="neo-btn neo-btn-primary px-6 py-2.5 text-sm">
                                Daftar Sekarang
                            </a>
                        @endif
                    @endauth
                </div>
            </div>
        </div>
    </header>

    <!-- Hero Section -->
    <section id="home" class="relative pt-52 pb-44 overflow-hidden">
        <!-- Decorative Background Blobs -->
        <div class="absolute top-[-10%] left-[-10%] w-96 h-96 bg-cyan-300/30 rounded-full blur-3xl pointer-events-none"></div>
        <div class="absolute bottom-[-10%] right-[-10%] w-[500px] h-[500px] bg-indigo-400/20 rounded-full blur-3xl pointer-events-none"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
                <!-- Hero Left Information -->
                <div class="lg:col-span-7 space-y-8 text-center lg:text-left">
                    <span class="inline-flex items-center px-4 py-1.5 rounded-full text-xs font-bold tracking-wider text-indigo-700 bg-indigo-50 border border-indigo-100 uppercase">
                        AIR ALKALI TERIONISASI & SEHAT
                    </span>
                    <h1 class="text-4xl sm:text-5xl lg:text-6xl font-black tracking-tight text-slate-800 leading-none sm:leading-tight lg:leading-[1.15]">
                        Hidrasi pH Tinggi untuk Kesehatan,<br class="hidden sm:inline">
                        <span class="mt-3 sm:mt-4 bg-gradient-to-r from-indigo-500 to-indigo-600 text-white px-4 py-2 inline-block rounded-xl shadow-md transform -rotate-1">
                            Keseimbangan Tubuh Anda
                        </span>
                    </h1>
                    <p class="text-lg text-slate-500 max-w-2xl mx-auto lg:mx-0 leading-relaxed">
                        Rindu Water menghadirkan air alkali terionisasi dengan tingkat pH optimal untuk membantu menetralkan kadar asam tubuh, meningkatkan hidrasi seluler, dan mendukung kebugaran harian Anda secara maksimal.
                    </p>

                    <!-- Interactive CTAs -->
                    <div class="flex flex-col sm:flex-row items-center justify-center lg:justify-start gap-4 pt-2">
                        <a href="#produk" class="w-full sm:w-auto px-8 py-4 rounded-xl text-center font-extrabold text-white neo-btn neo-btn-primary text-base">
                            Lihat Produk Kami
                        </a>
                        <a href="#keunggulan" class="w-full sm:w-auto px-8 py-4 rounded-xl text-center font-extrabold text-slate-700 neo-btn text-base">
                            Pelajari Keunggulan
                        </a>
                    </div>

                    <!-- Stats grid widget -->
                    <div class="grid grid-cols-3 gap-4 pt-8 max-w-lg mx-auto lg:mx-0 border-t border-slate-200">
                        <div class="text-center lg:text-left">
                            <span class="block text-2xl lg:text-3xl font-black text-slate-800">10k+</span>
                            <span class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Pelanggan</span>
                        </div>
                        <div class="text-center lg:text-left border-x border-slate-200 px-4">
                            <span class="block text-2xl lg:text-3xl font-black text-indigo-600">99.9%</span>
                            <span class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Kemurnian</span>
                        </div>
                        <div class="text-center lg:text-left pl-4">
                            <span class="block text-2xl lg:text-3xl font-black text-slate-800">15+</span>
                            <span class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Wilayah</span>
                        </div>
                    </div>
                </div>

                <!-- Hero Right outlined vector Water Bottle Graphic -->
                <div class="lg:col-span-5 flex justify-center relative">
                    <div class="floating-element w-72 sm:w-80 lg:w-96 select-none">
                        <!-- Outlined Brutalist Water Bottle Vector Graphic -->
                        <svg viewBox="0 0 500 600" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-full h-auto">
                            <!-- Background Bubbles (Brutalist Dot style) -->
                            <circle cx="100" cy="400" r="16" fill="#06b6d4" stroke="#000000" stroke-width="4"/>
                            <circle cx="420" cy="250" r="12" fill="#facc15" stroke="#000000" stroke-width="4"/>
                            <circle cx="380" cy="450" r="22" fill="#a78bfa" stroke="#000000" stroke-width="4"/>
                            
                            <!-- Sleek Outlined Brutalist Water Bottle Outer Shell -->
                            <rect x="175" y="240" width="150" height="280" rx="20" fill="#ffffff" stroke="#000000" stroke-width="6"/>
                            <!-- Neck -->
                            <path d="M220 240 L220 180 C220 160 235 160 235 160 L265 160 C265 160 280 160 280 180 L280 240" fill="#ffffff" stroke="#000000" stroke-width="6"/>
                            <!-- Cap (Bold Blue Cap) -->
                            <rect x="225" y="125" width="50" height="35" rx="6" fill="#2563eb" stroke="#000000" stroke-width="6"/>
                            
                            <!-- Water volume inside bottle -->
                            <rect x="184" y="270" width="132" height="242" rx="12" fill="#06b6d4" stroke="#000000" stroke-width="4"/>
                            <!-- Water Surface wave curve -->
                            <path d="M184 270 Q215 255 250 270 T316 270" fill="none" stroke="#000000" stroke-width="4"/>
                            
                            <!-- Stark Reflection Line -->
                            <line x1="200" y1="290" x2="200" y2="490" stroke="#ffffff" stroke-width="12" stroke-linecap="round" />
                            
                            <!-- Solid shadow drop below bottle -->
                            <ellipse cx="250" cy="545" rx="90" ry="12" fill="#000000" />
                        </svg>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Keunggulan Section -->
    <section id="keunggulan" class="py-24 border-t border-slate-100 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <!-- Section Title -->
            <div class="text-center max-w-3xl mx-auto mb-18 space-y-4">
                <span class="text-xs font-bold tracking-widest text-indigo-700 bg-indigo-50 px-3 py-1 border border-indigo-100 rounded-full uppercase">Mengapa Memilih Kami?</span>
                <h2 class="text-3xl sm:text-4xl font-extrabold text-slate-800">
                    Kualitas Terbaik untuk Hidrasi Sehat Anda
                </h2>
                <div class="w-24 h-1 bg-indigo-500 rounded-full mx-auto mt-2"></div>
            </div>

            <!-- Features Cards Grid -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Feature 1 -->
                <div class="neo-card p-8 bg-cyan-50/70 border border-cyan-100/70 flex flex-col justify-between group">
                    <div>
                        <div class="w-14 h-14 rounded-xl bg-white border border-cyan-150 shadow-sm flex items-center justify-center text-cyan-600 mb-6">
                            <!-- Droplet Icon -->
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.105-6 11.25-6 11.25S7.5 17.605 7.5 10.5a6 6 0 1112 0z" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-extrabold text-slate-800 mb-3">Air Alkali pH Optimal</h3>
                        <p class="text-slate-600 font-medium text-sm leading-relaxed">
                            Diproses dengan teknologi elektrolisis modern untuk memisahkan molekul air asam, menghasilkan air minum alkali sehat dengan pH tinggi.
                        </p>
                    </div>
                </div>

                <!-- Feature 2 -->
                <div class="neo-card p-8 bg-amber-50/70 border border-amber-100/70 flex flex-col justify-between group">
                    <div>
                        <div class="w-14 h-14 rounded-xl bg-white border border-amber-150 shadow-sm flex items-center justify-center text-amber-600 mb-6">
                            <!-- Shield check icon -->
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12c0 1.268-.63 2.39-1.593 3.068a3.745 3.745 0 01-1.043 3.296 3.745 3.745 0 01-3.296 1.043A3.745 3.745 0 0112 21c-1.268 0-2.39-.63-3.068-1.593a3.746 3.746 0 01-3.296-1.043 3.745 3.745 0 01-1.043-3.296A3.745 3.745 0 013 12c0-1.268.63-2.39 1.593-3.068a3.745 3.745 0 011.043-3.296 3.746 3.746 0 013.296-1.043A3.746 3.746 0 0112 3c1.268 0 2.39.63 3.068 1.593a3.746 3.746 0 013.296 1.043 3.746 3.746 0 011.043 3.296A3.745 3.745 0 0121 12z" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-extrabold text-slate-800 mb-3">Filtrasi & Ionisasi</h3>
                        <p class="text-slate-600 font-medium text-sm leading-relaxed">
                            Diproses dengan sistem filtrasi mikro canggih, sterilisasi ultraviolet, serta proses ionisasi elektrikal berkualitas tinggi demi kesehatan Anda.
                        </p>
                    </div>
                </div>

                <!-- Feature 3 -->
                <div class="neo-card p-8 bg-indigo-50/70 border border-indigo-100/70 flex flex-col justify-between group">
                    <div>
                        <div class="w-14 h-14 rounded-xl bg-white border border-indigo-150 shadow-sm flex items-center justify-center text-indigo-600 mb-6">
                            <!-- Truck Icon -->
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 18.75a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM19.5 18.75a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM2.25 15h13.5m-10.5-3h10.5m-10.5-3h10.5m-3.75-3H6.75A2.25 2.25 0 004.5 8.25V15h15V8.25A2.25 2.25 0 0017.25 6h-3.75Z" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-extrabold text-slate-800 mb-3">Layanan Pengiriman Kilat</h3>
                        <p class="text-slate-600 font-medium text-sm leading-relaxed">
                            Sistem manajemen pengiriman otomatis terjadwal yang memastikan pasokan air bersih murni Anda selalu terisi tepat waktu tanpa hambatan.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Produk Section -->
    <section id="produk" class="py-24 border-t border-slate-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Section Header -->
            <div class="text-center max-w-3xl mx-auto mb-16 space-y-4">
                <span class="text-xs font-bold tracking-widest text-indigo-700 bg-indigo-50 px-3 py-1 border border-indigo-100 rounded-full uppercase">Varian Produk Air</span>
                <h2 class="text-3xl sm:text-4xl font-extrabold text-slate-800">
                    Produk Air Mineral Premium Rindu Water
                </h2>
                <p class="text-slate-500 max-w-lg mx-auto">
                    Pilih kemasan yang sesuai dengan kebutuhan hidrasi harian Anda, mulai dari ukuran personal praktis hingga kebutuhan galon keluarga.
                </p>
                <div class="w-24 h-1 bg-indigo-500 rounded-full mx-auto mt-2"></div>
            </div>

            <!-- Products Grid -->
            @if(isset($produk) && $produk->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    @foreach($produk as $p)
                        <!-- Single Product Card -->
                        <div class="neo-card p-6 flex flex-col justify-between relative overflow-hidden group">
                            <div>
                                <!-- Product Image Container (Sleek modern style) -->
                                <div class="w-full h-56 rounded-xl mb-6 flex items-center justify-center relative overflow-hidden p-4 bg-slate-50/50 border border-slate-200/80 group-hover:scale-[1.02] transition-transform duration-150">
                                    @if($p->foto_produk)
                                        <img src="{{ asset('storage/' . $p->foto_produk) }}" alt="{{ $p->nama_produk }}" class="max-h-full max-w-full object-cover w-full h-full rounded-lg" />
                                    @else
                                        @if($p->jenis_kemasan == 'botol')
                                            <img src="{{ asset('images/produk_botol.jpg') }}" alt="{{ $p->nama_produk }}" class="w-full h-full object-cover rounded-lg" />
                                        @elseif($p->jenis_kemasan == 'galon')
                                            <img src="{{ asset('images/produk_galon.jpg') }}" alt="{{ $p->nama_produk }}" class="w-full h-full object-cover rounded-lg" />
                                        @elseif($p->jenis_kemasan == 'gelas')
                                            <img src="{{ asset('images/produk_gelas.jpg') }}" alt="{{ $p->nama_produk }}" class="w-full h-full object-cover rounded-lg" />
                                        @else
                                            <!-- Droplet SVG -->
                                            <svg viewBox="0 0 100 200" fill="none" class="h-44 w-auto text-blue-500">
                                                <path d="M50 40C50 40 15 100 15 130C15 157.61 37.39 180 50 180C62.61 180 85 157.61 85 130C85 100 50 40 50 40Z" fill="#06b6d4" stroke="#000000" stroke-width="4"/>
                                            </svg>
                                        @endif
                                    @endif
                                    
                                    <!-- Dynamic badge on capacity -->
                                    <span class="absolute bottom-3 left-3 bg-white/90 backdrop-blur-sm text-xs font-bold text-slate-800 px-3 py-1 rounded-lg border border-slate-200/60 shadow-sm">
                                        {{ $p->kapasitas }}
                                    </span>
                                </div>

                                <!-- Product Info -->
                                <div class="space-y-3">
                                    <div class="flex items-center justify-between">
                                        <!-- Packaging type badge -->
                                        <span class="text-xs font-bold uppercase tracking-wider text-indigo-700 bg-indigo-50 px-2.5 py-1 rounded-full border border-indigo-100">
                                            {{ $p->jenis_kemasan }}
                                        </span>
                                    </div>

                                    <h3 class="text-xl font-extrabold text-slate-800 leading-tight hover:text-indigo-600 transition-colors">
                                        {{ $p->nama_produk }}
                                    </h3>
                                    <p class="text-sm font-semibold text-slate-600 line-clamp-2 h-10">
                                        {{ $p->deskripsi ?? 'Pilihan terbaik air mineral murni berkualitas tinggi untuk memenuhi hidrasi berkualitas harian Anda.' }}
                                    </p>
                                </div>
                            </div>

                            <!-- Footer Action Button -->
                            <div class="mt-8 pt-4 border-t border-slate-100 flex items-center justify-between gap-4">
                                <a href="{{ route('login') }}" class="neo-btn neo-btn-primary px-4 py-3 text-center text-sm flex-1">
                                    Lihat Harga & Pesan
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <!-- Fallback Mock Cards -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <!-- Card 1 -->
                    <div class="neo-card p-6 flex flex-col justify-between group">
                        <div>
                            <div class="w-full h-56 rounded-xl mb-6 flex items-center justify-center relative overflow-hidden bg-slate-50 border border-slate-200">
                                <img src="{{ asset('images/produk_galon.jpg') }}" alt="Galon Rindu Keluarga" class="w-full h-full object-cover rounded-lg" />
                                <span class="absolute bottom-3 left-3 bg-white/90 backdrop-blur-sm text-xs font-bold text-slate-800 px-3 py-1 rounded-lg border border-slate-200/60 shadow-sm">19 Liter</span>
                            </div>
                            <div class="space-y-3">
                                <div class="flex items-center justify-between">
                                    <span class="text-xs font-bold uppercase tracking-wider text-indigo-700 bg-indigo-50 px-2.5 py-1 rounded-full border border-indigo-100">Galon</span>
                                </div>
                                <h3 class="text-xl font-extrabold text-slate-800">Galon Rindu Keluarga</h3>
                                <p class="text-sm font-semibold text-slate-600 line-clamp-2">Kebutuhan hidrasi keluarga terpenuhi dengan pasokan galon 19 Liter steril, berkualitas, serta hemat.</p>
                            </div>
                        </div>
                        <div class="mt-8 pt-4 border-t border-slate-100 flex items-center justify-between gap-4">
                            <a href="{{ route('login') }}" class="neo-btn neo-btn-primary px-4 py-3 text-sm flex-1">Lihat Harga & Pesan</a>
                        </div>
                    </div>
                    <!-- Card 2 -->
                    <div class="neo-card p-6 flex flex-col justify-between group">
                        <div>
                            <div class="w-full h-56 rounded-xl mb-6 flex items-center justify-center relative overflow-hidden bg-slate-50 border border-slate-200">
                                <img src="{{ asset('images/produk_botol.jpg') }}" alt="Rindu Premium Botol" class="w-full h-full object-cover rounded-lg" />
                                <span class="absolute bottom-3 left-3 bg-white/90 backdrop-blur-sm text-xs font-bold text-slate-800 px-3 py-1 rounded-lg border border-slate-200/60 shadow-sm">1500ml</span>
                            </div>
                            <div class="space-y-3">
                                <div class="flex items-center justify-between">
                                    <span class="text-xs font-bold uppercase tracking-wider text-indigo-700 bg-indigo-50 px-2.5 py-1 rounded-full border border-indigo-100">Botol</span>
                                </div>
                                <h3 class="text-xl font-extrabold text-slate-800">Rindu Premium Botol</h3>
                                <p class="text-sm font-semibold text-slate-600 line-clamp-2">Botol 1500ml untuk pemakaian harian di meja kerja atau bepergian jauh.</p>
                            </div>
                        </div>
                        <div class="mt-8 pt-4 border-t border-slate-100 flex items-center justify-between gap-4">
                            <a href="{{ route('login') }}" class="neo-btn neo-btn-primary px-4 py-3 text-sm flex-1">Lihat Harga & Pesan</a>
                        </div>
                    </div>
                    <!-- Card 3 -->
                    <div class="neo-card p-6 flex flex-col justify-between group">
                        <div>
                            <div class="w-full h-56 rounded-xl mb-6 flex items-center justify-center relative overflow-hidden bg-slate-50 border border-slate-200">
                                <img src="{{ asset('images/produk_gelas.jpg') }}" alt="Rindu Cup Praktis" class="w-full h-full object-cover rounded-lg" />
                                <span class="absolute bottom-3 left-3 bg-white/90 backdrop-blur-sm text-xs font-bold text-slate-800 px-3 py-1 rounded-lg border border-slate-200/60 shadow-sm">220ml</span>
                            </div>
                            <div class="space-y-3">
                                <div class="flex items-center justify-between">
                                    <span class="text-xs font-bold uppercase tracking-wider text-indigo-700 bg-indigo-50 px-2.5 py-1 rounded-full border border-indigo-100">Gelas</span>
                                </div>
                                <h3 class="text-xl font-extrabold text-slate-800">Rindu Cup Praktis</h3>
                                <p class="text-sm font-semibold text-slate-600 line-clamp-2">Air minum dalam kemasan gelas 220ml steril, sangat pas untuk hidrasi singkat tamu Anda.</p>
                            </div>
                        </div>
                        <div class="mt-8 pt-4 border-t border-slate-100 flex items-center justify-between gap-4">
                            <a href="{{ route('login') }}" class="neo-btn neo-btn-primary px-4 py-3 text-sm flex-1">Lihat Harga & Pesan</a>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </section>

    <!-- Layanan Langganan Section -->
    <section id="layanan" class="py-24 border-t border-slate-100 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <!-- Section Title -->
            <div class="text-center max-w-3xl mx-auto mb-20 space-y-4">
                <span class="text-xs font-bold tracking-widest text-indigo-700 bg-indigo-50 px-3 py-1 border border-indigo-100 rounded-full uppercase">Jadwal Berlangganan</span>
                <h2 class="text-3xl sm:text-4xl font-extrabold text-slate-800">
                    Sistem Berlangganan Pintar Rindu Water
                </h2>
                <p class="text-slate-500 max-w-md mx-auto">
                    Kendalikan pasokan air bersih murni Anda secara fleksibel menggunakan fitur langganan terjadwal.
                </p>
                <div class="w-24 h-1 bg-indigo-500 rounded-full mx-auto mt-2"></div>
            </div>

            <!-- Steps Grid -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-12 relative">
                <!-- Step 1 -->
                <div class="neo-card p-8 text-center relative group">
                    <span class="absolute -top-6 left-1/2 -translate-x-1/2 w-12 h-12 rounded-xl bg-gradient-to-br from-indigo-500 to-indigo-600 text-white font-extrabold text-lg flex items-center justify-center shadow-md">
                        1
                    </span>
                    <h3 class="text-xl font-extrabold text-slate-800 mb-3 mt-4">Buat Akun</h3>
                    <p class="text-slate-500 text-sm leading-relaxed">
                        Mendaftarlah secara instan dan lengkapi alamat detail profil pengiriman Anda di sistem kami.
                    </p>
                </div>

                <!-- Step 2 -->
                <div class="neo-card p-8 text-center relative group bg-indigo-50/70 border border-indigo-100/70 shadow-sm">
                    <span class="absolute -top-6 left-1/2 -translate-x-1/2 w-12 h-12 rounded-xl bg-gradient-to-br from-indigo-500 to-indigo-600 text-white font-extrabold text-lg flex items-center justify-center shadow-md">
                        2
                    </span>
                    <h3 class="text-xl font-extrabold text-slate-800 mb-3 mt-4">Pilih Paket & Produk</h3>
                    <p class="text-slate-600 text-sm leading-relaxed">
                        Tentukan varian air mineral serta frekuensi jadwal pengantaran harian, mingguan, atau bulanan.
                    </p>
                </div>

                <!-- Step 3 -->
                <div class="neo-card p-8 text-center relative group">
                    <span class="absolute -top-6 left-1/2 -translate-x-1/2 w-12 h-12 rounded-xl bg-gradient-to-br from-indigo-500 to-indigo-600 text-white font-extrabold text-lg flex items-center justify-center shadow-md">
                        3
                    </span>
                    <h3 class="text-xl font-extrabold text-slate-800 mb-3 mt-4">Air Diantar Otomatis</h3>
                    <p class="text-slate-500 text-sm leading-relaxed">
                        Kurir profesional kami akan mengantarkan air segar steril Anda langsung ke lokasi secara berkala.
                    </p>
                </div>
            </div>

            <div class="mt-16 text-center">
                <a href="{{ route('login') }}" class="inline-flex items-center justify-center px-8 py-4 rounded-xl font-bold text-white neo-btn neo-btn-primary gap-2 group">
                    <span>Mulai Berlangganan Sekarang</span>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-5 h-5 group-hover:translate-x-1 transition-transform">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                    </svg>
                </a>
            </div>
        </div>
    </section>

    <!-- Testimonial Section -->
    <section class="py-24 border-t border-slate-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
                <!-- Title Info -->
                <div class="lg:col-span-4 space-y-6 text-center lg:text-left">
                    <span class="text-xs font-bold tracking-widest text-indigo-700 bg-indigo-50 px-3 py-1 border border-indigo-100 rounded-full uppercase">Ulasan Pengguna</span>
                    <h2 class="text-3xl sm:text-4xl font-extrabold text-slate-800 leading-tight">
                        Apa Kata Mereka Tentang Rindu Water?
                    </h2>
                    <p class="text-slate-500">
                        Ribuan keluarga dan institusi telah mempercayakan kebutuhan hidrasi bersih higienis harian mereka bersama kami.
                    </p>
                    <div class="w-20 h-1 bg-indigo-500 rounded-full mx-auto lg:mx-0 mt-2"></div>
                </div>

                <!-- Testimonials Cards Grid -->
                <div class="lg:col-span-8 grid grid-cols-1 sm:grid-cols-2 gap-8">
                    <!-- Testi 1 -->
                    <div class="neo-card p-8 bg-cyan-50/70 border border-cyan-100/70 flex flex-col justify-between relative shadow-sm hover:shadow-md transition-all">
                        <p class="text-slate-700 font-semibold text-sm italic leading-relaxed">
                            "Rindu Water benar-benar mengubah cara kami mengonsumsi air. Jadwal pengantaran mingguan sangat konsisten, dan kualitas air mineralnya benar-benar terasa segar dan murni. Sangat direkomendasikan!"
                        </p>
                        <div class="flex items-center gap-3 pt-6 mt-6 border-t border-cyan-200/50">
                            <!-- Avatar Outlined -->
                            <div class="w-10 h-10 rounded-full bg-white border border-cyan-200 text-cyan-700 font-bold flex items-center justify-center text-xs shadow-sm">
                                AR
                            </div>
                            <div>
                                <span class="block text-sm font-bold text-slate-800">Ahmad Rian</span>
                                <span class="text-xs font-semibold text-slate-500">Kepala Rumah Tangga, Jakarta</span>
                            </div>
                        </div>
                    </div>

                    <!-- Testi 2 -->
                    <div class="neo-card p-8 bg-indigo-50/70 border border-indigo-100/70 flex flex-col justify-between relative shadow-sm hover:shadow-md transition-all">
                        <p class="text-slate-700 font-semibold text-sm italic leading-relaxed">
                            "Sangat praktis untuk kantor kami yang memiliki 50 staf. Fitur langganan bulanan di dashboard admin menghemat waktu pengadaan barang kami. Layanan kurirnya cepat dan ramah!"
                        </p>
                        <div class="flex items-center gap-3 pt-6 mt-6 border-t border-indigo-200/50">
                            <!-- Avatar -->
                            <div class="w-10 h-10 rounded-full bg-white border border-indigo-200 text-indigo-700 font-bold flex items-center justify-center text-xs shadow-sm">
                                S
                            </div>
                            <div>
                                <span class="block text-sm font-bold text-slate-800">Sarah</span>
                                <span class="text-xs font-semibold text-slate-500">Office Manager, PT Maju Bersama</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="py-16 border-t border-slate-800 bg-slate-900 text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-12 gap-12 pb-12 border-b border-slate-800">
                <!-- Branding info -->
                <div class="md:col-span-5 space-y-6">
                    <a href="#" class="flex items-center space-x-2">
                        <span class="p-2 bg-indigo-600 rounded-xl text-white p-2.5 shadow-md">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.105-6 11.25-6 11.25S7.5 17.605 7.5 10.5a6 6 0 1112 0z" />
                            </svg>
                        </span>
                        <span class="text-xl font-extrabold text-white">Rindu <span class="text-indigo-400">Water</span></span>
                    </a>
                    <p class="text-sm font-semibold text-slate-400 leading-relaxed max-w-sm">
                        Menghadirkan air alkali terionisasi berkualitas tinggi secara steril dan higienis untuk kesehatan hidrasi dan keseimbangan tubuh terbaik Anda setiap hari.
                    </p>
                </div>

                <!-- Footer Menu 1 -->
                <div class="md:col-span-3 space-y-4">
                    <h4 class="text-sm font-bold text-indigo-400 uppercase tracking-wider">Tautan Cepat</h4>
                    <ul class="space-y-2 text-sm font-bold text-slate-300">
                        <li><a href="#home" class="hover:text-white transition-colors">Home</a></li>
                        <li><a href="#keunggulan" class="hover:text-white transition-colors">Keunggulan</a></li>
                        <li><a href="#produk" class="hover:text-white transition-colors">Produk Kami</a></li>
                        <li><a href="#layanan" class="hover:text-white transition-colors">Layanan Berlangganan</a></li>
                    </ul>
                </div>

                <!-- Footer Menu 2 -->
                <div class="md:col-span-4 space-y-4">
                    <h4 class="text-sm font-bold text-indigo-400 uppercase tracking-wider">Hubungi Kami</h4>
                    <p class="text-sm text-slate-300 leading-relaxed font-semibold">
                        Alamat Pabrik Utama:<br>
                        Kawasan Industri Pengolahan Air Higienis Modern, Jawa Barat, Indonesia
                    </p>
                    <p class="text-sm text-slate-200 font-bold">
                        Email: info@rinduwater.co.id<br>
                        Telepon: (021) 8888-9999
                    </p>
                </div>
            </div>

            <!-- Credits and copyrights -->
            <div class="pt-8 flex flex-col sm:flex-row items-center justify-between gap-4">
                <p class="text-xs text-slate-400 font-bold">&copy; {{ date('Y') }} Rindu Water. Hak Cipta Dilindungi.</p>
                <div class="flex items-center space-x-6 text-xs text-slate-400 font-bold">
                    <a href="#" class="hover:text-white">Syarat & Ketentuan</a>
                    <a href="#" class="hover:text-white">Kebijakan Privasi</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Header Scroll background change script & Custom Smooth Scroll -->
    <script>
        window.addEventListener('scroll', function() {
            const navCard = document.getElementById('main-nav-card');
            
            if (window.scrollY > 50) {
                navCard.classList.remove('shadow-md');
                navCard.classList.add('shadow-sm', 'bg-white/90');
            } else {
                navCard.classList.remove('shadow-sm', 'bg-white/90');
                navCard.classList.add('shadow-md');
            }
        });

        // Elegant Smooth Scroll for Anchor Links using Cubic-Bezier easing
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                const targetId = this.getAttribute('href');
                if (targetId === '#') return;
                
                const targetElement = document.querySelector(targetId);
                if (targetElement) {
                    e.preventDefault();
                    
                    const headerHeight = 100; // Offset for sticky navbar
                    const targetPosition = targetElement.getBoundingClientRect().top + window.scrollY;
                    const startPosition = window.scrollY;
                    const distance = targetPosition - startPosition - headerHeight;
                    const duration = 1200; // Slow, luxurious scroll animation
                    let start = null;

                    // cubic-bezier easing out function: easeOutCubic
                    function easeOutCubic(t) {
                        return 1 - Math.pow(1 - t, 3);
                    }

                    function step(timestamp) {
                        if (!start) start = timestamp;
                        const progress = timestamp - start;
                        const time = Math.min(progress / duration, 1);
                        
                        window.scrollTo(0, startPosition + distance * easeOutCubic(time));
                        
                        if (progress < duration) {
                            window.requestAnimationFrame(step);
                        } else {
                            window.scrollTo(0, startPosition + distance);
                        }
                    }

                    window.requestAnimationFrame(step);
                }
            });
        });
    </script>
</body>
</html>
