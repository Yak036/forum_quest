<?php

namespace App\Http\Livewire;

use App\Models\User;
use App\Models\Category;
use Livewire\Component;
use Livewire\WithPagination;

class AdminPanel extends Component
{
    use WithPagination;

    public $showCategoryModal = false;
    public $categoryName = '';
    public $categoryColor = '#000000';
    public $delete = false;
    public $search = '';
    protected $listeners = [
        'open-category-modal' => 'openModal',
        'deleteCategory' => 'deleteCategory'
    ];

    protected $rules = [
        'categoryName' => 'required|min:3|max:50',
        'categoryColor' => 'required|regex:/^#[a-fA-F0-9]{6}$/',
    ];

    //? eliminar categoria
    public function deleteCategory($categoryId)
    {
        
        $category = Category::findOrFail($categoryId);
        $category->delete();
    }


    //? Abrir modal
    public function openModal()
    {
        $this->dispatchBrowserEvent('open-category-modal');
    }

    //? Renderizar componentes
    public function render()
    {
        if($this->search){
            $users = User::where('email', '!=', 'ramcesvedes@gmail.com')
            ->where('id', '!=', auth()->id())
            ->where('name', 'like', "%$this->search%")
            ->orWhere('email', 'like', "%$this->search%")
            ->orderBy('created_at', 'desc')
            ->paginate(5);
        }else{
            $users = User::where('email', '!=', 'ramcesvedes@gmail.com')
            ->where('id', '!=', auth()->id())
            ->orderBy('created_at', 'desc')
            ->paginate(5);
        }
        

        $categories = Category::orderBy('name')->get();

        return view('livewire.admin-panel', [
            'users' => $users,
            'categories' => $categories,
        ]);
    }

    //? Crear categoria
    public function createCategory()
    {
        $this->validate();

        Category::create([
            'name' => $this->categoryName,
            'color' => $this->categoryColor,
        ]);

        $this->reset(['categoryName', 'categoryColor']);
        $this->dispatchBrowserEvent('close-category-modal');
        $this->emit('categoryCreated', 'Categoría creada exitosamente');
    }

    //? cambiar rol
    public function changeRole($userId, $role)
    {

        $user = User::findOrFail($userId);
        $user->role = $role;
        $user->save();

        session()->flash('message', "Se cambio el rol correctamente del usuario  {$user->name}.");
    }

}
