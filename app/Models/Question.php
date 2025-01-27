<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    // Campos asignables
    protected $fillable = [
        'question', 'option_a', 'option_b', 'option_c','correct_option', 'media_url'
    ];

    // Relaciones
    public function gameQuestions()
    {
        return $this->hasMany(GameQuestion::class);
    }

    public function answers()
    {
        return $this->hasMany(Answer::class);
    }
}
