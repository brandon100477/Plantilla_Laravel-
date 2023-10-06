<?php

namespace App\Http\Controllers;

use App\Models\{formulario3, login_usuarios};
use Illuminate\Support\Facades\{Auth, hash};
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
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
        $datos = login_usuarios::all()->where('tipoUsuario', '=', '0');
        return view('admin.admin')->with('datos', $datos);
    }
    public function login()
    {
        return view('index');
    }
    public function authenticate(Request $request)
    //login validación y autenticación usuarios
    {
        $usuario = login_usuarios::where('usuario', $request->usuario)->first();
        if (!$usuario) {
            // El usuario no existe, muestra un mensaje de error
            return back()->withErrors(['usuario' => 'El usuario no existe']);
        }
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
            // Validar errores
            $errores = [];
            if (!$usuario) {
                $errores['usuario'] = 'El usuario no existe';
            }else if (!Hash::check($request->contrasena, $usuario->contrasena)) {
                $errores['contrasena'] = 'La contraseña es incorrecta';
            }

            // Mostrar el mensaje de error
            return back()->withErrors($errores);
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
            $number =2;
            $contenido = "Doctores";
            return view('Formularios.Formulario', compact('number', 'contenido'));
        } elseif ($accion === 'tipo2') {
            $number =3;
            $contenido = "Instituciones";
            return view('Formularios.Formulario', compact('number', 'contenido'));
        }elseif ($accion === 'tipo3') {
            $number =4;
            $contenido = "Centro Deportivo";
            return view('Formularios.Formulario', compact('number', 'contenido'));
        }else{
            return redirect()->back(); // Manejo predeterminado si no se presionó ningún botón válido   
        }
    }
    //Gestión para insertar al formulario3 de la DB
    public function formulario3(Request $request){
        $request->validate([
            'nombre' => 'required',
            // Otras reglas de validación para otros campos
        ]);
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
        $agregar -> categoria = $request ->categoria;
        $agregar -> save();
        return view('tipoFormulario');
    }
    /* Se muestra la tabla de registros */
    public function tabla(Request $request)
    {
        $filtro_nombre = $request->get('documento_campo');
        $filtro_ciudad = $request->get('ciudad_campo');
        $filtro_especialidad = $request->get('especialidad_campo');
        $filtro_select = $request->get('select');
        $sesion_usuario = auth()->user()->id;
        $datos = formulario3::orderByRaw("CASE WHEN sesion_usuario = $sesion_usuario THEN 0 ELSE 1 END")
                            ->orderBy('id', 'ASC')
                            ->where(function ($query) use ($filtro_nombre) {
                            if (!empty($filtro_nombre)) {
                                $query->where('nombre', 'like', '%' . $filtro_nombre . '%');
                            }})
                            ->where(function ($query) use ($filtro_ciudad) {
                                if (!empty($filtro_ciudad)) {
                                    $query->where('ciudad', 'like', '%' . $filtro_ciudad . '%');
                                }})
                            ->where(function ($query) use ($filtro_especialidad) {
                                if (!empty($filtro_especialidad)) {
                                    $query->where('especialidad', 'like', '%' . $filtro_especialidad . '%');
                                }})
                            ->where(function ($query) use ($filtro_select) {
                                if (!empty($filtro_select)) {
                                    $query->where('categoria', 'like', '%' . $filtro_select . '%');
                                }})
                            ->where('sesion_usuario', $sesion_usuario)
                            ->get();
        return view('formulariosRegistrados', compact('datos', 'filtro_nombre', 'filtro_especialidad', 'filtro_ciudad', 'filtro_select'));
    }
    /* Procesos para actualizar los registros*/
    public function tabla_actualizar($id){
        $datos_actualizar = formulario3::where('id', $id)->where('sesion_usuario','=', auth()->user()->id)->get();
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
        return redirect()->route('registrados');
    }
    /* Exportación de Excel */
    public function exportar_excel(Request $request)
    {
        $filtro_nombre = $request->get('documento_campo');
        $filtro_ciudad = $request->get('ciudad_campo');
        $filtro_especialidad = $request->get('especialidad_campo');
        $filtro_select = $request->get('select');
        $sesion_usuario = auth()->user()->id;
        $idsSeleccionados = $request->input('seleccionados', []);// Obtiene los IDs de las filas seleccionadas
        $datos = formulario3::orderByRaw("CASE WHEN sesion_usuario = $sesion_usuario THEN 0 ELSE 1 END")
                            ->orderBy('id', 'ASC')
                            ->where(function ($query) use ($filtro_nombre) {
                            if (!empty($filtro_nombre)) {
                                $query->where('nombre', 'like', '%' . $filtro_nombre . '%');
                            }})
                            ->where(function ($query) use ($filtro_ciudad) {
                                if (!empty($filtro_ciudad)) {
                                    $query->where('ciudad', 'like', '%' . $filtro_ciudad . '%');
                                }})
                            ->where(function ($query) use ($filtro_especialidad) {
                                if (!empty($filtro_especialidad)) {
                                    $query->where('especialidad', 'like', '%' . $filtro_especialidad . '%');
                                }})
                            ->where(function ($query) use ($filtro_select) {
                                if (!empty($filtro_select)) {
                                    $query->where('categoria', 'like', '%' . $filtro_select . '%');
                                }})
                            ->where('sesion_usuario', $sesion_usuario)
                            ->whereIn('id', $idsSeleccionados)
                            ->get();
        {
        // Crea una nueva hoja de cálculo
        $spreadsheet = new Spreadsheet();
        // Agrega los encabezados de las columnas y estilos
        $spreadsheet->getActiveSheet()->setCellValue('A1', 'Nombre');
        $spreadsheet->getActiveSheet()->setCellValue('B1', 'Especialidad');
        $spreadsheet->getActiveSheet()->setCellValue('C1', 'Teléfono');
        $spreadsheet->getActiveSheet()->setCellValue('D1', 'Dirección');
        $spreadsheet->getActiveSheet()->setCellValue('E1', 'Ciudad');
        $spreadsheet->getActiveSheet()->setCellValue('F1', 'Secretaria');
        $spreadsheet->getActiveSheet()->setCellValue('G1', 'Telefono de ayuda');
        $spreadsheet->getActiveSheet()->setCellValue('H1', 'Telefono de ayuda');
        $spreadsheet->getActiveSheet()->setCellValue('I1', 'Ips cirugia');
        $spreadsheet->getActiveSheet()->setCellValue('J1', '¿En este momento qué procedimientos de apoyo diagnostica en imageniologia son los que más ordena como especialista?');
        $spreadsheet->getActiveSheet()->setCellValue('K1', '¿Cree usted que nuestros resultados son confiables y determinantes para la definición del diagnóstico de sus pacientes?');
        $spreadsheet->getActiveSheet()->setCellValue('L1', '¿Considera que en _____, somos oportunos con el Agendamiento de las citas para sus pacientes?');
        $spreadsheet->getActiveSheet()->setCellValue('M1', '¿Que piensa de la calidad de la imagen que usted recibe, está de acuerdo con los protocolos solicitados?');
        $spreadsheet->getActiveSheet()->setCellValue('N1', '¿Esta de acuerdo con el tiempo de entrega de los resultados que entregamos a sus pacientes?');
        $spreadsheet->getActiveSheet()->setCellValue('O1', '¿Cuantos procedimientos de apoyo diagnóstico ordena en el mes? Más de 5, más de 10?');
        $spreadsheet->getActiveSheet()->setCellValue('P1', '¿Sabe usar nuestra plataforma, para ver los resultados e imágenes de sus pacientes?');
        $spreadsheet->getActiveSheet()->setCellValue('Q1', '¿Que cosas positivas ha encontrado en el proceso de toma de imagenes?');
        $spreadsheet->getActiveSheet()->setCellValue('R1', '¿Que ayudas diagnosticas cree que se necesita en la ciudad?');
        $spreadsheet->getActiveSheet()->setCellValue('S1', '¿Durante este mes ha tenido alguna situación desafortunada con algún paciente que haya tomado nuestros servicios?');
        $spreadsheet->getActiveSheet()->setCellValue('T1', '¿Conoce alguna Tecnica que podemos innovar?');
        $spreadsheet->getActiveSheet()->setCellValue('U1', '¿En Imagenologia que capacitación quisiera tener?');
        $spreadsheet->getActiveSheet()->setCellValue('V1', 'Categoría');
        $spreadsheet->getActiveSheet()->setCellValue('W1', 'Id del visitador - 45 (Laura) / 46 (Walter)');
        $spreadsheet->getActiveSheet()->getColumnDimension('A')->setWidth(40);
        $spreadsheet->getActiveSheet()->getColumnDimension('B')->setWidth(25);
        $spreadsheet->getActiveSheet()->getColumnDimension('C')->setWidth(28);
        $spreadsheet->getActiveSheet()->getColumnDimension('D')->setWidth(60);
        $spreadsheet->getActiveSheet()->getColumnDimension('E')->setWidth(15);
        $spreadsheet->getActiveSheet()->getColumnDimension('F')->setWidth(28);
        $spreadsheet->getActiveSheet()->getColumnDimension('G')->setWidth(28);
        $spreadsheet->getActiveSheet()->getColumnDimension('H')->setWidth(25);
        $spreadsheet->getActiveSheet()->getColumnDimension('I')->setWidth(28);
        $spreadsheet->getActiveSheet()->getColumnDimension('J')->setWidth(40);
        $spreadsheet->getActiveSheet()->getColumnDimension('K')->setWidth(40);
        $spreadsheet->getActiveSheet()->getColumnDimension('L')->setWidth(40);
        $spreadsheet->getActiveSheet()->getColumnDimension('M')->setWidth(40);
        $spreadsheet->getActiveSheet()->getColumnDimension('N')->setWidth(40);
        $spreadsheet->getActiveSheet()->getColumnDimension('O')->setWidth(40);
        $spreadsheet->getActiveSheet()->getColumnDimension('P')->setWidth(40);
        $spreadsheet->getActiveSheet()->getColumnDimension('Q')->setWidth(40);
        $spreadsheet->getActiveSheet()->getColumnDimension('R')->setWidth(40);
        $spreadsheet->getActiveSheet()->getColumnDimension('S')->setWidth(40);
        $spreadsheet->getActiveSheet()->getColumnDimension('T')->setWidth(40);
        $spreadsheet->getActiveSheet()->getColumnDimension('U')->setWidth(40);
        $spreadsheet->getActiveSheet()->getColumnDimension('V')->setWidth(12);
        $spreadsheet->getActiveSheet()->getColumnDimension('W')->setWidth(12);


        $spreadsheet->getActiveSheet()->getStyle('A1:W1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER); // Centrar los encabezados
        $spreadsheet->getActiveSheet()->getStyle('A1:W1')->getFont()->setBold(true); // Negrita
        $spreadsheet->getActiveSheet()->getStyle('A1:W1')->getFont()->setSize(15); $i=2; // Tamaño personalizado
        // Recorre los datos y los escribe en la hoja de cálculo
        foreach ($datos as $dato) {
            $spreadsheet->getActiveSheet()->setCellValue('A' . $i, $dato->nombre);
            $spreadsheet->getActiveSheet()->setCellValue('B' . $i, $dato->especialidad);
            $spreadsheet->getActiveSheet()->setCellValue('C' . $i, $dato->telefono);
            $spreadsheet->getActiveSheet()->setCellValue('D' . $i, $dato->direccion);
            $spreadsheet->getActiveSheet()->setCellValue('E' . $i, $dato->ciudad);
            $spreadsheet->getActiveSheet()->setCellValue('F' . $i, $dato->secretaria);
            $spreadsheet->getActiveSheet()->setCellValue('G' . $i, $dato->tel_ayuda);
            $spreadsheet->getActiveSheet()->setCellValue('H' . $i, $dato->ips_consulta);
            $spreadsheet->getActiveSheet()->setCellValue('I' . $i, $dato->ips_cirugia);
            $spreadsheet->getActiveSheet()->setCellValue('J' . $i, $dato->preg_indag1);
            $spreadsheet->getActiveSheet()->setCellValue('K' . $i, $dato->preg_indag2);
            $spreadsheet->getActiveSheet()->setCellValue('L' . $i, $dato->preg_indag3);
            $spreadsheet->getActiveSheet()->setCellValue('M' . $i, $dato->preg_indag4);
            $spreadsheet->getActiveSheet()->setCellValue('N' . $i, $dato->preg_indag5);
            $spreadsheet->getActiveSheet()->setCellValue('O' . $i, $dato->preg_indag6);
            $spreadsheet->getActiveSheet()->setCellValue('P' . $i, $dato->preg_indag7);
            $spreadsheet->getActiveSheet()->setCellValue('Q' . $i, $dato->preg_indag8);
            $spreadsheet->getActiveSheet()->setCellValue('R' . $i, $dato->preg_indag9);
            $spreadsheet->getActiveSheet()->setCellValue('S' . $i, $dato->preg_indag10);
            $spreadsheet->getActiveSheet()->setCellValue('T' . $i, $dato->preg_indag11);
            $spreadsheet->getActiveSheet()->setCellValue('U' . $i, $dato->preg_indag12);
            $spreadsheet->getActiveSheet()->setCellValue('V' . $i, $dato->categoria);
            $spreadsheet->getActiveSheet()->setCellValue('W' . $i, $dato->sesion_usuario);
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
    };
}
    /* Proceso para eliminar los datos */
    public function eliminar(Request $request){
        $id = $request->input('eliminar_id');
        // Realiza la lógica de eliminación, por ejemplo:
        formulario3::where('id', $id)->delete();
        // Redirecciona de vuelta a la página anterior o a donde desees
        return redirect()->back()->with('success', 'Registro eliminado exitosamente');
    }
    //Acceder desde un administrador.
    public function acceder(Request $request){
        $id = $request->input('id');
        $user = $request->input('usuario'); // Obtener el perfil seleccionado
        $contrasena = $request->input('contrasena');
        $datos = login_usuarios::where('id', $id)->first();
        $usuario = login_usuarios::where('usuario', $datos['usuario'])->first();
        Auth::login($usuario);
        session(['user' => $user]);
        return redirect('/medicos');
    }
}
