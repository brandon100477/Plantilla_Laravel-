<?php

namespace App\Http\Controllers;

use App\Models\{concepto,liquidacion, login_viaticos, registro_viaticos};
use Illuminate\Http\Request;

class viaticosController extends Controller
{
    public function concepto(){
        return concepto ::all();
    }
    public function liquidacion(){
        return liquidacion ::all();
    }
    public function login_viaticos(){
        return login_viaticos ::all();
    }
    public function registro_viaticos(){
        return registro_viaticos ::all();
    }
}
