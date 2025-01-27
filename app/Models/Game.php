<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    use HasFactory;

    // Campos asignables
    protected $fillable = [
        'user_id', 'score', 'date'
    ];

    // Relaciones
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function gameQuestions()
    {
        return $this->hasMany(GameQuestion::class);
    }

    public function answers()
    {
        return $this->hasMany(Answer::class);
    }
}

