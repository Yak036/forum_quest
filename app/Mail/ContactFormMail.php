<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ContactFormMail extends Mailable
{
    use Queueable, SerializesModels;

    public $name;
    public $email;
    public $message;

    // Constructor que recibe los datos del formulario de contacto
    public function __construct($name, $email, $message)
    {
        $this->name = $name;
        $this->email = $email;
        $this->message = $message;
    }

    // Define el sobre del correo (asunto y remitente)
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Nuevo mensaje de contacto',
            from: $this->email
        );
    }

    // Define el contenido del correo
    public function content(): Content
    {
        return new Content(
            view: 'emails.contact',
            with: [
                'name' => $this->name,
                'email' => $this->email,
                'mensaje' => $this->message
            ]
        );
    }

    // Define los archivos adjuntos (actualmente vacío)
    public function attachments(): array
    {
        return [];
    }
}
