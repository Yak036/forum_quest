<div class="min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
    <div class="w-1/2 space-y-8 bg-white p-8 rounded-lg shadow-md">
        <div>
            <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">
                Crear cuenta
            </h2>
            <p class="mt-2 text-center text-sm text-gray-600">
                Únete a nuestra comunidad fitness
            </p>
        </div>
        <form method="POST" wire:submit.prevent='store' class="mt-8 space-y-6">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <!-- Name -->
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700">Nombre</label>
                    <input id="name" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 
                    focus:outline-none focus:ring-yellow-500 focus:border-yellow-500 sm:text-sm" type="text" name="name" wire:model="name" :value="old('name')" required autofocus autocomplete="name" />
                    <x-input-error :messages="$errors->get('name')" class="text-red-500 text-xs mt-1" />
                </div>

                <!-- Last Name -->
                <div>
                    <label for="last_name" class="block text-sm font-medium text-gray-700">Apellido</label>
                    <input id="last_name" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 
                    focus:outline-none focus:ring-yellow-500 focus:border-yellow-500 sm:text-sm" type="text" name="last_name" wire:model="last_name" :value="old('last_name')" required autocomplete="family-name" />
                    <x-input-error :messages="$errors->get('last_name')" class="text-red-500 text-xs mt-1" />
                </div>

                <!-- ID Number -->
                <div>
                    <label for="id_number" class="block text-sm font-medium text-gray-700">Cedula</label>
                    <input id="id_number" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 
                    focus:outline-none focus:ring-yellow-500 focus:border-yellow-500 sm:text-sm" type="text" name="id_number" wire:model="id_number" :value="old('id_number')" required autocomplete="id-number" />
                    <x-input-error :messages="$errors->get('id_number')" class="text-red-500 text-xs mt-1" />
                </div>

                <!-- Date of Birth -->
                <div>
                    <label for="date_of_birth" class="block text-sm font-medium text-gray-700">Nacimiento</label>
                    <input id="date_of_birth" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 
                    focus:outline-none focus:ring-yellow-500 focus:border-yellow-500 sm:text-sm" type="date" name="date_of_birth" wire:model="date_of_birth" :value="old('date_of_birth')" required autocomplete="bday" />
                    <x-input-error :messages="$errors->get('date_of_birth')" class="text-red-500 text-xs mt-1" />
                </div>

                <!-- Email Address -->
                <div class="col-span-2">
                    <label for="email" class="block text-sm font-medium text-gray-700">Correo electrónico</label>
                    <input id="email" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 
                    focus:outline-none focus:ring-yellow-500 focus:border-yellow-500 sm:text-sm" type="email" name="email" wire:model="email" :value="old('email')" required autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="text-red-500 text-xs mt-1" />
                </div>
                <!-- Genero -->
                <div class="col-span-2">
                    <label for="genero" class="block text-sm font-medium text-gray-700">Genero</label>
                    <select id="genero" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 
                    focus:outline-none focus:ring-yellow-500 focus:border-yellow-500 sm:text-sm" name="genero" wire:model="genero" required>
                        <option value="">Selecciona un género</option>
                        <option value="M">Masculino</option>
                        <option value="F">Femenino</option>
                        <option value="O">Otro</option>
                    </select>
                    <x-input-error :messages="$errors->get('genero')" class="text-red-500 text-xs mt-1" />
                </div>

                <!-- Password -->
                <div class="col-span-2">
                    <label for="password" class="block text-sm font-medium text-gray-700">Contraseña</label>
                    <input id="password" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 
                    focus:outline-none focus:ring-yellow-500 focus:border-yellow-500 sm:text-sm" type="password" name="password" wire:model="password" required autocomplete="new-password" />
                    <x-input-error :messages="$errors->get('password')" class="text-red-500 text-xs mt-1" />
                </div>

                <!-- Confirm Password -->
                <div class="col-span-2">
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirmar contraseña</label>
                    <input id="password_confirmation" class="mt-1 block w-full px-3 py-3 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 
                    focus:outline-none focus:ring-yellow-500 focus:border-yellow-500 sm:text-sm" type="password" name="password_confirmation" wire:model="password_confirmation" required autocomplete="new-password" />
                    <x-input-error :messages="$errors->get('password_confirmation')" class="text-red-500 text-xs mt-1" />
                </div>
            <div class="col-span-2">
                <button type="submit" 
                    class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white 
                    bg-yellow-600 hover:bg-yellow-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500">
                    Registrarme
                </button>
            </div>
            <div class="text-center mt-4 col-span-2">
                <p class="text-gray-600">
                    ¿Ya tienes cuenta?
                    <a class="font-medium text-yellow-600 hover:text-yellow-500" href="{{ route('login') }}">
                        {{ __('Inicia sesión') }}
                    </a>
                </p>
            </div>
        </form>
    </div>
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
