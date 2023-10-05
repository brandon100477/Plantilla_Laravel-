<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
        <link rel="icon" href="{{ asset('img/favicon.png')}}">
        <link rel="stylesheet" href="{{ asset('css/actualizar_datos_registrados.css')}}">
        <title>Actualizar</title>
    </head>
    <body>
        <section class="inicio">
            <p class="texto_inicio">Actualizar información</p>
            <a href="{{ route('registrados')}}" class="volver" id="cerrar">Volver</a> <!--Se pone la Ruta 'registrados' para volver a la vista donde se filtran los registros-->
        </section>
        <form method="POST" class="form_login" action="{{route('actualizado')}}">
            @csrf
        <br>
            <!-- fila 1 -->
            <p class="titulos">Actualización de datos</p>
            <br>
            <div class="row">
                <div class="column">
                    <div class="form-group">
                    <input type="hidden" id="id" name="id" value="{{ $id }}" class="input">
                        <label for="nombre">1. Nombre</label>
                        <input type="text" id="nombre" name="nombre" placeholder="{{ $nombre }}"class="input" value="{{ $nombre }}">
                    </div><br>
                    <div class="form-group">
                        <label for="email">2. Telefono</label>
                        <input type="number" id="telefono" name="telefono" placeholder="{{ $telefono }}" class="input" value="{{ $telefono }}">
                    </div><br>
                </div><br>
                <div class="column">
                    <div class="form-group">
                        <label for="nombre">3. Especialidad</label>
                        <input type="text" id="especialidad" name="especialidad" placeholder="{{ $especialidad }}" class="input" value="{{ $especialidad }}">
                    </div><br>
                    <div class="form-group">
                        <label for="email">4. Dirección</label>
                        <input type="text" id="direccion" name="direccion" placeholder="{{ $direccion }}" class="input" value="{{ $direccion }}">
                    </div><br>
                    <div class="form-group">
                        <label for="email">5. Ciudad</label>
                        <input type="text" id="ciudad" name="ciudad" placeholder="{{ $ciudad }}" class="input" value="{{ $ciudad }}">
                    </div>
                </div>
            </div><br>
            
            <hr><br>
            <p class="titulos">IPS donde trabaja</p><br>

            <!-- fila 2 -->
            <div class="row">
                <div class="column">
                    <div class="form-group">
                        <label for="nombre">6. Secretaria o contacto de ayuda</label>
                        <input type="text" id="secretaria" name="secretaria" placeholder="{{ $secretaria }}" class="input" value="{{ $secretaria }}">
                    </div><br>
                    <div class="form-group">
                        <label for="email">7. IPS de consulta</label>
                        <input type="text" id="ips_consulta" name="ips_consulta" placeholder="{{ $ips_consulta }}" class="input" value="{{ $ips_consulta }}">
                    </div><br>
                </div><br>
                <div class="column">
                    <div class="form-group">
                        <label for="nombre">8. Telefono de contacto de ayuda</label>
                        <input type="number" id="tel_ayuda" name="tel_ayuda" placeholder="{{ $tel_ayuda }}" class="input" value="{{ $tel_ayuda }}">
                    </div><br>
                    <div class="form-group">
                        <label for="email">9. IPS de cirugia</label>
                        <input type="text" id="ips_cirugia" name="ips_cirugia" placeholder="{{ $ips_cirugia }}" class="input" value="{{ $ips_cirugia }}">
                    </div><br>
                </div><br>
            </div><br>
            <hr><br>
            <p class="titulos">Preguntas de indagación - parte 1</p><br>

            <!-- fila 3 -->
            <div class="row">
                <div class="column">
                    <div class="form-group">
                        <label for="nombre">10. ¿En este momento qué procedimientos de apoyo diagnostica en <br>
                            imageniologia son los que más ordena como especialista?</label>
                        <input type="text" placeholder="{{ $preg_indag1 }}" name="preg_indag1" for="nombre" style="resize: none;" class="c_preg1" rows="1" cols="50" value="{{ $preg_indag1 }}">
                    </div><br>
                    <div class="form-group">
                        <label for="email">11. ¿Cree usted que nuestros resultados son confiables y determinantes <br> para
                            la definición del diagnóstico de sus pacientes?</label>
                        <input type="text" placeholder="{{ $preg_indag2 }}" name="preg_indag2" for="nombre" style="resize: none;" class="c_preg1" rows="1" cols="50" value="{{ $preg_indag2 }}">
                    </div><br>
                </div><br>
                <div class="column">
                    <div class="form-group">
                        <label for="nombre">12. ¿Considera que en _____, somos oportunos con el Agendamiento <br> de las
                            citas para sus pacientes?</label>
                        <input type="text" placeholder="{{ $preg_indag3 }}" name="preg_indag3" for="nombre" style="resize: none;" class="c_preg1" rows="1" cols="50" value="{{ $preg_indag3 }}">
                    </div><br>
                    <div class="form-group">
                        <label for="email">13. ¿Que piensa de la calidad de la imagen que usted recibe, está de <br> acuerdo
                            con los protocolos solicitados?</label>
                        <input type="text" placeholder="{{ $preg_indag4 }}" name="preg_indag4" for="nombre" style="resize: none;" class="c_preg1" rows="1" cols="50" value="{{ $preg_indag4 }}">
                    </div><br>
                </div><br>
            </div><br>

            <!-- fila 4 -->
            <div class="row">
                <div class="column">
                    <div class="form-group">
                        <label for="nombre">14. ¿Esta de acuerdo con el tiempo de entrega de los resultados que <br>
                            entregamos a sus pacientes?</label>
                        <input type="text" placeholder="{{ $preg_indag5 }}" name="preg_indag5" for="nombre" style="resize: none;" class="c_preg1" rows="1" cols="50" value="{{ $preg_indag5 }}">
                    </div><br>
                    <div class="form-group">
                        <label for="email">15. ¿Cuantos procedimientos de apoyo diagnóstico ordena en el mes? <br> Más de 5
                            más de 10</label>
                        <input type="text" placeholder="{{ $preg_indag6 }}" name="preg_indag6" for="nombre" style="resize: none;" class="c_preg1" rows="1" cols="50" value="{{ $preg_indag6 }}">
                    </div><br>
                </div><br>
                <div class="column">
                    <div class="form-group">
                        <label for="nombre">16. ¿Sabe usar nuestra plataforma, para ver los resultados e imágenes <br> de
                            sus pacientes?</label>
                        <input type="text" placeholder="{{ $preg_indag7 }}" name="preg_indag7" for="nombre" style="resize: none;" class="c_preg1" rows="1" cols="50" value="{{ $preg_indag7 }}">
                    </div><br>
                </div><br>
            </div><br>
            <hr><br>
            <p class="titulos">Preguntas de indagación - parte 2</p><br>

            <!-- fila 5 -->
            <div class="row">
                <div class="column">
                    <div class="form-group">
                        <label for="nombre">17. ¿Que cosas positivas ha encontrado en el proceso de toma <br> de
                            imagenes?</label>
                        <input type="text" placeholder="{{ $preg_indag8 }}" name="preg_indag8" for="nombre" style="resize: none;" class="c_preg1" rows="1" cols="50" value="{{ $preg_indag8 }}">
                    </div><br>
                    <br>
                    <div class="form-group">
                        <label for="email">18. ¿Que ayudas diagnosticas cree que se necesita en la ciudad?</label>
                        <input type="text" placeholder="{{ $preg_indag9 }}" name="preg_indag9" for="nombre" style="resize: none;" class="c_preg1" rows="1" cols="50" value="{{ $preg_indag9 }}">
                    </div><br>
                </div><br>
                <br>
                <div class="column">
                    <div class="form-group">
                        <label for="nombre">19. ¿Durante este mes ha tenido alguna situación desafortunada <br> con algún
                            paciente que haya tomado nuestros servicios?</label>
                        <input type="text" placeholder="{{ $preg_indag10 }}" name="preg_indag10" for="nombre" style="resize: none;" class="c_preg1" rows="1" cols="50" value="{{ $preg_indag10 }}">
                    </div><br>
                    <br>
                    <div class="form-group">
                        <label for="email">20. ¿Conoce alguna Tecnica que podemos innovar?</label>
                        <input type="text" placeholder="{{ $preg_indag11 }}" name="preg_indag11" for="nombre" style="resize: none;" class="c_preg1" rows="1" cols="50" value="{{ $preg_indag11 }}">
                    </div><br>
                </div><br>
            </div><br>
            <br>
            <!-- fila 5 -->
            <div class="row">
                <div class="column">
                    <div class="form-group">
                        <label for="nombre">21. ¿En Imagenologia que capacitación quisiera tener?</label>
                        <input type="text" placeholder="{{ $preg_indag12 }}" name="preg_indag12" for="nombre" style="resize: none;" class="c_preg1" rows="1" cols="50" value="{{ $preg_indag12 }}">
                    </div><br>
                </div><br>
            </div><br>
            <input type="submit" class="butons" name="butons" id="butons" value="Actualizar" />
        </form>
    </body>
    <script>
    async function mostrarAlerta() {
        await Swal.fire('¡Perfecto!', 'Registro actualizado con éxito', 'success');
    }
    document.addEventListener("DOMContentLoaded", function () {
        const form = document.querySelector("form");
        form.addEventListener("submit", async function (event) {
            event.preventDefault(); // Evita que el formulario se envíe automáticamente
            await mostrarAlerta(); // Muestra la alerta y espera a que se cierre
            form.submit(); // Envía el formulario después de mostrar la alerta
        });
    });
    </script>
</html>