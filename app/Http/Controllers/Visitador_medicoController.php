<?php

namespace App\Http\Controllers;

use App\Models\{formulario3, login_usuarios, sedes, usuario_sedes};
use Illuminate\Http\Request;

class Visitador_medicoController extends Controller
{
    public function formulario3(){
        return formulario3 ::all();
    }
    public function login_usuarios(){
        return login_usuarios ::all();
    }
    public function sedes(){
        return sedes ::all();
    }
    public function usuario_sedes(){
        return usuario_sedes ::all();
    }
}
