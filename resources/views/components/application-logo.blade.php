<svg viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg" {{ $attributes }}>
    <defs>
        <linearGradient id="logoDropGrad" x1="50" y1="15" x2="50" y2="85" gradientUnits="userSpaceOnUse">
            <stop offset="0%" stop-color="#93C5FD"/>
            <stop offset="50%" stop-color="#3B82F6"/>
            <stop offset="100%" stop-color="#1D4ED8"/>
        </linearGradient>
        <linearGradient id="logoReflectGrad" x1="0" y1="0" x2="0" y2="1" gradientUnits="objectBoundingBox">
            <stop offset="0%" stop-color="white" stop-opacity="0.8"/>
            <stop offset="100%" stop-color="white" stop-opacity="0"/>
        </linearGradient>
    </defs>
    
    <!-- Droplet background drop-shadow shape -->
    <path d="M50 15 C 50 15, 18 52, 18 70 A 32 32 0 0 0 82 70 C 82 52, 50 15, 50 15 Z" fill="url(#logoDropGrad)" />
    
    <!-- Holographic white reflection curve -->
    <path d="M47 22 C 40 32, 26 48, 26 68 C 26 50, 38 35, 47 22 Z" fill="url(#logoReflectGrad)" opacity="0.65" />
    
    <!-- Secondary highlight drop -->
    <circle cx="70" cy="70" r="5" fill="white" opacity="0.3" />
</svg>
