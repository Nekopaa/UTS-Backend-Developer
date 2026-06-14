@extends('layouts.admin')

@section('title', 'Tambah Gudang Baru')

@section('content')
<div class="max-w-2xl mx-auto">
    <!-- Back Button -->
    <a href="{{ route('gudang.index') }}" class="inline-flex items-center px-4 py-2 bg-white border border-slate-200 rounded-xl font-bold text-xs text-slate-700 shadow-sm hover:translate-y-[-1px] transition-all mb-6">
        Kembali ke Gudang
    </a>

    <!-- Form Container -->
    <div class="neo-brutal-card p-8 bg-white space-y-6">
        <div class="border-b border-slate-100 pb-4">
            <h3 class="text-xl font-extrabold text-slate-800">Formulir Pendaftaran Gudang Baru</h3>
            <p class="text-xs font-semibold text-slate-500 mt-1">Masukkan data lokasi dan kapasitas daya tampung gudang.</p>
        </div>

        <form action="{{ route('gudang.store') }}" method="POST" class="space-y-6">
            @csrf

            <!-- Name -->
            <div class="space-y-2">
                <label for="nama_gudang" class="block font-bold text-sm text-slate-700">Nama Gudang <span class="text-red-500">*</span></label>
                <input type="text" id="nama_gudang" name="nama_gudang" class="neo-brutal-input" value="{{ old('nama_gudang') }}" required placeholder="Contoh: Gudang Distribusi Solo">
                @error('nama_gudang') <p class="text-xs font-semibold text-red-500 mt-1">{{ $message }}</p> @enderror
            </div>

            <!-- Capacity & Stock -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-2">
                    <label for="kapasitas_total" class="block font-bold text-sm text-slate-700">Kapasitas Maksimal (Unit) <span class="text-red-500">*</span></label>
                    <input type="number" id="kapasitas_total" name="kapasitas_total" class="neo-brutal-input" value="{{ old('kapasitas_total', 1000) }}" required placeholder="Contoh: 1000">
                    @error('kapasitas_total') <p class="text-xs font-semibold text-red-500 mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="space-y-2">
                    <label for="stok_saat_ini" class="block font-bold text-sm text-slate-700">Stok Saat Ini (Unit) <span class="text-red-500">*</span></label>
                    <input type="number" id="stok_saat_ini" name="stok_saat_ini" class="neo-brutal-input" value="{{ old('stok_saat_ini', 0) }}" required placeholder="Contoh: 0">
                    @error('stok_saat_ini') <p class="text-xs font-semibold text-red-500 mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

            <!-- Status -->
            <div class="space-y-2">
                <label for="status_gudang" class="block font-bold text-sm text-slate-700">Status Gudang <span class="text-red-500">*</span></label>
                <select id="status_gudang" name="status_gudang" class="neo-brutal-input" required>
                    <option value="aktif" {{ old('status_gudang') === 'aktif' ? 'selected' : '' }}>Aktif (Beroperasi)</option>
                    <option value="penuh" {{ old('status_gudang') === 'penuh' ? 'selected' : '' }}>Penuh</option>
                    <option value="maintenance" {{ old('status_gudang') === 'maintenance' ? 'selected' : '' }}>Maintenance</option>
                </select>
                @error('status_gudang') <p class="text-xs font-semibold text-red-500 mt-1">{{ $message }}</p> @enderror
            </div>

            <!-- Lokasi -->
            <div class="space-y-2">
                <label for="lokasi" class="block font-bold text-sm text-slate-700">Alamat Lokasi Gudang <span class="text-red-500">*</span></label>
                <textarea id="lokasi" name="lokasi" rows="3" class="neo-brutal-input" placeholder="Tuliskan alamat lokasi lengkap gudang penyimpanan..." required>{{ old('lokasi') }}</textarea>
                @error('lokasi') <p class="text-xs font-semibold text-red-500 mt-1">{{ $message }}</p> @enderror
            </div>

            <!-- Submit -->
            <button type="submit" class="w-full py-3.5 bg-gradient-to-tr from-emerald-500 to-emerald-400 text-white rounded-xl font-bold text-sm shadow-md shadow-emerald-500/15 hover:scale-[1.01] active:scale-[0.99] transition-all">
                Simpan Lokasi Gudang
            </button>
        </form>
    </div>
</div>
@endsection
