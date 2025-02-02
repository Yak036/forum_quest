<section>
    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="space-y-6">
        @csrf
        @method('patch')
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Nombre -->
            <div class="input-group">
                <label for="name" class="block text-sm font-medium text-gray-700">Nombre completo</label>
                <x-text-input id="name" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-yellow-500 focus:border-yellow-500 sm:text-sm" type="text" name="name" :value="old('name', $user->name)" required autofocus autocomplete="name" />
                <x-input-error :messages="$errors->get('name')" class="mt-1 text-red-500 text-sm" />
            </div>

            <!-- Apellido -->
            <div class="input-group">
                <label for="last_name" class="block text-sm font-medium text-gray-700">Apellido</label>
                <x-text-input id="last_name" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-yellow-500 focus:border-yellow-500 sm:text-sm" type="text" name="last_name" :value="old('last_name', $user->last_name)" required autocomplete="family-name" />
                <x-input-error :messages="$errors->get('last_name')" class="mt-1 text-red-500 text-sm" />
            </div>

            <!-- Cedula -->
            <div class="input-group">
                <label for="id_number" class="block text-sm font-medium text-gray-700">Cedula</label>
                <x-text-input id="id_number" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-yellow-500 focus:border-yellow-500 sm:text-sm bg-gray-100" type="text" name="id_number" :value="$user->id_number" readonly disabled />
            </div>

            <!-- Email -->
            <div class="input-group">
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <x-text-input id="email" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-yellow-500 focus:border-yellow-500 sm:text-sm" type="email" name="email" :value="old('email', $user->email)" required autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-1 text-red-500 text-sm" />
            </div>

            <!-- Fecha de Nacimiento -->
            <div class="input-group">
                <label for="date_of_birth" class="block text-sm font-medium text-gray-700">Fecha de Nacimiento</label>
                <x-text-input id="date_of_birth" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-yellow-500 focus:border-yellow-500 sm:text-sm" type="date" name="date_of_birth" :value="old('date_of_birth', $user->date_of_birth)" required autocomplete="bday" />
                <x-input-error :messages="$errors->get('date_of_birth')" class="mt-1 text-red-500 text-sm" />
            </div>

            <!-- Genero -->
            <div class="input-group">
                <label for="genero" class="block text-sm font-medium text-gray-700">Genero</label>
                <select id="genero" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 
                    focus:outline-none focus:ring-yellow-500 focus:border-yellow-500 sm:text-sm" name="genero" required>
                    <option value="">Selecciona un género</option>
                    <option value="M" {{ old('genero', $user->genero) == 'M' ? 'selected' : '' }}>Masculino</option>
                    <option value="F" {{ old('genero', $user->genero) == 'F' ? 'selected' : '' }}>Femenino</option>
                    <option value="O" {{ old('genero', $user->genero) == 'O' ? 'selected' : '' }}>Otro</option>
                </select>
                <x-input-error :messages="$errors->get('genero')" class="mt-1 text-red-500 text-sm" />
            </div>

        </div>

        @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
            <div class="text-sm mt-2 text-gray-200">
                {{ __('Your email address is unverified.') }}

                <button form="send-verification" class="text-yellow-500 hover:text-yellow-400 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500">
                    {{ __('Click here to re-send the verification email.') }}
                </button>
            </div>

            @if (session('status') === 'verification-link-sent')
                <p class="mt-2 text-sm text-yellow-400">
                    {{ __('A new verification link has been sent to your email address.') }}
                </p>
            @endif
        @endif

        <div class="flex justify-end mt-6">
            <x-primary-button class="bg-yellow-500 hover:bg-yellow-600 text-white font-semibold py-2 px-4 rounded-lg transition-colors duration-200">
                {{ __('Guardar Cambios') }}
            </x-primary-button>
        </div>
    </form>
</section>
