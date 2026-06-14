@extends('layouts.admin')

@section('title', 'Detail Admin')

@section('content')
<div class="max-w-3xl mx-auto space-y-6">
    <div>
        <a href="{{ route('admin.index') }}" class="inline-flex items-center px-4 py-2 bg-white text-slate-700 font-bold text-xs rounded-xl border border-slate-200 shadow-sm hover:bg-slate-50 transition-all gap-2">
            Kembali ke Daftar Admin
        </a>
    </div>

    <div class="neo-brutal-card p-8 bg-white space-y-6">
        <div class="border-b border-slate-100 pb-4">
            <span class="text-xs font-bold uppercase text-indigo-500 tracking-wider">Detail Info</span>
            <h3 class="text-2xl font-bold text-slate-800">{{ $admin->nama_admin }}</h3>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="space-y-1">
                <p class="text-xs font-bold text-slate-400 uppercase tracking-wider">Username</p>
                <p class="text-sm font-bold text-slate-800">{{ $admin->username }}</p>
            </div>

            <div class="space-y-1">
                <p class="text-xs font-bold text-slate-400 uppercase tracking-wider">Email</p>
                <p class="text-sm font-bold text-slate-800">{{ $admin->email }}</p>
            </div>

            <div class="space-y-1">
                <p class="text-xs font-bold text-slate-400 uppercase tracking-wider">No HP</p>
                <p class="text-sm font-bold text-slate-800">{{ $admin->no_hp }}</p>
            </div>

            <div class="space-y-1">
                <p class="text-xs font-bold text-slate-400 uppercase tracking-wider">Role</p>
                <p class="text-sm font-bold text-slate-800">{{ $admin->role }}</p>
            </div>

            <div class="space-y-1">
                <p class="text-xs font-bold text-slate-400 uppercase tracking-wider">Status</p>
                <p class="mt-1">
                    @if($admin->status_admin === 'aktif')
                        <span class="px-2.5 py-1 bg-emerald-50 text-emerald-700 border border-emerald-100 rounded-lg text-[10px] font-bold uppercase">Aktif</span>
                    @else
                        <span class="px-2.5 py-1 bg-rose-50 text-rose-700 border border-rose-100 rounded-lg text-[10px] font-bold uppercase">Nonaktif</span>
                    @endif
                </p>
            </div>
        </div>
    </div>
</div>
@endsection

