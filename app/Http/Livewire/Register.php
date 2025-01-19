<?php
namespace App\Http\Livewire;



use App\Models\User;
use App\Models\Country;
use App\Models\States;
use App\Models\Cities;

use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
// use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;


use Livewire\Component;

class Register extends Component
{
    public $name;
    public $last_name;
    public $id_number;
    public $email;
    public $date_of_birth;
    public $password;
    public $password_confirmation;
    public $genero;


    public function render()
    {
        
        return view('livewire.register');
    }

    public function store()
    {
        
        $this->validate([
            'name' => ['required', 'string', 'min:3', 'max:255', 'regex:/^[\p{L}]+$/u'],
            'last_name' => ['required', 'string', 'min:3', 'max:255', 'regex:/^[\p{L}]+$/u'],
            'id_number' => ['required', 'string', 'max:20', 'unique:'.User::class],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'date_of_birth' => ['required', 'date'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'genero' => ['required', 'string'],
        ]);
        
        $user = User::create([
            'name' => $this->name,
            'last_name' => $this->last_name,
            'id_number' => $this->id_number,
            'email' => $this->email,
            'date_of_birth' => $this->date_of_birth,
            'password' => Hash::make($this->password),
            'genero' => $this->genero,
            'role' => 'user',
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }

}
