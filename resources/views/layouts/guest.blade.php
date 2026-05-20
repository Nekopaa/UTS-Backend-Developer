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
        <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!-- Neomorphism Styles -->
        <style>
            :root {
                --neo-bg: #e0e5ec;
                --neo-shadow-dark: #a3b1c6;
                --neo-shadow-light: #ffffff;
                --neo-text: #2d3748;
            }

            * { font-family: 'Plus Jakarta Sans', sans-serif; }

            body {
                background-color: var(--neo-bg);
                color: var(--neo-text);
            }

            .neo-container {
                background-color: var(--neo-bg);
                border-radius: 28px;
                box-shadow: 12px 12px 24px var(--neo-shadow-dark),
                            -12px -12px 24px var(--neo-shadow-light);
            }

            .neo-logo-wrapper {
                width: 80px;
                height: 80px;
                display: flex;
                align-items: center;
                justify-content: center;
                border-radius: 50%;
                background-color: var(--neo-bg);
                box-shadow: 6px 6px 12px var(--neo-shadow-dark),
                            -6px -6px 12px var(--neo-shadow-light);
                transition: all 0.3s ease;
            }

            .neo-logo-wrapper:hover {
                box-shadow: inset 4px 4px 8px var(--neo-shadow-dark),
                            inset -4px -4px 8px var(--neo-shadow-light);
            }
        </style>
    </head>
    <body class="antialiased">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-[#e0e5ec]">
            <div class="mb-8">
                <a href="/" class="block">
                    <div class="neo-logo-wrapper">
                        <x-application-logo class="w-12 h-12 text-blue-600" />
                    </div>
                </a>
            </div>

            <div class="w-full sm:max-w-md px-8 py-8 neo-container mx-4 sm:mx-0">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>
