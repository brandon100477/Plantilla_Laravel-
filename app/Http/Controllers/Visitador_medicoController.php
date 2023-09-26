<?php

namespace App\Http\Controllers;

use App\Models\{formulario3, login_usuarios, sedes, usuario_sedes};
use Illuminate\Support\Facades\{Auth, hash};
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use Illuminate\Support\Facades\Response;

    //Este controlador majena todas las tablas de la base de datos de "Visitador_medico"
    //Maneja el inicio y registro de medicos y administradores.
class Visitador_medicoController extends Controller
{
    public function admin()
    {
        return view('index');
    }
    public function adminAuth(Request $request)
    //login validación y autenticación para administradores
    {
        $datos = login_usuarios::all();
        return view('admin.admin')->with('datos', $datos);
    }
    public function login()
    {
        return view('index');
    }
    public function authenticate(Request $request)
    //login validación y autenticación usuarios
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
                return redirect()->intended('/administrar');
            }else{
                return redirect()->intended('/medicos');
            }
        }else{
            return back()->withErrors(['usuario' => 'las credenciales no son correctas']);
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
    /* Se muestra la tabla de registros */
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
        return view('formulariosRegistrados', compact('datos', 'filtro_nombre',  'filtro_especialidad', 'filtro_ciudad', 'filtro_select'));
    }

