<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex gap-10 py-12">
    <div class="w-64">
        <a href="" class="block w-full py-4 mb-10 bg-gradient-to-r from-blue-600 to-blue-700 hover:to-blue-600 text-white/90 font-bold text-xs text-center rounded-md">
            Preguntar
        </a>


        <ul>
            @foreach ($categories as $category)
            <li class="mb-2">
                <a href="#" wire:click.prevent="filterByCategory('{{$category->id}}')" class="p-2 rounded-md flex bg-slate-800 item-center gap-2 text-white/60 hover:text-white font-semibold text-xs capitalize">
                    <span class="w-2 h-2 rounded-full" style="background-color: {{$category->color}};"></span>
                    {{$category->name}}
                </a>
            </li>
            @endforeach

            <li>
                <a href="#" wire:click.prevent="filterByCategory('')" class="p-2 rounded-md flex bg-slate-800 item-center gap-2 text-white/60 hover:text-white font-semibold text-xs">
                    <span class="w-2 h-2 rounded-full" style="background-color: #000;"></span>
                    Todos los resultados
                </a>
            </li>
        </ul>
    </div>
    <div class="w-full">
        {{-- Formulario --}}
        <form action="" class="mb-4">
            <input 
                type="text" 
                placeholder="// ..." 
                name="" 
                class="bg-slate-800 border-0 rounded-mb w-1/3 text-white/60 text-xs"
                wire:model='search'
            >
        </form>
        @foreach ($threads as $thread)
            <div class="rounded-md bg-gradient-to-r from-slate-800 to-slate-900 hover:to-slate-800 mb-4">
                <div class="p-4 flex gap-4">
                    <div class="">
                        <img src="{{$thread->user->avatar()}}" alt="{{$thread->user->name}}">
                    </div>

                    <div class="w-full">
                        <h2 class="mb-4 flex items-start justify-between">
                            <a href="{{ route('thread',$thread) }}" class="text-xl font-semibold text-white/90">
                                {{$thread->title}}
                            </a>
                            <span 
                                class="rounded-full text-xs py-2 px-4 capitalize" 
                                style="color: {{$thread->category->color}}; border: 1px solid {{$thread->category->color}}"
                            >
                                {{$thread->category->name}}
                            </span>
                        </h2>
                        <p class="flex items-center justify-between w-full text-xs">
                            <span class="text-blue-600 font-semibold">
                                {{$thread->user->name}}
                                {{-- ? Ver la fecha en formato legible --}}
                                <span class="text-white/90">{{$thread->created_at->diffForHumans()}}</span>
                            </span>
                            <span class="flex items-center gap-1 text-slate-700">
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
                                {{$thread->replies_count}} Respuesta{{$thread->replies_count !== 1? 's' : ''}}
                                |
                                <a href="{{ route('threads.edit', $thread)}}" class="hover:text-white cursor-pointer">Editar</a>
                            </span>
                        </p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
