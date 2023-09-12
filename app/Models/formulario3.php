<?php
//Este modelo es la conexión a la base de datos "Visitador_medico tabla: formulario3"
//Lo administra "Visitador_medicoController"
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class formulario3 extends Model
{   
    protected $table ="formulario3"; //nombre de la tabla
    protected $primaryKey = "id"; //columna de la llave primaria
    protected $connection ="visitador_medico";
    use HasFactory;
}
