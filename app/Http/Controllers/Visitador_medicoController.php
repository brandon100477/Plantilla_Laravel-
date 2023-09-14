<?php

namespace App\Http\Controllers;

use App\Models\{formulario3, login_usuarios, sedes, usuario_sedes};
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\hash;


    //Este controlador majena todas las tablas de la base de datos de "Visitador_medico"
    //Maneja el inicio y registro de medicos y administradores.
class Visitador_medicoController extends Controller
{
    public function admin()
    {
        return view('index');
    }
    public function adminAuth(Request $request)
    //login validación y autenticación
    {
                return view('admin.admin');

        }
    public function login()
    {
        return view('index');
    }
    public function authenticate(Request $request)
    //login validación y autenticación
    {
        $usuario =login_usuarios::where('usuario', $request->usuario)->first();

        if (Hash::check($request->contrasena, $usuario->contrasena)) {
            //dd(Auth::user());

            // Obtener el token de acceso del usuario
            $token = auth()->login($usuario);
            // Almacenar el token de acceso en la sesión del usuario
            $request->session()->put('accessToken', $token);
            
            $request->session()->regenerate();
            
            if(auth()->user()->tipoUsuario == '1'){
                return redirect()->route('admin.admin');
            }else{
                return redirect()->intended('/medicos');
            }
              //Sentencia para saber si es administrador o medico y llevarlos a la vista correspondiente.

        }else{
            return back()->withErrors([
                'usuario' => 'las credenciales no son correctas']);
        }
        
        
       
        }

    //funciones para que el registro a la tabla "login_usuarios" sea correcta.
    public function register()
    {
        return view('register');
    }
    public function login_usuarios(Request $request){

        $registro = new login_usuarios();
        $registro -> nombreApellido = $request -> nombreApellido;
        $registro -> usuario = $request -> usuario;
        $registro -> contrasena = bcrypt($request->contrasena); //Metodo para encriptar la contraseña por el metodo "Hash"
        $registro -> cedula = $request -> cedula;
        $registro -> telefono = $request -> telefono;
        $registro -> correo = $request -> correo;
        $registro -> tipoUsuario = $request -> tipoUsuario;
        $registro ->save(); //Guarda todo el registro.

        
            return redirect('/medicos');

        //Redirecciona a la pagina principal "Tener en cuenta que para entrar al principal, se debe iniciar primero sesión, por ende primero le pedira su respectivo logueo"
    }
    public function sedes(){
        return sedes ::all();
    }
    public function usuario_sedes(){
        return usuario_sedes ::all();
    }

    public function formulario3(){
        return formulario3 ::all();
    }

    public function logout(Request $request)
    //"Log out" function
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }

}
