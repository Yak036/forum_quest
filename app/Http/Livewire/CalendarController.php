<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Practice;
use App\Models\Reservation;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class CalendarController extends Component
{
    public $practices;
    public $message = '';
    public $messageType = '';
    public $selectedPractice = null;
    public $showModal = false;

    protected $listeners = ['dateClick' => 'loadPracticesForDate'];

    public function mount()
    {
        $this->loadAllPractices();
    }

    public function loadAllPractices()
    {
        $practices = Practice::with(['reservations', 'trainer'])->get();
        
        $this->practices = $practices->map(function ($practice) {
            $reserved = $practice->reservations->contains('user_id', Auth::id());
            $availableSpots = $practice->capacity - $practice->reservations->count();
            $startTime = Carbon::parse($practice->date_time);
            
            // Determinar el color basado en el estado
            $backgroundColor = '#10B981'; // Verde por defecto (disponible)
            $borderColor = '#059669';
            
            if ($reserved) {
                $backgroundColor = '#FCD34D'; // Amarillo (reservado)
                $borderColor = '#F59E0B';
            } elseif ($availableSpots <= 0) {
                $backgroundColor = '#EF4444'; // Rojo (lleno)
                $borderColor = '#DC2626';
            }
            
            return [
                'id' => $practice->id,
                'title' => $practice->name,
                'start' => $practice->date_time,
                'allDay' => false,
                'backgroundColor' => $backgroundColor,
                'borderColor' => $borderColor,
                'textColor' => '#000000FF',
                'extendedProps' => [
                    'description' => $practice->description,
                    'trainer' => $practice->trainer->name,
                    'capacity' => $practice->capacity,
                    'availableSpots' => $availableSpots,
                    'reserved' => $reserved,
                    'duration' => $practice->duration
                ]
            ];
        });
    }

    public function showPracticeDetails($practiceId)
    {
        $this->selectedPractice = Practice::with(['reservations', 'trainer'])->find($practiceId);
        $this->showModal = true;
    }

    public function closeModal()
    {
        $this->showModal = false;
        $this->selectedPractice = null;
        $this->message = '';
    }

    public function reservePractice($practiceId)
    {
        try {
            $practice = Practice::findOrFail($practiceId);

            if ($practice->reservations->count() >= $practice->capacity) {
                throw new \Exception('Lo sentimos, no hay cupos disponibles para esta práctica.');
            }

            if ($practice->reservations->contains('user_id', auth()->id())) {
                throw new \Exception('Ya tienes una reserva para esta práctica.');
            }

            // La fecha ya viene como Carbon gracias al cast en el modelo
            Reservation::create([
                'user_id' => auth()->id(),
                'practice_id' => $practiceId,
                'date' => $practice->date_time->format('Y-m-d')
            ]);

            $this->loadAllPractices();
            $this->closeModal();
            $this->emit('showAlert', [
                'type' => 'success',
                'title' => 'Éxito',
                'message' => '¡Reserva realizada con éxito!'
            ]);
        } catch (\Exception $e) {
            $this->emit('showAlert', [
                'type' => 'error',
                'title' => 'Error',
                'message' => $e->getMessage()
            ]);
        }
    }

    public function cancelReservation($practiceId)
    {
        try {
            $reservation = Reservation::where('practice_id', $practiceId)
                ->where('user_id', auth()->id())
                ->first();

            if (!$reservation) {
                throw new \Exception('No se encontró la reserva.');
            }
            $reservation->delete();
            
            $this->loadAllPractices();
            $this->closeModal();
            $this->emit('showAlert', [
                'type' => 'success',
                'title' => 'Éxito',
                'message' => 'Reserva cancelada con éxito.'
            ]);
        } catch (\Exception $e) {
            $this->emit('showAlert', [
                'type' => 'error',
                'title' => 'Error',
                'message' => $e->getMessage()
            ]);
        }
    }

    public function render()
    {
        return view('calendar.show-calendar');
    }
}
