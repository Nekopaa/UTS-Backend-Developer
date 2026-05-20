<button {{ $attributes->merge(['type' => 'button', 'class' => 'inline-flex items-center justify-center px-6 py-3 bg-[#e0e5ec] text-slate-700 font-bold text-xs uppercase tracking-widest rounded-xl shadow-[4px_4px_8px_#a3b1c6,-4px_-4px_8px_#ffffff] hover:shadow-[2px_2px_4px_#a3b1c6,-2px_-2px_4px_#ffffff] active:shadow-[inset_2px_2px_4px_#a3b1c6,inset_-2px_-2px_4px_#ffffff] active:scale-[0.98] focus:outline-none transition-all duration-300 disabled:opacity-50']) }}>
    {{ $slot }}
</button>
