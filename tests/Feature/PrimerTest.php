<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Support\Facades\Artisan;

class PrimerTest extends TestCase
{
    public function test_register(){
        Artisan::call('migrate');
        //Formulario carga correctamente
        $carga = $this->get(route('auth.register'));
        $carga->assertStatus(200)->assertSee('Registrarse');

        $csrfToken = csrf_token();
    
        //Registros incorrectos
        $registroError = $this->withHeaders([
            'X-CSRF-TOKEN' => $csrfToken,
        ])->post(route('auth.login_usuarios'), [
            "nombreApellido" => "pruebaUsuario", 
            "usuario" => "prueba3/$$/2024", 
            "contrasena" => "0000", 
            "cedula" => "prueba", 
            "telefono" => "telefonos", 
            "correo" => "eeee", 
            "tipoUsuario" => "efe"
        ]);
        $registroError->assertStatus(302);
        $sessionErrors = session()->get('errors', []);
        foreach ($sessionErrors->all() as $field => $message) {
            // Asumiendo que tienes un array de mensajes de error para cada campo
            $expectedMessages = [
                'nombreApellido' => __('validation.required', ['attribute' => 'nombreApellido']),
                'usuario' => __('validation.required', ['attribute' => 'text']),
                'contrasena' => __('validation.rmin.string', ['attribute' => 'password']),
                'cedula' => __('validation.required', ['attribute' => 'text']),
                'telefono' => __('validation.required', ['attribute' => 'text']),
                'correo' => __('validation.email', ['attribute' => 'email']),
                'tipoUsuario' => __('validation.required', ['attribute' => 'integer']),
            ];
        }

        //Registros correctos
        $registroBueno = $this->withHeaders([
            'X-CSRF-TOKEN' => $csrfToken,
        ])->post(route('auth.login_usuarios'), [
            "nombreApellido" => "pruebaUsuario", 
            "usuario" => "prueba3", 
            "contrasena" => "0000", 
            "cedula" => "1234", 
            "telefono" => "333333", 
            "correo" => "prueba@prueba.com", 
            "tipoUsuario" => "0"
        ]);
        $registroBueno->assertStatus(302)->assertRedirect(route('volver1'));
        //Verifica que los datos estén en la base de datos
        $this->assertDatabaseHas('login_usuarios', ['usuario'=>"prueba3"]);
;}
}
