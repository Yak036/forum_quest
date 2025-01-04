<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="bg-white p-8 rounded-lg shadow-md">
        <div class="flex gap-4">
            <div class="">
                <img src="{{$thread->user->avatar()}}" alt="{{$thread->user->name}}" class="rounded-full">
            </div>

            <div class="w-full">
                <h2 class="mb-4 flex items-start justify-between">
                    <a href="{{ route('thread',$thread) }}" class="text-xl font-semibold text-gray-900">
                        {{$thread->title}}
                    </a>
                    <span class="rounded-full text-xs py-2 px-4 capitalize bg-yellow-600 text-white">
                        {{$thread->category->name}}
                    </span>
                </h2>
                <p class="mb-4 text-yellow-600 font-semibold text-sm">
                    {{$thread->user->name}}
                    <span class="text-gray-600">{{$thread->created_at->diffForHumans()}}</span>
                </p>

                <div id="description" class="prose max-w-none text-gray-700">
                    {!! $thread->body !!}
                </div>

                {{-- * Respuestas --}}
                @foreach ($replies as $reply)
                    @livewire('show-reply', ['reply'=> $reply], key('reply-'.$reply->id))
                @endforeach

                {{-- * Formulario --}}
                <form wire:submit.prevent='postReply' class="mt-4">
                    <input
                        type="text"
                        placeholder="Escribe una respuesta"
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 
                        focus:outline-none focus:ring-yellow-500 focus:border-yellow-500 sm:text-sm"
                        wire:model.defer='body'
                    >
                </form>
            </div>
        </div>
    </div>
</div>

<style>
    #description {
        h2, h3, h4 {
            color: #374151;
            margin-bottom: 0.5rem;
        }
        h2 { font-size: 1.5rem; }
        h3 { font-size: 1.25rem; }
        h4 { font-size: 1.125rem; }
    }

    #description ul {
        margin-left: 1.5rem;
        margin-bottom: 1rem;
        list-style-type: disc;
        color: #374151;
    }
    #description ol {
        margin-left: 1.5rem;
        margin-bottom: 1rem;
        list-style-type: decimal;
        color: #374151;
    }
</style>
