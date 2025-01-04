<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cities extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'name',
        'state_id',
    ];

    public function states(){
        return $this->hasMany(States::class);
    }
}
