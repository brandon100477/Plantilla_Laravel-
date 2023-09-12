<?php
//Este modelo es la conexión a la base de datos "Visitador_medico tabla: login_usuarios"
//Lo administra "Visitador_medicoController"
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class login_usuarios extends Model
{
    protected $table ="login_usuarios"; //nombre de la tabla
    protected $primaryKey = "id"; //columna de la llave primaria
    protected $connection ="visitador_medico";
    use HasFactory;
}
