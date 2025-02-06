<div class="bg-gray-100">
    <!-- Hero Section -->
    <div class="relative bg-yellow-600 overflow-hidden">
        <div class="max-w-7xl mx-auto">
            <div class="relative z-10 pb-8 bg-yellow-600 sm:pb-16 md:pb-20 lg:max-w-2xl lg:w-full lg:pb-28 xl:pb-32">
                <main class="mt-10 mx-auto max-w-7xl px-4 sm:mt-12 sm:px-6 md:mt-16 lg:mt-20 lg:px-8 xl:mt-28">
                    <div class="sm:text-center lg:text-left">
                        <h1 class="text-4xl tracking-tight font-extrabold text-white sm:text-5xl md:text-6xl">
                            <span class="block">Mis Rutinas</span>
                            <span class="block text-yellow-300">RockstarFitness</span>
                        </h1>
                        <p class="mt-3 text-base text-yellow-100 sm:mt-5 sm:text-lg sm:max-w-xl sm:mx-auto md:mt-5 md:text-xl lg:mx-0">
                            Administra tus rutinas de entrenamiento y mantén un registro de tu progreso.
                        </p>
                    </div>
                </main>
            </div>
        </div>
        <div class="lg:absolute lg:inset-y-0 lg:right-0 lg:w-1/2">
            <img class="h-56 w-full object-cover sm:h-72 md:h-96 lg:w-full lg:h-full" 
                    src="https://images.unsplash.com/photo-1534438327276-14e5300c3a48?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1350&q=80" 
                    alt="Rutinas de ejercicio">
        </div>
    </div>

    <!-- Routines Section del usuario -->
    <div class="py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
           

            <div class="text-center">
                <h2 class="text-base text-yellow-600 font-semibold tracking-wide uppercase">Mis Rutinas</h2>
                <p class="mt-2 text-3xl leading-8 font-extrabold tracking-tight text-gray-900 sm:text-4xl">
                    Tu Plan de Entrenamiento
                </p>
            </div>

            <div class="mt-10">
                @if(session()->has('message'))
                    <div class="mb-4 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded relative" role="alert">
                        <span class="block sm:inline">{{ session('message') }}</span>
                    </div>
                @endif

                <!-- Botón Crear Nueva Rutina -->
                <div class="mb-6 flex justify-end">
                    <button wire:click="createRoutine" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-yellow-600 hover:bg-yellow-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500">
                        <svg class="-ml-1 mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
                        </svg>
                        Crear Nueva Rutina
                    </button>
                </div>

                <!-- Formulario de Nueva Rutina -->
                @if($showRoutineForm)
                    <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity z-50">
                        <div class="fixed inset-0 z-50 overflow-y-auto">
                            <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                                <div class="relative transform overflow-hidden rounded-lg bg-white px-4 pb-4 pt-5 text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg sm:p-6">
                                    <div>
                                        <h3 class="text-lg font-medium leading-6 text-gray-900 mb-4">Crear Nueva Rutina</h3>
                                        <form wire:submit.prevent="saveRoutine">
                                            <div class="space-y-4">
                                                <div>
                                                    <label for="newRoutineName" class="block text-sm font-medium text-gray-700">Nombre</label>
                                                    <input type="text" wire:model="newRoutineName" id="newRoutineName" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-yellow-500 focus:ring-yellow-500 sm:text-sm">
                                                    @error('newRoutineName') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                                                </div>
                                                
                                                <div>
                                                    <label for="newRoutineDescription" class="block text-sm font-medium text-gray-700">Descripción</label>
                                                    <textarea wire:model="newRoutineDescription" id="newRoutineDescription" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-yellow-500 focus:ring-yellow-500 sm:text-sm"></textarea>
                                                    @error('newRoutineDescription') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                                                </div>
                                                
                                                <div>
                                                    <label for="newRoutineDifficulty" class="block text-sm font-medium text-gray-700">Dificultad</label>
                                                    <select wire:model="newRoutineDifficulty" id="newRoutineDifficulty" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-yellow-500 focus:ring-yellow-500 sm:text-sm">
                                                        <option value="Principiante">Principiante</option>
                                                        <option value="Intermedio">Intermedio</option>
                                                        <option value="Avanzado">Avanzado</option>
                                                    </select>
                                                    @error('newRoutineDifficulty') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                                                </div>
                                            </div>
                                            
                                            <div class="mt-5 sm:mt-6 sm:grid sm:grid-flow-row-dense sm:grid-cols-2 sm:gap-3">
                                                <button type="submit" class="inline-flex w-full justify-center rounded-md border border-transparent bg-yellow-600 px-4 py-2 text-base font-medium text-white shadow-sm hover:bg-yellow-700 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-offset-2 sm:col-start-2 sm:text-sm">
                                                    Crear Rutina
                                                </button>
                                                <button type="button" wire:click="cancelRoutineCreation" class="mt-3 inline-flex w-full justify-center rounded-md border border-gray-300 bg-white px-4 py-2 text-base font-medium text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-offset-2 sm:col-start-1 sm:mt-0 sm:text-sm">
                                                    Cancelar
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

                @if($routines->isEmpty())
                    <div class="text-center py-12">
                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path>
                        </svg>
                        <h3 class="mt-2 text-sm font-medium text-gray-900">No hay rutinas</h3>
                        <p class="mt-1 text-sm text-gray-500">Comienza creando tu primera rutina de entrenamiento.</p>
                        <div class="mt-6">
                            <button wire:click="createRoutine" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-yellow-600 hover:bg-yellow-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500">
                                <svg class="-ml-1 mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
                                </svg>
                                Crear Nueva Rutina
                            </button>
                        </div>
                    </div>
                @else
                    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
                        @foreach($routines as $routine)
                            <div class="bg-white overflow-hidden shadow-sm rounded-lg">
                                <div class="p-6">
                                    <h3 class="text-lg leading-6 font-medium text-gray-900">
                                        {{ $routine->name }}
                                    </h3>
                                    <p class="mt-2 text-sm text-gray-500">
                                        {{ $routine->description }}
                                    </p>
                                    <div class="mt-4">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                            {{ $routine->difficulty }}
                                        </span>
                                        <span class="ml-2 text-sm text-gray-500">
                                            {{ $routine->exercises->count() }} ejercicios
                                        </span>
                                    </div>
                                    <div class="mt-4 flex justify-end space-x-3">
                                        <button wire:click="selectRoutine({{ $routine->id }})" class="inline-flex items-center px-3 py-2 border border-gray-300 shadow-sm text-sm leading-4 font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500">
                                            Ver Detalles
                                        </button>
                                        <button onclick="confirmDelete({{ $routine->id }})" class="inline-flex items-center px-3 py-2 border border-transparent shadow-sm text-sm leading-4 font-medium rounded-md text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                                            <svg class="-ml-0.5 mr-2 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                                            </svg>
                                            Eliminar
                                        </button>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>

    @if (Auth::user()->role === 'admin' || Auth::user()->role === 'trainer')
        @include('training.show-all-routines')
    @endif


