<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Reservation;
use Carbon\Carbon;

class Practice extends Model
{
    use HasFactory;

    protected $fillable = [
        'trainer_id',
        'name',
        'description',
        'capacity',
        'date_time',
        'duration',
    ];

    protected $casts = [
        'date_time' => 'datetime'
    ];

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'reservations');
    }

    public function trainer()
    {
        return $this->belongsTo(User::class, 'trainer_id');
    }
}
