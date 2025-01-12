    <div class="py-12 bg-gray-300">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <h1 class="text-3xl font-bold text-gray-800 mb-8">{{ __('Panel Administrativo') }}</h1>
            
            <div class="grid gap-8">
                <!-- Lista de Usuarios -->
                <div class="bg-white/90 rounded-lg shadow-lg overflow-hidden">
                    <div class="px-6 py-4 bg-gray-700 border-b border-gray-600 flex justify-between items-center">
                        <h2 class="text-xl font-semibold text-yellow-500">
                            {{ __('Usuarios Registrados') }}
                        </h2>
                        <input type="text" wire:model="search" class="bg-gray-800 border-0 rounded-md w-1/4 px-2 py-1 text-white/60" placeholder="Buscar usuario...">
                    </div>
                    <div class="p-6">
                        <ul class="divide-y divide-gray-200">
                            @foreach ($users as $user)
                                <li class="py-4 mb-8">
                                    <div class="flex items-center justify-between">
                                        <div>
                                            <p class="text-sm font-medium text-yellow-600">
                                                {{ $user->name }}
                                            </p>
                                            <p class="text-sm text-gray-500">
                                                {{ $user->email }}
                                            </p>
                                        </div>
                                        <div class="flex items-center">
                                            <div x-data="{ open: false }" class="relative">
                                                <button @click="open = !open" class="px-2 inline-flex items-center text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                    {{ $user->role }}
                                                    <svg class="ml-1 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                                    </svg>
                                                </button>
                                                <div x-show="open" @click.away="open = false" class="absolute z-10 mt-1 w-36 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5">
                                                    <div class="py-1" role="menu" aria-orientation="vertical" aria-labelledby="options-menu">
                                                        @foreach(['user', 'admin'] as $role)
                                                            <a href="#" wire:click="changeRole({{ $user->id }}, '{{ $role }}')" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900" role="menuitem">{{ ucfirst($role) }}</a>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                            <p class="ml-4 text-sm text-gray-500">
                                                Registrado el {{ $user->created_at->format('d/m/Y') }}
                                            </p>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="mt-8">
                    {{ $users->links() }}
                </div>
                <!-- Lista de Categorías -->
                <div class="bg-white/90 rounded-lg shadow-lg overflow-hidden">
                    <div class="px-6 py-4 bg-gray-700 border-b border-gray-600 flex justify-between items-center">
                        <h2 class="text-xl font-semibold text-yellow-500">
                            {{ __('Categorías') }}
                        </h2>
                        <button wire:click="$emit('open-category-modal')" class="px-4 py-2 bg-yellow-500 text-white rounded-md hover:bg-yellow-600 transition-colors duration-200">
                            Nueva Categoría
                        </button>
                    </div>
                    <div class="p-6">
                        <ul class="divide-y divide-gray-200">
                            @foreach ($categories as $category)
                                <li class="py-4">
                                    <div class="flex items-center justify-between">
                                        <div>
                                            <p class="text-sm font-medium text-yellow-600">
                                                {{ $category->name }}
                                            </p>
                                        </div>
                                        <div class="flex items-center gap-4">
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full" style="background-color: {{ $category->color }}">
                                                {{ $category->color }}
                                            </span>
                                            <button 
                                                onclick="confirmDelete({{ $category->id }}, '{{ $category->name }}')"
                                                class="text-red-600 hover:text-red-900"
                                            >
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                                    <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                                                </svg>
                                            </button>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal para crear categoría -->
    <div
    x-data="{ show: false }"
    x-show="show"
    x-on:open-category-modal.window="show = true"
    x-on:close-category-modal.window="show = false"
    x-on:keydown.escape.window="show = false"
    x-transition:enter="ease-out duration-300"
    x-transition:enter-start="opacity-0"
    x-transition:enter-end="opacity-100"
    x-transition:leave="ease-in duration-200"
    x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0"
    class="relative z-10"
    style="display: none;"
    >
    <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>

    <div class="fixed inset-0 z-10 overflow-y-auto">
        <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
            <div
                x-trap.noscroll="show"
                class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg"
                x-transition:enter="ease-out duration-300"
                x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                x-transition:leave="ease-in duration-200"
                x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
            >
                <div class="bg-white px-4 pb-4 pt-5 sm:p-6 sm:pb-4">
                    <div class="sm:flex sm:items-start">
                        <div class="mt-3 text-center sm:ml-4 sm:mt-0 sm:text-left w-full">
                            <h3 class="text-base font-semibold leading-6 text-gray-900" id="modal-title">Nueva Categoría</h3>
                            <div class="mt-4 space-y-4">
                                <div>
                                    <label for="categoryName" class="block text-sm font-medium text-gray-700">Nombre</label>
                                    <input type="text" wire:model="categoryName" id="categoryName" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-yellow-500 focus:ring-yellow-500 sm:text-sm">
                                    @error('categoryName') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                                </div>
                                <div>
                                    <label for="categoryColor" class="block text-sm font-medium text-gray-700">Color</label>
                                    <div class="mt-1 flex items-center gap-2">
                                        <input type="color" wire:model="categoryColor" id="categoryColor" class="h-8 w-8 rounded border-gray-300">
                                        <input type="text" wire:model="categoryColor" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-yellow-500 focus:ring-yellow-500 sm:text-sm" placeholder="#000000">
                                    </div>
                                    @error('categoryColor') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6">
                    <button type="button" wire:click="createCategory" class="inline-flex w-full justify-center rounded-md bg-yellow-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-yellow-500 sm:ml-3 sm:w-auto">
                        Crear
                    </button>
                    <button type="button" @click="show = false" class="mt-3 inline-flex w-full justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:mt-0 sm:w-auto">
                        Cancelar
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
{{-- <script>
    
    document.addEventListener('DOMContentLoaded', function() {
        Swal.fire({
                icon: 'success',
                title: 'Éxito',
                text: message,
                confirmButtonColor: '#D97706'
            });
        });

</script> --}}

<script>
    function confirmDelete(categoryId, categoryName) {
        Swal.fire({
            title: '¿Estás seguro?',
            text: `¿Deseas eliminar la categoría "${categoryName}"?`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Sí, eliminar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                Livewire.emit('deleteCategory', categoryId);
            }
        });
    }
</script>

    </div>

    