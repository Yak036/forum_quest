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
    public $countries;
    public $estates;
    public $cities;
    public $name;
    public $last_name;
    public $id_number;
    public $nationality;
    public $email;
    public $date_of_birth;
    public $password;
    public $password_confirmation;
    public $facebook;
    public $instagram;
    public $twitter;
    public $tiktok;
    public $personal_page;
    public $description;


    public function render()
    {
        
            $this->countries = Country::all();
     
        return view('livewire.register', ['countries'=> $this->countries]);
    }

    public function store()
    {
        
        $this->validate(
            [
                'name' => ['required', 'string', 'min:3', 'max:255', 'regex:/^[\p{L}]+$/u'],
                'last_name' => ['required', 'string', 'min:3', 'max:255', 'regex:/^[\p{L}]+$/u'],
                'id_number' => ['required', 'string', 'max:20', 'unique:'.User::class],
                'nationality' => ['required', 'string', 'max:100'],
                'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
                'date_of_birth' => ['required', 'date'],
                'password' => ['required', 'confirmed', Rules\Password::defaults()],
                'facebook' => ['nullable', 'url', 'regex:/^https:\/\/(www|es-la)\.facebook\.com\/.+$/'],
                'instagram' => ['nullable', 'url', 'regex:/^https:\/\/www\.instagram\.com\/.+$/'],
                'twitter' => ['nullable', 'url', 'regex:/^https:\/\/www\.x\.com\/.+$/'],
                'tiktok' => ['nullable', 'url', 'regex:/^https:\/\/www\.tiktok\.com\/.+$/'],
                'personal_page' => ['nullable', 'url', 'regex:/^https:\/\/.+$/'],
                'description' => ['nullable', 'string', 'max:1000', 'required'],
            ]
        );
        
        $user = User::create([
            'name' => $this->name,
            'last_name' => $this->last_name,
            'id_number' => $this->id_number,
            'nationality' => $this->nationality,
            'email' => $this->email,
            'date_of_birth' => $this->date_of_birth,
            'password' => Hash::make($this->password),
            'facebook' => $this->facebook,
            'instagram' => $this->instagram,
            'twitter' => $this->twitter,
            'tiktok' => $this->tiktok,
            'personal_page' => $this->personal_page,
            'description' => $this->description,
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }


    public function screenShot(Request $request)
    {
        try {
                $grabzIt = new \GrabzIt\GrabzItClient("YjQ5ZmY5OGM1N2FjNDkwOWJjZTI3YWEwYWE0MTEwNTc", "2ke_aUU_zC1hXDr9BQ1QNCg4Q_NQEGpb04sYjDdHjbA");
                $caracteres = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

                $filename = substr(str_shuffle(str_repeat($caracteres, 6)), 0, 6);

                $options = new \GrabzIt\GrabzItImageOptions();
                $options->setFormat("png");

                $grabzIt->URLToImage($request->url, $options);
                //Then call the Save or SaveTo method
                $grabzIt->SaveTo(public_path('screenshots/'.$filename.'.png'));
                return response()->json(['filename' => $filename . '.png']);

        } catch (\Exception $e) {
            return $e;

        }
    }


    public function get_states($id)
    {
        $this->estates = States::where('country_id', $id)->get();
    }

    public function get_cities($id){
        $this->cities = Cities::where('state_id', $id)->get();
    }

}
