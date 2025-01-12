<div class="@if(!$reply->reply_id) border-l-4 border-yellow-500 @endif bg-white rounded-lg shadow-md mb-4">
    @if($reply->exists && $reply->user)
        <div class="p-4 flex gap-4">
            <div>
                <img src="{{$reply->user->avatar()}}" alt="{{$reply->user->name}}" 
                    class="@if(!$reply->reply_id) w-12 h-12 @else w-10 h-10 @endif rounded-full">
            </div>

            <div class="w-full">
                <p class="mb-2 @if(!$reply->reply_id) text-yellow-600 font-semibold text-base @else text-gray-600 font-medium text-sm @endif">
                    {{$reply->user->name}}
                    <span class="text-gray-500 text-xs">{{$reply->created_at->diffForHumans()}}</span>
                </p>

                @if ($is_editing)
                    <form wire:submit.prevent='updateReply' class="mt-4">
                        <input
                            type="text"
                            placeholder="Escribe una respuesta"
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 
                            focus:outline-none focus:ring-yellow-500 focus:border-yellow-500 sm:text-sm"
                            wire:model.defer='body'
                        >
                    </form>
                @else
                    <p class="@if(!$reply->reply_id) text-gray-700 text-base @else text-gray-600 text-sm @endif">
                        {{$reply->body}}
                    </p>
                @endif

                @if ($is_creating)
                    <form wire:submit.prevent='postChild' class="mt-4">
                        <input
                            type="text"
                            placeholder="Escribe una respuesta"
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 
                            focus:outline-none focus:ring-yellow-500 focus:border-yellow-500 sm:text-sm"
                            wire:model.defer='body'
                        >
                    </form>
                @endif

                <p class="mt-4 text-sm flex gap-2 justify-end">
                    @auth
                        @if (!$is_creating && !$is_editing && !$is_deleting)
                            <button wire:click="$toggle('is_creating')" 
                                class="text-yellow-600 hover:text-yellow-700">
                                Responder
                            </button>
                        @endif

                        @if ($reply->user_id == auth()->id() || auth()->user()->role === 'admin')
                            @if (!$is_editing && !$is_creating && !$is_deleting)
                                <button wire:click="$toggle('is_editing')"
                                    class="text-yellow-600 hover:text-yellow-700">
                                    Editar
                                </button>

                                <button wire:click="$toggle('is_deleting')"
                                    class="text-red-600 hover:text-red-700">
                                    Eliminar
                                </button>
                            @endif
                        @endif
                    @endauth
                </p>

                @if ($is_deleting)
                    <div class="mt-4 p-4 bg-red-50 rounded-md">
                        <p class="text-red-700">¿Estás seguro de eliminar esta respuesta?</p>
                        <div class="mt-4 flex justify-end gap-2">
                            <button wire:click="$toggle('is_deleting')"
                                class="px-4 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500">
                                Cancelar
                            </button>
                            <button wire:click="delete"
                                class="px-4 py-2 border border-transparent rounded-md text-sm font-medium text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                                Confirmar
                            </button>
                        </div>
                    </div>
                @endif

                @if($reply->replies)
                    <div class="mt-4 space-y-4">
                        @foreach ($reply->replies as $item)
                            <div class="ml-8 border-l border-gray-200 pl-4">
                                @livewire('show-reply', ['reply' => $item], key('reply-' . $item->id))
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    @endif
</div>
