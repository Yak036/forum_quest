<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h2 class="text-2xl font-semibold text-yellow-600 mb-6">
                        Crear nuevo tema
                    </h2>
                    <form action="{{ route('threads.store') }}" method="POST">
                        @csrf
                        @method('POST')

                        @include('thread.form')

                        <input type="submit" value="Hacer una pregunta" id='create-theard' class=" mt-4 cursor-pointer w-full py-4 bg-gradient-to-r from-yellow-600 to-yellow-700 hover:to-yellow-600 text-white/90 font-bold text-xs rounded-md">
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
