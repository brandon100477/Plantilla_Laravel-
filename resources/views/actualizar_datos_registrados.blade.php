<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualizar</title>
    <a href="{{ route('registrados')}}" class="cerrar" id="cerrar">Volver</a>
    <!--Se pone la Ruta 'registrados' para volver a la vista donde se filtran los registros-->
</head>
    <body>
        <section class="inicio">
            <p class="texto_inicio">Actualizar información</p>
        </section>
        <form method="POST" class="form_login">
        <br>
            <!-- fila 1 -->
            <p class="titulos">Actualización de datos</p>
            <br>
            <div class="row">
                <div class="column">
                    <div class="form-group">
                        <label for="nombre">1. Nombre</label>
                        <input type="text" id="nombre" name="nombre" placeholder=""class="input">
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="email">2. Telefono</label>
                        <input type="text" id="telefono" name="telefono" placeholder="" class="input">
                    </div>
                </div>
                <br>
                <div class="column">
                    <div class="form-group">
                        <label for="nombre">3. Especialidad</label>
                        <input type="text" id="especialidad" name="especialidad" placeholder="" class="input">
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="email">4. Dirección</label>
                        <input type="text" id="direccion" name="direccion" placeholder="" class="input">
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="email">5. Ciudad</label>
                        <input type="text" id="ciudad" name="ciudad" placeholder="" class="input">
                    </div>
                </div>
            </div>
            <br>
            <hr>
            <br>
            <p class="titulos">IPS donde trabaja</p>
            <br>
            <!-- fila 2 -->
            <div class="row">
                <div class="column">
                    <div class="form-group">
                        <label for="nombre">6. Secretaria o contacto de ayuda</label>
                        <input type="text" id="secretaria" name="secretaria" placeholder="" class="input">
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="email">7. IPS de consulta</label>
                        <input type="text" id="ips_consulta" name="ips_consulta" placeholder="" class="input">
                    </div>
                </div>
                <div class="column">
                    <div class="form-group">
                        <label for="nombre">8. Telefono de contacto de ayuda</label>
                        <input type="text" id="tel_ayuda" name="tel_ayuda" placeholder="" class="input">
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="email">9. IPS de cirugia</label>
                        <input type="text" id="ips_cirugia" name="ips_cirugia" placeholder="" class="input">
                    </div>
                </div>
            </div>
            <br>
            <hr>
            <br>
            <p class="titulos">Preguntas de indagación - parte 1</p>
            <br>
            <!-- fila 3 -->
            <div class="row">
                <div class="column">
                    <div class="form-group">
                        <label for="nombre">10. ¿En este momento qué procedimientos de apoyo diagnostica en <br>
                            imageniologia son los que más ordena como especialista?</label>
                        <textarea placeholder="" name="preg_indag1" for="nombre" style="resize: none;" class="c_preg1" rows="1" cols="50"></textarea>
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="email">11. ¿Cree usted que nuestros resultados son confiables y determinantes <br> para
                            la definición del diagnóstico de sus pacientes?</label>
                        <textarea placeholder="" name="preg_indag2" for="nombre" style="resize: none;" class="c_preg1" rows="1" cols="50"></textarea>
                    </div>
                </div>
                <br>
                <div class="column">
                    <div class="form-group">
                        <label for="nombre">12. ¿Considera que en _____, somos oportunos con el Agendamiento <br> de las
                            citas para sus pacientes?</label>
                        <textarea placeholder="" name="preg_indag3" for="nombre" style="resize: none;" class="c_preg1" rows="1" cols="50"></textarea>
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="email">13. ¿Que piensa de la calidad de la imagen que usted recibe, está de <br> acuerdo
                            con los protocolos solicitados?</label>
                        <textarea placeholder="" name="preg_indag4" for="nombre" style="resize: none;" class="c_preg1" rows="1" cols="50"></textarea>
                    </div>
                </div>
            </div>
            <br>
            <!-- fila 4 -->
            <div class="row">
                <div class="column">
                    <div class="form-group">
                        <label for="nombre">14. ¿Esta de acuerdo con el tiempo de entrega de los resultados que <br>
                            entregamos a sus pacientes?</label>
                        <textarea placeholder="" name="preg_indag5" for="nombre" style="resize: none;" class="c_preg1" rows="1" cols="50"></textarea>
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="email">15. ¿Cuantos procedimientos de apoyo diagnóstico ordena en el mes? <br> Más de 5
                            más de 10</label>
                        <textarea placeholder="" name="preg_indag6" for="nombre" style="resize: none;" class="c_preg1" rows="1" cols="50"></textarea>
                    </div>
                </div>
                <br>
                <div class="column">
                    <div class="form-group">
                        <label for="nombre">16. ¿Sabe usar nuestra plataforma, para ver los resultados e imágenes <br> de
                            sus pacientes?</label>
                        <textarea placeholder="" name="preg_indag7" for="nombre" style="resize: none;" class="c_preg1" rows="1" cols="50"></textarea>
                    </div>
                </div>
            </div>
            <br>
            <hr>
            <br>
            <p class="titulos">Preguntas de indagación - parte 2</p>
            <br>
            <!-- fila 5 -->
            <div class="row">
                <div class="column">
                    <div class="form-group">
                        <label for="nombre">17. ¿Que cosas positivas ha encontrado en el proceso de toma <br> de
                            imagenes?</label>
                        <textarea placeholder="" name="preg_indag8" for="nombre" style="resize: none;" class="c_preg1" rows="1" cols="50"></textarea>
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="email">18. ¿Que ayudas diagnosticas cree que se necesita en la ciudad?</label>
                        <textarea placeholder="" name="preg_indag9" for="nombre" style="resize: none;" class="c_preg1" rows="1" cols="50"></textarea>
                    </div>
                </div>
                <br>
                <div class="column">
                    <div class="form-group">
                        <label for="nombre">19. ¿Durante este mes ha tenido alguna situación desafortunada <br> con algún
                            paciente que haya tomado nuestros servicios?</label>
                        <textarea placeholder="" name="preg_indag10" for="nombre" style="resize: none;" class="c_preg1" rows="1" cols="50"></textarea>
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="email">20. ¿Conoce alguna Tecnica que podemos innovar?</label>
                        <textarea placeholder="" name="preg_indag11" for="nombre" style="resize: none;" class="c_preg1" rows="1" cols="50"></textarea>
                    </div>
                </div>
            </div>
            <br>
            <!-- fila 5 -->
            <div class="row">
                <div class="column">
                    <div class="form-group">
                        <label for="nombre">21. ¿En Imagenologia que capacitación quisiera tener?</label>
                        <textarea placeholder="" name="preg_indag12" for="nombre"
                            style="resize: none;" class="c_preg1" rows="1" cols="50"></textarea>
                    </div>
                </div>
            </div>
            <br><br>
            <input type="submit" class="butons" name="butons" id="butons" value="Actualizar" />
        </form>
    </body>
</html>