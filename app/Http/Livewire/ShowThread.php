<?php

namespace App\Http\Livewire;

use App\Models\Reply;
use App\Models\Thread;
use Livewire\Component;

class ShowThread extends Component
{
    // ? es obligatorio que al momento de pasar una variable especifiques el Model al que pertenece
    // * En caso de q esta variable sea un objeto completo claro....
    public Thread $thread;
    public $body;

    public function postReply(){
        // validate
        $this->validate([
            'body'=>'required',
        ]);
        // create
        auth()->user()->replies()->create([
            'thread_id'=> $this->thread->id,
            'body'=> $this->body,
        ]);

        // refresh
        $this->body = '';

        // $reply = new Reply();
        // $reply->reply_id = null;
        // $reply->thread_id = $this->thread->id;
        // $reply->user_id = auth()->id();
        // $reply->body = $this->body;

        // $reply->save();
    }

    public function render()
    {

        return view('livewire.show-thread',[
            // vas a traer las respuestas donde sea null el reply_id
            'replies'=>$this->thread
            ->replies()
            ->whereNull("reply_id")
            ->get(),
        ]);
    }
}
