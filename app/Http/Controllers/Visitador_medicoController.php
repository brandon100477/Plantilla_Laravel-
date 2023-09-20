<?php

namespace App\Http\Controllers;

use App\Models\{formulario3, login_usuarios, sedes, usuario_sedes};
use Illuminate\Support\Facades\{Auth, hash};
use Illuminate\Http\Request;

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
            

            // Obtener el token de acceso del usuario
            $token = auth()->login($usuario);
            // Almacenar el token de acceso en la sesión del usuario
            $request->session()->put('accessToken', $token);
            
            $request->session()->regenerate();
            
            //Sentencia para saber si es administrador o medico y llevarlos a la vista correspondiente.
            if(auth()->user()->tipoUsuario == '1'){
                return redirect()->route('admin.admin');
            }else{
                return redirect()->intended('/medicos');
            }

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

    public function logout(Request $request)
    //Función de cerrar sesión
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }

    //controlador para filtrar el tipo de formulario para agregar (Entre doctores - Instituciones -Centro deportivo)
    public function clasificacionformulario(Request $request){

        $accion = $request->input('tipo');
        $contenido = "";
        if ($accion === 'tipo') {
            $contenido = "Doctores";
            return view('Formularios.Formulario')->with('contenido', $contenido);
        } elseif ($accion === 'tipo2') {
            $contenido = "Instituciones";
            return view('Formularios.Formulario')->with('contenido', $contenido);
        }elseif ($accion === 'tipo3') {
            $contenido = "Centro Deportivo";
            return view('Formularios.Formulario')->with('contenido', $contenido);


    }else{
        return redirect()->back(); // Manejo predeterminado si no se presionó ningún botón válido   
}

    }

    //Gestión para insertar al formulario3 de la DB
    public function formulario3(Request $request){

        $id=auth()->user()->id; //Representa la obtención del ID del usuario que está iniciando sesión
        $agregar = new formulario3();
        //Parte: Actualización de datos
        $agregar -> nombre = $request -> nombre;
        $agregar -> especialidad = $request -> especialidad;
        $agregar -> telefono = $request -> telefono;
        $agregar -> direccion = $request -> direccion;
        $agregar -> ciudad = $request -> ciudad;
        //Parte: IPS donde trabaja
        $agregar -> secretaria = $request -> secretaria;
        $agregar -> tel_ayuda = $request -> tel_ayuda;
        $agregar -> ips_consulta = $request -> ips_consulta;
        $agregar -> ips_cirugia = $request -> ips_cirugia;
        //Parte: Preguntas de indagación 1
        $agregar -> preg_indag1 = $request -> preg_indag1;
        $agregar -> preg_indag2 = $request -> preg_indag2;
        $agregar -> preg_indag3 = $request -> preg_indag3;
        $agregar -> preg_indag4 = $request -> preg_indag4;
        $agregar -> preg_indag5 = $request -> preg_indag5;
        $agregar -> preg_indag6 = $request -> preg_indag6;
        $agregar -> preg_indag7 = $request -> preg_indag7;
        //Parte: Preguntas de indagación 2
        $agregar -> preg_indag8 = $request -> preg_indag8;
        $agregar -> preg_indag9 = $request -> preg_indag9;
        $agregar -> preg_indag10 = $request -> preg_indag10;
        $agregar -> preg_indag11 = $request -> preg_indag11;
        $agregar -> preg_indag12 = $request -> preg_indag12;
        $agregar -> sesion_usuario = $id;
        $agregar -> categoria = $request ->select;
        $agregar -> save();
        return view('tipoFormulario');

    }

    public function tabla(Request $request)
    {
       
        $filtro_nombre =$request->get('documento_campo');
        $filtro_ciudad =$request->get('ciudad_campo');
        $filtro_especialidad =$request->get('especialidad_campo');
        $filtro_select = $request->get('select');
        $datos = formulario3::orderBy('id', 'ASC')
                            ->where('nombre','like', '%'.$filtro_nombre.'%')
                            ->where('ciudad','like', '%'.$filtro_ciudad.'%')
                            ->where('especialidad','like', '%'.$filtro_especialidad.'%')
                            ->where('categoria','like', '%'.$filtro_select.'%')
                            ->where('sesion_usuario','=', auth()->user()->id)
                            /*->paginate(15)*/
                            ->get() ;

        $descargar = $request->input('boton_excel');


        return view('formulariosRegistrados', compact('datos', 'filtro_nombre',  'filtro_especialidad', 'filtro_ciudad', 'filtro_select'));
    }

    public function tabla_actualizar(){


        return view('actualizar_datos_registrados');
    }
}


