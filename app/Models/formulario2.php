<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class formulario2 extends Model
{
    protected $table ="formulario2"; //nombre de la tabla
    protected $primaryKey = "id"; //columna de la llave primaria
    protected $connection ="formularios_1_y_2";
    use HasFactory;
}