<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Rindu Water') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;800&display=swap" rel="stylesheet">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!-- Soft Glassmorphic SaaS Design System -->
        <style>
            :root {
                --neo-bg: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 50%, #e2e8f0 100%);
                --neo-yellow: #facc15;
                --neo-blue: #4f46e5;
                --neo-border-color: rgba(226, 232, 240, 0.8);
            }

            * { font-family: 'Plus Jakarta Sans', sans-serif; }

            body {
                background: var(--neo-bg);
                color: #1e293b;
                min-height: 100vh;
            }

            .neo-container {
                background: rgba(255, 255, 255, 0.85);
                backdrop-filter: blur(12px);
                -webkit-backdrop-filter: blur(12px);
                border: 1px solid rgba(226, 232, 240, 0.8);
                border-radius: 24px;
                box-shadow: 0 10px 30px -5px rgba(0, 0, 0, 0.03), 0 4px 12px -2px rgba(0, 0, 0, 0.02);
            }

            .neo-logo-wrapper {
                width: 76px;
                height: 76px;
                display: flex;
                align-items: center;
                justify-content: center;
                border-radius: 20px;
                background: linear-gradient(135deg, #6366f1 0%, #4f46e5 100%);
                color: #ffffff;
                box-shadow: 0 8px 16px rgba(79, 70, 229, 0.2);
                transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            }

            .neo-logo-wrapper:hover {
                transform: translateY(-2px);
                box-shadow: 0 12px 20px rgba(79, 70, 229, 0.3);
            }
        </style>
    </head>
    <body class="antialiased">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0" style="background: var(--neo-bg);">
            <div class="mb-8">
                <a href="/" class="block">
                    <div class="neo-logo-wrapper">
                        <!-- Custom logo icon using white color -->
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-10 h-10 text-white">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.105-6 11.25-6 11.25S7.5 17.605 7.5 10.5a6 6 0 1112 0z" />
                        </svg>
                    </div>
                </a>
            </div>

            <div class="w-full sm:max-w-md px-8 py-8 neo-container mx-4 sm:mx-0">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>
