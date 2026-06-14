@extends('layouts.admin')

@section('title', 'Tambah Kurir Baru')

@section('content')
<div class="max-w-2xl mx-auto">
    <!-- Back Button -->
    <a href="{{ route('kurir.index') }}" class="inline-flex items-center px-4 py-2 border-3 border-black rounded-xl bg-white font-extrabold text-xs shadow-[3px_3px_0px_#000000] hover:scale-105 active:scale-95 transition-all mb-6 gap-2">
        ⬅️ Kembali ke Armada
    </a>

    <!-- Form Container -->
    <div class="neo-brutal-card p-8 bg-white space-y-6">
        <div class="border-b-3 border-black pb-4">
            <h3 class="text-xl font-black text-black">Formulir Tambah Armada Kurir</h3>
            <p class="text-xs font-semibold text-slate-500 mt-1">Masukkan informasi profil kurir dan detail kendaraan operasional.</p>
        </div>

        <form action="{{ route('kurir.store') }}" method="POST" class="space-y-6">
            @csrf

            <!-- Name -->
            <div class="space-y-2">
                <label for="nama_kurir" class="block font-black text-sm text-black">Nama Lengkap Kurir <span class="text-red-500">*</span></label>
                <input type="text" id="nama_kurir" name="nama_kurir" class="neo-brutal-input" value="{{ old('nama_kurir') }}" required placeholder="Contoh: Budi Prasetyo">
                @error('nama_kurir') <p class="text-xs font-black text-red-500 mt-1">{{ $message }}</p> @enderror
            </div>

            <!-- Kontak & Status -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-2">
                    <label for="no_hp" class="block font-black text-sm text-black">Nomor HP / WhatsApp <span class="text-red-500">*</span></label>
                    <input type="text" id="no_hp" name="no_hp" class="neo-brutal-input" value="{{ old('no_hp') }}" required placeholder="Contoh: 08123456789">
                    @error('no_hp') <p class="text-xs font-black text-red-500 mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="space-y-2">
                    <label for="status_kurir" class="block font-black text-sm text-black">Status Operasional <span class="text-red-500">*</span></label>
                    <select id="status_kurir" name="status_kurir" class="neo-brutal-input" required>
                        <option value="aktif" {{ old('status_kurir') === 'aktif' ? 'selected' : '' }}>Aktif (Siap Tugas)</option>
                        <option value="istirahat" {{ old('status_kurir') === 'istirahat' ? 'selected' : '' }}>Istirahat</option>
                        <option value="tidak aktif" {{ old('status_kurir') === 'tidak aktif' ? 'selected' : '' }}>Tidak Aktif (Off)</option>
                    </select>
                    @error('status_kurir') <p class="text-xs font-black text-red-500 mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

            <!-- Armada Kendaraan -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-2">
                    <label for="kendaraan" class="block font-black text-sm text-black">Tipe Kendaraan Operasional <span class="text-red-500">*</span></label>
                    <select id="kendaraan" name="kendaraan" class="neo-brutal-input" required>
                        <option value="Motor" {{ old('kendaraan') === 'Motor' ? 'selected' : '' }}>Motor</option>
                        <option value="Mobil" {{ old('kendaraan') === 'Mobil' ? 'selected' : '' }}>Mobil</option>
                        <option value="Grandmax" {{ old('kendaraan') === 'Grandmax' ? 'selected' : '' }}>Grandmax</option>
                    </select>
                    @error('kendaraan') <p class="text-xs font-black text-red-500 mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="space-y-2">
                    <label for="plat_nomor" class="block font-black text-sm text-black">Plat Nomor Kendaraan <span class="text-red-500">*</span></label>
                    <input type="text" id="plat_nomor" name="plat_nomor" class="neo-brutal-input" value="{{ old('plat_nomor') }}" required placeholder="Contoh: AD 1234 XY">
                    @error('plat_nomor') <p class="text-xs font-black text-red-500 mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

            <!-- Alamat -->
            <div class="space-y-2">
                <label for="alamat" class="block font-black text-sm text-black">Alamat Rumah Kurir <span class="text-red-500">*</span></label>
                <textarea id="alamat" name="alamat" rows="3" class="neo-brutal-input" placeholder="Tuliskan alamat tinggal lengkap..." required>{{ old('alamat') }}</textarea>
                @error('alamat') <p class="text-xs font-black text-red-500 mt-1">{{ $message }}</p> @enderror
            </div>

            <!-- Catatan -->
            <div class="space-y-2">
                <label for="catatan" class="block font-black text-sm text-black">Catatan Tambahan</label>
                <textarea id="catatan" name="catatan" rows="2" class="neo-brutal-input" placeholder="Catatan mengenai SIM, wilayah pengantaran utama, dll...">{{ old('catatan') }}</textarea>
                @error('catatan') <p class="text-xs font-black text-red-500 mt-1">{{ $message }}</p> @enderror
            </div>

            <!-- Submit -->
            <button type="submit" class="w-full py-4 border-3 border-black rounded-xl bg-[#4ade80] font-black text-sm text-black shadow-[4px_4px_0px_#000000] hover:scale-105 active:scale-95 transition-all">
                💾 Simpan Profil Kurir
            </button>
        </form>
    </div>
</div>
@endsection
