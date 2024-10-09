
<div class="">
    <div class="rounded-md bg-gradient-to-r from-slate-800 to-slate-900 hover:to-slate-800 mb-4">
        <div class="p-4 flex gap-4">
            <div class="">
                <img src="{{$reply->user->avatar()}}" alt="{{$reply->user->name}}">
            </div>

            <div class="w-full">
                <p class="mb-2 text-blue-600 font-semibold text-xs">

                        {{$reply->user->name}}
                    
                </p>
                @if ($is_editing)
                        {{-- * Formulario --}}
                    <form wire:submit.prevent='updateReply' class="mt-4">
                        <input 
                            type="text" 
                            placeholder="Escribe una respuesta" 
                            name="" 
                            class="bg-slate-800 border-0 rounded-mb w-full text-white/60 text-xs"
                            style="border: 1px solid rgba(255, 255, 255, 0.254);"
                            {{-- ? Con esta consulta mejoras un poco el rendimiento del sistema --}}
                            wire:model.defe='body'
                        >
                    </form>
                @else 
                    <p class="text-white/60">
                        {{$reply->body}}
                    </p>
                @endif

                
                
                @if ($is_creating)
                        {{-- * Formulario --}}
                    <form wire:submit.prevent='postChild' class="mt-4">
                        <input 
                            type="text" 
                            placeholder="Escribe una respuesta" 
                            name="" 
                            class="bg-slate-800 border-0 rounded-mb w-full text-white/60 text-xs"
                            style="border: 1px solid rgba(255, 255, 255, 0.254);"
                            {{-- ? Con esta consulta mejoras un poco el rendimiento del sistema --}}
                            wire:model.defe='body'
                        >
                    </form>
                @endif
                    
                    <p class="mt-4 text-white/60 text-xs flex gap-2 justify-end">
                        @if (is_null($reply->reply_id))
                        <a href="#" wire:click.prevent="$toggle('is_creating')" class="hover:text-white">Responder</a>
                        @endif

                        @can('update', $reply)
                            <a href="#" wire:click.prevent="$toggle('is_editing')" class="hover:text-white">Editar</a>
                        @endcan
                    </p>
                
            </div>
        </div>
    </div>

    @foreach($reply->replies as $item)
    <div class="ml-8">
        @livewire('show-reply', ['reply' => $item], key('reply-'.$item->id))
    </div>
    @endforeach
</div>
