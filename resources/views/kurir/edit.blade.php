@extends('layouts.admin')

@section('title', 'Edit Profil Kurir')

@section('content')
<div class="max-w-2xl mx-auto">
    <!-- Back Button -->
    <a href="{{ route('kurir.index') }}" class="inline-flex items-center px-4 py-2 border border-slate-200 rounded-xl bg-white font-bold text-xs text-slate-700 shadow-sm hover:translate-y-[-1px] transition-all mb-6 gap-2">
        Kembali ke Armada
    </a>

    <!-- Form Container -->
    <div class="neo-brutal-card p-8 bg-white space-y-6">
        <div class="border-b border-slate-100 pb-4">
            <h3 class="text-xl font-extrabold text-slate-850">Formulir Edit Profil Kurir</h3>
            <p class="text-xs font-semibold text-slate-500 mt-1">Perbarui data kurir dan info armada kendaraan.</p>
        </div>

        <form action="{{ route('kurir.update', $kurir->id_kurir) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <!-- Name -->
            <div class="space-y-2">
                <label for="nama_kurir" class="block font-bold text-sm text-slate-700 mb-2">Nama Lengkap Kurir <span class="text-rose-500">*</span></label>
                <input type="text" id="nama_kurir" name="nama_kurir" class="neo-brutal-input" value="{{ old('nama_kurir', $kurir->nama_kurir) }}" required placeholder="Contoh: Budi Prasetyo">
                @error('nama_kurir') <p class="text-xs font-semibold text-rose-500 mt-1">{{ $message }}</p> @enderror
            </div>

            <!-- Kontak & Status -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-2">
                    <label for="no_hp" class="block font-bold text-sm text-slate-700 mb-2">Nomor HP / WhatsApp <span class="text-rose-500">*</span></label>
                    <input type="text" id="no_hp" name="no_hp" class="neo-brutal-input" value="{{ old('no_hp', $kurir->no_hp) }}" required placeholder="Contoh: 08123456789">
                    @error('no_hp') <p class="text-xs font-semibold text-rose-500 mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="space-y-2">
                    <label for="status_kurir" class="block font-bold text-sm text-slate-700 mb-2">Status Operasional <span class="text-rose-500">*</span></label>
                    <select id="status_kurir" name="status_kurir" class="neo-brutal-input" required>
                        <option value="aktif" {{ old('status_kurir', $kurir->status_kurir) === 'aktif' ? 'selected' : '' }}>Aktif (Siap Tugas)</option>
                        <option value="istirahat" {{ old('status_kurir', $kurir->status_kurir) === 'istirahat' ? 'selected' : '' }}>Istirahat</option>
                        <option value="tidak aktif" {{ old('status_kurir', $kurir->status_kurir) === 'tidak aktif' ? 'selected' : '' }}>Tidak Aktif (Off)</option>
                    </select>
                    @error('status_kurir') <p class="text-xs font-semibold text-rose-500 mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

            <!-- Armada Kendaraan -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-2">
                    <label for="kendaraan" class="block font-bold text-sm text-slate-700 mb-2">Tipe Kendaraan Operasional <span class="text-rose-500">*</span></label>
                    <select id="kendaraan" name="kendaraan" class="neo-brutal-input" required>
                        <option value="">-- Pilih Tipe Kendaraan --</option>
                        <option value="Motor" {{ old('kendaraan', $kurir->kendaraan) === 'Motor' ? 'selected' : '' }}>Motor</option>
                        <option value="Mobil" {{ old('kendaraan', $kurir->kendaraan) === 'Mobil' ? 'selected' : '' }}>Mobil</option>
                        <option value="Grandmax" {{ old('kendaraan', $kurir->kendaraan) === 'Grandmax' ? 'selected' : '' }}>Grandmax</option>
                    </select>
                    @error('kendaraan') <p class="text-xs font-semibold text-rose-500 mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="space-y-2">
                    <label for="plat_nomor" class="block font-bold text-sm text-slate-700 mb-2">Plat Nomor Kendaraan <span class="text-rose-500">*</span></label>
                    <input type="text" id="plat_nomor" name="plat_nomor" class="neo-brutal-input" value="{{ old('plat_nomor', $kurir->plat_nomor) }}" required placeholder="Contoh: AD 1234 XY">
                    @error('plat_nomor') <p class="text-xs font-semibold text-rose-500 mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

            <!-- Alamat -->
            <div class="space-y-2">
                <label for="alamat" class="block font-bold text-sm text-slate-700 mb-2">Alamat Rumah Kurir <span class="text-rose-500">*</span></label>
                <textarea id="alamat" name="alamat" rows="3" class="neo-brutal-input" placeholder="Tuliskan alamat tinggal lengkap..." required>{{ old('alamat', $kurir->alamat) }}</textarea>
                @error('alamat') <p class="text-xs font-semibold text-rose-500 mt-1">{{ $message }}</p> @enderror
            </div>

            <!-- Catatan -->
            <div class="space-y-2">
                <label for="catatan" class="block font-bold text-sm text-slate-700 mb-2">Catatan Tambahan</label>
                <textarea id="catatan" name="catatan" rows="2" class="neo-brutal-input" placeholder="Catatan mengenai SIM, wilayah pengantaran utama, dll...">{{ old('catatan', $kurir->catatan) }}</textarea>
                @error('catatan') <p class="text-xs font-semibold text-rose-500 mt-1">{{ $message }}</p> @enderror
            </div>

            <!-- Submit -->
            <button type="submit" class="w-full py-3.5 bg-gradient-to-tr from-cyan-500 to-cyan-400 text-white rounded-xl font-bold text-sm shadow-md shadow-cyan-500/15 hover:scale-102 active:scale-98 transition-all">
                Simpan Perubahan Profil
            </button>
        </form>
    </div>
</div>
@endsection
