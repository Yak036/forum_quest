    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="mb-6">
                        <h2 class="text-2xl font-semibold text-gray-800">Mis Clases</h2>
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
                                                <button onclick="deletePractice({{ $practice->id }})" class="text-red-600 hover:text-red-900">
                                                    Eliminar
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
