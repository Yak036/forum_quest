<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;
use App\Models\Practice;

class PracticeController extends Component
{
    public $message;
    public $messageType;
    public $showCreateForm = false;
    public $showEditForm = false;
    public $editingPracticeId;
    public $name;
    public $description;
    public $capacity;
    public $date_time;
    public $duration;
    public $trainer_id;
    public $search;
    protected $listeners = ['deletePractice'];
    public $filter = 'date_time';
    public $asc = true;
    

    protected $rules = [
        'name' => 'required|string|min:3|max:255|regex:/^[^0-9]*$/',
        'description' => 'required|string|min:5',
        'capacity' => 'required|integer|min:5|max:20',
        'date_time' => 'required|date|after_or_equal:today|after:now',
        'duration' => 'required|integer|min:15',
        'trainer_id' => 'required|exists:users,id',
    ];

    public function render()
    {
        $user = auth()->user();
        $practicesQuery = Practice::with('reservations')
            ->where(function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%')
                    ->orWhere('description', 'like', '%' . $this->search . '%');
            });

        // Aplicar el ordenamiento según el filtro seleccionado
        if ($this->filter === 'reservations') {
            $practicesQuery->withCount('reservations')
                          ->orderBy('reservations_count', $this->asc ? 'asc' : 'desc');
        } else {
            $practicesQuery->orderBy($this->filter, $this->asc ? 'asc' : 'desc');
        }
        
        if ($user->role === 'admin') {
            $practices = $practicesQuery->paginate(9);
        } elseif ($user->role === 'trainer') {
            $practices = $practicesQuery->where('trainer_id', $user->id)->paginate(10);
        } else {
            $practices = collect();
        }

        return view('calendar.practice', [
            'trainers' => User::where('role', 'trainer')->get(),
            'practices' => $practices
        ]);
    }

    // ? funcion para los filtros
    public function filter($filter)
    {
        $this->asc = !$this->asc;
        $this->filter = $filter;
    }

    public function createPractice()
    {
        $this->validate();

        try {
            Practice::create([
                'name' => $this->name,
                'description' => $this->description,
                'capacity' => $this->capacity,
                'date_time' => $this->date_time,
                'duration' => $this->duration,
                'trainer_id' => $this->trainer_id
            ]);

            $this->reset(['name', 'description', 'capacity', 'date_time', 'duration', 'trainer_id']);
            $this->showCreateForm = false;
            $this->emit('showAlert', [
                'type' => 'success',
                'title' => 'Éxito',
                'message' => 'Clase creada correctamente'
            ]);
            $this->emit('practicesUpdated');
        } catch (\Exception $e) {
            $this->emit('showAlert', [
                'type' => 'error',
                'title' => 'Error',
                'message' => 'Error al crear la clase: ' . $e->getMessage()
            ]);
        }
    }

    public function editPractice($practiceId)
    {
        $practice = Practice::findOrFail($practiceId);
        $this->editingPracticeId = $practiceId;
        $this->name = $practice->name;
        $this->description = $practice->description;
        $this->capacity = $practice->capacity;
        $this->date_time = $practice->date_time->format('Y-m-d\TH:i');
        $this->duration = $practice->duration;
        $this->trainer_id = $practice->trainer_id;
        $this->showEditForm = true;
        $this->showCreateForm = false;
    }

    public function cancelEdit()
    {
        $this->reset(['editingPracticeId', 'name', 'description', 'capacity', 'date_time', 'duration', 'trainer_id']);
        $this->showEditForm = false;
    }

    public function updatePractice()
    {
        $this->validate();

        try {
            $practice = Practice::findOrFail($this->editingPracticeId);
            $practice->update([
                'name' => $this->name,
                'description' => $this->description,
                'capacity' => $this->capacity,
                'date_time' => $this->date_time,
                'duration' => $this->duration,
                'trainer_id' => $this->trainer_id
            ]);

            $this->reset(['editingPracticeId', 'name', 'description', 'capacity', 'date_time', 'duration', 'trainer_id']);
            $this->showEditForm = false;
            $this->emit('showAlert', [
                'type' => 'success',
                'title' => 'Éxito',
                'message' => 'Práctica actualizada correctamente'
            ]);
            $this->emit('practicesUpdated');
        } catch (\Exception $e) {
            $this->emit('showAlert', [
                'type' => 'error',
                'title' => 'Error',
                'message' => 'Error al actualizar la práctica: ' . $e->getMessage()
            ]);
        }
    }

    public function deletePractice($id)
    {
        try {

            $practice = Practice::findOrFail($id);
            
            if (auth()->user()->role !== 'admin') {
                // dd('wawa');
                throw new \Exception('No tienes permiso para eliminar esta clase');
            }

            //* Codigo para no eliminar practicas con reservas activas
            // if ($practice->reservations->count() > 0) {
            //     throw new \Exception('No puedes eliminar una clase con reservas activas');
            // }
     
            $practice->delete();
            $this->emit('showAlert', [
                'type' => 'success',
                'title' => 'Éxito',
                'message' => 'Clase eliminada correctamente'
            ]);
            $this->emit('practicesUpdated');
        } catch (\Exception $e) {
            $this->emit('showAlert', [
                'type' => 'error',
                'title' => 'Error',
                'message' => $e->getMessage()
            ]);
        }
    }
}
