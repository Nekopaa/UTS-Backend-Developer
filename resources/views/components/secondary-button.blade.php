<button {{ $attributes->merge(['type' => 'button', 'class' => 'inline-flex items-center justify-center px-6 py-3 bg-white text-slate-700 font-bold text-xs uppercase tracking-widest rounded-xl border border-slate-200 shadow-sm hover:bg-slate-50 hover:shadow active:scale-[0.98] focus:outline-none transition-all duration-150 disabled:opacity-50']) }}>
    {{ $slot }}
</button>

