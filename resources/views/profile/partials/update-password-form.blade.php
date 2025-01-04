<section>
    <form method="post" action="{{ route('password.update') }}" class="space-y-6">
        @csrf
        @method('put')

        <div class="space-y-4">
            <!-- Contraseña Actual -->
            <div>
                <label for="current_password" class="block text-sm font-medium text-gray-700">{{ __('Contraseña Actual') }}</label>
                <x-text-input id="current_password" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-yellow-500 focus:border-yellow-500 sm:text-sm" type="password" name="current_password" required autocomplete="current-password" />
                <x-input-error :messages="$errors->get('current_password')" class="mt-1 text-red-500 text-sm" />
            </div>

            <!-- Nueva Contraseña -->
            <div>
                <label for="password" class="block text-sm font-medium text-gray-700">{{ __('Nueva Contraseña') }}</label>
                <x-text-input id="password" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-yellow-500 focus:border-yellow-500 sm:text-sm" type="password" name="password" required autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password')" class="mt-1 text-red-500 text-sm" />
            </div>

            <!-- Confirmar Contraseña -->
            <div>
                <label for="password_confirmation" class="block text-sm font-medium text-gray-700">{{ __('Confirmar Contraseña') }}</label>
                <x-text-input id="password_confirmation" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-yellow-500 focus:border-yellow-500 sm:text-sm" type="password" name="password_confirmation" required autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1 text-red-500 text-sm" />
            </div>
        </div>

        <div class="flex justify-end">
            <button type="submit" class="bg-yellow-500 hover:bg-yellow-600 text-white font-semibold py-2 px-4 rounded-lg transition-colors duration-200">
                {{ __('Actualizar Contraseña') }}
            </button>
        </div>
    </form>
</section>
