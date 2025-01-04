<?php

namespace App\Http\Controllers\Auth;
use GrabzIt\GrabzItClient;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{

    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {

        $request->validate(
            [
                'name' => ['required', 'string', 'max:255'],
                'last_name' => ['required', 'string', 'max:255'],
                'id_number' => ['required', 'string', 'max:20'],
                'nationality' => ['required', 'string', 'max:100'],
                'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
                'date_of_birth' => ['required', 'date'],
                'password' => ['required', 'confirmed', Rules\Password::defaults()],
                'facebook' => ['nullable', 'url', 'regex:/^https:\/\/(www|es-la)\.facebook\.com\/.+$/'],
                'instagram' => ['nullable', 'url', 'regex:/^https:\/\/www\.instagram\.com\/.+$/'],
                'twitter' => ['nullable', 'url', 'regex:/^https:\/\/www\.x\.com\/.+$/'],
                'tiktok' => ['nullable', 'url', 'regex:/^https:\/\/www\.tiktok\.com\/.+$/'],
                'personal_page' => ['nullable', 'url', 'regex:/^https:\/\/.+$/'],
                'description' => ['nullable', 'string', 'max:1000'],
            ], [
                // 'facebook.regex' => 'El enlace de Facebook debe ser una URL válida de Facebook.',
                // 'instagram.regex' => 'El enlace de Instagram debe ser una URL válida de Instagram.',
                // 'twitter.regex' => 'El enlace de Twitter debe ser una URL válida de Twitter.',
                // 'tiktok.regex' => 'El enlace de TikTok debe ser una URL válida de TikTok.',
                // 'personal_page.regex' => 'El enlace de la página personal debe ser una URL válida.',
            ]
        );

        $user = User::create([
            'name' => $request->name,
            'last_name' => $request->last_name,
            'id_number' => $request->id_number,
            'nationality' => $request->nationality,
            'email' => $request->email,
            'date_of_birth' => $request->date_of_birth,
            'password' => Hash::make($request->password),
            'facebook' => $request->facebook,
            'instagram' => $request->instagram,
            'twitter' => $request->twitter,
            'tiktok' => $request->tiktok,
            'personal_page' => $request->personal_page,
            'description' => $request->description,
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }


    public function screenShot(Request $request)
    {
        try {
                $grabzIt = new \GrabzIt\GrabzItClient("YjQ5ZmY5OGM1N2FjNDkwOWJjZTI3YWEwYWE0MTEwNTc", "tyFXdmgVcODTvnckcjwIQAP9jqkX7h2hAN3rnikNHxQ");
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
}
