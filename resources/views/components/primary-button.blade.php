<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center justify-center px-6 py-3 bg-gradient-to-tr from-indigo-600 to-violet-600 text-white font-bold text-xs uppercase tracking-widest rounded-xl shadow-sm hover:from-indigo-700 hover:to-violet-700 hover:shadow active:scale-[0.98] focus:outline-none transition-all duration-150']) }}>
    {{ $slot }}
</button>

