<section class="space-y-6">
    <header>
        <h2 class="text-lg font-medium text-gray-700">
            {{ __('Delete Account') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.') }}
        </p>
    </header>

    <form method="post" action="{{ route('profile.destroy') }}" class="space-y-6">
        @csrf
        @method('delete')

        <div class="space-y-4">
            <p class="text-sm text-gray-600">
                {{ __('Una vez que tu cuenta sea eliminada, todos tus recursos y datos serán eliminados permanentemente. Antes de eliminar tu cuenta, por favor descarga cualquier dato o información que desees conservar.') }}
            </p>

            <!-- Contraseña -->
            <div>
                <label for="password" class="block text-sm font-medium text-gray-700">{{ __('Contraseña') }}</label>
                <x-text-input id="password" 
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-yellow-500 focus:border-yellow-500 sm:text-sm" 
                    type="password" 
                    name="password" 
                    :value="old('password')" 
                    required 
                    autocomplete="current-password" 
                    placeholder="{{ __('Para confirmar, ingresa tu contraseña') }}" />
                <x-input-error :messages="$errors->get('password')" class="mt-1 text-red-500 text-sm" />
            </div>
        </div>

        <div class="flex justify-end">
            <button type="submit" 
                class="px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 active:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150"
            >
                Eliminar Cuenta
            </button>
        </div>
    </form>