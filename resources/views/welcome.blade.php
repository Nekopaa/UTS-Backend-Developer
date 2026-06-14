<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Rindu Water - Mulai Hidrasi Sehat</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=outfit:300,400,600,800" rel="stylesheet" />

    <!-- Scripts (Tailwind CSS) -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body { font-family: 'Outfit', sans-serif; }
        .glass-card {
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.5);
            box-shadow: 0 10px 30px rgba(0, 163, 255, 0.08);
        }
        .btn-primary {
            background: linear-gradient(135deg, #0ea5e9, #0284c7);
            box-shadow: 0 4px 15px rgba(14, 165, 233, 0.4);
            transition: all 0.3s ease;
        }
        .btn-primary:hover {
            box-shadow: 0 6px 20px rgba(14, 165, 233, 0.6);
            transform: translateY(-2px);
        }
        .btn-outline {
            border: 2px solid #0ea5e9;
            color: #0ea5e9;
            transition: all 0.3s ease;
        }
        .btn-outline:hover {
            background: rgba(14, 165, 233, 0.1);
        }
    </style>
</head>
<body class="bg-slate-50 antialiased min-h-screen flex flex-col relative overflow-x-hidden">

    <!-- Decorative Background Blobs -->
    <div class="absolute top-[-10%] left-[-10%] w-96 h-96 bg-cyan-300/30 rounded-full blur-3xl pointer-events-none"></div>
    <div class="absolute bottom-[-10%] right-[-10%] w-[500px] h-[500px] bg-blue-400/20 rounded-full blur-3xl pointer-events-none"></div>

    <!-- Navigation -->
    <nav class="w-full py-6 px-8 flex justify-between items-center z-10 relative">
        <div class="flex items-center gap-2">
            <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-cyan-400 to-blue-600 flex items-center justify-center text-white font-extrabold text-xl shadow-lg">
                RW
            </div>
            <span class="text-xl font-extrabold text-slate-800 tracking-tight">Rindu<span class="text-sky-500">Water</span></span>
        </div>
        
        @if (Route::has('login'))
            <div class="flex items-center gap-4">
                @auth
                    <a href="{{ url('/dashboard') }}" class="font-semibold text-slate-600 hover:text-sky-600 transition-colors">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="font-semibold text-slate-600 hover:text-sky-600 transition-colors">Log in</a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="btn-primary text-white px-5 py-2 rounded-full font-semibold text-sm">Daftar</a>
                    @endif
                @endauth
            </div>
        @endif
    </nav>

    <!-- Hero Section -->
    <main class="flex-grow flex flex-col items-center justify-center px-4 z-10 text-center py-20 relative">
        <span class="px-4 py-1.5 rounded-full bg-sky-100 text-sky-700 text-sm font-bold mb-6 tracking-wide shadow-sm">
            💧 Sumber Mata Air Pegunungan Asli
        </span>
        <h1 class="text-5xl md:text-7xl font-extrabold text-slate-900 mb-6 leading-tight max-w-4xl">
            Mulai <span class="text-transparent bg-clip-text bg-gradient-to-r from-sky-400 to-blue-600">Hidrasi Sehat</span> <br class="hidden md:block"> Tanpa Ribet
        </h1>
        <p class="text-lg text-slate-500 mb-10 max-w-2xl">
            Kirim galon, botol, dan gelas air mineral berkualitas langsung ke rumah atau kantor Anda hanya dengan beberapa klik. Layanan cepat, higienis, dan terpercaya.
        </p>
        
        <div class="flex flex-col sm:flex-row gap-4 items-center">
            @if(Route::has('register'))
                <a href="{{ route('register') }}" class="btn-primary text-white px-8 py-3.5 rounded-full font-bold text-lg w-full sm:w-auto">
                    Mulai Hidrasi Sehat
                </a>
            @endif
            <a href="{{ route('login') }}" class="btn-outline px-8 py-3.5 rounded-full font-bold text-lg bg-white w-full sm:w-auto">
                Lihat Harga & Pesan
            </a>
        </div>
    </main>

    <!-- Varian Produk -->
    <section class="py-20 px-4 md:px-8 z-10 relative">
        <div class="max-w-6xl mx-auto">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-extrabold text-slate-800 mb-4">Pilihan Produk Rindu Water</h2>
                <p class="text-slate-500 max-w-2xl mx-auto">Tersedia dalam berbagai kemasan untuk memenuhi segala kebutuhan harian, acara keluarga, hingga operasional kantor Anda.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Varian 1 -->
                <div class="glass-card rounded-3xl p-8 flex flex-col items-center text-center transition-transform hover:-translate-y-2">
                    <div class="w-32 h-32 bg-sky-50 rounded-full flex items-center justify-center mb-6 shadow-inner border-4 border-white">
                        <span class="text-5xl">🚰</span>
                    </div>
                    <h3 class="text-2xl font-bold text-slate-800 mb-2">Galon 19 Liter</h3>
                    <p class="text-slate-500 mb-8 text-sm">Pilihan ekonomis dan ramah lingkungan. Sangat cocok untuk kebutuhan air minum keluarga di rumah atau operasional kantor.</p>
                    <a href="{{ route('login') }}" class="w-full py-3 rounded-2xl bg-slate-100 text-sky-600 font-bold hover:bg-sky-50 transition-colors mt-auto border border-sky-100">
                        Lihat Harga & Pesan
                    </a>
                </div>

                <!-- Varian 2 -->
                <div class="glass-card rounded-3xl p-8 flex flex-col items-center text-center transition-transform hover:-translate-y-2">
                    <div class="w-32 h-32 bg-sky-50 rounded-full flex items-center justify-center mb-6 shadow-inner border-4 border-white">
                        <span class="text-5xl">🧴</span>
                    </div>
                    <h3 class="text-2xl font-bold text-slate-800 mb-2">Botol 600 ml</h3>
                    <p class="text-slate-500 mb-8 text-sm">Praktis untuk dibawa bepergian, rapat kecil, atau acara keluarga. Hidrasi kapan saja dan di mana saja.</p>
                    <a href="{{ route('login') }}" class="w-full py-3 rounded-2xl bg-slate-100 text-sky-600 font-bold hover:bg-sky-50 transition-colors mt-auto border border-sky-100">
                        Lihat Harga & Pesan
                    </a>
                </div>

                <!-- Varian 3 -->
                <div class="glass-card rounded-3xl p-8 flex flex-col items-center text-center transition-transform hover:-translate-y-2">
                    <div class="w-32 h-32 bg-sky-50 rounded-full flex items-center justify-center mb-6 shadow-inner border-4 border-white">
                        <span class="text-5xl">🥤</span>
                    </div>
                    <h3 class="text-2xl font-bold text-slate-800 mb-2">Cup 220 ml</h3>
                    <p class="text-slate-500 mb-8 text-sm">Sangat efisien untuk disajikan di acara berskala besar, seminar, perayaan, atau acara hajatan.</p>
                    <a href="{{ route('login') }}" class="w-full py-3 rounded-2xl bg-slate-100 text-sky-600 font-bold hover:bg-sky-50 transition-colors mt-auto border border-sky-100">
                        Lihat Harga & Pesan
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="mt-auto py-8 text-center text-slate-400 text-sm z-10 border-t border-slate-200">
        &copy; {{ date('Y') }} Rindu Water. Hak Cipta Dilindungi.
    </footer>

</body>
</html>
