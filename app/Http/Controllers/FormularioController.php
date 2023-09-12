<?php

namespace App\Http\Controllers;

use App\Models\{formulario1, formulario2, loginadmin, loginsedes};
use Illuminate\Http\Request;

class formularioController extends Controller
{
    public function formulario1(){
        return formulario1 ::all();
    }
    public function formulario2(){
        return formulario2 ::all();
    }
    public function loginadmin(){
        return loginadmin ::all();
    }
    public function loginsedes(){
        return loginsedes ::all();
    }
}
