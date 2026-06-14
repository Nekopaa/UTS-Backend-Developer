@extends('layouts.admin')

@section('title', 'Tambah Langganan Baru')

@section('content')
<div class="max-w-2xl mx-auto">
    <a href="{{ route('langganan.index') }}"
       class="inline-flex items-center px-4 py-2 border border-slate-200 rounded-xl bg-white font-bold text-xs text-slate-700 shadow-sm hover:translate-y-[-1px] transition-all mb-6 gap-2">
        Daftar Langganan
    </a>

    <div class="neo-brutal-card p-8 bg-white space-y-6">
        <div class="border-b border-slate-100 pb-4">
            <h3 class="text-xl font-extrabold text-slate-850">Formulir Pendaftaran Langganan</h3>
            <p class="text-xs font-semibold text-slate-500 mt-1">Daftarkan paket langganan air mineral untuk pelanggan.</p>
        </div>

        <form action="{{ route('langganan.store') }}" method="POST" class="space-y-6">
            @csrf

            {{-- ID Pelanggan & ID Produk --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="id_pelanggan" class="block font-bold text-sm text-slate-700 mb-2">Pelanggan</label>
                    <select name="id_pelanggan" id="id_pelanggan" required class="neo-brutal-input">
                        <option value="">-- Pilih Pelanggan --</option>
                        @foreach($pelanggan as $p)
                            <option value="{{ $p->id_pelanggan }}" {{ old('id_pelanggan') == $p->id_pelanggan ? 'selected' : '' }}>
                                {{ $p->nama_pelanggan }}
                            </option>
                        @endforeach
                    </select>
                    @error('id_pelanggan')
                        <p class="text-xs font-semibold text-rose-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="id_produk" class="block font-bold text-sm text-slate-700 mb-2">Produk Air</label>
                    <select name="id_produk" id="id_produk" required class="neo-brutal-input">
                        <option value="">-- Pilih Produk --</option>
                        @foreach($produk as $pr)
                            <option value="{{ $pr->id_produk }}" {{ old('id_produk') == $pr->id_produk ? 'selected' : '' }}>
                                {{ $pr->nama_produk }}
                            </option>
                        @endforeach
                    </select>
                    @error('id_produk')
                        <p class="text-xs font-semibold text-rose-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            {{-- Periode Pengantaran --}}
            <div>
                <label for="periode_pengantaran" class="block font-bold text-sm text-slate-700 mb-2">Periode Pengantaran</label>
                <select name="periode_pengantaran" id="periode_pengantaran" required class="neo-brutal-input">
                    <option value="">-- Pilih Periode --</option>
                    <option value="harian" {{ old('periode_pengantaran') === 'harian' ? 'selected' : '' }}>Harian</option>
                    <option value="mingguan" {{ old('periode_pengantaran') === 'mingguan' ? 'selected' : '' }}>Mingguan</option>
                    <option value="bulanan" {{ old('periode_pengantaran') === 'bulanan' ? 'selected' : '' }}>Bulanan</option>
                </select>
                @error('periode_pengantaran')
                    <p class="text-xs font-semibold text-rose-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Tanggal Mulai & Tanggal Berakhir --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="tanggal_mulai" class="block font-bold text-sm text-slate-700 mb-2">Tanggal Mulai</label>
                    <input type="date" name="tanggal_mulai" id="tanggal_mulai" value="{{ old('tanggal_mulai') }}" required
                           class="neo-brutal-input">
                    @error('tanggal_mulai')
                        <p class="text-xs font-semibold text-rose-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="tanggal_berakhir" class="block font-bold text-sm text-slate-700 mb-2">Tanggal Berakhir</label>
                    <input type="date" name="tanggal_berakhir" id="tanggal_berakhir" value="{{ old('tanggal_berakhir') }}" required
                           class="neo-brutal-input">
                    @error('tanggal_berakhir')
                        <p class="text-xs font-semibold text-rose-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            {{-- Jumlah Pesanan --}}
            <div>
                <label for="jumlah_pesanan" class="block font-bold text-sm text-slate-700 mb-2">Jumlah Pesanan</label>
                <input type="number" name="jumlah_pesanan" id="jumlah_pesanan" value="{{ old('jumlah_pesanan') }}" required
                       class="neo-brutal-input">
                @error('jumlah_pesanan')
                    <p class="text-xs font-semibold text-rose-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Status Langganan --}}
            <div>
                <label for="status_langganan" class="block font-bold text-sm text-slate-700 mb-2">Status Langganan</label>
                <select name="status_langganan" id="status_langganan" required class="neo-brutal-input">
                    <option value="">-- Pilih Status --</option>
                    <option value="aktif" {{ old('status_langganan') === 'aktif' ? 'selected' : '' }}>Aktif</option>
                    <option value="berhenti" {{ old('status_langganan') === 'berhenti' ? 'selected' : '' }}>Berhenti</option>
                    <option value="tertunda" {{ old('status_langganan') === 'tertunda' ? 'selected' : '' }}>Tertunda</option>
                </select>
                @error('status_langganan')
                    <p class="text-xs font-semibold text-rose-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit"
                    class="w-full py-3.5 bg-gradient-to-tr from-emerald-500 to-emerald-400 text-white rounded-xl font-bold text-sm shadow-md shadow-emerald-500/15 hover:scale-102 active:scale-98 transition-all">
                Simpan Langganan
            </button>
        </form>
    </div>
</div>
@endsection
