@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
        <div class="neo-brutal-card p-8">
            <h2 class="text-2xl font-extrabold text-slate-800 mb-6">Buat Langganan Baru</h2>

            <form action="{{ route('pelanggan.langganan.store') }}" method="POST" class="space-y-6">
                @csrf
                
                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-2">Periode Pengantaran</label>
                    <select name="periode_pengantaran" class="neo-brutal-input" required>
                        <option value="">Pilih Periode</option>
                        <option value="Mingguan">Mingguan</option>
                        <option value="Bulanan">Bulanan</option>
                        <option value="Harian">Harian</option>
                    </select>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-2">Tanggal Mulai</label>
                        <input type="date" name="tanggal_mulai" value="{{ old('tanggal_mulai') }}" class="neo-brutal-input" required>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-2">Tanggal Berakhir</label>
                        <input type="date" name="tanggal_berakhir" value="{{ old('tanggal_berakhir') }}" class="neo-brutal-input" required>
                    </div>
                </div>
                
                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-2">Jumlah Pesanan (Galon/Botol/Gelas)</label>
                    <input type="number" name="jumlah_pesanan" value="{{ old('jumlah_pesanan', 1) }}" min="1" class="neo-brutal-input" required>
                </div>
                
                <div class="flex justify-end gap-3 pt-4 border-t border-slate-100">
                    <a href="{{ route('pelanggan.dashboard') }}" class="inline-flex items-center px-4 py-2 border border-slate-200 rounded-xl bg-white font-bold text-xs text-slate-700 shadow-sm hover:translate-y-[-1px] transition-all">
                        Batal
                    </a>
                    <button type="submit" class="inline-flex items-center px-5 py-2 bg-gradient-to-tr from-cyan-500 to-cyan-400 text-white rounded-xl font-bold text-xs shadow-sm hover:scale-105 active:scale-95 transition-all">
                        Simpan Langganan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection