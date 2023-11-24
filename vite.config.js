import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/js/Formulario.JS', 'resources/js/app.js', 'resources/css/login.css', 
                    'resources/css/admin.css','resources/css/medicos.css','resources/css/tipoFormulario.css',
                    'resources/css/formulariosRegistrados.css', 'resources/css/registro.css','resources/css/actualizar_datos_registrados.css',
                    'resources/css/Formulario.css'],
            refresh: true,
        }),
    ],
});
