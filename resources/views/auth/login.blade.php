<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div class="input-group">
            <x-input-label for="email" class="block text-white/60 text-xl mt-5" :value="__('Email')" />
            <x-text-input id="email" class="bg-slate-800 border-0 rounded-mb w-full text-white/60 max-h-80 text-xl" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" style="border: 1px solid rgba(255, 255, 255, 0.254); overflow: hidden; resize: none;" />
            <x-input-error :messages="$errors->get('email')" class="text-red-500" />
        </div>

        <!-- Password -->
        <div class="input-group">
            <x-input-label for="password" class="block text-white/60 text-xl mt-5" :value="__('Password')" />
            <x-text-input id="password" class="bg-slate-800 border-0 rounded-mb w-full text-white/60 max-h-80 text-xl" type="password" name="password" required autocomplete="current-password" style="border: 1px solid rgba(255, 255, 255, 0.254); overflow: hidden; resize: none;" />
            <x-input-error :messages="$errors->get('password')" class="text-red-500" />
        </div>

        <!-- Remember Me -->
        <div class="input-group block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800" name="remember">
                <span class="ms-2 text-sm text-white/60">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-white/60 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('register') }}">
                {{ __('¿No tienes cuenta?') }}
            </a>
            @if (Route::has('password.request'))
                <a class="underline text-sm text-white/60 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif

            <x-primary-button class="ms-3">
                {{ __('Log in') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
