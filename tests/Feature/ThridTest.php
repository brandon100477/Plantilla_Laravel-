<?php

namespace Tests\Feature;

use App\Http\Controllers\Visitador_medicoController;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\login_usuarios;
use Tests\TestCase;

class ThridTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $sessionData = [
            'user_id' => 1, // Example session data
            'username' => 'test_user',
        ];
        $this->withSession($sessionData);
        
        $usuario = login_usuarios::create([
            'nombreApellido' => 'pruebaUsuario',
            'usuario' => 'prueba3',
            'contrasena' => bcrypt('0000'),
            'cedula' => '1234',
            'telefono' => '333333',
            'correo' => 'prueba@prueba.com',
            'tipoUsuario' => '0',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        $this->actingAs($usuario);
        
        $csrfToken = csrf_token();

        $controlador = new Visitador_medicoController();


        $datos = [
            (object) [
            '_token' => $csrfToken,
            // Agrega aquí los datos necesarios para la solicitud POST
            'nombre' => 'Juan Pérez',
            'especialidad' => 'Cardiología',
            'telefono' => '1234567890',
            'direccion' => 'Calle Falsa 123',
            'ciudad' => 'Ciudad Ejemplo',
            'secretaria' => 'Secretaría Ejemplo',
            'tel_ayuda' => '0987654321',
            'ips_consulta' => 'IPS Consulta Ejemplo',
            'ips_cirugia' => 'IPS Cirugía Ejemplo',
            'preg_indag1' => '11111',
            'preg_indag2' => 'Pregunta 2',
            'preg_indag3' => 'Pregunta 1',
            'preg_indag4' => 'Pregunta 2',
            'preg_indag5' => 'Pregunta 1',
            'preg_indag6' => 'Pregunta 2',
            'preg_indag7' => 'Pregunta 1',
            'preg_indag8' => 'Pregunta 2',
            'preg_indag9' => 'Pregunta 1',
            'preg_indag10' => 'Pregunta 2',
            'preg_indag11' => 'Pregunta 1',
            'preg_indag12' => 'Pregunta 2',
            'sesion_usuario'=> '1',
            'categoria' => '2',
            'observaciones' => 'Observaciones',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
            'seleccionados' => [1, 2, 3], // Ejemplo de IDs seleccionados
            ],
            (object) [
                '_token' => $csrfToken,
                // Agrega aquí los datos necesarios para la solicitud POST
                'nombre' => 'Juan Pérez',
                'especialidad' => 'Cardiología',
                'telefono' => '1234567890',
                'direccion' => 'Calle Falsa 123',
                'ciudad' => 'Ciudad Ejemplo',
                'secretaria' => 'Secretaría Ejemplo',
                'tel_ayuda' => '0987654321',
                'ips_consulta' => 'IPS Consulta Ejemplo',
                'ips_cirugia' => 'IPS Cirugía Ejemplo',
                'preg_indag1' => '11111',
                'preg_indag2' => 'Pregunta 2',
                'preg_indag3' => 'Pregunta 1',
                'preg_indag4' => 'Pregunta 2',
                'preg_indag5' => 'Pregunta 1',
                'preg_indag6' => 'Pregunta 2',
                'preg_indag7' => 'Pregunta 1',
                'preg_indag8' => 'Pregunta 2',
                'preg_indag9' => 'Pregunta 1',
                'preg_indag10' => 'Pregunta 2',
                'preg_indag11' => 'Pregunta 1',
                'preg_indag12' => 'Pregunta 2',
                'sesion_usuario'=> '1',
                'categoria' => '2',
                'observaciones' => 'Observaciones',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'seleccionados' => [1, 2], // Ejemplo de IDs seleccionados
                ],
        ];
        $tempPath = $controlador->generarExcel($datos);
        echo "Ruta del archivo temporal: " . $tempPath;
        $this->assertFileExists($tempPath);
        $spreadsheet = IOFactory::load($tempPath);
        $this->assertInstanceOf(Spreadsheet::class, $spreadsheet);
        $this->assertEquals('Nombre', $spreadsheet->getActiveSheet()->getCell('A1')->getValue());
        $this->assertEquals('Especialidad', $spreadsheet->getActiveSheet()->getCell('B1')->getValue());
        unlink($tempPath);
        echo "Archivo temporal eliminado correctamente";
    }
}
