@extends('layouts.admin')

@section('title', 'Edit Langganan')

@section('content')
<div class="max-w-2xl mx-auto">
    <a href="{{ route('langganan.index') }}" class="inline-flex items-center px-4 py-2 border border-slate-200 rounded-xl bg-white font-bold text-xs text-slate-700 shadow-sm hover:translate-y-[-1px] transition-all mb-6 gap-2">
        Daftar Langganan
    </a>

    <div class="neo-brutal-card p-8 bg-white space-y-6">
        <div class="border-b border-slate-100 pb-4">
            <h3 class="text-xl font-extrabold text-slate-850">Formulir Perbarui Langganan</h3>
            <p class="text-xs font-semibold text-slate-500 mt-1">Ubah detail paket langganan pelanggan.</p>
        </div>

        <form action="{{ route('langganan.update', $langganan->id_langganan) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-2">
                    <label for="id_pelanggan" class="block font-bold text-sm text-slate-700 mb-2">Pelanggan <span class="text-rose-500">*</span></label>
                    <select name="id_pelanggan" id="id_pelanggan" required class="neo-brutal-input">
                        <option value="">-- Pilih Pelanggan --</option>
                        @foreach($pelanggan as $p)
                            <option value="{{ $p->id_pelanggan }}" {{ old('id_pelanggan', $langganan->id_pelanggan) == $p->id_pelanggan ? 'selected' : '' }}>
                                {{ $p->nama_pelanggan }}
                            </option>
                        @endforeach
                    </select>
                    @error('id_pelanggan') <p class="text-xs font-semibold text-rose-500 mt-1">{{ $message }}</p> @enderror
                </div>
                <div class="space-y-2">
                    <label for="id_produk" class="block font-bold text-sm text-slate-700 mb-2">Produk Air <span class="text-rose-500">*</span></label>
                    <select name="id_produk" id="id_produk" required class="neo-brutal-input">
                        <option value="">-- Pilih Produk --</option>
                        @foreach($produk as $pr)
                            <option value="{{ $pr->id_produk }}" {{ old('id_produk', $langganan->id_produk) == $pr->id_produk ? 'selected' : '' }}>
                                {{ $pr->nama_produk }}
                            </option>
                        @endforeach
                    </select>
                    @error('id_produk') <p class="text-xs font-semibold text-rose-500 mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="space-y-2">
                <label for="periode_pengantaran" class="block font-bold text-sm text-slate-700 mb-2">Periode Pengantaran <span class="text-rose-500">*</span></label>
                <select id="periode_pengantaran" name="periode_pengantaran" class="neo-brutal-input" required>
                    <option value="harian" {{ old('periode_pengantaran', $langganan->periode_pengantaran) === 'harian' ? 'selected' : '' }}>Harian</option>
                    <option value="mingguan" {{ old('periode_pengantaran', $langganan->periode_pengantaran) === 'mingguan' ? 'selected' : '' }}>Mingguan</option>
                    <option value="bulanan" {{ old('periode_pengantaran', $langganan->periode_pengantaran) === 'bulanan' ? 'selected' : '' }}>Bulanan</option>
                </select>
                @error('periode_pengantaran') <p class="text-xs font-semibold text-rose-500 mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-2">
                    <label for="tanggal_mulai" class="block font-bold text-sm text-slate-700 mb-2">Tanggal Mulai <span class="text-rose-500">*</span></label>
                    <input type="date" id="tanggal_mulai" name="tanggal_mulai" class="neo-brutal-input" value="{{ old('tanggal_mulai', $langganan->tanggal_mulai ? \Carbon\Carbon::parse($langganan->tanggal_mulai)->format('Y-m-d') : '') }}" required>
                    @error('tanggal_mulai') <p class="text-xs font-semibold text-rose-500 mt-1">{{ $message }}</p> @enderror
                </div>
                <div class="space-y-2">
                    <label for="tanggal_berakhir" class="block font-bold text-sm text-slate-700 mb-2">Tanggal Berakhir <span class="text-rose-500">*</span></label>
                    <input type="date" id="tanggal_berakhir" name="tanggal_berakhir" class="neo-brutal-input" value="{{ old('tanggal_berakhir', $langganan->tanggal_berakhir ? \Carbon\Carbon::parse($langganan->tanggal_berakhir)->format('Y-m-d') : '') }}" required>
                    @error('tanggal_berakhir') <p class="text-xs font-semibold text-rose-500 mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-2">
                    <label for="jumlah_pesanan" class="block font-bold text-sm text-slate-700 mb-2">Jumlah Pesanan <span class="text-rose-500">*</span></label>
                    <input type="number" id="jumlah_pesanan" name="jumlah_pesanan" class="neo-brutal-input" value="{{ old('jumlah_pesanan', $langganan->jumlah_pesanan) }}" required>
                    @error('jumlah_pesanan') <p class="text-xs font-semibold text-rose-500 mt-1">{{ $message }}</p> @enderror
                </div>
                <div class="space-y-2">
                    <label for="status_langganan" class="block font-bold text-sm text-slate-700 mb-2">Status Langganan <span class="text-rose-500">*</span></label>
                    <select id="status_langganan" name="status_langganan" class="neo-brutal-input" required>
                        <option value="aktif" {{ old('status_langganan', $langganan->status_langganan) === 'aktif' ? 'selected' : '' }}>Aktif</option>
                        <option value="berhenti" {{ old('status_langganan', $langganan->status_langganan) === 'berhenti' ? 'selected' : '' }}>Berhenti</option>
                        <option value="tertunda" {{ old('status_langganan', $langganan->status_langganan) === 'tertunda' ? 'selected' : '' }}>Tertunda</option>
                    </select>
                    @error('status_langganan') <p class="text-xs font-semibold text-rose-500 mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

            <button type="submit" class="w-full py-3.5 bg-gradient-to-tr from-cyan-500 to-cyan-400 text-white rounded-xl font-bold text-sm shadow-md shadow-cyan-500/15 hover:scale-102 active:scale-98 transition-all">
                Simpan Perubahan
            </button>
        </form>
    </div>
</div>
@endsection
