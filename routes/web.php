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
    Route::get('/register', 'register')->name('auth.register'); //GET:Se envian los datos por URL
    Route::post('/register', 'login_usuarios')->name('auth.login_usuarios'); //POST:Se envían los datos de forma oculta

    // cierre de sesión
    Route::post('/logout', 'logout')->name('auth.logout')->middleware('auth');

    //Ruta para el formulario de Doctores
    Route::post('medicos/tipo-de-formulario/Doctores','clasificacionformulario')->name('clasificacion')->middleware('auth');
    Route::get('medicos/tipo-de-formulario/Doctores','clasificacionformulario')->name('clasificacion')->middleware('auth');

    //Ruta para insertar los datos al formulario.
    Route::post('medicos/tipo-de-formulario','formulario3')->name('insertar')->middleware('auth');
    Route::get('medicos/tipo-de-formulario','formulario3')->name('insertar')->middleware('auth');

    //Ruta para ver los formularios registrados
    Route::get('medicos/formularios-registrados', 'tabla')->name('registrados')->middleware('auth');

    //Ruta para actualizar los formularios registrados
    Route::get('medicos/formularios-registrados/Actualizar', 'tabla_actualizar')->name('actualizar')->middleware('auth');
    Route::post('medicos/formularios-registrados/Actualizar', 'tabla_actualizar')->name('actualizar')->middleware('auth');

    //Ruta para actualizar los datos de los registros
    Route::get('medicos/formularios-registrados/Actualizar/Actualizado', 'proceso_actualizar')->name('actualizado')->middleware('auth');
    Route::post('medicos/formularios-registrados/Actualizar/Actualizado', 'proceso_actualizar')->name('actualizado')->middleware('auth');

    //Ruta para exportar los excel's 
    Route::post('medicos/formularios-registrados/Exportar', 'exportar_excel')->name('exportar')->middleware('auth');
    Route::post('medicos/formularios-registrados/Eliminar', 'eliminar')->name('eliminar')->middleware('auth');

    //Ruta para acceder desde un administrador a otro medico
    Route::post('/{id}','acceder')->name('acceder')->middleware('auth');
});


//master template
Route::get('/master', function () { 
    return view('all.father');
});

//Rutas para los medicos:
Route::get('/medicos', function () {
    return view('medicos');
})->middleware('auth');

//Ruta para regresar a la vista de medicos:
Route::get('/medicos', function () {
    return view('medicos');
})->middleware('auth')->name('volver1');

//Ruta para Diligenciar formulario
Route::get('medicos/tipo-de-formulario', function () {
    return view('tipoFormulario');
})->middleware('auth');

//Ruta para regresar a la vista de tipo de formulario (doctores - instituciones - centro deportivo):
Route::get('medicos/tipo-de-formulario', function () {
    return view('tipoFormulario');
})->middleware('auth')->name('volver');





