@extends('layouts.admin')

@section('title', 'Tambah Pelanggan Baru')

@section('content')
<div class="max-w-2xl mx-auto">
    <a href="{{ route('pelanggan.index') }}" class="inline-flex items-center px-4 py-2 border border-slate-200 rounded-xl bg-white font-bold text-xs text-slate-700 shadow-sm hover:translate-y-[-1px] transition-all mb-6 gap-2">
        Kembali ke Daftar Pelanggan
    </a>

    <div class="neo-brutal-card p-8 bg-white space-y-6">
        <div class="border-b border-slate-100 pb-4">
            <h3 class="text-xl font-extrabold text-slate-850">Formulir Pendaftaran Pelanggan Baru</h3>
            <p class="text-xs font-semibold text-slate-500 mt-1">Daftarkan pelanggan baru ke dalam sistem Rindu Water.</p>
        </div>

        <form action="{{ route('pelanggan.store') }}" method="POST" class="space-y-6">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-2">
                    <label for="jenis_pelanggan" class="block font-bold text-sm text-slate-700 mb-2">Jenis Pelanggan <span class="text-rose-500">*</span></label>
                    <select id="jenis_pelanggan" name="jenis_pelanggan" class="neo-brutal-input" required>
                        <option value="individu" {{ old('jenis_pelanggan') === 'individu' ? 'selected' : '' }}>Individu</option>
                        <option value="lembaga" {{ old('jenis_pelanggan') === 'lembaga' ? 'selected' : '' }}>Lembaga / Instansi</option>
                    </select>
                    @error('jenis_pelanggan') <p class="text-xs font-semibold text-rose-500 mt-1">{{ $message }}</p> @enderror
                </div>
                <div class="space-y-2">
                    <label for="status_pelanggan" class="block font-bold text-sm text-slate-700 mb-2">Status <span class="text-rose-500">*</span></label>
                    <select id="status_pelanggan" name="status_pelanggan" class="neo-brutal-input" required>
                        <option value="aktif" {{ old('status_pelanggan') === 'aktif' ? 'selected' : '' }}>Aktif</option>
                        <option value="tidak aktif" {{ old('status_pelanggan') === 'tidak aktif' ? 'selected' : '' }}>Tidak Aktif</option>
                    </select>
                    @error('status_pelanggan') <p class="text-xs font-semibold text-rose-500 mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="space-y-2">
                <label for="nama_pelanggan" class="block font-bold text-sm text-slate-700 mb-2">Nama Pelanggan <span class="text-rose-500">*</span></label>
                <input type="text" id="nama_pelanggan" name="nama_pelanggan" class="neo-brutal-input" value="{{ old('nama_pelanggan') }}" required placeholder="Contoh: Budi Santoso">
                @error('nama_pelanggan') <p class="text-xs font-semibold text-rose-500 mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-2">
                    <label for="nama_lembaga" class="block font-bold text-sm text-slate-700 mb-2">Nama Lembaga</label>
                    <input type="text" id="nama_lembaga" name="nama_lembaga" class="neo-brutal-input" value="{{ old('nama_lembaga') }}" placeholder="Isi jika jenis pelanggan Lembaga">
                    @error('nama_lembaga') <p class="text-xs font-semibold text-rose-500 mt-1">{{ $message }}</p> @enderror
                </div>
                <div class="space-y-2">
                    <label for="penanggung_jawab" class="block font-bold text-sm text-slate-700 mb-2">Penanggung Jawab <span class="text-rose-500">*</span></label>
                    <input type="text" id="penanggung_jawab" name="penanggung_jawab" class="neo-brutal-input" value="{{ old('penanggung_jawab') }}" required placeholder="Nama penanggung jawab">
                    @error('penanggung_jawab') <p class="text-xs font-semibold text-rose-500 mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-2">
                    <label for="no_telepon" class="block font-bold text-sm text-slate-700 mb-2">No Telepon <span class="text-rose-500">*</span></label>
                    <input type="text" id="no_telepon" name="no_telepon" class="neo-brutal-input" value="{{ old('no_telepon') }}" required placeholder="Contoh: 08123456789">
                    @error('no_telepon') <p class="text-xs font-semibold text-rose-500 mt-1">{{ $message }}</p> @enderror
                </div>
                <div class="space-y-2">
                    <label for="email" class="block font-bold text-sm text-slate-700 mb-2">Email</label>
                    <input type="email" id="email" name="email" class="neo-brutal-input" value="{{ old('email') }}" placeholder="Contoh: budi@email.com">
                    @error('email') <p class="text-xs font-semibold text-rose-500 mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="space-y-2">
                <label for="alamat" class="block font-bold text-sm text-slate-700 mb-2">Alamat <span class="text-rose-500">*</span></label>
                <textarea id="alamat" name="alamat" rows="3" class="neo-brutal-input" placeholder="Tuliskan alamat lengkap pelanggan..." required>{{ old('alamat') }}</textarea>
                @error('alamat') <p class="text-xs font-semibold text-rose-500 mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="space-y-2">
                <label for="tanggal_daftar" class="block font-bold text-sm text-slate-700 mb-2">Tanggal Daftar <span class="text-rose-500">*</span></label>
                <input type="date" id="tanggal_daftar" name="tanggal_daftar" class="neo-brutal-input" value="{{ old('tanggal_daftar', date('Y-m-d')) }}" required>
                @error('tanggal_daftar') <p class="text-xs font-semibold text-rose-500 mt-1">{{ $message }}</p> @enderror
            </div>

            <button type="submit" class="w-full py-3.5 bg-gradient-to-tr from-emerald-500 to-emerald-400 text-white rounded-xl font-bold text-sm shadow-md shadow-emerald-500/15 hover:scale-102 active:scale-98 transition-all">
                Simpan Pelanggan
            </button>
        </form>
    </div>
</div>
@endsection
