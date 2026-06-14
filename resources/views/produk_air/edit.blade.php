@extends('layouts.admin')

@section('title', 'Edit Produk')

@section('content')
<div class="max-w-2xl mx-auto">
    <!-- Back Button -->
    <a href="{{ route('produk-air.index') }}" class="inline-flex items-center px-4 py-2 bg-white border border-slate-200 rounded-xl font-bold text-xs text-slate-700 shadow-sm hover:translate-y-[-1px] transition-all mb-6 gap-2">
        Kembali ke Katalog
    </a>

    <!-- Form Container -->
    <div class="neo-brutal-card p-8 bg-white space-y-6">
        <div class="border-b border-slate-100 pb-4">
            <h3 class="text-xl font-extrabold text-slate-800">Formulir Perbarui Produk Air Mineral</h3>
            <p class="text-xs font-semibold text-slate-500 mt-1">Ubah informasi produk air mineral yang sudah ada di katalog.</p>
        </div>

        <form action="{{ route('produk-air.update', $produk->id_produk) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')

            <!-- Name -->
            <div class="space-y-2">
                <label for="nama_produk" class="block font-bold text-sm text-slate-700">Nama Produk <span class="text-red-500">*</span></label>
                <input type="text" id="nama_produk" name="nama_produk" class="neo-brutal-input @error('nama_produk') border-red-500 @enderror" value="{{ old('nama_produk', $produk->nama_produk) }}" required placeholder="Contoh: Galon Rindu Premium">
                @error('nama_produk') <p class="text-xs font-semibold text-red-500 mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Jenis Kemasan -->
                <div class="space-y-2">
                    <label for="jenis_kemasan" class="block font-bold text-sm text-slate-700">Jenis Kemasan <span class="text-red-500">*</span></label>
                    <select id="jenis_kemasan" name="jenis_kemasan" class="neo-brutal-input" required>
                        <option value="galon" {{ old('jenis_kemasan', $produk->jenis_kemasan) === 'galon' ? 'selected' : '' }}>Galon</option>
                        <option value="botol" {{ old('jenis_kemasan', $produk->jenis_kemasan) === 'botol' ? 'selected' : '' }}>Botol</option>
                        <option value="gelas" {{ old('jenis_kemasan', $produk->jenis_kemasan) === 'gelas' ? 'selected' : '' }}>Gelas</option>
                    </select>
                    @error('jenis_kemasan') <p class="text-xs font-semibold text-red-500 mt-1">{{ $message }}</p> @enderror
                </div>

                <!-- Kapasitas -->
                <div class="space-y-2">
                    <label for="kapasitas" class="block font-bold text-sm text-slate-700">Kapasitas (Volume) <span class="text-red-500">*</span></label>
                    <input type="text" id="kapasitas" name="kapasitas" class="neo-brutal-input" value="{{ old('kapasitas', $produk->kapasitas) }}" required placeholder="Contoh: 15L, 600ml, 220ml">
                    @error('kapasitas') <p class="text-xs font-semibold text-red-500 mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Harga -->
                <div class="space-y-2">
                    <label for="harga" class="block font-bold text-sm text-slate-700">Harga Jual (Rp) <span class="text-red-500">*</span></label>
                    <input type="number" step="0.01" id="harga" name="harga" min="0" class="neo-brutal-input" value="{{ old('harga', $produk->harga) }}" required placeholder="Contoh: 15000">
                    @error('harga') <p class="text-xs font-semibold text-red-500 mt-1">{{ $message }}</p> @enderror
                </div>

                <!-- Stok -->
                <div class="space-y-2">
                    <label for="stok" class="block font-bold text-sm text-slate-700">Jumlah Stok <span class="text-red-500">*</span></label>
                    <input type="number" id="stok" name="stok" min="0" class="neo-brutal-input" value="{{ old('stok', $produk->stok) }}" required placeholder="Contoh: 100">
                    @error('stok') <p class="text-xs font-semibold text-red-500 mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

            <!-- Status & Photo -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-2">
                    <label for="status_produk" class="block font-bold text-sm text-slate-700">Status Produk <span class="text-red-500">*</span></label>
                    <select id="status_produk" name="status_produk" class="neo-brutal-input" required>
                        <option value="tersedia" {{ old('status_produk', $produk->status_produk) === 'tersedia' ? 'selected' : '' }}>Tersedia</option>
                        <option value="habis" {{ old('status_produk', $produk->status_produk) === 'habis' ? 'selected' : '' }}>Kosong</option>
                    </select>
                    @error('status_produk') <p class="text-xs font-semibold text-red-500 mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="space-y-2">
                    <label for="foto_produk" class="block font-bold text-sm text-slate-700">Foto Produk</label>
                    @if($produk->foto_produk)
                    <div class="flex items-center gap-4 mb-2">
                        <div class="w-16 h-16 border border-slate-200 rounded-lg overflow-hidden bg-slate-50 shadow-sm">
                            <img src="{{ asset('storage/' . $produk->foto_produk) }}" alt="Preview" class="w-full h-full object-cover">
                        </div>
                        <span class="text-xs font-bold text-slate-400">Gambar yang digunakan saat ini</span>
                    </div>
                    @endif
                    <input type="file" id="foto_produk" name="foto_produk" class="neo-brutal-input" accept="image/*">
                    <p class="text-[10px] font-bold text-slate-400">Unggah file baru jika ingin mengganti gambar produk</p>
                    @error('foto_produk') <p class="text-xs font-semibold text-red-500 mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

            <!-- Deskripsi -->
            <div class="space-y-2">
                <label for="deskripsi" class="block font-bold text-sm text-slate-700">Deskripsi Produk</label>
                <textarea id="deskripsi" name="deskripsi" rows="4" class="neo-brutal-input" placeholder="Tuliskan spesifikasi produk, kelebihan, atau petunjuk penggunaan...">{{ old('deskripsi', $produk->deskripsi) }}</textarea>
                @error('deskripsi') <p class="text-xs font-semibold text-red-500 mt-1">{{ $message }}</p> @enderror
            </div>

            <!-- Submit -->
            <button type="submit" class="w-full py-3.5 bg-gradient-to-tr from-cyan-500 to-cyan-400 text-white rounded-xl font-bold text-sm shadow-md shadow-cyan-500/15 hover:scale-[1.01] active:scale-[0.99] transition-all">
                Perbarui Informasi Produk
            </button>
        </form>
    </div>
</div>
@endsection
