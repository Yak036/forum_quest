<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactFormMail;

class ContactController extends Controller
{
    public function index()
    {
        return view('contact');
    }

    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required|regex:/^[a-zA-Z\s]+$/',
            'last_name' => 'required|regex:/^[a-zA-Z\s]+$/',
            'email' => 'required|email',
            'message' => 'required',
        ], [
            'first_name.required' => 'El nombre es obligatorio.',
            'first_name.regex' => 'El nombre solo puede contener letras y espacios.',
            'last_name.required' => 'El apellido es obligatorio.',
            'last_name.regex' => 'El apellido solo puede contener letras y espacios.',
            'email.required' => 'El correo electrónico es obligatorio.',
            'email.email' => 'El correo electrónico debe ser válido.',
            'message.required' => 'El mensaje es obligatorio.',
        ]);
        Mail::to(config('mail.from.address'))->send(new ContactFormMail($request->first_name, $request->email, $request->message));

        return view('contact')->with('success', 'Mensaje enviado correctamente.');
    }
}
