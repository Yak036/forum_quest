<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\Thread;

use Livewire\Component;

class ShowThreads extends Component
{
    public $search = '';
    public $category = '';

    public function filterByCategory($category){
        $this->category = $category;
    }
    public function render()
    {

        //! Escribiendolo asi hacemos que se sumen los resultados para un unico dato mas efectivo
        $categories = Category::get();
        //? trae todas las preguntas contando cuantos de estas tengo
        $threads = Thread::query();
        
        //? vas a buscar en tiempo real lo que escriban en la barra de busqueda
        $threads->where('title', 'like', "%$this->search%");

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
}