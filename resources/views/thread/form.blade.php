<div class="space-y-6">
    <div class="input-group">
        <label for="body" class="block text-gray-700 text-lg font-medium mb-2">Titulo</label>

        <input
            type='text'
            id="body"
            placeholder="Titulo"
            name="title"
            class="w-full rounded-lg border border-gray-300 bg-white px-4 py-2 text-gray-700 focus:border-yellow-500 focus:ring-2 focus:ring-yellow-200"
            style="overflow: hidden; resize: none;"
            oninput="this.style.height = 'auto'; this.style.height = (this.scrollHeight) + 'px';"
            value="{{ isset($thread->title) ? $thread->title : '' }}"
        >
        @error('title')
            <span class="text-red-500">{{ $message }}</span>
        @enderror
    </div>

    <div class="input-group">
        <label for="category" class="block text-gray-700 text-lg font-medium mb-2">Categoría</label>

        <select
            id="category"
            name="category"
            class="w-full rounded-lg border border-gray-300 bg-white px-4 py-2 text-gray-700 focus:border-yellow-500 focus:ring-2 focus:ring-yellow-200"
            style="overflow: hidden; resize: none;"
        >

            @if(isset($thread))
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" {{ ($thread->category_id == $category->id) ? 'selected' : '' }}>{{ $category->name }}</option>
                @endforeach
            @else
                <option value="" disabled selected>Selecciona una categoría</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            @endif
        </select>
        @error('category')
            <span class="text-red-500">{{ $message }}</span>
        @enderror
    </div>

    <div class="input-group">
        <label for="body" class="block text-gray-700 text-lg font-medium mb-2">Escribe tu pregunta</label>

        <textarea
            id="description"
            placeholder="Escribe tu pregunta"
            name="body"
            class="w-full rounded-lg border border-gray-300 bg-white px-4 py-2 text-gray-700 focus:border-yellow-500 focus:ring-2 focus:ring-yellow-200"
            style="overflow: hidden; resize: none;"
            oninput="this.style.height = 'auto'; this.style.height = (this.scrollHeight) + 'px';"
        >{{(isset($thread->body)) ? $thread->body : ''}}</textarea>
        @error('body')
            <span class="text-red-500">{{ $message }}</span>
        @enderror
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            ClassicEditor
                .create(document.querySelector('#description'))

                .catch(error => {
                    console.error(error);
                });
        });
    </script>
</div>
