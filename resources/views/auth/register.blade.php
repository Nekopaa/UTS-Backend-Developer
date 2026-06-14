<x-guest-layout>
    <!-- Back Button -->
    <div class="mb-6">
        <a href="/" class="neo-brutal-btn px-4 py-2 text-xs gap-2 text-slate-700">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-4 h-4">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
            </svg>
            <span>Kembali ke Halaman Utama</span>
        </a>
    </div>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Nama')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Role Selection (Admin / Pelanggan) -->
        <div class="mt-4">
            <x-input-label for="role" :value="__('Daftar sebagai')" />
            <div class="mt-2 flex flex-col gap-2">
                <label class="inline-flex items-center gap-3">
                    <input type="radio" name="role" value="user" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" {{ old('role', 'user') === 'user' ? 'checked' : '' }}>
                    <span class="text-sm text-gray-700 font-bold">Pelanggan</span>
                </label>

                <label class="inline-flex items-center gap-3">
                    <input type="radio" name="role" value="admin" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" {{ old('role') === 'admin' ? 'checked' : '' }}>
                    <span class="text-sm text-gray-700 font-bold">Admin</span>
                </label>
            </div>
            <x-input-error :messages="$errors->get('role')" class="mt-2" />
        </div>

        <!-- Company Code (only for Admin) -->
        <div class="mt-4" id="company_code_container" style="display: {{ old('role') === 'admin' ? 'block' : 'none' }};">
            <x-input-label for="company_code" :value="__('Kode Perusahaan (Admin)')" />
            <x-text-input id="company_code" class="block mt-1 w-full" type="text" name="company_code" :value="old('company_code')" autocomplete="off" />
            <div class="text-xs font-bold text-gray-600 mt-2">Kode: <span class="font-black">PRIMA</span></div>
            <x-input-error :messages="$errors->get('company_code')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <div class="relative mt-1">
                <x-text-input id="password" class="block w-full pr-12"
                                type="password"
                                name="password"
                                required autocomplete="new-password" />
                <button type="button" onclick="togglePasswordVisibility('password', this)" class="absolute inset-y-0 right-0 pr-4 flex items-center text-slate-500 hover:text-black focus:outline-none">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                </button>
            </div>

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Konfirmasi Password')" />

            <div class="relative mt-1">
                <x-text-input id="password_confirmation" class="block w-full pr-12"
                                type="password"
                                name="password_confirmation" required autocomplete="new-password" />
                <button type="button" onclick="togglePasswordVisibility('password_confirmation', this)" class="absolute inset-y-0 right-0 pr-4 flex items-center text-slate-500 hover:text-black focus:outline-none">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                </button>
            </div>

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                {{ __('Sudah terdaftar?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Daftar') }}
            </x-primary-button>
        </div>
    </form>

    <script>
        function toggleCompanyCodeField() {
            const selectedRole = document.querySelector('input[name="role"]:checked')?.value;
            const container = document.getElementById('company_code_container');
            if (!container) return;
            if (selectedRole === 'admin') {
                container.style.display = 'block';
            } else {
                container.style.display = 'none';
            }
        }

        document.addEventListener('DOMContentLoaded', function () {
            const roleRadios = document.querySelectorAll('input[name="role"]');
            roleRadios.forEach(r => r.addEventListener('change', toggleCompanyCodeField));
            toggleCompanyCodeField();
        });

        function togglePasswordVisibility(fieldId, button) {
            const input = document.getElementById(fieldId);
            const icon = button.querySelector('svg');
            if (input.type === 'password') {
                input.type = 'text';
                icon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 001.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.45 10.45 0 0112 4.5c4.756 0 8.773 3.162 10.065 7.498a10.523 10.523 0 01-4.293 5.774M6.228 6.228L3 3m3.228 3.228l3.65 3.65m7.894 7.894L21 21m-3.228-3.228l-3.65-3.65m0 0a3 3 0 10-4.243-4.243m4.242 4.242L9.88 9.88" />';
            } else {
                input.type = 'password';
                icon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" /><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />';
            }
        }
    </script>
</x-guest-layout>
