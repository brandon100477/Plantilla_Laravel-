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

Route::controller(Visitador_medicoController::class)->group(function(){
    // inicio de sesión
    Route::get('/login', 'login')->name('auth.authenticate');
    Route::post('/login', 'authenticate')->name('login');

    //Inicio de sesión de administrador
    Route::get('/administrar', 'adminAuth')->middleware('auth.admin') ->name('admin.admin'); //Metodo que ayuda a restringir esta vista. "si no se ha autenticado, no podrá ingresar"

    // Registro
    Route::get('/register', 'register')->name('auth.register'); //aquí es donde llegan los datos del formulario "register.php" 
    Route::post('/register', 'login_usuarios')->name('auth.login_usuarios'); //aquí se redireccionan al controlador "Visitador_medicoController"

    // cierre de sesión
    Route::post('/logout', 'logout')->name('auth.logout');

    //Ruta para el formulario de Doctores
    Route::post('medicos/tipo-de-formulario/Doctores','clasificacionformulario')->name('clasificacion');
    Route::get('medicos/tipo-de-formulario/Doctores','clasificacionformulario')->name('clasificacion');



});

//master template
Route::get('/master', function () { 
    return view('all.father');
});

//Rutas para los medicos:
Route::get('/medicos', function () {
    return view('medicos');
})->middleware('auth');

//Ruta para Diligenciar formulario
Route::get('medicos/tipo-de-formulario', function () {
    return view('tipoFormulario');
})->middleware('auth');


//Ruta para ver los formularios registrados
Route::get('medicos/formularios-registrados', function () {
    return view('formulariosRegistrados');
})->middleware('auth');