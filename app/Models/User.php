<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'last_name',
        'id_number',
        'email',
        'date_of_birth',
        'password',
        'genero',
        'role'
        // 'nationality',
        // 'facebook',
        // 'instagram',
        // 'twitter',
        // 'tiktok',
        // 'personal_page',
        // 'description',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function avatar(){
        // ? una pagina web q verifica si estas registrado y te asigna un avatar
        return 'https://gravatar.com/avatar/' . md5($this->email) . '?s=50';
    }

    public function replies(){
        return $this->hasMany(Reply::class);
    }

    public function threads(){
        return $this->hasMany(Thread::class);
    }

    public function routines()
    {
        return $this->hasMany(Routine::class);
    }
}
