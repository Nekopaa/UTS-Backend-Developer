@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'w-full bg-[#e0e5ec] border-0 text-slate-800 rounded-xl px-4 py-3 shadow-[inset_4px_4px_8px_#a3b1c6,inset_-4px_-4px_8px_#ffffff] focus:ring-2 focus:ring-blue-400 focus:outline-none transition-all duration-300']) }}>
