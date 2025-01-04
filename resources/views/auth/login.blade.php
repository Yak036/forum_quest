<x-guest-layout>
    <div class="bg-white p-8 rounded-lg shadow-md">
        <div class="text-center">
            <h2 class="mt-2 text-center text-3xl font-extrabold text-gray-900">
                Iniciar sesión
            </h2>
            <p class="mt-2 text-center text-sm text-gray-600">
                Accede a tu cuenta
            </p>
        </div>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <form method="POST" action="{{ route('login') }}" class="mt-8 space-y-6">
            @csrf

            <!-- Email Address -->
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">Correo electrónico</label>
                <input id="email" name="email" type="email" autocomplete="email" required 
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 
                    focus:outline-none focus:ring-yellow-500 focus:border-yellow-500 sm:text-sm"
                    :value="old('email')">
                <x-input-error :messages="$errors->get('email')" class="text-red-500 text-xs mt-1" />
            </div>

            <!-- Password -->
            <div>
                <label for="password" class="block text-sm font-medium text-gray-700">Contraseña</label>
                <input id="password" name="password" type="password" autocomplete="current-password" required
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 
                    focus:outline-none focus:ring-yellow-500 focus:border-yellow-500 sm:text-sm">
                <x-input-error :messages="$errors->get('password')" class="text-red-500 text-xs mt-1" />
            </div>

            <!-- Remember Me -->
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <input id="remember_me" name="remember" type="checkbox" 
                        class="h-4 w-4 text-yellow-600 focus:ring-yellow-500 border-gray-300 rounded">
                    <label for="remember_me" class="ml-2 block text-sm text-gray-700">
                        Recordarme
                    </label>
                </div>

                @if (Route::has('password.request'))
                    <div class="text-sm">
                        <a href="{{ route('password.request') }}" class="font-medium text-yellow-600 hover:text-yellow-500">
                            ¿Olvidaste tu contraseña?
                        </a>
                    </div>
                @endif
            </div>

            <div>
                <button type="submit" 
                    class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white 
                    bg-yellow-600 hover:bg-yellow-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500">
                    Iniciar sesión
                </button>
            </div>

            <div class="text-center text-sm">
                <p class="text-gray-600">
                    ¿No tienes cuenta?
                    <a href="{{ route('register') }}" class="font-medium text-yellow-600 hover:text-yellow-500">
                        Regístrate
                    </a>
                </p>
            </div>
        </form>
    </div>

    <style>
        /* Estilos personalizados para el tema amarillo */
        .focus\:ring-yellow-500:focus {
            --tw-ring-color: #F59E0B;
            --tw-ring-opacity: 0.5;
        }
        .focus\:border-yellow-500:focus {
            --tw-border-opacity: 1;
            border-color: rgba(245, 158, 11, var(--tw-border-opacity));
        }
        .bg-yellow-600 {
            --tw-bg-opacity: 1;
            background-color: rgba(217, 119, 6, var(--tw-bg-opacity));
        }
        .hover\:bg-yellow-700:hover {
            --tw-bg-opacity: 1;
            background-color: rgba(180, 83, 9, var(--tw-bg-opacity));
        }
        .text-yellow-600 {
            --tw-text-opacity: 1;
            color: rgba(217, 119, 6, var(--tw-text-opacity));
        }
        .hover\:text-yellow-500:hover {
            --tw-text-opacity: 1;
            color: rgba(245, 158, 11, var(--tw-text-opacity));
        }
    </style>
</x-guest-layout>
