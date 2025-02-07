    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="mb-6">
                        <h2 class="text-2xl font-semibold text-gray-800">Mis Practicas</h2>
                    </div>

                    @if($message)
                        <div class="mb-4 p-4 rounded {{ $messageType === 'success' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                            {{ $message }}
                        </div>
                    @endif

                    @if(Auth::user()->role === 'admin')
                        <div class="mb-6">
                            <button wire:click="$toggle('showCreateForm')" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-yellow-600 hover:bg-yellow-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500">
                                {{ $showCreateForm ? 'Cerrar formulario' : 'Crear nueva practica' }}
                            </button>
                        </div>

                        @if($showCreateForm)
                            @include('calendar.form.create-practice')
                        @endif

                        @if($showEditForm)
                            <div class="mt-4 p-4 bg-gray-50 rounded-lg">
                                <h3 class="text-lg font-medium text-gray-900 mb-4">Editar Práctica</h3>
                                <form wire:submit.prevent="updatePractice">
                                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                                        <div>
                                            <label for="edit_name" class="block text-sm font-medium text-gray-700">Nombre</label>
                                            <input type="text" wire:model="name" id="edit_name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-yellow-500 focus:ring-yellow-500">
                                            @error('name') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                                        </div>

                                        <div>
                                            <label for="edit_description" class="block text-sm font-medium text-gray-700">Descripción</label>
                                            <textarea wire:model="description" id="edit_description" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-yellow-500 focus:ring-yellow-500"></textarea>
                                            @error('description') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                                        </div>

                                        <div>
                                            <label for="edit_capacity" class="block text-sm font-medium text-gray-700">Capacidad</label>
                                            <input type="number" wire:model="capacity" id="edit_capacity" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-yellow-500 focus:ring-yellow-500">
                                            @error('capacity') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                                        </div>

                                        <div>
                                            <label for="edit_date_time" class="block text-sm font-medium text-gray-700">Fecha y Hora</label>
                                            <input type="datetime-local" wire:model="date_time" id="edit_date_time" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-yellow-500 focus:ring-yellow-500">
                                            @error('date_time') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                                        </div>

                                        <div>
                                            <label for="edit_duration" class="block text-sm font-medium text-gray-700">Duración (minutos)</label>
                                            <input type="number" wire:model="duration" id="edit_duration" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-yellow-500 focus:ring-yellow-500">
                                            @error('duration') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                                        </div>

                                        <div>
                                            <label for="edit_trainer_id" class="block text-sm font-medium text-gray-700">Entrenador</label>
                                            <select wire:model="trainer_id" id="edit_trainer_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-yellow-500 focus:ring-yellow-500">
                                                <option value="">Seleccionar entrenador</option>
                                                @foreach($trainers as $trainer)
                                                    <option value="{{ $trainer->id }}">{{ $trainer->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('trainer_id') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                                        </div>
                                    </div>

                                    <div class="mt-4 flex justify-end space-x-3">
                                        <button type="button" wire:click="cancelEdit" class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500">
                                            Cancelar
                                        </button>
                                        <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-yellow-600 hover:bg-yellow-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500">
                                            Actualizar
                                        </button>
                                    </div>
                                </form>
                            </div>
                        @endif
                    @endIf

                    <div class="mt-6">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Practicas programadas</h3>
                        <div class="overflow-x-auto">
                            <div>
                                <input type="text" wire:model="search" placeholder="Buscar entrenador..." id="searchInput" class="border border-gray-300 rounded-md px-4 py-2">
                            </div>
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nombre</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer" wire:click="filter('date_time')">
                                            Fecha y Hora
                                            <i class="fas fa-sort ml-1"></i>
                                        </th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer" wire:click="filter('duration')">
                                            Duración
                                            <i class="fas fa-sort ml-1"></i>
                                        </th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer" wire:click="filter('capacity')">
                                            Capacidad
                                            <i class="fas fa-sort ml-1"></i>
                                        </th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer" wire:click="filter('reservations')">
                                            Reservas
                                            <i class="fas fa-sort ml-1"></i>
                                        </th>
                                        @if(Auth::user()->role === 'admin')
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Acciones</th>
                                        @endif                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach($practices as $practice)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $practice->name }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $practice->date_time->format('d/m/Y H:i') }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $practice->duration }} min</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $practice->capacity }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $practice->reservations->count() }}/{{ $practice->capacity }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                                @if(Auth::user()->role === 'admin')
                                                <button wire:click="editPractice({{ $practice->id }})" class="text-blue-600 hover:text-blue-900 hover:bg-blue-900 mr-4">
                                                    <i class="fas fa-pencil-alt"></i>
                                                </button>
                                                <button onclick="deletePractice({{ $practice->id }})" class="text-red-600 hover:text-red-900 ml-4">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="mt-4">
                            {{ $practices->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        let search = document.getElementById('searchInput');
        search.addEventListener('keyup', function(e) {
            if (!isNaN(e.target.value.charAt(0))) {
                search.value = '';
            } else {
                search.value = e.target.value.replace(/[0-9]/g, '');
            }
        });

        function deletePractice(id) {
            Swal.fire({
                title: '¿Estás seguro?',
                text: '¿Deseas eliminar esta practica?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Sí, eliminar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    Livewire.emit('deletePractice', id);
                }
            });
        }
        document.addEventListener('livewire:load', function() {
            // Escuchar eventos de Livewire
            Livewire.on('showAlert', params => {
                Swal.fire({
                    icon: params.type,
                    title: params.title,
                    text: params.message,
                    confirmButtonColor: '#D97706'
                });
            });
        });

       
    </script>
    @endpush
