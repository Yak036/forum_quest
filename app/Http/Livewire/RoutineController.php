<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Routine;
use App\Models\Exercise;
use App\Models\Progress;
use Illuminate\Support\Facades\Auth;

class RoutineController extends Component
{
    // Propiedades públicas para manejar la selección de rutinas y ejercicios
    public $selectedRoutineId = null;
    public $selectedExerciseId = null;
    public $showProgressForm = false;
    public $showRoutineForm = false;
    public $showExerciseForm = false;

    // Propiedades para el formulario de nueva rutina
    public $newRoutineName = '';
    public $newRoutineDescription = '';
    public $newRoutineDifficulty = 'Principiante';

    // Propiedades para el formulario de nuevo ejercicio
    public $newExerciseName = '';
    public $newExerciseImageUrl = '';
    public $newExerciseVideoUrl = '';
    
    // Propiedades para el formulario de progreso
    public $weight;
    public $reps;
    public $notes;

    // Busqueda de usuario 
    public $search;
    // Reglas de validación para los formularios
    protected $rules = [
        'weight' => 'required|numeric|min:0',
        'reps' => 'required|integer|min:1',
        'notes' => 'nullable|string|max:255',
        'newRoutineName' => 'required|string|min:3|max:255',
        'newRoutineDescription' => 'required|string|min:10|max:1000',
        'newRoutineDifficulty' => 'required|in:Principiante,Intermedio,Avanzado',
        'newExerciseName' => 'required|string|min:3|max:255',
        'newExerciseImageUrl' => 'nullable|url|max:255',
        'newExerciseVideoUrl' => 'nullable|url|max:255'
    ];

    protected $listeners = ['deleteConfirmed' => 'deleteRoutine', 'deleteExerciseConfirmed' => 'deleteExercise'];

    // Método que se ejecuta al montar el componente
    public function mount($routineId = null)
    {
        $this->selectedRoutineId = $routineId;
    }

    // Método para seleccionar una rutina
    public function selectRoutine($routineId)
    {
        $this->selectedRoutineId = $routineId;
        $this->selectedExerciseId = null;
        $this->resetProgressForm();
    }

    // Método para seleccionar un ejercicio
    public function selectExercise($exerciseId)
    {
        $this->selectedExerciseId = $exerciseId;
        $this->showProgressForm = false;
    }

    // Método para mostrar el formulario de progreso
    public function showAddProgress()
    {
        $this->showProgressForm = true;
    }

    // Método para guardar el progreso
    public function saveProgress()
    {
        $this->validate();

        Progress::create([
            'exercise_id' => $this->selectedExerciseId,
            'weight' => $this->weight,
            'reps' => $this->reps,
            'notes' => $this->notes,
            'date' => now()
        ]);

        $this->resetProgressForm();
        session()->flash('message', 'Progreso guardado exitosamente.');
    }

    // Método privado para resetear el formulario de progreso
    private function resetProgressForm()
    {
        $this->weight = '';
        $this->reps = '';
        $this->notes = '';
        $this->showProgressForm = false;
    }

    // Método para mostrar el formulario de creación de rutina
    public function createRoutine()
    {
        $this->showRoutineForm = true;
    }

    // Método para guardar una nueva rutina
    public function saveRoutine()
    {
        $this->validate([
            'newRoutineName' => 'required|string|min:3|max:255',
            'newRoutineDescription' => 'required|string|min:10|max:1000',
            'newRoutineDifficulty' => 'required|in:Principiante,Intermedio,Avanzado'
        ]);

        $routine = Auth::user()->routines()->create([
            'name' => $this->newRoutineName,
            'description' => $this->newRoutineDescription,
            'difficulty' => $this->newRoutineDifficulty
        ]);

        $this->resetRoutineForm();
        $this->selectRoutine($routine->id);
        session()->flash('message', 'Rutina creada exitosamente.');
    }

    // Método para resetear el formulario de rutina
    public function resetRoutineForm()
    {
        $this->newRoutineName = '';
        $this->newRoutineDescription = '';
        $this->newRoutineDifficulty = 'Principiante';
        $this->showRoutineForm = false;
    }

    // Método para cancelar la creación de una rutina
    public function cancelRoutineCreation()
    {
        $this->resetRoutineForm();
    }

    // Método para mostrar el formulario de creación de ejercicio
    public function createExercise()
    {
        $this->showExerciseForm = true;
    }

    // Método para guardar un nuevo ejercicio
    public function saveExercise()
    {
        $this->validate([
            'newExerciseName' => 'required|string|min:3|max:255',
            'newExerciseImageUrl' => 'nullable|url|max:255',
            'newExerciseVideoUrl' => 'nullable|url|max:255'
        ]);

        $exercise = Exercise::create([
            'routine_id' => $this->selectedRoutineId,
            'name' => $this->newExerciseName,
            'image_url' => $this->newExerciseImageUrl,
            'video_url' => $this->newExerciseVideoUrl
        ]);

        $this->resetExerciseForm();
        session()->flash('message', 'Ejercicio creado exitosamente.');
    }

    // Método para resetear el formulario de ejercicio
    public function resetExerciseForm()
    {
        $this->newExerciseName = '';
        $this->newExerciseImageUrl = '';
        $this->newExerciseVideoUrl = '';
        $this->showExerciseForm = false;
    }

    // Método para cancelar la creación de un ejercicio
    public function cancelExerciseCreation()
    {
        $this->resetExerciseForm();
    }

    // Método para eliminar una rutina
    public function deleteRoutine($routineId)
    {
        $routine = Routine::findOrFail($routineId);
        
        if ($routine->user_id !== Auth::id()) {
            session()->flash('error', 'No tienes permiso para eliminar esta rutina.');
            return;
        }

        $routine->delete();

        session()->flash('success', 'La rutina ha sido eliminada exitosamente.');
        $this->selectedRoutineId = null;
    }

    // Método para eliminar un ejercicio
    public function deleteExercise($exerciseId)
    {
        $exercise = Exercise::findOrFail($exerciseId);
        
        if ($exercise->routine->user_id !== Auth::id()) {
            session()->flash('error', 'No tienes permiso para eliminar este ejercicio.');
            return;
        }

        $exercise->delete();
        session()->flash('success', 'El ejercicio ha sido eliminado exitosamente.');
        $this->selectedExerciseId = null;
    }

    // * Método para renderizar la vista
    public function render()
    {
        if ($this->selectedRoutineId) {
            $routine = Routine::findOrFail($this->selectedRoutineId);
            $selectedExercise = null;
            $progress = null;

            if ($this->selectedExerciseId) {
                $selectedExercise = Exercise::findOrFail($this->selectedExerciseId);
                $progress = $selectedExercise->progress()->latest()->get();
            }

            return view('training.show-routine', [
                'routine' => $routine,
                'selectedExercise' => $selectedExercise,
                'progress' => $progress
            ]);
        }

        $allRoutines = Routine::join('users', 'routines.user_id', '=', 'users.id')
    ->where(function ($query) {
        $query->where('routines.name', 'like', '%' . $this->search . '%')
              ->orWhere('routines.description', 'like', '%' . $this->search . '%');
    })
    ->orWhere('users.name', 'like', '%' . $this->search . '%') // Buscar por nombre de usuario
    ->select('routines.*') // Seleccionar solo las columnas de la tabla routines
    ->paginate(9);

        $routines = Auth::user()->routines()->latest()->get();
        return view('training.show-routines', [
            'routines' => $routines,
            'allRoutines'=> $allRoutines
        ]);
    }
}
