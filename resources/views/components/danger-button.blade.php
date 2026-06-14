<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center justify-center px-6 py-3 bg-gradient-to-tr from-rose-600 to-red-600 text-white font-bold text-xs uppercase tracking-widest rounded-xl shadow-sm hover:from-rose-700 hover:to-red-700 hover:shadow active:scale-[0.98] focus:outline-none transition-all duration-150']) }}>
    {{ $slot }}
</button>

