<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Exercise;

class Routine extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'difficulty',
        'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function exercises()
    {
        return $this->hasMany(Exercise::class);
    }
}
