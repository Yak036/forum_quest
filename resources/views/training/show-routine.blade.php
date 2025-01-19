<div class="">
    <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
        <!-- Botón de regreso -->
        <div class="mb-6">
            <button wire:click="selectRoutine(null)" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-yellow-600 hover:bg-yellow-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500">
                <svg class="-ml-1 mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
                </svg>
                Volver a Rutinas
            </button>
        </div>

        <!-- Detalles de la rutina -->
          <!-- Detalles de la rutina -->
          <div class="bg-white shadow overflow-hidden sm:rounded-lg">
            <div class="px-6 py-4 bg-gray-700 border-b border-gray-600 shadow-md shadow-black">
                <h3 class="text-xl font-semibold text-yellow-500">
                    {{ $routine->name }}
                </h3>
                <p class="mt-1 max-w-2xl text-sm text-gray-200">
                    {{ $routine->description }}
                </p>
            </div>
            <div class=" shadow-sm shadow-black">
                <dl>
                    <div class="bg-gray-400 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-black">
                            Dificultad
                        </dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-1">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                {{ $routine->difficulty }}
                            </span>
                        </dd>
                    </div>
                </dl>
            </div>

            <!-- Contenedor principal de dos columnas -->
            <div class="grid grid-cols-1 md:grid-cols-2 p-6 gap-2">
                <!-- Columna izquierda: Lista de ejercicios -->
                <div class="space-y-4">
                    <div class="flex justify-between items-center">
                        <h4 class="text-lg font-medium text-gray-900">Ejercicios</h4>
                        <button wire:click="createExercise" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-white bg-yellow-600 hover:bg-yellow-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500">
                            <svg class="-ml-0.5 mr-2 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 01-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
                            </svg>
                            Añadir Ejercicio
                        </button>
                    </div>

                    @if(session()->has('message'))
                        <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded relative" role="alert">
                            <span class="block sm:inline">{{ session('message') }}</span>
                        </div>
                    @endif

                    <!-- Formulario de Nuevo Ejercicio -->
                    @if($showExerciseForm)
                        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity z-50">
                            <div class="fixed inset-0 z-50 overflow-y-auto">
                                <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                                    <div class="relative transform overflow-hidden rounded-lg bg-white px-4 pb-4 pt-5 text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg sm:p-6">
                                        <div>
                                            <h3 class="text-lg font-medium leading-6 text-gray-900 mb-4">Añadir Nuevo Ejercicio</h3>
                                            <form wire:submit.prevent="saveExercise">
                                                <div class="space-y-4">
                                                    <div>
                                                        <label for="newExerciseName" class="block text-sm font-medium text-gray-700">Nombre del Ejercicio</label>
                                                        <input type="text" wire:model="newExerciseName" id="newExerciseName" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-yellow-500 focus:ring-yellow-500 sm:text-sm">
                                                        @error('newExerciseName') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                                                    </div>
                                                    
                                                    <div>
                                                        <label for="newExerciseImageUrl" class="block text-sm font-medium text-gray-700">URL de la Imagen (opcional)</label>
                                                        <input type="url" wire:model="newExerciseImageUrl" id="newExerciseImageUrl" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-yellow-500 focus:ring-yellow-500 sm:text-sm">
                                                        @error('newExerciseImageUrl') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                                                    </div>

                                                    <div>
                                                        <label for="newExerciseVideoUrl" class="block text-sm font-medium text-gray-700">URL del Video (opcional)</label>
                                                        <input type="url" wire:model="newExerciseVideoUrl" id="newExerciseVideoUrl" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-yellow-500 focus:ring-yellow-500 sm:text-sm">
                                                        @error('newExerciseVideoUrl') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                                                    </div>
                                                </div>
                                                
                                                <div class="mt-5 sm:mt-6 sm:grid sm:grid-flow-row-dense sm:grid-cols-2 sm:gap-3">
                                                    <button type="submit" class="inline-flex w-full justify-center rounded-md border border-transparent bg-yellow-600 px-4 py-2 text-base font-medium text-white shadow-sm hover:bg-yellow-700 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-offset-2 sm:col-start-2 sm:text-sm">
                                                        Guardar Ejercicio
                                                    </button>
                                                    <button type="button" wire:click="cancelExerciseCreation" class="mt-3 inline-flex w-full justify-center rounded-md border border-gray-300 bg-white px-4 py-2 text-base font-medium text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-offset-2 sm:col-start-1 sm:mt-0 sm:text-sm">
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

                    @forelse($routine->exercises as $exercise)
                        <div class="bg-gray-50 rounded-lg p-4">
                            <div class="flex items-start justify-between">
                                <div>
                                    <h5 class="text-base font-medium text-gray-900">{{ $exercise->name }}</h5>
                                    <p class="mt-1 text-sm text-gray-500">{{ $exercise->description }}</p>
                                    <p class="mt-1 text-xs text-gray-400">Añadido el: {{ $exercise->created_at->format('d/m/Y') }}</p>
                                    <div class="mt-2 flex space-x-2">
                                        <button wire:click="selectExercise({{ $exercise->id }})" class="inline-flex items-center px-2.5 py-1.5 border border-transparent text-xs font-medium rounded text-yellow-700 bg-yellow-100 hover:bg-yellow-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500">
                                            Ver Progreso
                                        </button>
                                        <button onclick="confirmDeleteExercise({{ $exercise->id }})" class="inline-flex items-center px-2.5 py-1.5 border border-transparent text-xs font-medium rounded text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                                            <svg class="-ml-0.5 mr-1 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                                            </svg>
                                            Eliminar
                                        </button>
                                    </div>
                                </div>
                                @if($exercise->image_url || $exercise->video_url)
                                    <div class="flex space-x-2">
                                        @if($exercise->image_url)
                                            <a href="{{ $exercise->image_url }}" target="_blank" class="text-yellow-600 hover:text-yellow-700">
                                                <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z" clip-rule="evenodd" />
                                                </svg>
                                            </a>
                                        @endif
                                        @if($exercise->video_url)
                                            <a href="{{ $exercise->video_url }}" target="_blank" class="text-yellow-600 hover:text-yellow-700">
                                                <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                                                    <path d="M2 6a2 2 0 012-2h6a2 2 0 012 2v8a2 2 0 01-2 2H4a2 2 0 01-2-2V6zm12.553 1.106A1 1 0 0014 8v4a1 1 0 00.553.894l2 1A1 1 0 0018 13V7a1 1 0 00-1.447-.894l-2 1z" />
                                                </svg>
                                            </a>
                                        @endif
                                    </div>
                                @endif
                            </div>
                        </div>
                    @empty
                        <p class="text-sm text-gray-500">No hay ejercicios en esta rutina.</p>
                    @endforelse
                </div>

                <!-- Columna derecha: Progreso -->
                <div>
                    @if($selectedExercise)
                        <div class="bg-gray-50 rounded-lg">
                            <div class="">
                                <div class="flex justify-between items-center">
                                    <h4 class="text-lg font-medium text-gray-900"">Progreso de {{ $selectedExercise->name }}</h4>
                                    <button wire:click="showAddProgress" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-white bg-yellow-600 hover:bg-yellow-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500">
                                        <svg class="-ml-0.5 mr-2 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 01-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
                                        </svg>
                                        Añadir Progreso
                                    </button>
                                </div>
                            </div>

                            @if($showProgressForm)
                                <div class="p-4">
                                    <form wire:submit.prevent="saveProgress">
                                        <div class="grid grid-cols-1 gap-4 sm:grid-cols-3">
                                            <div>
                                                <label for="weight" class="block text-sm font-medium text-gray-700">Peso (kg)</label>
                                                <input type="number" step="0.5" wire:model="weight" id="weight" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-yellow-500 focus:border-yellow-500 sm:text-sm">
                                                @error('weight') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                                            </div>
                                            <div>
                                                <label for="reps" class="block text-sm font-medium text-gray-700">Repeticiones</label>
                                                <input type="number" wire:model="reps" id="reps" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-yellow-500 focus:border-yellow-500 sm:text-sm">
                                                @error('reps') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                                            </div>
                                            <div>
                                                <label for="notes" class="block text-sm font-medium text-gray-700">Notas</label>
                                                <input type="text" wire:model="notes" id="notes" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-yellow-500 focus:border-yellow-500 sm:text-sm">
                                                @error('notes') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                                            </div>
                                        </div>
                                        <div class="mt-4 flex justify-end space-x-3">
                                            <button type="button" wire:click="$set('showProgressForm', false)" class="inline-flex items-center px-3 py-2 border border-gray-300 shadow-sm text-sm leading-4 font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500">
                                                Cancelar
                                            </button>
                                            <button type="submit" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-white bg-yellow-600 hover:bg-yellow-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500">
                                                Guardar
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            @endif

                            @if(session()->has('message'))
                                <div class="mx-4 my-3 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded relative" role="alert">
                                    <span class="block sm:inline">{{ session('message') }}</span>
                                </div>
                            @endif

                            <div class="p-4">
                                @if($progress && $progress->count() > 0)
                                    <div class="overflow-x-auto">
                                        <table class="min-w-full divide-y divide-gray-200">
                                            <thead class="bg-gray-50">
                                                <tr>
                                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Fecha</th>
                                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Peso</th>
                                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Repeticiones</th>
                                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Notas</th>
                                                </tr>
                                            </thead>
                                            <tbody class="bg-white divide-y divide-gray-200">
                                                @foreach($progress as $p)
                                                    <tr>
                                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                            {{ $p->date->format('d/m/Y') }}
                                                        </td>
                                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                            {{ $p->weight }} kg
                                                        </td>
                                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                            {{ $p->reps }}
                                                        </td>
                                                        <td class="px-6 py-4 text-sm text-gray-500">
                                                            {{ $p->notes }}
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                @else
                                    <p class="text-gray-500 text-center py-4">No hay registros de progreso para este ejercicio.</p>
                                @endif
                            </div>
                        </div>
                    @else
                        <div class="bg-gray-50 rounded-lg p-6 text-center">
                            <p class="text-gray-500">Selecciona un ejercicio para ver su progreso</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
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
</script>
