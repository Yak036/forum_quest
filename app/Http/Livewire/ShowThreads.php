<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\Thread;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ShowThreads extends Component
{
    public $search = '';
    public $category = '';
    public $selectedCategory = '';
    public function filterByCategory($category){
        $this->category = $category;
        
    }

    public function render()
    {
        //! Escribiendolo asi hacemos que se sumen los resultados para un unico dato mas efectivo
        $categories = Category::withCount('threads')->get();

        //? trae todas las preguntas contando cuantos de estas tengo
        $threads = Thread::query();
        if (request()->routeIs('my_threads')) {
            //? vas a buscar las preguntas del usuario logeado
            $threads->where('user_id', Auth::id());

        } else {
            //? vas a buscar entre todas las preguntas
            $threads->where('title', 'like', "%$this->search%");
        }

        //* si el usuario selecciono una categoria se anidara este where a la consulta
        if ($this->category) {
            $threads->where('category_id', $this->category);

        }
        $threads->withCount('replies');
        $threads->latest();
        return view('livewire.show-threads', [
            'categories'=> $categories,
            'threads'=> $threads->get()
        ]);
    }

    public function show_all(){
        $categories = Category::withCount('threads')->get();

        $threads = Thread::query();
        $threads->where('user_id', Auth()->id());


        return view('livewire.show-my-threads', [
            'categories'=> $categories,
            'threads'=> $threads->get()
        ]);
    }
}
