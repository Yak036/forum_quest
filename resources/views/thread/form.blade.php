<div class="">

    <div class="input-group">
        <label for="body" class="block text-white/60 text-xl mt-5">Titulo</label>

        <input
            type='text'
            id="body"
            placeholder="Titulo"
            name="title"
            class="bg-slate-800 border-0 rounded-mb w-full text-white/60 max-h-80 text-xl"
            style="border: 1px solid rgba(255, 255, 255, 0.254); overflow: hidden; resize: none;"
            oninput="this.style.height = 'auto'; this.style.height = (this.scrollHeight) + 'px';"
            value="{{ isset($thread->title) ? $thread->title : '' }}"
        >
        @error('title')
            <span class="text-red-500">{{ $message }}</span>
        @enderror

    </div>

    <div class="input-group">
        <label for="category" class="block text-white/60 text-xl mt-5">Categoría</label>

        <select
            id="category"
            name="category"
            class="bg-slate-800 border-0 rounded-mb w-full text-white/60 max-h-80 text-xl"
            style="border: 1px solid rgba(255, 255, 255, 0.254); overflow: hidden; resize: none;"
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
        <label for="body" class="block text-white/60 text-xl mt-5">Escribe tu pregunta</label>

        <textarea
            id="body"
            placeholder="Escribe tu pregunta"
            name="body"
            class="bg-slate-800 border-0 rounded-mb w-full text-white/60 max-h-80 text-xl"
            style="border: 1px solid rgba(255, 255, 255, 0.254); overflow: hidden; resize: none;"
            oninput="this.style.height = 'auto'; this.style.height = (this.scrollHeight) + 'px';"
        >{{(isset($thread->body)) ? $thread->body : ''}}</textarea>
        @error('body')
            <span class="text-red-500">{{ $message }}</span>
        @enderror
    </div>
</div>
