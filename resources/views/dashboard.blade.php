<x-app-layout>
    <x-slot name="header">
        <h2 class="font-extrabold text-2xl text-slate-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="neo-raised overflow-hidden p-8 sm:rounded-[24px]">
                <div class="text-slate-800 space-y-6">
                    <div class="flex items-center space-x-4">
                        <div class="w-12 h-12 rounded-full bg-gradient-to-br from-blue-400 to-blue-600 shadow-[4px_4px_8px_#a3b1c6,-4px_-4px_8px_#ffffff] flex items-center justify-center text-white">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12c0 1.268-.63 2.39-1.593 3.068a3.745 3.745 0 01-1.043 3.296 3.745 3.745 0 01-3.296 1.043A3.745 3.745 0 0112 21c-1.268 0-2.39-.63-3.068-1.593a3.746 3.746 0 01-3.296-1.043 3.745 3.745 0 01-1.043-3.296A3.745 3.745 0 013 12c0-1.268.63-2.39 1.593-3.068a3.745 3.745 0 011.043-3.296 3.746 3.746 0 013.296-1.043A3.746 3.746 0 0112 3c1.268 0 2.39.63 3.068 1.593a3.746 3.746 0 013.296 1.043 3.746 3.746 0 011.043 3.296A3.745 3.745 0 0121 12z" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-xl font-extrabold text-slate-800">Selamat Datang, {{ Auth::user()->name }}!</h3>
                            <p class="text-sm font-medium text-slate-500">Anda berhasil masuk ke dashboard Rindu Water.</p>
                        </div>
                    </div>
                    
                    <div class="h-0.5 bg-[#c3cfd9] opacity-50 rounded-full"></div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <!-- Card 1 -->
                        <div class="p-6 bg-[#e0e5ec] rounded-2xl shadow-[inset_3px_3px_6px_#a3b1c6,inset_-3px_-3px_6px_#ffffff] flex flex-col justify-between">
                            <span class="text-xs font-bold uppercase tracking-wider text-blue-600">Hidrasi Anda</span>
                            <span class="text-2xl font-black text-slate-800 mt-2">100% Terjaga</span>
                            <p class="text-xs font-light text-slate-500 mt-2">Dapatkan asupan mineral murni alami berkualitas secara otomatis.</p>
                        </div>
                        
                        <!-- Card 2 -->
                        <div class="p-6 bg-[#e0e5ec] rounded-2xl shadow-[inset_3px_3px_6px_#a3b1c6,inset_-3px_-3px_6px_#ffffff] flex flex-col justify-between">
                            <span class="text-xs font-bold uppercase tracking-wider text-blue-600">Pesanan Aktif</span>
                            <span class="text-2xl font-black text-slate-800 mt-2">0 Paket</span>
                            <p class="text-xs font-light text-slate-500 mt-2">Belum ada paket langganan aktif saat ini.</p>
                        </div>
                        
                        <!-- Card 3 -->
                        <div class="p-6 bg-[#e0e5ec] rounded-2xl shadow-[inset_3px_3px_6px_#a3b1c6,inset_-3px_-3px_6px_#ffffff] flex flex-col justify-between">
                            <span class="text-xs font-bold uppercase tracking-wider text-blue-600">Metode Pengantaran</span>
                            <span class="text-2xl font-black text-slate-800 mt-2">Kurir Kilat</span>
                            <p class="text-xs font-light text-slate-500 mt-2">Pengiriman otomatis terjadwal langsung ke alamat rumah Anda.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
