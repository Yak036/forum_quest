<?php

namespace App\Http\Livewire;

use App\Models\Reply;
use App\Models\Thread;
use Livewire\Component;

class ShowThread extends Component
{
    public Thread $thread;
    public $body;

    protected $listeners = ['refreshThread' => '$refresh'];

    public function postReply()
    {
        $this->validate([
            'body' => 'required',
        ]);

        auth()->user()->replies()->create([
            'thread_id' => $this->thread->id,
            'body' => $this->body,
        ]);

        $this->body = '';
        $this->emit('refreshThread');
    }

    public function render()
    {
        $this->thread = Thread::with(['replies.user', 'replies.replies.user'])
            ->find($this->thread->id);

        return view('livewire.show-thread', [
            'replies' => $this->thread
                ->replies()
                ->whereNull('reply_id')
                ->with(['user', 'replies.user'])
                ->get(),
        ]);
    }
}
