<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center justify-center px-6 py-3 bg-gradient-to-br from-blue-500 to-blue-700 text-white font-bold text-xs uppercase tracking-widest rounded-xl shadow-[4px_4px_8px_#a3b1c6,-4px_-4px_8px_#ffffff] hover:from-blue-600 hover:to-blue-800 active:scale-[0.98] focus:outline-none transition-all duration-300']) }}>
    {{ $slot }}
</button>
