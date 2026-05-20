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
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Tailwind CSS (via Vite) -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <script src="https://cdn.tailwindcss.com"></script>
    @endif

    <!-- Neomorphism Custom Theme Styles -->
    <style>
        :root {
            --neo-bg: #e0e5ec;
            --neo-shadow-dark: #a3b1c6;
            --neo-shadow-light: #ffffff;
            --neo-accent: #3b82f6;
            --neo-accent-dark: #1d4ed8;
            --neo-text-dark: #2d3748;
            --neo-text-muted: #64748b;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: var(--neo-bg);
            color: var(--neo-text-dark);
            scroll-behavior: smooth;
        }

        /* Neomorphic Styles */
        .neo-raised {
            background: var(--neo-bg);
            box-shadow: 9px 9px 16px var(--neo-shadow-dark),
                        -9px -9px 16px var(--neo-shadow-light);
        }

        .neo-inset {
            background: var(--neo-bg);
            box-shadow: inset 4px 4px 8px var(--neo-shadow-dark),
                        inset -4px -4px 8px var(--neo-shadow-light);
        }

        .neo-raised-sm {
            background: var(--neo-bg);
            box-shadow: 5px 5px 10px var(--neo-shadow-dark),
                        -5px -5px 10px var(--neo-shadow-light);
        }

        .neo-inset-sm {
            background: var(--neo-bg);
            box-shadow: inset 2px 2px 5px var(--neo-shadow-dark),
                        inset -2px -2px 5px var(--neo-shadow-light);
        }

        /* Ambient background soft colors */
        .ambient-sphere {
            position: absolute;
            border-radius: 50%;
            filter: blur(120px);
            opacity: 0.45;
            pointer-events: none;
            z-index: 0;
        }

        /* Interactive active transitions */
        .neo-btn {
            background: var(--neo-bg);
            box-shadow: 6px 6px 12px var(--neo-shadow-dark),
                        -6px -6px 12px var(--neo-shadow-light);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .neo-btn:hover {
            box-shadow: 3px 3px 6px var(--neo-shadow-dark),
                        -3px -3px 6px var(--neo-shadow-light);
            transform: translateY(-1px);
        }

        .neo-btn:active {
            box-shadow: inset 3px 3px 6px var(--neo-shadow-dark),
                        inset -3px -3px 6px var(--neo-shadow-light);
            transform: translateY(0);
        }

        .neo-btn-primary {
            background: linear-gradient(135deg, #3b82f6, #1d4ed8);
            color: #ffffff;
            box-shadow: 6px 6px 12px rgba(59, 130, 246, 0.3),
                        -6px -6px 12px var(--neo-shadow-light);
            transition: all 0.3s ease;
        }

        .neo-btn-primary:hover {
            background: linear-gradient(135deg, #2563eb, #1e40af);
            box-shadow: 3px 3px 6px rgba(59, 130, 246, 0.4),
                        -3px -3px 6px var(--neo-shadow-light);
            transform: translateY(-1px);
        }

        .neo-btn-primary:active {
            box-shadow: inset 3px 3px 6px rgba(0, 0, 0, 0.2);
            transform: translateY(0);
        }

        /* Water Droplet Hover Effect */
        .product-card {
            background: var(--neo-bg);
            border-radius: 24px;
            box-shadow: 8px 8px 16px var(--neo-shadow-dark),
                        -8px -8px 16px var(--neo-shadow-light);
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .product-card:hover {
            transform: translateY(-4px);
            box-shadow: 12px 12px 24px var(--neo-shadow-dark),
                        -12px -12px 24px var(--neo-shadow-light);
        }

        /* Micro Floating Animation */
        @keyframes float {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-10px) rotate(1deg); }
        }

        .floating-element {
            animation: float 6s ease-in-out infinite;
        }

        /* Waves divider */
        .ocean {
            height: 60px;
            width: 100%;
            position: absolute;
            bottom: 0;
            left: 0;
            background: none;
            overflow: hidden;
            pointer-events: none;
        }

        .wave {
            background: url('data:image/svg+xml;utf8,<svg viewBox="0 0 120 28" fill="%23e0e5ec" xmlns="http://www.w3.org/2000/svg"><path d="M0 15 C 30 20, 30 10, 60 15 C 90 20, 90 10, 120 15 L 120 28 L 0 28 Z"/></svg>') repeat-x;
            position: absolute;
            top: -5px;
            width: 6400px;
            height: 100%;
            animation: wave 16s cubic-bezier(0.36, 0.45, 0.63, 0.53) infinite;
            transform: translate3d(0, 0, 0);
        }

        @keyframes wave {
            0% { margin-left: 0; }
            100% { margin-left: -1600px; }
        }
    </style>
</head>
<body class="antialiased overflow-x-hidden">

    <!-- Ambient Spheres -->
    <div class="ambient-sphere bg-blue-400 w-[500px] h-[500px] -top-60 -left-60"></div>
    <div class="ambient-sphere bg-sky-300 w-[400px] h-[400px] top-60 right-0"></div>

    <!-- Header Navigation -->
    <header class="fixed top-0 left-0 w-full z-50 transition-all duration-300 py-4" id="main-header">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="neo-raised rounded-full px-6 py-4 flex items-center justify-between transition-all duration-300">
                <!-- Brand Logo -->
                <a href="#" class="flex items-center space-x-2 group">
                    <span class="p-2 bg-gradient-to-br from-blue-400 to-blue-600 rounded-full text-white shadow-md shadow-blue-500/20 group-hover:scale-105 transition-transform duration-300">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.105-6 11.25-6 11.25S7.5 17.605 7.5 10.5a6 6 0 1112 0z" />
                        </svg>
                    </span>
                    <span class="text-xl font-extrabold tracking-tight text-slate-800">Rindu <span class="text-blue-600">Water</span></span>
                </a>

                <!-- Navigation Links -->
                <nav class="hidden md:flex items-center space-x-8 text-sm font-bold text-slate-600">
                    <a href="#home" class="hover:text-blue-600 transition-colors">Home</a>
                    <a href="#keunggulan" class="hover:text-blue-600 transition-colors">Keunggulan</a>
                    <a href="#produk" class="hover:text-blue-600 transition-colors">Produk Kami</a>
                    <a href="#layanan" class="hover:text-blue-600 transition-colors">Jadwal Langganan</a>
                </nav>

                <!-- Authentication CTAs -->
                <div class="flex items-center space-x-4">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="neo-btn px-5 py-2.5 text-sm font-bold rounded-full text-blue-600">
                            Dashboard
                        </a>
                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button type="submit" class="neo-btn px-5 py-2.5 text-sm font-bold text-red-600 rounded-full">
                                Keluar
                            </button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="text-sm font-bold text-slate-600 hover:text-blue-600 transition-colors px-3 py-2">
                            Masuk
                        </a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="neo-btn-primary px-6 py-2.5 text-sm font-bold rounded-full">
                                Daftar Sekarang
                            </a>
                        @endif
                    @endauth
                </div>
            </div>
        </div>
    </header>

    <!-- Hero Section -->
    <section id="home" class="relative pt-40 pb-44 overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
                <!-- Hero Left Information -->
                <div class="lg:col-span-7 space-y-8 text-center lg:text-left">
                    <span class="inline-flex items-center px-4 py-1.5 rounded-full text-xs font-extrabold tracking-wider text-blue-700 bg-blue-100/60 uppercase">
                        💧 KEMURNIAN TERJAMIN & STERIL
                    </span>
                    <h1 class="text-4xl sm:text-5xl lg:text-6xl font-black tracking-tight text-slate-800 leading-tight">
                        Kemurnian Alami dari Pegunungan, <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-sky-500">Langsung ke Rumah Anda</span>
                    </h1>
                    <p class="text-lg text-slate-600 max-w-2xl mx-auto lg:mx-0 leading-relaxed font-light">
                        Rindu Water menghadirkan air mineral pegunungan berkualitas tinggi yang steril, kaya mineral alami, serta diproses higienis untuk menjaga hidrasi terbaik keluarga tercinta.
                    </p>

                    <!-- Interactive CTAs -->
                    <div class="flex flex-col sm:flex-row items-center justify-center lg:justify-start gap-4 pt-2">
                        <a href="#produk" class="w-full sm:w-auto px-8 py-4 rounded-full text-center font-extrabold text-white neo-btn-primary text-base">
                            Lihat Produk Kami
                        </a>
                        <a href="#keunggulan" class="w-full sm:w-auto px-8 py-4 rounded-full text-center font-extrabold text-slate-700 neo-btn text-base">
                            Pelajari Keunggulan
                        </a>
                    </div>

                    <!-- Micro stats dashboard widget -->
                    <div class="grid grid-cols-3 gap-4 pt-8 max-w-lg mx-auto lg:mx-0 border-t border-slate-300">
                        <div class="text-center lg:text-left">
                            <span class="block text-2xl lg:text-3xl font-black text-slate-800">10k+</span>
                            <span class="text-xs font-bold text-slate-500 uppercase tracking-wider">Pelanggan</span>
                        </div>
                        <div class="text-center lg:text-left border-x border-slate-300 px-4">
                            <span class="block text-2xl lg:text-3xl font-black text-blue-600">99.9%</span>
                            <span class="text-xs font-bold text-slate-500 uppercase tracking-wider">Kemurnian</span>
                        </div>
                        <div class="text-center lg:text-left pl-4">
                            <span class="block text-2xl lg:text-3xl font-black text-slate-800">15+</span>
                            <span class="text-xs font-bold text-slate-500 uppercase tracking-wider">Wilayah</span>
                        </div>
                    </div>
                </div>

                <!-- Hero Right SVG Graphic (Premium Bottle Illustration with Water Droplets) -->
                <div class="lg:col-span-5 flex justify-center relative">
                    <div class="absolute w-80 h-80 rounded-full bg-blue-200/50 blur-3xl -z-10 top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2"></div>
                    
                    <div class="floating-element w-72 sm:w-80 lg:w-96 select-none drop-shadow-[0_20px_40px_rgba(59,130,246,0.15)]">
                        <!-- Premium Neomorphic Water Bottle Graphic -->
                        <svg viewBox="0 0 500 600" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-full h-auto">
                            <!-- Background bubbles -->
                            <circle cx="100" cy="400" r="12" fill="#60A5FA" opacity="0.3"/>
                            <circle cx="420" cy="250" r="8" fill="#93C5FD" opacity="0.4"/>
                            <circle cx="380" cy="450" r="16" fill="#3B82F6" opacity="0.2"/>
                            <!-- Water Drops -->
                            <path d="M250 80C250 80 200 150 200 180C200 207.614 222.386 230 250 230C277.614 230 300 207.614 300 180C300 150 250 80 250 80Z" fill="url(#dropGrad)" opacity="0.75"/>
                            
                            <!-- Sleek Premium Water Bottle Outer Glass Shell -->
                            <rect x="175" y="240" width="150" height="280" rx="30" fill="url(#glassGrad)" stroke="rgba(255,255,255,0.6)" stroke-width="3"/>
                            <!-- Bottle Neck -->
                            <path d="M220 240 L220 180 Q220 160 235 160 L265 160 Q280 160 280 180 L280 240 Z" fill="url(#glassGrad)" stroke="rgba(255,255,255,0.6)" stroke-width="3"/>
                            <!-- Bottle Cap -->
                            <rect x="228" y="130" width="44" height="30" rx="8" fill="url(#blueCapGrad)" stroke="#1d4ed8" stroke-width="1.5"/>
                            
                            <!-- Water volume inside bottle -->
                            <rect x="181" y="270" width="138" height="230" rx="20" fill="url(#waterGrad)"/>
                            <!-- Water Surface wave curve -->
                            <path d="M181 270 Q215 255 250 270 T319 270 L319 290 L181 290 Z" fill="#60A5FA" opacity="0.8"/>
                            
                            <!-- Reflection Lines -->
                            <line x1="195" y1="260" x2="195" y2="500" stroke="white" stroke-width="6" stroke-linecap="round" opacity="0.4"/>
                            <line x1="210" y1="280" x2="210" y2="440" stroke="white" stroke-width="3" stroke-linecap="round" opacity="0.3"/>
                            <line x1="305" y1="280" x2="305" y2="480" stroke="white" stroke-width="4" stroke-linecap="round" opacity="0.2"/>

                            <!-- Water Splash ripple -->
                            <ellipse cx="250" cy="540" rx="100" ry="15" fill="#3B82F6" opacity="0.2"/>
                            <ellipse cx="250" cy="540" rx="70" ry="10" fill="#60A5FA" opacity="0.3"/>

                            <!-- Definitions for Gradients -->
                            <defs>
                                <linearGradient id="dropGrad" x1="250" y1="80" x2="250" y2="230" gradientUnits="userSpaceOnUse">
                                    <stop offset="0%" stop-color="#93C5FD"/>
                                    <stop offset="100%" stop-color="#2563EB"/>
                                </linearGradient>
                                <linearGradient id="glassGrad" x1="175" y1="130" x2="325" y2="520" gradientUnits="userSpaceOnUse">
                                    <stop offset="0%" stop-color="rgba(255, 255, 255, 0.7)"/>
                                    <stop offset="100%" stop-color="rgba(191, 219, 254, 0.35)"/>
                                </linearGradient>
                                <linearGradient id="blueCapGrad" x1="228" y1="130" x2="272" y2="160" gradientUnits="userSpaceOnUse">
                                    <stop offset="0%" stop-color="#3b82f6"/>
                                    <stop offset="100%" stop-color="#1d4ed8"/>
                                </linearGradient>
                                <linearGradient id="waterGrad" x1="250" y1="270" x2="250" y2="500" gradientUnits="userSpaceOnUse">
                                    <stop offset="0%" stop-color="#60A5FA" stop-opacity="0.85"/>
                                    <stop offset="100%" stop-color="#1D4ED8" stop-opacity="0.95"/>
                                </linearGradient>
                            </defs>
                        </svg>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Keunggulan Section -->
    <section id="keunggulan" class="py-24">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <!-- Section Title -->
            <div class="text-center max-w-3xl mx-auto mb-16 space-y-4">
                <span class="text-xs font-extrabold tracking-widest text-blue-600 uppercase">✨ Mengapa Memilih Kami?</span>
                <h2 class="text-3xl sm:text-4xl font-black text-slate-800">
                    Standar Kualitas Tertinggi untuk Hidrasi Sehat Anda
                </h2>
                <div class="w-20 h-1.5 bg-blue-600 rounded-full mx-auto"></div>
            </div>

            <!-- Features Cards Grid -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Feature 1 -->
                <div class="product-card p-8 flex flex-col justify-between group">
                    <div>
                        <div class="w-14 h-14 rounded-2xl bg-[#e0e5ec] shadow-[4px_4px_8px_#a3b1c6,-4px_-4px_8px_#ffffff] flex items-center justify-center text-blue-600 mb-6 group-hover:scale-105 transition-transform duration-300">
                            <!-- Mountain Icon -->
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v1.5M12 18.75V21m-7.5-7.5h1.5m12 0h1.5M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-extrabold text-slate-800 mb-3">100% Mata Air Pilihan</h3>
                        <p class="text-slate-500 font-light leading-relaxed">
                            Diambil langsung dari sumber mata air vulkanik alam terdalam yang kaya akan nutrisi mineral mikro penting yang dibutuhkan tubuh setiap hari.
                        </p>
                    </div>
                </div>

                <!-- Feature 2 -->
                <div class="product-card p-8 flex flex-col justify-between group">
                    <div>
                        <div class="w-14 h-14 rounded-2xl bg-[#e0e5ec] shadow-[4px_4px_8px_#a3b1c6,-4px_-4px_8px_#ffffff] flex items-center justify-center text-purple-600 mb-6 group-hover:scale-105 transition-transform duration-300">
                            <!-- Shield check icon -->
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12c0 1.268-.63 2.39-1.593 3.068a3.745 3.745 0 01-1.043 3.296 3.745 3.745 0 01-3.296 1.043A3.745 3.745 0 0112 21c-1.268 0-2.39-.63-3.068-1.593a3.746 3.746 0 01-3.296-1.043 3.745 3.745 0 01-1.043-3.296A3.745 3.745 0 013 12c0-1.268.63-2.39 1.593-3.068a3.745 3.745 0 011.043-3.296 3.746 3.746 0 013.296-1.043A3.746 3.746 0 0112 3c1.268 0 2.39.63 3.068 1.593a3.746 3.746 0 013.296 1.043 3.746 3.746 0 011.043 3.296A3.745 3.745 0 0121 12z" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-extrabold text-slate-800 mb-3">Filtrasi Ozon & UV</h3>
                        <p class="text-slate-500 font-light leading-relaxed">
                            Diproses dengan sistem filtrasi canggih multi-tahap, sterilisasi ultraviolet, serta ozonisasi murni tanpa sentuhan tangan manusia demi keamanan Anda.
                        </p>
                    </div>
                </div>

                <!-- Feature 3 -->
                <div class="product-card p-8 flex flex-col justify-between group">
                    <div>
                        <div class="w-14 h-14 rounded-2xl bg-[#e0e5ec] shadow-[4px_4px_8px_#a3b1c6,-4px_-4px_8px_#ffffff] flex items-center justify-center text-cyan-600 mb-6 group-hover:scale-105 transition-transform duration-300">
                            <!-- Truck Icon -->
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 18.75a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM19.5 18.75a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM2.25 15h13.5m-10.5-3h10.5m-10.5-3h10.5m-3.75-3H6.75A2.25 2.25 0 004.5 8.25V15h15V8.25A2.25 2.25 0 0017.25 6h-3.75Z" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-extrabold text-slate-800 mb-3">Layanan Pengiriman Kilat</h3>
                        <p class="text-slate-500 font-light leading-relaxed">
                            Sistem manajemen pengiriman otomatis terjadwal yang memastikan pasokan air bersih murni Anda selalu terisi tepat waktu tanpa hambatan.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Produk Section -->
    <section id="produk" class="py-24">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Section Header -->
            <div class="text-center max-w-3xl mx-auto mb-16 space-y-4">
                <span class="text-xs font-extrabold tracking-widest text-blue-600 uppercase">📦 Varian Produk Air</span>
                <h2 class="text-3xl sm:text-4xl font-black text-slate-800">
                    Produk Air Mineral Premium Rindu Water
                </h2>
                <p class="text-slate-500 font-light max-w-lg mx-auto">
                    Pilih kemasan yang sesuai dengan kebutuhan hidrasi harian Anda, mulai dari ukuran personal praktis hingga kebutuhan galon keluarga.
                </p>
                <div class="w-20 h-1.5 bg-blue-600 rounded-full mx-auto"></div>
            </div>

            <!-- Products Grid -->
            @if(isset($produk) && $produk->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    @foreach($produk as $p)
                        <!-- Single Product Card -->
                        <div class="product-card p-6 flex flex-col justify-between relative overflow-hidden group">
                            <!-- Glass Droplet Icon in top corner background -->
                            <div class="absolute -right-4 -top-4 text-blue-100/10 group-hover:text-blue-100/20 w-24 h-24 transition-colors duration-300">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24" class="w-full h-full">
                                    <path d="M12 2.69l5.66 5.66a8 8 0 1 1-11.31 0z"/>
                                </svg>
                            </div>

                            <div>
                                <!-- Product Image Container (Neomorphic Inset) -->
                                <div class="w-full h-56 rounded-2xl mb-6 flex items-center justify-center relative overflow-hidden p-4 neo-inset group-hover:scale-[1.02] transition-transform duration-300">
                                    @if($p->foto_produk)
                                        <img src="{{ asset('storage/' . $p->foto_produk) }}" alt="{{ $p->nama_produk }}" class="max-h-full max-w-full object-contain drop-shadow-[0_10px_20px_rgba(59,130,246,0.15)]" />
                                    @else
                                        <!-- Custom styled dynamic SVGs based on kemasan type -->
                                        @if($p->jenis_kemasan == 'botol')
                                            <!-- Detailed Botol SVG -->
                                            <svg viewBox="0 0 100 200" fill="none" class="h-44 w-auto drop-shadow-md">
                                                <rect x="35" y="80" width="30" height="100" rx="8" fill="url(#pCardGlass)" stroke="#3B82F6" stroke-width="2"/>
                                                <path d="M43 80 L43 50 Q43 45 47 45 L53 45 Q57 45 57 50 L57 80 Z" fill="url(#pCardGlass)" stroke="#3B82F6" stroke-width="2"/>
                                                <rect x="45" y="38" width="10" height="10" fill="#3B82F6" rx="2"/>
                                                <rect x="37" y="100" width="26" height="60" rx="3" fill="#60A5FA" opacity="0.8"/>
                                            </svg>
                                        @elseif($p->jenis_kemasan == 'galon')
                                            <!-- Premium Galon SVG -->
                                            <svg viewBox="0 0 100 200" fill="none" class="h-44 w-auto drop-shadow-md">
                                                <rect x="25" y="60" width="50" height="120" rx="15" fill="url(#pCardGlass)" stroke="#2563EB" stroke-width="2.5"/>
                                                <path d="M42 60 L42 35 Q42 30 46 30 L54 30 Q58 30 58 35 L58 60 Z" fill="url(#pCardGlass)" stroke="#2563EB" stroke-width="2.5"/>
                                                <rect x="44" y="20" width="12" height="12" fill="#2563EB" rx="2"/>
                                                <rect x="29" y="85" width="42" height="85" rx="10" fill="#3B82F6" opacity="0.85"/>
                                                <line x1="29" y1="100" x2="71" y2="100" stroke="white" stroke-width="2" opacity="0.4"/>
                                            </svg>
                                        @elseif($p->jenis_kemasan == 'gelas')
                                            <!-- Cute Cup SVG -->
                                            <svg viewBox="0 0 100 200" fill="none" class="h-44 w-auto drop-shadow-md">
                                                <path d="M25 60 L30 160 Q32 170 40 170 L60 170 Q68 170 70 160 L75 60 Z" fill="url(#pCardGlass)" stroke="#3B82F6" stroke-width="2"/>
                                                <ellipse cx="50" cy="60" rx="25" ry="8" fill="#3b82f6" stroke="#2563eb" stroke-width="1.5"/>
                                                <path d="M28 85 L32 155 Q33 162 38 162 L62 162 Q67 162 68 155 L72 85 Z" fill="#60A5FA" opacity="0.75"/>
                                            </svg>
                                        @else
                                            <!-- Generic Water Droplet SVG -->
                                            <svg viewBox="0 0 100 200" fill="none" class="h-44 w-auto text-blue-500">
                                                <path d="M50 40C50 40 15 100 15 130C15 157.61 37.39 180 50 180C62.61 180 85 157.61 85 130C85 100 50 40 50 40Z" fill="url(#waterDropGrad)"/>
                                            </svg>
                                        @endif
                                    @endif
                                    
                                    <!-- Dynamic badge on capacity -->
                                    <span class="absolute bottom-3 left-3 bg-[#e0e5ec]/90 backdrop-blur-sm text-xs font-bold text-blue-700 px-3 py-1 rounded-full shadow-[2px_2px_4px_#a3b1c6,-2px_-2px_4px_#ffffff] border border-white/50">
                                        {{ $p->kapasitas }}
                                    </span>
                                </div>

                                <!-- Product Info -->
                                <div class="space-y-3">
                                    <div class="flex items-center justify-between">
                                        <!-- Packaging type badge -->
                                        <span class="text-xs font-bold uppercase tracking-wider text-blue-600 bg-blue-100/50 px-2.5 py-1 rounded-md">
                                            Kemasan: {{ $p->jenis_kemasan }}
                                        </span>

                                        <!-- Stock status Badge -->
                                        @if($p->stok > 100)
                                            <span class="text-xs font-extrabold text-emerald-700 bg-emerald-100/60 px-2.5 py-0.5 rounded-full">
                                                Stok Melimpah
                                            </span>
                                        @elseif($p->stok > 0)
                                            <span class="text-xs font-extrabold text-amber-700 bg-amber-100/60 px-2.5 py-0.5 rounded-full">
                                                Stok Terbatas ({{ $p->stok }})
                                            </span>
                                        @else
                                            <span class="text-xs font-extrabold text-red-700 bg-red-100/60 px-2.5 py-0.5 rounded-full">
                                                Habis
                                            </span>
                                        @endif
                                    </div>

                                    <h3 class="text-xl font-black text-slate-800 leading-tight group-hover:text-blue-600 transition-colors">
                                        {{ $p->nama_produk }}
                                    </h3>
                                    <p class="text-sm font-light text-slate-500 line-clamp-2 h-10">
                                        {{ $p->deskripsi ?? 'Pilihan terbaik air mineral murni berkualitas tinggi untuk memenuhi hidrasi berkualitas harian Anda.' }}
                                    </p>
                                </div>
                            </div>

                            <!-- Footer Price and Action Button -->
                            <div class="mt-8 pt-4 border-t border-slate-300 flex items-center justify-between gap-4">
                                <div>
                                    <span class="block text-xs font-semibold text-slate-500">Harga Per Unit</span>
                                    <span class="text-xl font-black text-slate-800">Rp {{ number_format($p->harga, 0, ',', '.') }}</span>
                                </div>
                                <a href="{{ url('/dashboard') }}" class="py-3 px-4 text-center font-bold text-white bg-gradient-to-br from-blue-500 to-blue-700 hover:from-blue-600 hover:to-blue-800 rounded-full shadow-[3px_3px_6px_#a3b1c6,-3px_-3px_6px_#ffffff] transition-all duration-300 hover:-translate-y-0.5 text-sm flex-1">
                                    Pesan Sekarang
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <!-- Fallback Mock Cards -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <!-- Card 1 -->
                    <div class="product-card p-6 flex flex-col justify-between group">
                        <div>
                            <div class="w-full h-56 rounded-2xl mb-6 flex items-center justify-center relative overflow-hidden p-4 neo-inset">
                                <svg viewBox="0 0 100 200" fill="none" class="h-44 w-auto drop-shadow-md">
                                    <rect x="25" y="60" width="50" height="120" rx="15" fill="url(#pCardGlass)" stroke="#2563EB" stroke-width="2.5"/>
                                    <path d="M42 60 L42 35 Q42 30 46 30 L54 30 Q58 30 58 35 L58 60 Z" fill="url(#pCardGlass)" stroke="#2563EB" stroke-width="2.5"/>
                                    <rect x="44" y="20" width="12" height="12" fill="#2563eb" rx="2"/>
                                    <rect x="29" y="85" width="42" height="85" rx="10" fill="#3B82F6" opacity="0.85"/>
                                </svg>
                                <span class="absolute bottom-3 left-3 bg-[#e0e5ec]/90 backdrop-blur-sm text-xs font-bold text-blue-700 px-3 py-1 rounded-full shadow-[2px_2px_4px_#a3b1c6,-2px_-2px_4px_#ffffff] border border-white/50">19 Liter</span>
                            </div>
                            <div class="space-y-3">
                                <div class="flex items-center justify-between">
                                    <span class="text-xs font-bold uppercase tracking-wider text-blue-600 bg-blue-100/50 px-2.5 py-1 rounded-md">Galon</span>
                                    <span class="text-xs font-extrabold text-emerald-700 bg-emerald-100/60 px-2.5 py-0.5 rounded-full">Tersedia</span>
                                </div>
                                <h3 class="text-xl font-black text-slate-800 group-hover:text-blue-600 transition-colors">Galon Rindu Keluarga</h3>
                                <p class="text-sm font-light text-slate-500 line-clamp-2">Kebutuhan hidrasi keluarga terpenuhi dengan pasokan galon 19 Liter steril, berkualitas, serta hemat.</p>
                            </div>
                        </div>
                        <div class="mt-8 pt-4 border-t border-slate-300 flex items-center justify-between gap-4">
                            <div><span class="block text-xs font-semibold text-slate-500">Harga</span><span class="text-xl font-black text-slate-800">Rp 19.000</span></div>
                            <a href="{{ url('/dashboard') }}" class="py-3 px-4 text-center font-bold text-white bg-gradient-to-br from-blue-500 to-blue-700 hover:from-blue-600 hover:to-blue-800 rounded-full shadow-[3px_3px_6px_#a3b1c6,-3px_-3px_6px_#ffffff] text-sm flex-1">Pesan Sekarang</a>
                        </div>
                    </div>
                    <!-- Card 2 -->
                    <div class="product-card p-6 flex flex-col justify-between group">
                        <div>
                            <div class="w-full h-56 rounded-2xl mb-6 flex items-center justify-center relative overflow-hidden p-4 neo-inset">
                                <svg viewBox="0 0 100 200" fill="none" class="h-44 w-auto drop-shadow-md">
                                    <rect x="35" y="80" width="30" height="100" rx="8" fill="url(#pCardGlass)" stroke="#3B82F6" stroke-width="2"/>
                                    <path d="M43 80 L43 50 Q43 45 47 45 L53 45 Q57 45 57 50 L57 80 Z" fill="url(#pCardGlass)" stroke="#3B82F6" stroke-width="2"/>
                                    <rect x="45" y="38" width="10" height="10" fill="#3b82f6" rx="2"/>
                                    <rect x="37" y="100" width="26" height="60" rx="3" fill="#60A5FA" opacity="0.8"/>
                                </svg>
                                <span class="absolute bottom-3 left-3 bg-[#e0e5ec]/90 backdrop-blur-sm text-xs font-bold text-blue-700 px-3 py-1 rounded-full shadow-[2px_2px_4px_#a3b1c6,-2px_-2px_4px_#ffffff] border border-white/50">1500ml</span>
                            </div>
                            <div class="space-y-3">
                                <div class="flex items-center justify-between">
                                    <span class="text-xs font-bold uppercase tracking-wider text-blue-600 bg-blue-100/50 px-2.5 py-1 rounded-md">Botol</span>
                                    <span class="text-xs font-extrabold text-emerald-700 bg-emerald-100/60 px-2.5 py-0.5 rounded-full">Tersedia</span>
                                </div>
                                <h3 class="text-xl font-black text-slate-800 group-hover:text-blue-600 transition-colors">Rindu Premium Botol</h3>
                                <p class="text-sm font-light text-slate-500 line-clamp-2">Botol 1500ml untuk pemakaian harian di meja kerja atau bepergian jauh.</p>
                            </div>
                        </div>
                        <div class="mt-8 pt-4 border-t border-slate-300 flex items-center justify-between gap-4">
                            <div><span class="block text-xs font-semibold text-slate-500">Harga</span><span class="text-xl font-black text-slate-800">Rp 6.000</span></div>
                            <a href="{{ url('/dashboard') }}" class="py-3 px-4 text-center font-bold text-white bg-gradient-to-br from-blue-500 to-blue-700 hover:from-blue-600 hover:to-blue-800 rounded-full shadow-[3px_3px_6px_#a3b1c6,-3px_-3px_6px_#ffffff] text-sm flex-1">Pesan Sekarang</a>
                        </div>
                    </div>
                    <!-- Card 3 -->
                    <div class="product-card p-6 flex flex-col justify-between group">
                        <div>
                            <div class="w-full h-56 rounded-2xl mb-6 flex items-center justify-center relative overflow-hidden p-4 neo-inset">
                                <svg viewBox="0 0 100 200" fill="none" class="h-44 w-auto drop-shadow-md">
                                    <path d="M25 60 L30 160 Q32 170 40 170 L60 170 Q68 170 70 160 L75 60 Z" fill="url(#pCardGlass)" stroke="#3B82F6" stroke-width="2"/>
                                    <ellipse cx="50" cy="60" rx="25" ry="8" fill="#3b82f6" stroke="#2563eb" stroke-width="1.5"/>
                                    <path d="M28 85 L32 155 Q33 162 38 162 L62 162 Q67 162 68 155 L72 85 Z" fill="#60A5FA" opacity="0.75"/>
                                </svg>
                                <span class="absolute bottom-3 left-3 bg-[#e0e5ec]/90 backdrop-blur-sm text-xs font-bold text-blue-700 px-3 py-1 rounded-full shadow-[2px_2px_4px_#a3b1c6,-2px_-2px_4px_#ffffff] border border-white/50">220ml</span>
                            </div>
                            <div class="space-y-3">
                                <div class="flex items-center justify-between">
                                    <span class="text-xs font-bold uppercase tracking-wider text-blue-600 bg-blue-100/50 px-2.5 py-1 rounded-md">Gelas</span>
                                    <span class="text-xs font-extrabold text-emerald-700 bg-emerald-100/60 px-2.5 py-0.5 rounded-full">Tersedia</span>
                                </div>
                                <h3 class="text-xl font-black text-slate-800 group-hover:text-blue-600 transition-colors">Rindu Cup Praktis</h3>
                                <p class="text-sm font-light text-slate-500 line-clamp-2">Air minum dalam kemasan gelas 220ml steril, sangat pas untuk hidrasi singkat tamu Anda.</p>
                            </div>
                        </div>
                        <div class="mt-8 pt-4 border-t border-slate-300 flex items-center justify-between gap-4">
                            <div><span class="block text-xs font-semibold text-slate-500">Harga</span><span class="text-xl font-black text-slate-800">Rp 1.500</span></div>
                            <a href="{{ url('/dashboard') }}" class="py-3 px-4 text-center font-bold text-white bg-gradient-to-br from-blue-500 to-blue-700 hover:from-blue-600 hover:to-blue-800 rounded-full shadow-[3px_3px_6px_#a3b1c6,-3px_-3px_6px_#ffffff] text-sm flex-1">Pesan Sekarang</a>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </section>

    <!-- Definitions for Card Gradients -->
    <svg class="hidden">
        <defs>
            <linearGradient id="pCardGlass" x1="0" y1="0" x2="100" y2="200" gradientUnits="userSpaceOnUse">
                <stop offset="0%" stop-color="rgba(255,255,255,0.7)"/>
                <stop offset="100%" stop-color="rgba(191,219,254,0.3)"/>
            </linearGradient>
            <linearGradient id="waterDropGrad" x1="50" y1="40" x2="50" y2="180" gradientUnits="userSpaceOnUse">
                <stop offset="0%" stop-color="#93C5FD"/>
                <stop offset="100%" stop-color="#3B82F6"/>
            </linearGradient>
        </defs>
    </svg>

    <!-- Layanan Langganan Section -->
    <section id="layanan" class="py-24 relative">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <!-- Section Title -->
            <div class="text-center max-w-3xl mx-auto mb-20 space-y-4">
                <span class="text-xs font-extrabold tracking-widest text-blue-600 uppercase">📅 Kemudahan Berlangganan</span>
                <h2 class="text-3xl sm:text-4xl font-black text-slate-800">
                    Sistem Berlangganan Pintar Rindu Water
                </h2>
                <p class="text-slate-500 font-light max-w-md mx-auto">
                    Kendalikan pasokan air bersih murni Anda secara fleksibel menggunakan fitur langganan terjadwal.
                </p>
                <div class="w-20 h-1.5 bg-blue-600 rounded-full mx-auto"></div>
            </div>

            <!-- Steps Grid -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-12 relative">
                <!-- Step 1 -->
                <div class="product-card p-8 text-center relative group">
                    <span class="absolute -top-6 left-1/2 -translate-x-1/2 w-12 h-12 rounded-full bg-blue-600 text-white font-extrabold text-lg flex items-center justify-center shadow-lg border-4 border-[#e0e5ec]">
                        1
                    </span>
                    <h3 class="text-xl font-extrabold text-slate-800 mb-3 mt-4">Buat Akun</h3>
                    <p class="text-slate-500 font-light text-sm leading-relaxed">
                        Mendaftarlah secara instan dan lengkapi alamat detail profil pengiriman Anda di sistem kami.
                    </p>
                </div>

                <!-- Step 2 -->
                <div class="product-card p-8 text-center relative group">
                    <span class="absolute -top-6 left-1/2 -translate-x-1/2 w-12 h-12 rounded-full bg-blue-600 text-white font-extrabold text-lg flex items-center justify-center shadow-lg border-4 border-[#e0e5ec]">
                        2
                    </span>
                    <h3 class="text-xl font-extrabold text-slate-800 mb-3 mt-4">Pilih Paket & Produk</h3>
                    <p class="text-slate-500 font-light text-sm leading-relaxed">
                        Tentukan varian air mineral serta frekuensi jadwal pengantaran harian, mingguan, atau bulanan.
                    </p>
                </div>

                <!-- Step 3 -->
                <div class="product-card p-8 text-center relative group">
                    <span class="absolute -top-6 left-1/2 -translate-x-1/2 w-12 h-12 rounded-full bg-blue-600 text-white font-extrabold text-lg flex items-center justify-center shadow-lg border-4 border-[#e0e5ec]">
                        3
                    </span>
                    <h3 class="text-xl font-extrabold text-slate-800 mb-3 mt-4">Air Diantar Otomatis</h3>
                    <p class="text-slate-500 font-light text-sm leading-relaxed">
                        Kurir profesional kami akan mengantarkan air segar steril Anda langsung ke lokasi secara berkala.
                    </p>
                </div>
            </div>

            <!-- Call to Action below steps -->
            <div class="mt-16 text-center">
                <a href="{{ route('register') }}" class="inline-flex items-center justify-center px-8 py-4 rounded-full font-bold text-white neo-btn-primary text-base gap-2 group">
                    <span>Mulai Berlangganan Sekarang</span>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-5 h-5 group-hover:translate-x-1 transition-transform">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                    </svg>
                </a>
            </div>
        </div>
    </section>

    <!-- Testimonial Section -->
    <section class="py-24 relative overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
                <!-- Title Info -->
                <div class="lg:col-span-4 space-y-6 text-center lg:text-left">
                    <span class="text-xs font-extrabold tracking-widest text-blue-600 uppercase">💬 Ulasan Pengguna</span>
                    <h2 class="text-3xl sm:text-4xl font-black text-slate-800 leading-tight">
                        Apa Kata Mereka Tentang Rindu Water?
                    </h2>
                    <p class="text-slate-500 font-light">
                        Ribuan keluarga dan institusi telah mempercayakan kebutuhan hidrasi bersih higienis harian mereka bersama kami.
                    </p>
                    <div class="w-20 h-1 bg-blue-600 rounded-full mx-auto lg:mx-0"></div>
                </div>

                <!-- Testimonials Cards Grid -->
                <div class="lg:col-span-8 grid grid-cols-1 sm:grid-cols-2 gap-8">
                    <!-- Testi 1 -->
                    <div class="product-card p-8 flex flex-col justify-between">
                        <p class="text-slate-600 font-light text-sm italic leading-relaxed">
                            "Rindu Water benar-benar mengubah cara kami mengonsumsi air. Jadwal pengantaran mingguan sangat konsisten, dan kualitas air mineralnya benar-benar terasa segar dan murni. Sangat direkomendasikan!"
                        </p>
                        <div class="flex items-center gap-3 pt-6 mt-6 border-t border-slate-300">
                            <!-- Avatar (Neo Inset) -->
                            <div class="w-10 h-10 rounded-full bg-blue-600 text-white font-extrabold flex items-center justify-center text-xs shadow-md">
                                AR
                            </div>
                            <div>
                                <span class="block text-sm font-bold text-slate-800">Ahmad Rian</span>
                                <span class="text-xs text-slate-500">Kepala Rumah Tangga, Jakarta</span>
                            </div>
                        </div>
                    </div>

                    <!-- Testi 2 -->
                    <div class="product-card p-8 flex flex-col justify-between">
                        <p class="text-slate-600 font-light text-sm italic leading-relaxed">
                            "Sangat praktis untuk kantor kami yang memiliki 50 staf. Fitur langganan bulanan di dashboard admin menghemat waktu pengadaan barang kami. Layanan kurirnya cepat dan ramah!"
                        </p>
                        <div class="flex items-center gap-3 pt-6 mt-6 border-t border-slate-300">
                            <!-- Avatar -->
                            <div class="w-10 h-10 rounded-full bg-purple-600 text-white font-extrabold flex items-center justify-center text-xs shadow-md">
                                S
                            </div>
                            <div>
                                <span class="block text-sm font-bold text-slate-800">Sarah</span>
                                <span class="text-xs text-slate-500">Office Manager, PT Maju Bersama</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="py-16 border-t border-slate-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-12 gap-12 pb-12 border-b border-slate-300">
                <!-- Branding info -->
                <div class="md:col-span-5 space-y-6">
                    <a href="#" class="flex items-center space-x-2">
                        <span class="p-2 bg-gradient-to-br from-blue-400 to-blue-600 rounded-full text-white shadow-md">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.105-6 11.25-6 11.25S7.5 17.605 7.5 10.5a6 6 0 1112 0z" />
                            </svg>
                        </span>
                        <span class="text-xl font-extrabold text-slate-800">Rindu <span class="text-blue-600">Water</span></span>
                    </a>
                    <p class="text-sm font-light text-slate-500 leading-relaxed max-w-sm">
                        Menghadirkan air mineral alami pegunungan berkualitas tinggi secara steril dan higienis untuk kesehatan hidrasi terbaik Anda setiap hari.
                    </p>
                </div>

                <!-- Footer Menu 1 -->
                <div class="md:col-span-3 space-y-4">
                    <h4 class="text-sm font-extrabold text-slate-800 uppercase tracking-wider">Tautan Cepat</h4>
                    <ul class="space-y-2 text-sm font-semibold text-slate-600">
                        <li><a href="#home" class="hover:text-blue-600 transition-colors">Home</a></li>
                        <li><a href="#keunggulan" class="hover:text-blue-600 transition-colors">Keunggulan</a></li>
                        <li><a href="#produk" class="hover:text-blue-600 transition-colors">Produk Kami</a></li>
                        <li><a href="#layanan" class="hover:text-blue-600 transition-colors">Layanan Berlangganan</a></li>
                    </ul>
                </div>

                <!-- Footer Menu 2 -->
                <div class="md:col-span-4 space-y-4">
                    <h4 class="text-sm font-extrabold text-slate-800 uppercase tracking-wider">Hubungi Kami</h4>
                    <p class="text-sm text-slate-500 leading-relaxed font-light">
                        Alamat Pabrik Utama:<br>
                        Kawasan Industri Mata Air Pegunungan Vulkanik, Jawa Barat, Indonesia
                    </p>
                    <p class="text-sm text-slate-600 font-bold">
                        Email: info@rinduwater.co.id<br>
                        Telepon: (021) 8888-9999
                    </p>
                </div>
            </div>

            <!-- Credits and copyrights -->
            <div class="pt-8 flex flex-col sm:flex-row items-center justify-between gap-4">
                <p class="text-xs text-slate-500 font-bold">&copy; {{ date('Y') }} Rindu Water. Hak Cipta Dilindungi.</p>
                <div class="flex items-center space-x-6 text-xs text-slate-500 font-bold">
                    <a href="#" class="hover:text-blue-600">Syarat & Ketentuan</a>
                    <a href="#" class="hover:text-blue-600">Kebijakan Privasi</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Header Scroll background change script -->
    <script>
        window.addEventListener('scroll', function() {
            const header = document.querySelector('#main-header div');
            if (window.scrollY > 50) {
                header.classList.remove('neo-raised');
                header.classList.add('neo-inset');
            } else {
                header.classList.remove('neo-inset');
                header.classList.add('neo-raised');
            }
        });
    </script>
</body>
</html>
