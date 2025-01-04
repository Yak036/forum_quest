<x-app-layout>
    <div class="py-12 bg-gray-300">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <h1 class="text-3xl font-bold text-gray-800 mb-8">{{ __('Mi Perfil') }}</h1>
            
            <div class="grid gap-8">
                <!-- Información del Perfil -->
                <div class="bg-white/90 rounded-lg shadow-lg overflow-hidden">
                    <div class="px-6 py-4 bg-gray-700 border-b border-gray-600">
                        <h2 class="text-xl font-semibold text-yellow-500">
                            {{ __('Información Personal') }}
                        </h2>
                    </div>
                    <div class="p-6">
                        @include('profile.partials.update-profile-information-form')
                    </div>
                </div>

                <!-- Contraseña -->
                <div class="bg-white/90 rounded-lg shadow-lg overflow-hidden">
                    <div class="px-6 py-4 bg-gray-700 border-b border-gray-600">
                        <h2 class="text-xl font-semibold text-yellow-500">
                            {{ __('Cambiar Contraseña') }}
                        </h2>
                    </div>
                    <div class="p-6">
                        @include('profile.partials.update-password-form')
                    </div>
                </div>

                <!-- Eliminar Cuenta -->
                <div class="bg-white/90 rounded-lg shadow-lg overflow-hidden">
                    <div class="px-6 py-4 bg-gray-700 border-b border-gray-600">
                        <h2 class="text-xl font-semibold text-red-500">
                            {{ __('Eliminar Cuenta') }}
                        </h2>
                    </div>
                    <div class="p-6">
                        @include('profile.partials.delete-user-form')
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
