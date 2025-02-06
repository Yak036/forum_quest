<div class="py-12">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
     

      <div class="text-center">
          <p class="mt-2 text-3xl leading-8 font-extrabold tracking-tight text-gray-900 sm:text-4xl">
              Todos los planes de Entrenamiento
          </p>
      </div>

      <div class="mt-10">
          @if(session()->has('message'))
              <div class="mb-4 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded relative" role="alert">
                  <span class="block sm:inline">{{ session('message') }}</span>
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
              <div class="mb-4">
                <input type="text" wire:model="search" placeholder="Buscar usuario..." class="border border-gray-300 rounded-md px-4 py-2">
              </div>
              <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
                  @foreach($allRoutines as $routine)
                      <div class="bg-white overflow-hidden shadow-sm rounded-lg">
                          <div class="p-6">
                              <h3 class="text-lg leading-6 font-medium text-gray-900">
                                  {{ $routine->name }}
                              </h3>
                              <span class="{{ $routine->user->role === 'trainer' ? 'text-yellow-500' : 'text-green-800' }}">
                                {{ $routine->user->name }}
                              </span>
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
                                  @if (Auth::user()->role === 'admin')
                                  <button onclick="confirmDelete({{ $routine->id }})" class="inline-flex items-center px-3 py-2 border border-transparent shadow-sm text-sm leading-4 font-medium rounded-md text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                                      <svg class="-ml-0.5 mr-2 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                          <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                                      </svg>
                                      Eliminar
                                  </button>
                                      
                                  @endif
                              </div>
                          </div>
                      </div>
                  @endforeach
                </div>
                <div class="mt-4">
                  {{ $allRoutines->links() }}
              </div>
          @endif
      </div>
  </div>
</div>