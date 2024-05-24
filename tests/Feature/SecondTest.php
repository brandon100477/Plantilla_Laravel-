<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;
use App\Models\login_usuarios;

class SecondTest extends TestCase
{

    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
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

        $response = $this->get(route('clasificacion', ['tipo' => 'tipo']));
        $response->assertStatus(200);

        $response = $this->get(route('insertar'));
        $response->assertStatus(200);

        Artisan::call('migrate');
        $this->actingAs($usuario);
        //Formulario carga correctamente
        $carga = $this->get('medicos/tipo-de-formulario');
        $carga->assertStatus(200);
        $csrfToken = csrf_token();

        $registroBueno = $this->withHeaders([
            'X-CSRF-TOKEN' => $csrfToken,
        ])->post(route('insertar'), [
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
        ]);
        $registroBueno->assertStatus(200)->assertViewIs('tipoFormulario');
        //Verifica que los datos estén en la base de datos
        $this->assertDatabaseHas('formulario3', ['nombre'=>"Juan Pérez"]);
    }
}
