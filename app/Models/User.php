<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;  // Importa la clase Authenticatable
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;  // Asegúrate de usar Notifiable para notificaciones
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable  // Cambia de Model a Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens;  // Asegúrate de usar el trait Notifiable para notificaciones

     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'nickname',
        'email',
        'password',
        'role',
        'birth_date',
        'avatar',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // Relaciones
    public function games()
    {
        return $this->hasMany(Game::class);
    }

    public function rankings()
    {
        return $this->hasOne(Ranking::class);
    }

    // Si tienes otros métodos personalizados para la autenticación o validación,
    // puedes agregarlos aquí.
}

