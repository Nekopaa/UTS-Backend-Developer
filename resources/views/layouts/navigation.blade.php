<nav x-data="{ open: false }" class="bg-white/80 backdrop-blur-md border-b border-slate-200/80 sticky top-0 z-50 shadow-sm">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-20 items-center">
            <div class="flex items-center">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}" class="block p-1.5 bg-gradient-to-tr from-yellow-400 to-yellow-300 rounded-full hover:scale-105 transition-all duration-300 shadow-md shadow-yellow-400/20">
                        <x-application-logo class="block h-9 w-9 text-black" />
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <a href="{{ route('dashboard') }}" class="px-4 py-2 rounded-xl font-extrabold text-sm transition-all duration-200 {{ request()->routeIs('dashboard') ? 'bg-gradient-to-tr from-yellow-400 to-yellow-300 text-black shadow-md shadow-yellow-400/20' : 'bg-transparent text-slate-600 hover:text-slate-900 hover:bg-slate-100/80' }}">
                        {{ __('Dashboard') }}
                    </a>
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-4 py-2 text-sm leading-4 font-extrabold rounded-xl text-black bg-gradient-to-tr from-yellow-400 to-yellow-300 hover:opacity-95 shadow-md shadow-yellow-400/20 hover:translate-y-[-1px] active:translate-y-[1px] focus:outline-none transition-all duration-200">
                            <div>{{ Auth::user()->name }}</div>

                            <div class="ms-2">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <!-- We override content styling in dropdown-link or apply custom class -->
                        <x-dropdown-link :href="route('profile.edit')" class="font-bold text-slate-700 hover:bg-slate-50 hover:text-indigo-600">
                            {{ __('Profile') }}
                        </x-dropdown-link>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();" class="font-bold text-red-600 hover:bg-red-50">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-3 rounded-xl text-black bg-gradient-to-tr from-yellow-400 to-yellow-300 shadow-md shadow-yellow-400/20 hover:opacity-95 focus:outline-none transition-all duration-200">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden bg-white border-t border-slate-200 py-4">
        <div class="pt-2 pb-3 space-y-2 px-4">
            <a href="{{ route('dashboard') }}" class="block px-4 py-3 rounded-xl font-extrabold transition-all duration-200 {{ request()->routeIs('dashboard') ? 'bg-gradient-to-tr from-yellow-400 to-yellow-300 text-black shadow-md shadow-yellow-400/10' : 'text-slate-600 bg-slate-100 hover:bg-slate-200' }}">
                {{ __('Dashboard') }}
            </a>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-slate-200">
            <div class="px-6 py-2">
                <div class="font-extrabold text-base text-black">{{ Auth::user()->name }}</div>
                <div class="font-bold text-sm text-slate-600">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-2 px-4">
                <a href="{{ route('profile.edit') }}" class="block px-4 py-3 rounded-xl font-extrabold text-slate-700 bg-slate-100 hover:bg-slate-200">
                    {{ __('Profile') }}
                </a>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <button type="submit" class="w-full text-left block px-4 py-3 rounded-xl font-extrabold text-red-600 bg-slate-100 hover:bg-red-50">
                        {{ __('Log Out') }}
                    </button>
                </form>
            </div>
        </div>
    </div>
</nav>
