<?php

use App\Http\Controllers\{Visitador_medicoController, formularioController, viaticosController};
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('index');
});

// inicio de sesión
Route::get('/login', [Visitador_medicoController::class, 'login'])->name('auth.authenticate');
Route::post('/login', [Visitador_medicoController::class, 'authenticate'])->name('login');

// Registro
Route::get('/register', [Visitador_medicoController::class, 'register'])->name('auth.register'); //aquí es donde llegan los datos del formulario "register.php" 
Route::post('/register', [Visitador_medicoController::class, 'login_usuarios'])->name('auth.login_usuarios'); //aquí se redireccionan al controlador "Visitador_medicoController"

// cierre de sesión
Route::post('/logout', [Visitador_medicoController::class, 'logout'])->name('auth.logout');

//master template
Route::get('/master', function () { 
    return view('all.father');
});


Route::get('/administrar', [Visitador_medicoController::class, 'adminAuth'])->middleware('auth.admin') ->name('admin.admin'); //Metodo que ayuda a restringir esta vista. "si no se ha autenticado, no podrá ingresar"

//central o pagina principal
Route::get('/medicos', function () {
    return view('medicos');
})->middleware('auth');

Route::get('/formulario', "App\Http\Controllers\FormularioController@formulario2");
Route::get('/viaticos', "App\Http\Controllers\ViaticosController@concepto");
Route::get('/visitadores', "App\Http\Controllers\Visitador_medicoController@formulario3");
