<div class="min-h-screen flex items-center justify-centerpy-12 px-4 sm:px-6 lg:px-8">
    <div class="w-full space-y-8 bg-white p-8 rounded-lg shadow-md">
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
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <!-- Name -->
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700">Nombre completo</label>
                    <x-text-input id="name" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 
                    focus:outline-none focus:ring-yellow-500 focus:border-yellow-500 sm:text-sm" type="text" name="name" wire:model="name" :value="old('name')" required autofocus autocomplete="name" />
                    <x-input-error :messages="$errors->get('name')" class="text-red-500 text-xs mt-1" />
                </div>

                <!-- Last Name -->
                <div>
                    <label for="last_name" class="block text-sm font-medium text-gray-700">Apellido</label>
                    <x-text-input id="last_name" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 
                    focus:outline-none focus:ring-yellow-500 focus:border-yellow-500 sm:text-sm" type="text" name="last_name" wire:model="last_name" :value="old('last_name')" required autocomplete="family-name" />
                    <x-input-error :messages="$errors->get('last_name')" class="text-red-500 text-xs mt-1" />
                </div>

                <!-- ID Number -->
                <div>
                    <label for="id_number" class="block text-sm font-medium text-gray-700">Cedula</label>
                    <x-text-input id="id_number" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 
                    focus:outline-none focus:ring-yellow-500 focus:border-yellow-500 sm:text-sm" type="text" name="id_number" wire:model="id_number" :value="old('id_number')" required autocomplete="id-number" />
                    <x-input-error :messages="$errors->get('id_number')" class="text-red-500 text-xs mt-1" />
                </div>

                <!-- Date of Birth -->
                <div>
                    <label for="date_of_birth" class="block text-sm font-medium text-gray-700">Nacimiento</label>
                    <x-text-input id="date_of_birth" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 
                    focus:outline-none focus:ring-yellow-500 focus:border-yellow-500 sm:text-sm" type="date" name="date_of_birth" wire:model="date_of_birth" :value="old('date_of_birth')" required autocomplete="bday" />
                    <x-input-error :messages="$errors->get('date_of_birth')" class="text-red-500 text-xs mt-1" />
                </div>

                <!-- Nationality -->
                <div>
                    <label for="nationality" class="block text-sm font-medium text-gray-700">Nacionalidad</label>
                    <select id="nationality" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 
                    focus:outline-none focus:ring-yellow-500 focus:border-yellow-500 sm:text-sm" name="nationality" wire:model="nationality" required>
                        <option value="" disabled selected>{{ __('Seleccione su nacionalidad') }}</option>
                        @foreach($countries as $country)
                            <option value="{{$country->id}}">{{ __($country->nationality) }}</option>
                        @endforeach
                    </select>
                    <x-input-error :messages="$errors->get('nationality')" class="text-red-500 text-xs mt-1" />
                </div>

                <!-- Email Address -->
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700">Correo electrónico</label>
                    <x-text-input id="email" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 
                    focus:outline-none focus:ring-yellow-500 focus:border-yellow-500 sm:text-sm" type="email" name="email" wire:model="email" :value="old('email')" required autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="text-red-500 text-xs mt-1" />
                </div>

                <!-- Password -->
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700">Contraseña</label>
                    <x-text-input id="password" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 
                    focus:outline-none focus:ring-yellow-500 focus:border-yellow-500 sm:text-sm" type="password" name="password" wire:model="password" required autocomplete="new-password" />
                    <x-input-error :messages="$errors->get('password')" class="text-red-500 text-xs mt-1" />
                </div>

                <!-- Confirm Password -->
                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirmar contraseña</label>
                    <x-text-input id="password_confirmation" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 
                    focus:outline-none focus:ring-yellow-500 focus:border-yellow-500 sm:text-sm" type="password" name="password_confirmation" wire:model="password_confirmation" required autocomplete="new-password" />
                    <x-input-error :messages="$errors->get('password_confirmation')" class="text-red-500 text-xs mt-1" />
                </div>

                <!-- Facebook -->
                <div>
                    <label for="facebook" class="block text-sm font-medium text-gray-700">Facebook</label>
                    <x-text-input id="facebook" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 
                    focus:outline-none focus:ring-yellow-500 focus:border-yellow-500 sm:text-sm" name="facebook" wire:model="facebook" :value="old('facebook')" autocomplete="facebook" />
                    <x-input-error :messages="$errors->get('facebook')" class="text-red-500 text-xs mt-1" />
                </div>

                <!-- Instagram -->
                <div>
                    <label for="instagram" class="block text-sm font-medium text-gray-700">Instagram</label>
                    <x-text-input id="instagram" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 
                    focus:outline-none focus:ring-yellow-500 focus:border-yellow-500 sm:text-sm" name="instagram" wire:model="instagram" :value="old('instagram')" autocomplete="instagram" />
                    <x-input-error :messages="$errors->get('instagram')" class="text-red-500 text-xs mt-1" />
                </div>

                <!-- X (Formerly Twitter) -->
                <div>
                    <label for="twitter" class="block text-sm font-medium text-gray-700">X</label>
                    <x-text-input id="twitter" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 
                    focus:outline-none focus:ring-yellow-500 focus:border-yellow-500 sm:text-sm" name="twitter" wire:model="twitter" :value="old('twitter')" autocomplete="twitter" />
                    <x-input-error :messages="$errors->get('twitter')" class="text-red-500 text-xs mt-1" />
                </div>

                <!-- Tiktok -->
                <div>
                    <label for="tiktok" class="block text-sm font-medium text-gray-700">Tiktok</label>
                    <x-text-input id="tiktok" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 
                    focus:outline-none focus:ring-yellow-500 focus:border-yellow-500 sm:text-sm" name="tiktok" wire:model="tiktok" :value="old('tiktok')" autocomplete="tiktok" />
                    <x-input-error :messages="$errors->get('tiktok')" class="text-red-500 text-xs mt-1" />
                </div>
            </div>

            <!-- personal page - Full width -->
            <div id='personal_page_container' class="mt-4">
                <label for="personal_page" class="block text-sm font-medium text-gray-700">Pagina personal</label>
                <x-text-input id="personal_page" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 
                focus:outline-none focus:ring-yellow-500 focus:border-yellow-500 sm:text-sm" name="personal_page" wire:model="personal_page" :value="old('personal_page')" autocomplete="personal_page" />
                <x-input-error :messages="$errors->get('personal_page')" class="text-red-500 text-xs mt-1" />

                <img id="personal_page_image" src="" alt="Imagen de la pagina personal" class="mt-5 w-full rounded-md hidden" />

                <div id="personal_page_loader" class="mt-5 flex justify-center items-center">
                    <div class="animate-spin rounded-full h-5 w-5 border-b-2 border-white"></div>
                    <p class="text-white ml-2">Cargando...</p>
                </div>
            </div>

            <script>
                document.addEventListener("DOMContentLoaded", function() {
                    document.getElementById('personal_page').addEventListener('change', function() {
                        document.getElementById('personal_page_loader').classList.remove('hidden');
                        document.getElementById('personal_page_image').classList.add('hidden');

                        let personalPageUrl = this.value;

                        fetch('{{ route('personal_page_check') }}', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            body: JSON.stringify({ url: personalPageUrl })
                        })
                        .then(response => response.json())
                        .then(data => {
                            document.getElementById('personal_page_image').src = "{{ asset('screenshots/') }}/"+data.filename;
                            document.getElementById('personal_page_image').classList.remove('hidden');
                            document.getElementById('personal_page_loader').classList.add('hidden');
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            document.getElementById('personal_page_loader').classList.add('hidden');
                        });
                    });
                });
            </script>

            <!-- Brief Description -->
            <div wire:ignore>
                <label for="description" class="block text-sm font-medium text-gray-700">Breve Descripción</label>
                <textarea id="description" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 
                focus:outline-none focus:ring-yellow-500 focus:border-yellow-500 sm:text-sm" name="description" autocomplete="description"></textarea>
                <x-input-error :messages="$errors->get('description')" class="text-red-500 text-xs mt-1" />
            </div>
            <div>
                <button type="submit" 
                    class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white 
                    bg-yellow-600 hover:bg-yellow-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500">
                    Registrarme
                </button>
            </div>
            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-yellow-600 hover:text-yellow-500 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('login') }}">
                    {{ __('¿Ya estás registrado?') }}
                </a>
            </div>
        </form>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        ClassicEditor
            .create(document.querySelector('#description'))
            .then(editor => {
                editor.model.document.on('change:data', () => {
                    @this.set('description', editor.getData());
                });
            })
            .catch(error => {
                console.error(error);
            });
    });
</script>
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
