// Comando para crear controlador livewire
-> php artisan make:livewire show-threads

// Comando para migrar desde 0
-> php artisan migrate:fresh --seed

// Estos comandos funcionan mediante las relaciones en los modelos (Son SUPER importantes){
auth()->user()->replies()->create([
'thread_id'=> $this->thread->id,
'body'=> $this->body,
]);
}

// La proteccion CSRF que provee laravel, es implementada por livewire automaticamente

// Vas a usar funciones como esta como parametro en tus etiquetas HTML para interactuar con los componentes livewire
// Esta detiene el evento por defecto q realice un formulario o cualquier redireccion, con la variable toggle que viene
// Por defecto en tailwind inviertes el valor de otra variable en este caso is_creating la cual creas en tu controlador
// Livewire
wire:click.prevent="$toggle('is_creating')
