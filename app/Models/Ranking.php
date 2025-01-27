<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ranking extends Model
{
    use HasFactory;

    // Campos asignables
    protected $fillable = [
        'user_id', 'weekly_score', 'total_score'
    ];

    // Relaciones
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

