<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Thread;
use Illuminate\Http\Request;

class ThreadController extends Controller
{
    public function create(){
        $categories = Category::get();

        return view('thread.create', compact('categories'));
    }

    public function store(Request $request): \Illuminate\Http\RedirectResponse
    {
        // Validar el formulario
        $validatedData = $request->validate([
            'title' => 'required',
            'body' => 'required',
            'category'=> 'required',
        ]);



        // Crear un nuevo hilo

         auth()->user()->threads()->create([
         'title'=> $request->input('title'),
         'body'=> $request->input('body'),
         'category_id'=> $request->input('category'),

         ]);
        session()->flash('success', 'Pregunta creada exitosamente.');
        return redirect()->route('dashboard');
    }

    public function edit(Thread $thread){
        $categories = Category::get();

        return view('thread.edit', compact('categories', 'thread'));
    }

    public function update(Request $request,Thread $thread){
        // Validar el formulario
        $request->validate([
            'title' => 'required',
            'body' => 'required',
            'category'=> 'required',
        ]);

        //Actualizar registro
        $thread->title = $request->input('title');
        $thread->body = $request->input('body');
        $thread->category_id = $request->input('category');
            $thread->save();
        session()->flash('success', 'Pregunta editada exitosamente.');
        return redirect()->route('dashboard');
    }

    public function destroy(Thread $thread)
    {
        $thread->delete();

        session()->flash('success', 'Pregunta eliminada exitosamente.');

        return redirect()->route('dashboard');
    }
}
