<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Routine;
use App\Models\Progress;

class Exercise extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'image_url',
        'video_url',
        'routine_id'
    ];

    public function routine()
    {
        return $this->belongsTo(Routine::class);
    }

    public function progress()
    {
        return $this->hasMany(Progress::class);
    }
}
