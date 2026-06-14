@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'w-full bg-white/80 border border-slate-200 text-slate-800 font-semibold rounded-xl px-4 py-3 placeholder-slate-400 focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 focus:outline-none transition-all duration-150']) }}>

