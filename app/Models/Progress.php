<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Exercise;

class Progress extends Model
{
    use HasFactory;

    protected $fillable = [
        'weight',
        'reps',
        'notes',
        'date',
        'exercise_id'
    ];

    protected $casts = [
        'date' => 'datetime',
    ];

    public function exercise()
    {
        return $this->belongsTo(Exercise::class);
    }
}
