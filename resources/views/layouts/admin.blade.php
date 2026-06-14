<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Rindu Water') }} - Admin Portal</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;800&display=swap" rel="stylesheet">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/css/admin_dashboard.css', 'resources/js/app.js'])

        <!-- Soft Glassmorphic SaaS Design System -->
        <style>
            :root {
                --neo-bg: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 50%, #e2e8f0 100%);
                --neo-yellow: #facc15;
                --neo-blue: #4f46e5;
                --neo-cyan: #06b6d4;
                --neo-red: #f43f5e;
                --neo-border-color: rgba(226, 232, 240, 0.8);
                --neo-text: #1e293b;
                --neo-shadow-dark: rgba(0,0,0,0.03);
                --neo-radius: 20px;
            }

            * { font-family: 'Plus Jakarta Sans', sans-serif; }

            body {
                background: var(--neo-bg);
                color: var(--neo-text);
                min-height: 100vh;
            }

            /* Premium Soft Glassmorphic classes */
            .neo-brutal-card {
                background: rgba(255, 255, 255, 0.85);
                backdrop-filter: blur(12px);
                -webkit-backdrop-filter: blur(12px);
                border: 1px solid rgba(226, 232, 240, 0.8);
                border-radius: var(--neo-radius);
                box-shadow: 0 10px 30px -5px rgba(0, 0, 0, 0.03), 0 4px 12px -2px rgba(0, 0, 0, 0.02);
                transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            }

            .neo-brutal-card:hover {
                transform: translateY(-2px);
                box-shadow: 0 20px 40px -10px rgba(0, 0, 0, 0.06), 0 8px 20px -6px rgba(0, 0, 0, 0.03);
            }

            .neo-brutal-btn {
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

            .neo-brutal-btn:hover {
                transform: translateY(-1px);
                box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.08), 0 4px 6px -2px rgba(0, 0, 0, 0.04);
                background: #f8fafc;
            }

            .neo-brutal-btn:active {
                transform: translateY(1px);
                box-shadow: 0 2px 4px 0 rgba(0, 0, 0, 0.05);
            }

            .neo-brutal-btn-blue {
                background: linear-gradient(135deg, #6366f1 0%, #4f46e5 100%) !important;
                color: #ffffff !important;
                border: 0 !important;
                box-shadow: 0 4px 12px 0 rgba(79, 70, 229, 0.2) !important;
            }
            .neo-brutal-btn-blue:hover {
                box-shadow: 0 8px 20px 0 rgba(79, 70, 229, 0.3) !important;
                background: linear-gradient(135deg, #818cf8 0%, #4f46e5 100%) !important;
            }

            .neo-brutal-btn-cyan {
                background: linear-gradient(135deg, #06b6d4 0%, #0891b2 100%) !important;
                color: #ffffff !important;
                border: 0 !important;
                box-shadow: 0 4px 12px 0 rgba(6, 182, 212, 0.2) !important;
            }
            .neo-brutal-btn-cyan:hover {
                box-shadow: 0 8px 20px 0 rgba(6, 182, 212, 0.3) !important;
                background: linear-gradient(135deg, #22d3ee 0%, #0891b2 100%) !important;
            }

            .neo-brutal-btn-red {
                background: linear-gradient(135deg, #f43f5e 0%, #e11d48 100%) !important;
                color: #ffffff !important;
                border: 0 !important;
                box-shadow: 0 4px 12px 0 rgba(244, 63, 94, 0.2) !important;
            }
            .neo-brutal-btn-red:hover {
                box-shadow: 0 8px 20px 0 rgba(244, 63, 94, 0.3) !important;
                background: linear-gradient(135deg, #fb7185 0%, #e11d48 100%) !important;
            }

            .neo-brutal-input {
                width: 100%;
                background: rgba(248, 250, 252, 0.6) !important;
                border: 1px solid #e2e8f0 !important;
                border-radius: 12px !important;
                padding: 10px 14px !important;
                font-size: 0.9rem !important;
                font-weight: 600 !important;
                color: #1e293b !important;
                outline: none !important;
                box-shadow: none !important;
                transition: all 0.2s ease;
            }

            .neo-brutal-input:hover {
                transform: none;
                border-color: #cbd5e1 !important;
            }

            .neo-brutal-input:focus {
                background: #ffffff !important;
                border-color: #6366f1 !important;
                transform: none;
                box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.12) !important;
            }

            select.neo-brutal-input {
                appearance: none !important;
                -webkit-appearance: none !important;
                -moz-appearance: none !important;
                background-image: url("data:image/svg+xml;charset=UTF-8,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='%2364748b' stroke-width='2.5' stroke-linecap='round' stroke-linejoin='round'%3e%3cpolyline points='6 9 12 15 18 9'%3e%3c/polyline%3e%3c/svg%3e") !important;
                background-repeat: no-repeat !important;
                background-position: right 16px center !important;
                background-size: 14px !important;
                padding-right: 40px !important;
                cursor: pointer !important;
                font-weight: 600 !important;
            }

            .neo-brutal-badge {
                display: inline-flex;
                align-items: center;
                padding: 4px 10px;
                background: rgba(99, 102, 241, 0.1);
                color: #4f46e5;
                border: 0;
                border-radius: 999px;
                font-weight: 700;
                font-size: 0.7rem;
                text-transform: uppercase;
                letter-spacing: 0.05em;
                box-shadow: none;
            }

            .neo-border-thick {
                border: 1px solid rgba(226, 232, 240, 0.8);
            }

            ::-webkit-scrollbar {
                width: 8px;
                height: 8px;
            }
            ::-webkit-scrollbar-track {
                background: #f1f5f9;
                border-left: 0;
            }
            ::-webkit-scrollbar-thumb {
                background: #cbd5e1;
                border: 0;
                border-radius: 99px;
            }
            ::-webkit-scrollbar-thumb:hover {
                background: #94a3b8;
            }

            /* Custom Dropdown Styles (SaaS Modern) */
            .custom-dropdown-container {
                position: relative;
                width: 100%;
            }
            .custom-dropdown-list {
                position: absolute;
                left: 0;
                right: 0;
                margin-top: 6px;
                background: rgba(255, 255, 255, 0.95);
                backdrop-filter: blur(8px);
                border: 1px solid rgba(226, 232, 240, 0.8);
                border-radius: 12px;
                box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 8px 10px -6px rgba(0, 0, 0, 0.05);
                z-index: 50;
                max-height: 240px;
                overflow-y: auto;
            }
            .custom-dropdown-item {
                padding: 10px 14px;
                font-weight: 600;
                font-size: 0.9rem;
                color: #334155;
                cursor: pointer;
                border-bottom: 1px solid #f1f5f9;
                transition: all 0.15s ease;
            }
            .custom-dropdown-item:last-child {
                border-bottom: none;
            }
            .custom-dropdown-item:hover:not(.disabled) {
                background: #f1f5f9;
                color: #1e293b;
            }
            .custom-dropdown-item.selected {
                background: rgba(99, 102, 241, 0.1);
                color: #4f46e5;
            }
            .custom-dropdown-item.disabled {
                opacity: 0.5;
                cursor: not-allowed;
            }
            .chevron-icon {
                display: inline-flex;
                align-items: center;
                justify-content: center;
                transition: transform 0.2s ease;
            }
            .chevron-icon.rotate-180 {
                transform: rotate(180deg);
            }
        </style>

    </head>
    <body class="antialiased" x-data="{ sidebarOpen: false }">
        <div class="min-h-screen flex" style="background: var(--neo-bg);">
            
            <!-- Sidebar for Admin (Mobile Drawer & Desktop Fixed) -->
            <aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'" class="fixed inset-y-0 left-0 w-72 bg-white border-r border-slate-200/80 z-50 transform lg:transform-none lg:opacity-100 lg:sticky lg:top-0 lg:h-screen transition-transform duration-250 ease-out flex flex-col justify-between shadow-sm">
                <div class="flex-1 overflow-hidden flex flex-col">
                    <!-- Logo / Brand Header -->
                    <div class="h-20 border-b border-slate-200/80 flex items-center px-6 bg-gradient-to-tr from-yellow-400 to-yellow-300 gap-3">
                        <a href="{{ route('admin.dashboard') }}" class="block p-1.5 bg-white rounded-full shadow-sm">
                            <x-application-logo class="h-8 w-8 text-black" />
                        </a>
                        <span class="font-extrabold text-lg text-slate-800 tracking-tight">Rindu Admin Portal</span>
                    </div>

                    <!-- Navigation Links -->
                    <nav class="flex-1 p-4 space-y-1 overflow-y-auto">
                        <!-- Dashboard -->
                        <a href="{{ route('admin.dashboard') }}" class="flex items-center px-4 py-3 rounded-xl font-bold transition-all duration-200 text-slate-700 text-sm {{ request()->routeIs('admin.dashboard') ? 'bg-gradient-to-tr from-yellow-400 to-yellow-300 text-black shadow-md shadow-yellow-400/20 font-extrabold' : 'hover:bg-slate-100/85 hover:text-slate-900' }}">
                            <svg class="h-5 w-5 mr-3 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6A2.25 2.25 0 0 1 6 3.75h2.25A2.25 2.25 0 0 1 10.5 6v2.25a2.25 2.25 0 0 1-2.25 2.25H6a2.25 2.25 0 0 1-2.25-2.25V6ZM3.75 15.75A2.25 2.25 0 0 1 6 13.5h2.25a2.25 2.25 0 0 1 2.25 2.25V18a2.25 2.25 0 0 1-2.25 2.25H6A2.25 2.25 0 0 1 3.75 18v-2.25ZM13.5 6a2.25 2.25 0 0 1 2.25-2.25H18A2.25 2.25 0 0 1 20.25 6v2.25A2.25 2.25 0 0 1 18 10.5h-2.25a2.25 2.25 0 0 1-2.25-2.25V6ZM13.5 15.75a2.25 2.25 0 0 1 2.25-2.25H18a2.25 2.25 0 0 1 2.25 2.25V18A2.25 2.25 0 0 1 18 20.25h-2.25A2.25 2.25 0 0 1 13.5 18v-2.25Z" />
                            </svg>
                            Dashboard Overview
                        </a>

                        <div class="pt-3 pb-1 text-[11px] font-extrabold text-slate-400 uppercase tracking-widest pl-2">Katalog & Stok</div>
                        
                        <!-- Produk Air -->
                        <a href="{{ route('produk-air.index') }}" class="flex items-center px-4 py-3 rounded-xl font-bold transition-all duration-200 text-slate-700 text-sm {{ request()->routeIs('produk-air.*') ? 'bg-gradient-to-tr from-cyan-500 to-cyan-400 text-white shadow-md shadow-cyan-500/15 font-extrabold' : 'hover:bg-slate-100/85 hover:text-slate-900' }}">
                            <svg class="h-5 w-5 mr-3 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.105-7.5 11.25-7.5 11.25S4.5 17.605 4.5 10.5a7.5 7.5 0 1 1 15 0Z" />
                            </svg>
                            Produk & Stok Air
                        </a>
                        
                        <!-- Riwayat Stock -->
                        <a href="{{ route('riwayat-stock.index') }}" class="flex items-center px-4 py-3 rounded-xl font-bold transition-all duration-200 text-slate-700 text-sm {{ request()->routeIs('riwayat-stock.*') ? 'bg-gradient-to-tr from-cyan-500 to-cyan-400 text-white shadow-md shadow-cyan-500/15 font-extrabold' : 'hover:bg-slate-100/85 hover:text-slate-900' }}">
                            <svg class="h-5 w-5 mr-3 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 0 0 2.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 0 0-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 0 0 .75-.75 2.25 2.25 0 0 0-.1-.664m-5.8 0A2.251 2.251 0 0 0 13.5 2.25H15c1.03 0 1.9.693 2.166 1.638m-7.377 15.75A2.25 2.25 0 0 1 7.5 18V6.108c0-1.135.845-2.098 1.976-2.192a48.424 48.424 0 0 1 1.123-.08" />
                            </svg>
                            Log Mutasi Stok
                        </a>
                        
                        <!-- Gudang -->
                        <a href="{{ route('gudang.index') }}" class="flex items-center px-4 py-3 rounded-xl font-bold transition-all duration-200 text-slate-700 text-sm {{ request()->routeIs('gudang.*') ? 'bg-gradient-to-tr from-cyan-500 to-cyan-400 text-white shadow-md shadow-cyan-500/15 font-extrabold' : 'hover:bg-slate-100/85 hover:text-slate-900' }}">
                            <svg class="h-5 w-5 mr-3 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 21h19.5m-18-18v18m10.5-18v18m6-13.5V21M6.75 6.75h.75m-.75 3h.75m-.75 3h.75m3-6h.75m-.75 3h.75m-.75 3h.75M14 8.25h1.5m-1.5 3h1.5m-1.5 3h1.5M18.75 9.75h.75m-.75 3h.75" />
                            </svg>
                            Inventaris Gudang
                        </a>

                        <div class="pt-3 pb-1 text-[11px] font-extrabold text-slate-400 uppercase tracking-widest pl-2">Transaksi & Siklus</div>
                        
                        <!-- Transaksi -->
                        <a href="{{ route('transaksi.index') }}" class="flex items-center px-4 py-3 rounded-xl font-bold transition-all duration-200 text-slate-700 text-sm {{ request()->routeIs('transaksi.*') ? 'bg-gradient-to-tr from-emerald-500 to-emerald-400 text-white shadow-md shadow-emerald-500/15 font-extrabold' : 'hover:bg-slate-100/85 hover:text-slate-900' }}">
                            <svg class="h-5 w-5 mr-3 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18.75a60.07 60.07 0 0 1 15.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5h16.5c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125H3.75a1.125 1.125 0 0 1-1.125-1.125V5.625c0-.621.504-1.125 1.125-1.125Z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9.75A2.25 2.25 0 1 0 9.75 12 2.25 2.25 0 0 0 12 9.75Z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 9.75h.008v.008h-.008V9.75Zm-9 4.5h.008v.008h-.008v-.008Z" />
                            </svg>
                            Riwayat Transaksi
                        </a>

                        <!-- Langganan -->
                        <a href="{{ route('langganan.index') }}" class="flex items-center px-4 py-3 rounded-xl font-bold transition-all duration-200 text-slate-700 text-sm {{ request()->routeIs('langganan.*') ? 'bg-gradient-to-tr from-emerald-500 to-emerald-400 text-white shadow-md shadow-emerald-500/15 font-extrabold' : 'hover:bg-slate-100/85 hover:text-slate-900' }}">
                            <svg class="h-5 w-5 mr-3 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5" />
                            </svg>
                            Paket Langganan
                        </a>

                        <div class="pt-3 pb-1 text-[11px] font-extrabold text-slate-400 uppercase tracking-widest pl-2">Pengiriman & Logistik</div>

                        <!-- Kurir -->
                        <a href="{{ route('kurir.index') }}" class="flex items-center px-4 py-3 rounded-xl font-bold transition-all duration-200 text-slate-700 text-sm {{ request()->routeIs('kurir.*') ? 'bg-gradient-to-tr from-indigo-500 to-indigo-400 text-white shadow-md shadow-indigo-500/15 font-extrabold' : 'hover:bg-slate-100/85 hover:text-slate-900' }}">
                            <svg class="h-5 w-5 mr-3 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 18.75a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m3 0h6m-9 0H3.375a1.125 1.125 0 0 1-1.125-1.125V14.25m17.25 4.5a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m3 0h1.125c.621 0 1.129-.504 1.129-1.125V11.25c0-.447-.267-.852-.68-1.01l-2.902-1.09A1.125 1.125 0 0 0 17.25 9.75H13.5v9M13.5 9v11.25m-10.5-6h10.5" />
                            </svg>
                            Staff Kurir
                        </a>

                        <!-- Pengiriman -->
                        <a href="{{ route('pengiriman.index') }}" class="flex items-center px-4 py-3 rounded-xl font-bold transition-all duration-200 text-slate-700 text-sm {{ request()->routeIs('pengiriman.*') ? 'bg-gradient-to-tr from-indigo-500 to-indigo-400 text-white shadow-md shadow-indigo-500/15 font-extrabold' : 'hover:bg-slate-100/85 hover:text-slate-900' }}">
                            <svg class="h-5 w-5 mr-3 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 7.5l-.625 10.632a2.25 2.25 0 0 1-2.247 2.118H6.622a2.25 2.25 0 0 1-2.247-2.118L3.75 7.5M10 11.25h4M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125Z" />
                            </svg>
                            Status Pengiriman
                        </a>

                        <div class="pt-3 pb-1 text-[11px] font-extrabold text-slate-400 uppercase tracking-widest pl-2">Administrasi</div>

                        <!-- Pelanggan -->
                        <a href="{{ route('pelanggan.index') }}" class="flex items-center px-4 py-3 rounded-xl font-bold transition-all duration-200 text-slate-700 text-sm {{ request()->routeIs('pelanggan.*') ? 'bg-gradient-to-tr from-orange-500 to-orange-400 text-white shadow-md shadow-orange-500/15 font-extrabold' : 'hover:bg-slate-100/85 hover:text-slate-900' }}">
                            <svg class="h-5 w-5 mr-3 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 0 0 3.741-.479 3 3 0 0 0-4.682-2.72m.94 3.198.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0 1 12 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 0 1 6 18.719m12 0a5.971 5.971 0 0 0-.941-3.197m0 0A5.995 5.995 0 0 0 12 12.75a5.995 5.995 0 0 0-5.058 2.772m0 0a3 3 0 0 0-4.681 2.72 8.986 8.986 0 0 0 3.74.477m.94-3.197a5.971 5.971 0 0 0-.94 3.197M15 6.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm6 3a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Zm-13.5 0a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Z" />
                            </svg>
                            Akun Pelanggan
                        </a>

                        <!-- Users -->
                        <a href="{{ route('users.index') }}" class="flex items-center px-4 py-3 rounded-xl font-bold transition-all duration-200 text-slate-700 text-sm {{ request()->routeIs('users.*') ? 'bg-gradient-to-tr from-orange-500 to-orange-400 text-white shadow-md shadow-orange-500/15 font-extrabold' : 'hover:bg-slate-100/85 hover:text-slate-900' }}">
                            <svg class="h-5 w-5 mr-3 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 5.25a3 3 0 0 1 3 3m3 0a6 6 0 0 1-7.029 5.912c-.563-.097-1.159.026-1.563.43L10.5 17.25H8.25v2.25H6v2.25H2.25v-2.818c0-.597.237-1.17.659-1.591l6.499-6.499c.404-.404.527-1 .43-1.563A6 6 0 1 1 21.75 8.25Z" />
                            </svg>
                            Akun Pengguna
                        </a>

                        <!-- Laporan Penjualan -->
                        <a href="{{ route('laporan-penjualan.index') }}" class="flex items-center px-4 py-3 rounded-xl font-bold transition-all duration-200 text-slate-700 text-sm {{ request()->routeIs('laporan-penjualan.*') ? 'bg-gradient-to-tr from-pink-500 to-pink-400 text-white shadow-md shadow-pink-500/15 font-extrabold' : 'hover:bg-slate-100/85 hover:text-slate-900' }}">
                            <svg class="h-5 w-5 mr-3 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18 9 11.25l4.306 4.306a11.95 11.95 0 0 1 5.814-5.518l2.74-1.22m0 0-5.94-2.281m5.94 2.28-2.28 5.941" />
                            </svg>
                            Laporan Keuangan
                        </a>
                    </nav>
                </div>

                <!-- Footer / Profile Sign Out -->
                <div class="p-4 border-t border-slate-200/80 bg-slate-50/50 flex items-center justify-between">
                    <div class="flex items-center gap-2">
                        <div class="w-10 h-10 rounded-full border border-slate-200 bg-gradient-to-tr from-yellow-400 to-yellow-300 flex items-center justify-center font-black text-slate-800">
                            A
                        </div>
                        <div class="overflow-hidden w-36">
                            <div class="font-extrabold text-xs text-slate-800 truncate">{{ Auth::user()->name }}</div>
                            <div class="text-[10px] font-bold text-slate-500 truncate">Administrator</div>
                        </div>
                    </div>
                    <!-- Logout -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="p-2.5 rounded-xl bg-gradient-to-tr from-rose-500 to-rose-400 text-white hover:scale-105 active:scale-95 transition-all shadow-sm" title="Log Out">
                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                            </svg>
                        </button>
                    </form>
                </div>
            </aside>

            <!-- Main Content Area -->
            <div class="flex-1 flex flex-col min-w-0">
                <!-- Topbar -->
                <header class="h-20 bg-white/80 backdrop-blur-md border-b border-slate-200/80 flex items-center justify-between px-6 lg:px-8 sticky top-0 z-40">
                    <div class="flex items-center gap-4">
                        <!-- Hamburger button -->
                        <button @click="sidebarOpen = !sidebarOpen" class="p-2.5 rounded-xl bg-gradient-to-tr from-yellow-400 to-yellow-300 shadow-sm active:translate-y-0.5 lg:hidden">
                            <svg class="h-6 w-6 text-black" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
                            </svg>
                        </button>

                        <h1 class="font-extrabold text-2xl text-slate-800 tracking-tight">
                            @yield('title', 'Admin Panel')
                        </h1>
                    </div>

                    <!-- Clock / Date indicator -->
                    <div class="hidden md:flex items-center gap-2 bg-slate-100 text-slate-700 px-4 py-2 rounded-xl border border-slate-200/80 font-bold text-xs">
                        <svg class="h-4 w-4 shrink-0 text-slate-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5" />
                        </svg>
                        {{ now()->translatedFormat('d F Y') }}
                    </div>
                </header>

                <!-- Dynamic View Content Slot -->
                <main class="p-6 lg:p-8 flex-1 overflow-y-auto max-w-7xl w-full mx-auto space-y-8">
                    
                    <!-- Alert notification banner -->
                    @if(session('success'))
                        <div class="p-4 bg-emerald-50 border border-emerald-200/80 rounded-xl text-emerald-800 font-bold flex items-center space-x-3 shadow-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6 shrink-0 text-emerald-600">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                            </svg>
                            <span>{{ session('success') }}</span>
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="p-4 bg-rose-50 border border-rose-200/80 rounded-xl text-rose-800 font-bold flex items-center space-x-3 shadow-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6 shrink-0 text-rose-600">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z" />
                            </svg>
                            <span>{{ session('error') }}</span>
                        </div>
                    @endif

                    @yield('content')
                </main>
            </div>
        </div>
        
        <!-- Generic Custom Select Dropdown Transformer -->
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Transform all native select elements with class 'neo-brutal-input'
                document.querySelectorAll('select.neo-brutal-input').forEach(select => {
                    // If it's already transformed, skip
                    if (select.dataset.transformed) return;
                    select.dataset.transformed = "true";

                    // Hide native select
                    select.style.display = 'none';

                    // Create wrapper
                    const wrapper = document.createElement('div');
                    wrapper.className = 'custom-dropdown-container';
                    select.parentNode.insertBefore(wrapper, select);
                    wrapper.appendChild(select);

                    // Create trigger button
                    const trigger = document.createElement('button');
                    trigger.type = 'button';
                    trigger.className = 'neo-brutal-input text-left flex items-center justify-between w-full font-extrabold pr-10';
                    
                    const selectedText = document.createElement('span');
                    selectedText.className = 'selected-text';
                    
                    // Get selected option
                    const activeOption = select.options[select.selectedIndex] || select.options[0];
                    selectedText.textContent = activeOption ? activeOption.textContent : '-- Pilih --';
                    
                    // Chevron icon SVG
                    const chevron = document.createElement('span');
                    chevron.className = 'chevron-icon';
                    chevron.innerHTML = `<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor" style="width: 16px; height: 16px;">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                    </svg>`;

                    trigger.appendChild(selectedText);
                    trigger.appendChild(chevron);
                    wrapper.appendChild(trigger);

                    // Create options list
                    const list = document.createElement('div');
                    list.className = 'custom-dropdown-list hidden';
                    wrapper.appendChild(list);

                    // Populate options
                    Array.from(select.options).forEach(opt => {
                        if (opt.value === '' && opt.disabled) return; // skip placeholder if disabled and empty

                        const item = document.createElement('div');
                        item.className = 'custom-dropdown-item';
                        item.textContent = opt.textContent;
                        item.dataset.value = opt.value;

                        if (opt.disabled) {
                            item.classList.add('disabled');
                        }
                        if (opt.selected) {
                            item.classList.add('selected');
                        }

                        if (!opt.disabled) {
                            item.addEventListener('click', function(e) {
                                e.stopPropagation();
                                
                                // Remove previous selection styling
                                list.querySelectorAll('.custom-dropdown-item').forEach(el => el.classList.remove('selected'));
                                item.classList.add('selected');

                                // Update select value and dispatch change
                                select.value = opt.value;
                                select.dispatchEvent(new Event('change', { bubbles: true }));

                                // Update button text
                                selectedText.textContent = opt.textContent;

                                // Close list
                                list.classList.add('hidden');
                                chevron.classList.remove('rotate-180');
                            });
                        }

                        list.appendChild(item);
                    });

                    // Trigger click to toggle dropdown
                    trigger.addEventListener('click', function(e) {
                        e.stopPropagation();
                        
                        // Close all other custom dropdowns
                        document.querySelectorAll('.custom-dropdown-list').forEach(l => {
                            if (l !== list) {
                                l.classList.add('hidden');
                                const otherChevron = l.previousSibling.querySelector('.chevron-icon');
                                if (otherChevron) otherChevron.classList.remove('rotate-180');
                            }
                        });

                        const isHidden = list.classList.contains('hidden');
                        if (isHidden) {
                            list.classList.remove('hidden');
                            chevron.classList.add('rotate-180');
                        } else {
                            list.classList.add('hidden');
                            chevron.classList.remove('rotate-180');
                        }
                    });
                });

                // Close dropdowns when clicking outside
                document.addEventListener('click', function(e) {
                    if (!e.target.closest('.custom-dropdown-container')) {
                        document.querySelectorAll('.custom-dropdown-list').forEach(list => {
                            list.classList.add('hidden');
                        });
                        document.querySelectorAll('.chevron-icon').forEach(chevron => {
                            chevron.classList.remove('rotate-180');
                        });
                    }
                });
            });
        </script>
    </body>
</html>