</div>
<script>
        function confirmDeleteExercise(exerciseId) {
        Swal.fire({
            title: '¿Estás seguro?',
            text: "Esta acción no se puede deshacer y eliminará todo el progreso asociado.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#dc2626',
            cancelButtonColor: '#6b7280',
            confirmButtonText: 'Sí, eliminar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                @this.call('deleteExercise', exerciseId)
                    .then(() => {
                        Swal.fire(
                            '¡Eliminado!',
                            'El ejercicio ha sido eliminado exitosamente.',
                            'success'
                        );
                    })
                    .catch(() => {
                        Swal.fire(
                            'Error',
                            'No se pudo eliminar el ejercicio.',
                            'error'
                        );
                    });
            }
        });
    }

    
    function confirmDelete(routineId) {
            Swal.fire({
                title: '¿Estás seguro?',
                text: "Esta acción no se puede deshacer y eliminará todos los ejercicios asociados.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d97706',
                cancelButtonColor: '#6b7280',
                confirmButtonText: 'Sí, eliminar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    @this.call('deleteRoutine', routineId)
                    .then(() => {
                        Swal.fire(
                            '¡Eliminado!',
                            'La rutina ha sido eliminado exitosamente.',
                            'success'
                        );
                    })
                    .catch(() => {
                        Swal.fire(
                            'Error',
                            'No se pudo eliminar la rutina.',
                            'error'
                        );
                    });
                }
            });
        }
</script>