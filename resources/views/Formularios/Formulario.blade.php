<!DOCTYPE html>
<html lang="en">
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        <link rel="icon" href="{{ asset('img/favicon.png')}}">
        <title>{{ $contenido }}</title>
        <a href="{{ route('volver')}}" class="cerrar" id="cerrar">Volver</a>
</head>
    <body>
    <section class="inicio">
        <h1>{{ $contenido }}</h1>
        </section>

    <section class="form-register" id="form-register">

        <form method="POST" action="{{ route('insertar') }}">
        @csrf
    <!--  ACTUALIZACIÓN DE DATOS  -->
    <br>

        <div class="accordion_item" style="background-color: #eae5fc;">
        <div class="accordion_header">
            <span>
                ACTUALIZACIÓN DE DATOS
            </span> 
            <div class="icon">
                +
            </div>
        </div>

        <div class="accordion_content">
        <br>
        <select id="select" name="select" class="select" onchange="actualizar(this)">	
                    <option selected readonly>Seleccione una categoria</option>
                    <option value="2">Medicos</option>
                    <option value="3">Instituciones</option>
                    <option value="4">Centro deportivo</option>
                </select><br><br><br>

            <label for="texto" class="textos">1. Nombre </label><br><br>
                <input type="text" class="campo_texto" name="nombre" id="nombre" placeholder="Escriba su respuesta"><br><br><br>

            <label for="texto" class="textos">2. Especialidad </label><br><br>
                <input type="text" class="campo_texto" name="especialidad" id="especialidad" placeholder="Escriba su respuesta"><br><br><br>

            <label for="texto" class="textos">3. Telefono </label><br><br>
                <input type="number" class="campo_texto" name="telefono" id="telefono" placeholder="Escriba su respuesta"><br><br><br>

            <label for="texto" class="textos">4. Direccion </label><br><br>
                <input type="text" class="campo_texto" name="direccion" id="direccion" placeholder="Escriba su respuesta"><br><br><br>

            <label for="texto" class="textos">5. Ciudad </label><br><br>
                <input type="text" class="campo_texto" name="ciudad" id="ciudad" placeholder="Escriba su respuesta"><br><br>

        </div>
        </div>

        <br><br><br>

    <!-- IPS DONDE TRABAJA   -->

    <div class="accordion_item" style="background-color: #eae5fc;">
        <div class="accordion_header">
            <span>
            IPS DONDE TRABAJA
            </span> 
            <div class="icon">
            +
            </div>
        </div>

        <div class="accordion_content">
        <br>

            <label for="texto" class="textos">6. Secretaria o contacto de ayuda </label><br><br>
                <input type="text" class="campo_texto" name="secretaria" placeholder="Escriba su respuesta"><br><br><br>

            <label for="texto" class="textos">7. Telefono de contacto de ayuda </label><br><br>
                <input type="number" class="campo_texto" name="tel_ayuda" placeholder="Escriba su respuesta"><br><br><br>

            <label for="texto" class="textos">8. IPS de consulta </label><br><br>
                <input type="text" class="campo_texto" name="ips_consulta" placeholder="Escriba su respuesta"><br><br><br>

            <label for="texto" class="textos">9. IPS de cirugia </label><br><br>
                <input type="text" class="campo_texto" name="ips_cirugia" placeholder="Escriba su respuesta"><br><br>

        </div>

    </div>
        <br><br><br>

    <!--  PREGUNTAS DE INDAGACIÓN - PARTE 1 -->

    <div class="accordion_item" style="background-color: #eae5fc;">
        <div class="accordion_header">
            <span>
            PREGUNTAS DE INDAGACIÓN 1
            </span> 
            <div class="icon">
            +
            </div>
        </div>

        <div class="accordion_content">
        <br>

            <text for="texto" class="textos">10. ¿En este momento qué procedimientos de apoyo diagnostica en imageniologia son los que más ordena como especialista?</label><br><br>
                <textarea name="preg_indag1" style="resize: none;" class="campo_texto" rows="3" cols="50" placeholder="Escriba su respuesta"></textarea><br><br><br>


            <label for="texto" class="textos">11. ¿Considera que en ________, somos oportunos con el Agendamiento de las citas para sus pacientes?  </label><br><br>        					
                <textarea name="preg_indag2" style="resize: none;" class="campo_texto" rows="3" cols="50" placeholder="Escriba su respuesta"></textarea><br><br><br>

            <label for="texto" class="textos">12. ¿Cree usted que nuestros resultados son confiables y determinantes para la definición del diagnóstico de sus pacientes?</label><br><br>					
                <textarea name="preg_indag3" style="resize: none;" class="campo_texto" rows="3" cols="50" placeholder="Escriba su respuesta"></textarea><br><br><br>
            

            <label for="texto" class="textos">13. ¿que piensa de la calidad de la imagen que usted recibe, está de acuerdo con los protocolos solicitados?</label><br><br>
                <textarea name="preg_indag4" style="resize: none;" class="campo_texto" rows="3" cols="50" placeholder="Escriba su respuesta"></textarea><br><br><br>
            

            <label for="texto" class="textos">14. ¿Esta de acuerdo con el tiempo de entrega de los resultados que entregamos a sus pacientes? </label><br><br>
                <textarea name="preg_indag5" style="resize: none;" class="campo_texto" rows="3" cols="50" placeholder="Escriba su respuesta"></textarea><br><br><br>


            <label for="texto" class="textos">15. ¿Sabe usar nuestra plataforma, para ver los resultados e imágenes de sus pacientes? </label><br><br>
                <textarea name="preg_indag6" style="resize: none;" class="campo_texto" rows="3" cols="50" placeholder="Escriba su respuesta"></textarea><br><br><br>


            <label for="texto" class="textos">16. ¿Cuantos procedimientos de apoyo diagnóstico ordena en el mes? Más de 5 más de 10 </label><br><br>
                <textarea name="preg_indag7" style="resize: none;" class="campo_texto" rows="3" cols="50" placeholder="Escriba su respuesta"></textarea><br><br><br>
                <br><br><br>

        </div>
    </div>

    <br><br><br>

    <!--  PREGUNTAS DE INDAGACIÓN - PARTE 2 -->
    <div class="accordion_item" style="background-color: #eae5fc;">
        <div class="accordion_header">
            <span>
            PREGUNTAS DE INDAGACIÓN 2
            </span> 
            <div class="icon">
            +
            </div>
        </div>

        <div class="accordion_content" id="accordion_content">
        <br>

            <label for="texto" class="textos">17. ¿Que cosas positivas ha encontrado en el proceso de toma de imagenes?</label><br><br>
                <textarea name="preg_indag8" style="resize: none;" class="campo_texto" rows="3" cols="50" placeholder="Escriba su respuesta"></textarea><br><br><br>

            <label for="texto" class="textos">18. ¿Durante este mes ha tenido alguna situación desafortunada con algún paciente que haya tomado nuestros servicios?</label><br><br>
                <textarea name="preg_indag9" style="resize: none;" class="campo_texto" rows="3" cols="50" placeholder="Escriba su respuesta"></textarea><br><br><br>

            <label for="texto" class="textos">19. ¿Que ayudas diagnosticas cree que se necesita en la ciudad?</label><br><br>
                <textarea name="preg_indag10" style="resize: none;" class="campo_texto" rows="3" cols="50" placeholder="Escriba su respuesta"></textarea><br><br><br>

            <label for="texto" class="textos">20. ¿Conoce alguna Tecnica que podemos innovar?</label><br><br>
                <textarea name="preg_indag11" style="resize: none;" class="campo_texto" rows="3" cols="50" placeholder="Escriba su respuesta"></textarea><br><br><br>

            <label for="texto" class="textos">21. ¿En Imagenologia que capacitación quisiera tener?</label><br><br>
                <textarea name="preg_indag12" style="resize: none;" class="campo_texto" rows="3" cols="50" placeholder="Escriba su respuesta"></textarea><br><br><br>

        </div>
    </div>

    <br><br><br>

    <!-- PRESENTACIÓN DE SERVICIOS A -->

    <div class="accordion_item" style="background-color: #eae5fc;">
        <div class="accordion_header">
            <span>
            PRESENTACIÓN DE SERVICIOS A
            </span> 
            <div class="icon">
            +
            </div>
        </div>

        <div class="accordion_content" id="accordion_content">
        <br>

            <label class="Obligatorio">Da clic en el icono "<i class="fa-solid fa-eye" style="color: #730080; font-size: 12px;"></i>" para ver una breve descripción de cada servicio:</label><br><br><br>

            <label for="texto" class="textos">22. RMN de Rodilla con Cartigram</label><br><br>

            <!-- boton -->
            <div class="boton-modal">
                <label for="btn-modal">
                    <i class="fa-solid fa-eye" style="color: #fff; font-size: 18px; cursor: pointer;"></i>
                </label>
            </div>
            <!-- fin del boton -->
            <br>

            <!-- ventana modal -->
            <input type="checkbox" id="btn-modal">
            <div class="container-modal">
                <div class="content-modal">
                    <h2>RMN de Rodilla con Cartigram</h2>
                    <p>Se realiza para evaluar la inegridad de los meniscos, ver si tienen una ruptura, determinar el grado de ruptura y localización.</p>
                    <div class="btn-cerrar">
                        <label for="btn-modal">Cerrar</label>
                    </div>
                </div>
                <label for="btn-modal" class="cerrar-modal"></label>
            </div>
            <!-- fin de ventana modal -->

            <label for="texto" class="textos">23. RMN disminución artificios metálicos</label><br><br>
            <!-- boton -->
            <div class="boton-modal">
                <label for="btn-modal2">
                    <i class="fa-solid fa-eye" style="color: #fff; font-size: 18px; cursor: pointer;"></i>
                </label>
            </div>
            <!-- fin del boton -->
            <br>

            <!-- ventana modal -->
            <input type="checkbox" id="btn-modal2">
            <div class="container-modal2">
                <div class="content-modal">
                    <h2>RMN disminución artificios metálicos</h2>
                    <p >En tomografia y resonancia a pacientes operados o que cuentan con implantes metalicos en su cuerpo, al realizar examenes diagnosticos se cuenta con un software que disminuye
                    los artificios por objetos metalicos dentro del cuerpo.</p>
                        <div class="btn-cerrar">
                            <label for="btn-modal2">Cerrar</label>
                        </div>
                </div>
                <label for="btn-modal2" class="cerrar-modal"></label>
            </div>
            <!-- fin de ventana modal -->



            <label for="texto" class="textos">24. Artroresonancia articulaciones - hombro</label><br><br>
            <!-- boton -->
            <div class="boton-modal">
                <label for="btn-modal3">
                    <i class="fa-solid fa-eye" style="color: #fff; font-size: 18px; cursor: pointer;"></i>
                </label>
            </div>
            <!-- fin del boton -->
            <br>

            <!-- ventana modal -->
            <input type="checkbox" id="btn-modal3">
            <div class="container-modal3">
                <div class="content-modal">
                    <h2>Artroresonancia articulaciones - hombro</h2>
                    <p >Es un estudio mediante el cual se evalua la capsula articular mediante la inyección de un medio de contraste, los mas frecuentes son: hombro, rodilla y muñeca.</p>
                        <div class="btn-cerrar">
                            <label for="btn-modal3">Cerrar</label>
                        </div>
                </div>
                <label for="btn-modal3" class="cerrar-modal"></label>
            </div>
            <!-- fin de ventana modal -->

            <label for="texto" class="textos">25. RMN con protocolo de parkinson</label><br><br>
            <!-- boton -->
            <div class="boton-modal">
                <label for="btn-modal4">
                    <i class="fa-solid fa-eye" style="color: #fff; font-size: 18px; cursor: pointer;"></i>
                </label>
            </div>
            <!-- fin del boton -->
            <br>

            <!-- ventana modal -->
            <input type="checkbox" id="btn-modal4">
            <div class="container-modal4">
                <div class="content-modal">
                    <h2>RMN con protocolo de parkinson</h2>
                    <p>Esutdio de cerebro con un protocolo especifico para evaluar la enfermerdad de parkinson.</p>
                        <div class="btn-cerrar">
                        <label for="btn-modal4">Cerrar</label>
                        </div>
                </div>
                <label for="btn-modal4" class="cerrar-modal"></label>
            </div>
            <!-- fin de ventana modal -->

            <label for="texto" class="textos">26. RMN protocolo neuronavegación</label><br><br>
            <!-- boton -->
            <div class="boton-modal">
                <label for="btn-modal5">
                    <i class="fa-solid fa-eye" style="color: #fff; font-size: 18px; cursor: pointer;"></i>
                </label>
            </div>
            <!-- fin del boton -->
            <br>

            <!-- ventana modal -->
            <input type="checkbox" id="btn-modal5">
            <div class="container-modal5">
                <div class="content-modal">
                    <h2>RMN protocolo neuronavegación</h2>
                    <p >Estudio del cerebro que se realiza para ubicar una lesion y servir como guia para procedimiento quirurjico. </p>
                        <div class="btn-cerrar">
                        <label for="btn-modal5">Cerrar</label>
                        </div>
                </div>
                <label for="btn-modal5" class="cerrar-modal"></label>
            </div>
            <!-- fin de ventana modal -->

            <label for="texto" class="textos">27. RMN volumetria cerebral hipocampal</label><br><br>
            <!-- boton -->
            <div class="boton-modal">
                <label for="btn-modal6">
                    <i class="fa-solid fa-eye" style="color: #fff; font-size: 18px; cursor: pointer;"></i>
                </label>
            </div>
            <!-- fin del boton -->
            <br>

            <!-- ventana modal -->
            <input type="checkbox" id="btn-modal6">
            <div class="container-modal6">
                <div class="content-modal">
                    <h2>RMN volumetria cerebral</h2>
                    <p >Estudio de cerebro para pacientes con epilepsia en el cual se realiza la medición del hipocampo y se define diagnostico de acuerdo a resultados.</p>
                    <div class="btn-cerrar">
                        <label for="btn-modal6">Cerrar</label>
                    </div>
                </div>
                <label for="btn-modal6" class="cerrar-modal"></label>
            </div>
            <!-- fin de ventana modal -->

            <label for="texto" class="textos">28. TAC rotulas con mediciones TG - TT</label><br><br>
            <!-- boton -->
            <div class="boton-modal">
                <label for="btn-modal7">
                    <i class="fa-solid fa-eye" style="color: #fff; font-size: 18px; cursor: pointer;"></i>
                </label>
            </div>
            <!-- fin del boton -->
            <br>

            <!-- ventana modal -->
            <input type="checkbox" id="btn-modal7">
            <div class="container-modal7">
                <div class="content-modal">
                <h2>TAC rotulas con mediciones TG - TT</h2>
                <p >Tomografia de las rodillas para determinar el grado de alineación de la rotula y evaluar dolor, tratamiento, patologias de la marcha y se deben realizar de acuerdo a un protocolo
                    especifico que de acuerdo a los resultados de las mediciones se toman las decisiones de tratamiento.</p>
                    <div class="btn-cerrar">
                        <label for="btn-modal7">Cerrar</label>
                    </div>
                </div>
                <label for="btn-modal7" class="cerrar-modal"></label>
            </div>
            <!-- fin de ventana modal -->

            <label for="texto" class="textos">29. TAC anterversión femoral - tibial</label><br><br>

            <!-- boton -->
            <div class="boton-modal">
                <label for="btn-modal8">
                    <i class="fa-solid fa-eye" style="color: #fff; font-size: 18px; cursor: pointer;"></i>
                </label>
            </div>
            <!-- fin del boton -->
                <br>

            <!-- ventana modal -->
            <input type="checkbox" id="btn-modal8">
            <div class="container-modal8">
                <div class="content-modal">
                <h2>TAC anterversión femoral - tibial</h2>
                <p >Tomografia de los miembros inferiores para determinar el grado de alineación de la cabeza femoral y determinar tratamiento </p>
                    <div class="btn-cerrar">
                        <label for="btn-modal8">Cerrar</label>
                </div>
                </div>
                <label for="btn-modal8" class="cerrar-modal"></label>
            </div>
            <!-- fin de ventana modal -->


        </div>
    </div>

        <br><br><br>

    <input type="submit" class="butons" name="butons" id="butons" value="Enviar"/>
        <br><br>

        </form>
    </section>

    </body>
    </html>