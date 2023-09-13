<?php
//Este modelo es la conexión a la base de datos "Visitador_medico tabla: login_usuarios"
//Lo administra "Visitador_medicoController"
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;


class login_usuarios extends Authenticatable
{
    protected $connection ="visitador_medico";
    protected $table ="login_usuarios"; //nombre de la tabla
    protected $primaryKey = "id"; //columna de la llave primaria
    

    protected $hidden = [
        'contrasena'
    ];
    use HasApiTokens, HasFactory, Notifiable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'usuario',
        'contrasena',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'usuario_verified_at' => 'datetime',
        'contrasena' => 'hashed',
    ];
}

