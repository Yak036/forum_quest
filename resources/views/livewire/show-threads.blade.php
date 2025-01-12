<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex gap-10 py-12">
    @if (!request()->routeIs('my_threads'))
        <div class="w-64">
            <a href="{{ route('threads.create')}}" class="block w-full py-4 mb-10 bg-yellow-600 hover:bg-yellow-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500 text-white font-bold text-sm text-center rounded-md">
                Crear un tema
            </a>
            @if(!Auth::check())
                <div class="bg-white p-6 rounded-lg shadow-md mb-4">
                    <p class="text-gray-700 mb-4">Inicia sesión para participar en el foro</p>
                    <a href="{{ route('login') }}" class="block w-full py-2 text-center bg-yellow-600 hover:bg-yellow-700 text-white rounded-md text-sm font-medium">
                        Iniciar sesión
                    </a>
                </div>
            @endif

            <div class="bg-white rounded-lg shadow-md p-6">
                <h2 class="text-lg font-semibold text-gray-900 mb-4">Categorías</h2>
                <ul class="space-y-2">
                    @foreach($categories as $categoryDB)
                        <li>
                            <a href="#" wire:click.prevent="filterByCategory({{ $categoryDB->id }})" 
                                class="flex items-center gap-2 p-2 rounded-md hover:bg-gray-50 {{ $category == $categoryDB->id ? 'bg-yellow-50 text-yellow-600' : 'text-gray-600' }}">
                                <span class="w-2 h-2 rounded-full" style="background-color: {{ $categoryDB->color }}"></span>
                                {{ $categoryDB->name }}
                                <span class="text-xs text-gray-500">({{ $categoryDB->threads_count }})</span>
                            </a>
                        </li>
                    @endforeach
                    <li>
                        <a href="#" wire:click.prevent="filterByCategory('')" class="flex items-center gap-2 p-2 rounded-md hover:bg-gray-50 {{ $category == '' ? 'bg-yellow-50 text-yellow-600' : 'text-gray-600' }}">
                            <span class="w-2 h-2 rounded-full" style="background-color: #000;"></span>
                            Todos los resultados
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    @endif

    <div class="flex-1">
        @if (!request()->routeIs('my_threads'))
            {{-- Formulario --}}
            <form class="mb-4">
                <input type="text" 
                    placeholder="Buscar..." 
                    class="w-full rounded-md border-gray-300 shadow-sm focus:border-yellow-500 focus:ring-yellow-500"
                    wire:model="search"
                >
            </form>
        @else
            <a href="{{ route('threads.create')}}" class="block w-full py-4 mb-10 bg-yellow-600 hover:bg-yellow-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500 text-white font-bold text-sm text-center rounded-md">
                Crear un tema
            </a>
        @endif
        @if ($threads->isEmpty())
            
            <p class="text-gray-200 bg-gray-800 text-center p-5 rounded-lg">No posees ningun tema</p>
        @else
            @foreach($threads as $thread)
                <div class="bg-white p-4 rounded-lg shadow-md mb-4">
                    <div class="flex gap-4">
                        <div>
                            <img src="{{ $thread->user->avatar() }}" alt="{{ $thread->user->name }}" class="rounded-full">
                        </div>
                        <div class="w-full">
                            <h2 class="mb-4 flex items-start justify-between">
                                <a href="{{ route('thread', $thread) }}" class="text-xl font-semibold text-gray-900 hover:text-yellow-600">
                                    {{ $thread->title }}
                                </a>
                                <span class="rounded-full text-xs py-2 px-4 capitalize bg-yellow-600 text-white">
                                    {{ $thread->category->name }}
                                </span>
                            </h2>
                            <p class="flex items-center justify-between w-full text-sm">
                                <span class="text-yellow-600 font-semibold">
                                    {{ $thread->user->name }}
                                    {{-- ? Ver la fecha en formato legible --}}
                                    <span class="text-gray-600">{{ $thread->created_at->diffForHumans() }}</span>
                                </span>
                                <span class="flex items-center gap-1 text-gray-600">
                                    <svg
                                    data-slot="icon"
                                    fill="currentColor"
                                    viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg"
                                    aria-hidden="true"
                                    class="h-4"
                                    >
                                        <path clip-rule="evenodd" fill-rule="evenodd" d="M4.848 2.771A49.144 49.144 0 0 1 12 2.25c2.43 0 4.817.178 7.152.52 1.978.292 3.348 2.024 3.348 3.97v6.02c0 1.946-1.37 3.678-3.348 3.97a48.901 48.901 0 0 1-3.476.383.39.39 0 0 0-.297.17l-2.755 4.133a.75.75 0 0 1-1.248 0l-2.755-4.133a.39.39 0 0 0-.297-.17 48.9 48.9 0 0 1-3.476-.384c-1.978-.29-3.348-2.024-3.348-3.97V6.741c0-1.946 1.37-3.68 3.348-3.97ZM6.75 8.25a.75.75 0 0 1 .75-.75h9a.75.75 0 0 1 0 1.5h-9a.75.75 0 0 1-.75-.75Zm.75 2.25a.75.75 0 0 0 0 1.5H12a.75.75 0 0 0 0-1.5H7.5Z"></path>
                                    </svg>
                                    {{ $thread->replies_count }} Respuesta{{ $thread->replies_count !== 1? 's' : ''}}
                                    |
                                    @can('update', $thread)
                                        <a href="{{ route('threads.edit', $thread)}}" class="hover:text-yellow-600 cursor-pointer">Editar</a>
                                    @endcan
                                </span>
                            </p>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
    </div>
<script>
    
    document.addEventListener('DOMContentLoaded', function() {
        
        @if (session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Éxito',
                text: "{{ session('success') }}",
                confirmButtonColor: '#D97706'
            });
        @endif
    });
</script>

</div>
