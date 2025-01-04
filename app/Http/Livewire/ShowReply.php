<?php

namespace App\Http\Livewire;

use App\Models\Reply;
use Livewire\Component;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class ShowReply extends Component
{
    use AuthorizesRequests;

    public Reply $reply;
    public $body = '';
    public $is_creating = false;
    public $is_editing = false;
    public $is_deleting = false;

    protected $listeners = ['refreshThread' => '$refresh'];

    public function updatedIsCreating()
    {
        $this->is_editing = false;
        $this->is_deleting = false;
        $this->body = '';
    }

    public function updatedIsDeleting()
    {
        $this->is_creating = false;
        $this->is_editing = false;
        $this->body = '';
    }

    public function updatedIsEditing()
    {
        $this->authorize('update', $this->reply);
        $this->is_creating = false;
        $this->is_deleting = false;
        $this->body = $this->reply->body;
    }

    public function postChild()
    {
        if(!auth()->check()){
            return redirect()->route('login');
        }

        $this->validate(['body' => 'required']);

        auth()->user()->replies()->create([
            'reply_id' => $this->reply->id,
            'thread_id' => $this->reply->thread->id,
            'body' => $this->body
        ]);

        $this->is_creating = false;
        $this->body = '';
        
        $this->emit('refreshThread');
    }

    public function updateReply()
    {
        $this->authorize('update', $this->reply);

        $this->validate(['body' => 'required']);

        $this->reply->update(['body' => $this->body]);

        $this->is_editing = false;
        $this->body = '';

        $this->emit('refreshThread');
    }

    public function delete()
    {
        $this->authorize('delete', $this->reply);
        
        // Eliminar primero las respuestas hijas
        $this->reply->replies()->delete();
        // Luego eliminar la respuesta principal
        $this->reply->delete();

        // Emitir evento para actualizar todo el thread
        $this->emit('refreshThread');
    }

    public function render()
    {
        return view('livewire.show-reply');
    }
}