/* Procesos para actualizar los registros*/
    public function tabla_actualizar(Request $request){
        $id = $request->input('actualizar_id');
        $datos_actualizar = formulario3::where('id', $id)
                            ->where('sesion_usuario','=', auth()->user()->id)
                            ->get();
        foreach ($datos_actualizar as $dato) {
            $id= $dato->id;
            $nombre = $dato->nombre;
            $especialidad = $dato->especialidad;
            $telefono = $dato->telefono;
            $direccion = $dato->direccion;
            $ciudad = $dato->ciudad;
            $secretaria = $dato->secretaria;
            $tel_ayuda = $dato->tel_ayuda;
            $ips_consulta = $dato->ips_consulta;
            $ips_cirugia = $dato->ips_cirugia;
            $preg_indag1= $dato->preg_indag1;
            $preg_indag2= $dato->preg_indag2;
            $preg_indag3= $dato->preg_indag3;
            $preg_indag4= $dato->preg_indag4;
            $preg_indag5= $dato->preg_indag5;
            $preg_indag6= $dato->preg_indag6;
            $preg_indag7= $dato->preg_indag7;
            $preg_indag8= $dato->preg_indag8;
            $preg_indag9= $dato->preg_indag9;
            $preg_indag10= $dato->preg_indag10;
            $preg_indag11= $dato->preg_indag11;
            $preg_indag12= $dato->preg_indag12;
        }
        return view('actualizar_datos_registrados', compact('id','nombre', 'especialidad', 'telefono', 'direccion', 'ciudad', 'secretaria', 'tel_ayuda', 'ips_consulta', 'ips_cirugia', 'preg_indag1', 'preg_indag2', 'preg_indag3', 'preg_indag4', 'preg_indag5', 'preg_indag6', 'preg_indag7', 'preg_indag8', 'preg_indag9', 'preg_indag10', 'preg_indag11', 'preg_indag12'));
    }
    /* Proceso para actualizar los datos y guardarlos en la DB */
    public function proceso_actualizar(Request $request){
        $id = $request->input('id');
        $datos_actualizar = formulario3::findOrfail($id);
        $datos_actualizar->id= $id;
        $datos_actualizar->nombre = $request->input('nombre');
        $datos_actualizar->especialidad = $request->input('especialidad');
        $datos_actualizar->telefono = $request->input('telefono');
        $datos_actualizar->direccion = $request->input('direccion');
        $datos_actualizar->ciudad = $request->input('ciudad');
        $datos_actualizar->secretaria = $request->input('secretaria');
        $datos_actualizar->tel_ayuda = $request->input('tel_ayuda');
        $datos_actualizar->ips_consulta = $request->input('ips_consulta');
        $datos_actualizar->ips_cirugia = $request->input('ips_cirugia');
        $datos_actualizar->preg_indag1 = $request->preg_indag1;
        $datos_actualizar->preg_indag2 = $request->input('preg_indag2');
        $datos_actualizar->preg_indag3 = $request->input('preg_indag3');
        $datos_actualizar->preg_indag4 = $request->input('preg_indag4');
        $datos_actualizar->preg_indag5 = $request->input('preg_indag5');
        $datos_actualizar->preg_indag6 = $request->input('preg_indag6');
        $datos_actualizar->preg_indag7 = $request->input('preg_indag7');
        $datos_actualizar->preg_indag8 = $request->input('preg_indag8');
        $datos_actualizar->preg_indag9 = $request->input('preg_indag9');
        $datos_actualizar->preg_indag10 = $request->input('preg_indag10');
        $datos_actualizar->preg_indag11 = $request->input('preg_indag11');
        $datos_actualizar->preg_indag12 = $request->input('preg_indag12');
        $datos_actualizar -> save();
        return $this->tabla(new Request());
    }
    /* Exportación de Excel */
    public function exportar_excel(Request $request)
    {    
        // Obtenemos los datos de la base de datos
        $datos = formulario3::orderBy('id', 'ASC')
            ->where('nombre', 'like', '%' . $request->get('documento_campo') . '%')
            ->where('ciudad', 'like', '%' . $request->get('ciudad_campo') . '%')
            ->where('especialidad', 'like', '%' . $request->get('especialidad_campo') . '%')
            ->where('categoria', 'like', '%' . $request->get('select') . '%')
            ->where('sesion_usuario', '=', auth()->user()->id)
            ->get(); 
        // Obtiene los IDs de las filas seleccionadas
        $idsSeleccionados = explode(',', $request->input('seleccionados', ''));
        // Crea una nueva hoja de cálculo
        $spreadsheet = new Spreadsheet();
        // Agrega los encabezados de las columnas y estilos
        $spreadsheet->getActiveSheet()->setCellValue('A1', 'Nombre');
        $spreadsheet->getActiveSheet()->setCellValue('B1', 'Especialidad');
        $spreadsheet->getActiveSheet()->setCellValue('C1', 'Teléfono');
        $spreadsheet->getActiveSheet()->setCellValue('D1', 'Dirección');
        $spreadsheet->getActiveSheet()->setCellValue('E1', 'Ciudad');
        $spreadsheet->getActiveSheet()->getColumnDimension('A')->setWidth(40);
        $spreadsheet->getActiveSheet()->getColumnDimension('B')->setWidth(25);
        $spreadsheet->getActiveSheet()->getColumnDimension('C')->setWidth(28);
        $spreadsheet->getActiveSheet()->getColumnDimension('D')->setWidth(60);
        $spreadsheet->getActiveSheet()->getColumnDimension('E')->setWidth(10);
        $spreadsheet->getActiveSheet()->getStyle('A1:E1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER); // Centrar los encabezados
        $spreadsheet->getActiveSheet()->getStyle('A1:E1')->getFont()->setBold(true); // Negrita
        $spreadsheet->getActiveSheet()->getStyle('A1:E1')->getFont()->setSize(15); $i=2; // Tamaño personalizado
        // Recorre los datos y los escribe en la hoja de cálculo
        foreach ($datos as $dato) {
            $spreadsheet->getActiveSheet()->setCellValue('A' . $i, $dato->nombre);
            $spreadsheet->getActiveSheet()->setCellValue('B' . $i, $dato->especialidad);
            $spreadsheet->getActiveSheet()->setCellValue('C' . $i, $dato->telefono);
            $spreadsheet->getActiveSheet()->setCellValue('D' . $i, $dato->direccion);
            $spreadsheet->getActiveSheet()->setCellValue('E' . $i, $dato->ciudad);
            $i++;
        }
        // Guarda el archivo Excel en un directorio temporal
        $writer = new Xlsx($spreadsheet);
        $tempPath = tempnam(sys_get_temp_dir(), 'registro_');
        $writer->save($tempPath);
        // Envía el archivo Excel al navegador
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="registro.Xlsx"');
        header('Cache-Control: max-age=0');
        readfile($tempPath);
        // Elimina el archivo Excel temporal
        unlink($tempPath);
    }
    /* Proceso para eliminar los datos */
    public function eliminar(Request $request){
    $id = $request->input('eliminar_id');
    // Realiza la lógica de eliminación, por ejemplo:
    formulario3::where('id', $id)->delete();
    // Redirecciona de vuelta a la página anterior o a donde desees
    return redirect()->back()->with('success', 'Registro eliminado exitosamente');
    }

    public function acceder(Request $request){
         $id = $request->input('id');
        $tipoUsuario ="";
        $datos = login_usuarios::where('id', $id)
                            ->first();
        $datos->tipoUsuario = $tipoUsuario; 
       $tipoUsuario = $datos->tipoUsuario; 
         dd($tipoUsuario);
          if (Hash::check($request->input('id'), $datos->id)) {  
             //Obtener el token de acceso del usuario
             $token = auth()->login($datos);  
             //Almacenar el token de acceso en la sesión del usuario
             $request->session()->put('accessToken', $token);
            $request->session()->regenerate();
            return view('medicos');
    } 
/*     $ide = $request->input('id');
    $datos = login_usuarios::find($ide);
    if (!$datos) {
        // Manejo de error si el usuario no se encuentra
        return redirect()->back()->with('error', 'Usuario no encontrado.');
    }
     // Verifica la autenticación (esto dependerá de cómo estés manejando la autenticación en tu aplicación)
    if (Hash::check($request->input('id'), $datos->id)) { 
        // Obtiene el token de acceso del usuario
        $token = auth()->login($datos); 
         // Almacena el token de acceso en la sesión del usuario
        $request->session()->put('accessToken', $token);
        $request->session()->regenerate();
         return redirect()->route('medicos');
    } else {
        // Manejo de error si la autenticación falla
        return redirect()->back()->with('error', 'Autenticación fallida.');

    } */
}
}