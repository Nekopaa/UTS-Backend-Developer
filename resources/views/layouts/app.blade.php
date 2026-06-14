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
                --neo-cyan: #06b6d4;
                --neo-red: #f43f5e;
                --neo-border-color: rgba(226, 232, 240, 0.8);
                --neo-text: #1e293b;
                --neo-shadow-dark: rgba(0,0,0,0.03);
                --neo-radius: 20px;
            }

            * { font-family: 'Plus Jakarta Sans', sans-serif; }

            body {
                background: var(--neo-bg);
                color: var(--neo-text);
                min-height: 100vh;
            }

            /* Premium Soft Glassmorphic classes */
            .neo-brutal-card {
                background: rgba(255, 255, 255, 0.85);
                backdrop-filter: blur(12px);
                -webkit-backdrop-filter: blur(12px);
                border: 1px solid rgba(226, 232, 240, 0.8);
                border-radius: var(--neo-radius);
                box-shadow: 0 10px 30px -5px rgba(0, 0, 0, 0.03), 0 4px 12px -2px rgba(0, 0, 0, 0.02);
                transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            }

            .neo-brutal-card:hover {
                transform: translateY(-2px);
                box-shadow: 0 20px 40px -10px rgba(0, 0, 0, 0.06), 0 8px 20px -6px rgba(0, 0, 0, 0.03);
            }

            .neo-brutal-btn {
                background: #ffffff;
                border: 1px solid rgba(226, 232, 240, 0.8);
                border-radius: 12px;
                box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -1px rgba(0, 0, 0, 0.03);
                color: #334155;
                font-weight: 700;
                cursor: pointer;
                transition: all 0.2s ease;
                display: inline-flex;
                align-items: center;
                justify-content: center;
            }

            .neo-brutal-btn:hover {
                transform: translateY(-1px);
                box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.08), 0 4px 6px -2px rgba(0, 0, 0, 0.04);
                background: #f8fafc;
            }

            .neo-brutal-btn:active {
                transform: translateY(1px);
                box-shadow: 0 2px 4px 0 rgba(0, 0, 0, 0.05);
            }

            .neo-brutal-btn-blue {
                background: linear-gradient(135deg, #6366f1 0%, #4f46e5 100%) !important;
                color: #ffffff !important;
                border: 0 !important;
                box-shadow: 0 4px 12px 0 rgba(79, 70, 229, 0.2) !important;
            }
            .neo-brutal-btn-blue:hover {
                box-shadow: 0 8px 20px 0 rgba(79, 70, 229, 0.3) !important;
                background: linear-gradient(135deg, #818cf8 0%, #4f46e5 100%) !important;
            }

            .neo-brutal-btn-cyan {
                background: linear-gradient(135deg, #06b6d4 0%, #0891b2 100%) !important;
                color: #ffffff !important;
                border: 0 !important;
                box-shadow: 0 4px 12px 0 rgba(6, 182, 212, 0.2) !important;
            }
            .neo-brutal-btn-cyan:hover {
                box-shadow: 0 8px 20px 0 rgba(6, 182, 212, 0.3) !important;
                background: linear-gradient(135deg, #22d3ee 0%, #0891b2 100%) !important;
            }

            .neo-brutal-btn-red {
                background: linear-gradient(135deg, #f43f5e 0%, #e11d48 100%) !important;
                color: #ffffff !important;
                border: 0 !important;
                box-shadow: 0 4px 12px 0 rgba(244, 63, 94, 0.2) !important;
            }
            .neo-brutal-btn-red:hover {
                box-shadow: 0 8px 20px 0 rgba(244, 63, 94, 0.3) !important;
                background: linear-gradient(135deg, #fb7185 0%, #e11d48 100%) !important;
            }

            .neo-brutal-badge {
                display: inline-flex;
                align-items: center;
                padding: 4px 10px;
                background: rgba(99, 102, 241, 0.1);
                color: #4f46e5;
                border: 0;
                border-radius: 999px;
                font-weight: 700;
                font-size: 0.7rem;
                text-transform: uppercase;
                letter-spacing: 0.05em;
                box-shadow: none;
            }

            .neo-brutal-input {
                width: 100%;
                background: rgba(248, 250, 252, 0.6) !important;
                border: 1px solid #e2e8f0 !important;
                border-radius: 12px !important;
                padding: 10px 14px !important;
                font-size: 0.9rem !important;
                font-weight: 600 !important;
                color: #1e293b !important;
                outline: none !important;
                box-shadow: none !important;
                transition: all 0.2s ease;
            }

            .neo-brutal-input:hover {
                transform: none;
                border-color: #cbd5e1 !important;
            }

            .neo-brutal-input:focus {
                background: #ffffff !important;
                border-color: #6366f1 !important;
                transform: none;
                box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.12) !important;
            }

            select.neo-brutal-input {
                appearance: none !important;
                -webkit-appearance: none !important;
                -moz-appearance: none !important;
                background-image: url("data:image/svg+xml;charset=UTF-8,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='%2364748b' stroke-width='2.5' stroke-linecap='round' stroke-linejoin='round'%3e%3cpolyline points='6 9 12 15 18 9'%3e%3c/polyline%3e%3c/svg%3e") !important;
                background-repeat: no-repeat !important;
                background-position: right 16px center !important;
                background-size: 14px !important;
                padding-right: 40px !important;
                cursor: pointer !important;
                font-weight: 600 !important;
            }

            /* Custom Dropdown Styles (SaaS Modern) */
            .custom-dropdown-container {
                position: relative;
                width: 100%;
            }
            .custom-dropdown-list {
                position: absolute;
                left: 0;
                right: 0;
                margin-top: 6px;
                background: rgba(255, 255, 255, 0.95);
                backdrop-filter: blur(8px);
                border: 1px solid rgba(226, 232, 240, 0.8);
                border-radius: 12px;
                box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 8px 10px -6px rgba(0, 0, 0, 0.05);
                z-index: 50;
                max-height: 240px;
                overflow-y: auto;
            }
            .custom-dropdown-item {
                padding: 10px 14px;
                font-weight: 600;
                font-size: 0.9rem;
                color: #334155;
                cursor: pointer;
                border-bottom: 1px solid #f1f5f9;
                transition: all 0.15s ease;
            }
            .custom-dropdown-item:last-child {
                border-bottom: none;
            }
            .custom-dropdown-item:hover:not(.disabled) {
                background: #f1f5f9;
                color: #1e293b;
            }
            .custom-dropdown-item.selected {
                background: rgba(99, 102, 241, 0.1);
                color: #4f46e5;
            }
            .custom-dropdown-item.disabled {
                opacity: 0.5;
                cursor: not-allowed;
            }
            .chevron-icon {
                display: inline-flex;
                align-items: center;
                justify-content: center;
                transition: transform 0.2s ease;
            }
            .chevron-icon.rotate-180 {
                transform: rotate(180deg);
            }

            .neo-border-thick {
                border: 1px solid rgba(226, 232, 240, 0.8);
            }

            ::-webkit-scrollbar {
                width: 8px;
                height: 8px;
            }
            ::-webkit-scrollbar-track {
                background: #f1f5f9;
                border-left: 0;
            }
            ::-webkit-scrollbar-thumb {
                background: #cbd5e1;
                border: 0;
                border-radius: 99px;
            }
            ::-webkit-scrollbar-thumb:hover {
                background: #94a3b8;
            }
        </style>
    </head>
    <body class="antialiased">
        <div class="min-h-screen" style="background: var(--neo-bg);">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white/85 backdrop-blur-md border-b border-slate-200/85 py-6 sticky top-0 z-40">
                    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main class="py-8">
                {{ $slot }}
            </main>
        </div>

        <!-- Generic Custom Select Dropdown Transformer -->
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Function to transform a native select into custom neobrutalist dropdown
                function transformSelect(select) {
                    if (select.dataset.transformed) return;
                    select.dataset.transformed = "true";

                    // Hide native select
                    select.style.display = 'none';

                    // Create wrapper
                    const wrapper = document.createElement('div');
                    wrapper.className = 'custom-dropdown-container';
                    select.parentNode.insertBefore(wrapper, select);
                    wrapper.appendChild(select);

                    // Create trigger button
                    const trigger = document.createElement('button');
                    trigger.type = 'button';
                    trigger.className = 'neo-brutal-input text-left flex items-center justify-between w-full font-extrabold pr-10';
                    
                    const selectedText = document.createElement('span');
                    selectedText.className = 'selected-text';
                    
                    // Get selected option
                    const activeOption = select.options[select.selectedIndex] || select.options[0];
                    selectedText.textContent = activeOption ? activeOption.textContent : '-- Pilih --';
                    
                    // Chevron icon SVG
                    const chevron = document.createElement('span');
                    chevron.className = 'chevron-icon';
                    chevron.innerHTML = `<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor" style="width: 16px; height: 16px;">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                    </svg>`;

                    trigger.appendChild(selectedText);
                    trigger.appendChild(chevron);
                    wrapper.appendChild(trigger);

                    // Create options list
                    const list = document.createElement('div');
                    list.className = 'custom-dropdown-list hidden';
                    wrapper.appendChild(list);

                    // Populate options
                    function rebuildOptions() {
                        list.innerHTML = '';
                        Array.from(select.options).forEach(opt => {
                            if (opt.value === '' && opt.disabled) return; // skip placeholder if disabled and empty

                            const item = document.createElement('div');
                            item.className = 'custom-dropdown-item';
                            item.textContent = opt.textContent;
                            item.dataset.value = opt.value;

                            if (opt.disabled) {
                                item.classList.add('disabled');
                            }
                            if (opt.selected) {
                                item.classList.add('selected');
                            }

                            if (!opt.disabled) {
                                item.addEventListener('click', function(e) {
                                    e.stopPropagation();
                                    
                                    // Remove previous selection styling
                                    list.querySelectorAll('.custom-dropdown-item').forEach(el => el.classList.remove('selected'));
                                    item.classList.add('selected');

                                    // Update select value and dispatch change
                                    select.value = opt.value;
                                    select.dispatchEvent(new Event('change', { bubbles: true }));

                                    // Update button text
                                    selectedText.textContent = opt.textContent;

                                    // Close list
                                    list.classList.add('hidden');
                                    chevron.classList.remove('rotate-180');
                                });
                            }

                            list.appendChild(item);
                        });
                    }

                    rebuildOptions();

                    // Observe native select for programmatic changes to rebuild options if needed
                    const observer = new MutationObserver(() => {
                        const newActive = select.options[select.selectedIndex] || select.options[0];
                        selectedText.textContent = newActive ? newActive.textContent : '-- Pilih --';
                        rebuildOptions();
                    });
                    observer.observe(select, { childList: true, attributes: true });

                    // Trigger click to toggle dropdown
                    trigger.addEventListener('click', function(e) {
                        e.stopPropagation();
                        
                        // Close all other custom dropdowns
                        document.querySelectorAll('.custom-dropdown-list').forEach(l => {
                            if (l !== list) {
                                l.classList.add('hidden');
                                const otherChevron = l.previousSibling.querySelector('.chevron-icon');
                                if (otherChevron) otherChevron.classList.remove('rotate-180');
                            }
                        });

                        const isHidden = list.classList.contains('hidden');
                        if (isHidden) {
                            list.classList.remove('hidden');
                            chevron.classList.add('rotate-180');
                        } else {
                            list.classList.add('hidden');
                            chevron.classList.remove('rotate-180');
                        }
                    });
                }

                // Transform all native select elements with class 'neo-brutal-input'
                document.querySelectorAll('select.neo-brutal-input').forEach(transformSelect);

                // Close dropdowns when clicking outside
                document.addEventListener('click', function(e) {
                    if (!e.target.closest('.custom-dropdown-container')) {
                        document.querySelectorAll('.custom-dropdown-list').forEach(list => {
                            list.classList.add('hidden');
                        });
                        document.querySelectorAll('.chevron-icon').forEach(chevron => {
                            chevron.classList.remove('rotate-180');
                        });
                    }
                });
            });
        </script>
    </body>
</html>
