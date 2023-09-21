<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        <link rel="icon" href="{{ asset('img/favicon.png')}}">
        <link src="../js/formulariosRegistrados.js">
        <title>Formularios Registrados</title>
        <a href="{{ route('volver1')}}" class="cerrar" id="cerrar">Volver</a>
    </head>
    <body>
        <div class="heading">
            <h1 class="filtrar">Formularios Registrados</h1>
        </div>
        <section method="POST" class="registro">
        <!-- FILA 1 -->
        <br><br>
        <div class="titulo1">
            <label class="titulo_2">Filtrar formularios por:</label>
        </div>
        <!-- FILA 2 -->
        <br><br>
        <form>
            <div class="column">
                <div class="form-group">
                    <input type="search" class="documento_campo" name="documento_campo" id="documento_campo" value="{{ $filtro_nombre }}" placeholder="Nombre del especialista: ">
                    <input type="text" class="fechacreacion_campo" name="especialidad_campo" id="especialidad_campo" value="{{ $filtro_especialidad }}" placeholder="Especialista: ">
                    <input type="text" class="fechacreacion_campo" name="ciudad_campo" id="ciudad_campo" value="{{ $filtro_ciudad }}" placeholder="Ciudad: ">
                </div>
            </div>
            <!-- Botón para filtrar por medio de la categoría en los componentes de la tabla-->
            <div class="column">
                <div class="form-group">
                    <label class="estados">Categorias:</label><br>
                    <select type="submit" id="select" name="select" class="select" value="{{ $filtro_select }}">	
                        <option selected readonly value="">Seleccione una categoria</option>
                        <option value="2">Medicos</option>
                        <option value="3">Instituciones</option>
                        <option value="4">Centro deportivo</option>
                    </select>
                </div>
            </div>
            <!-- Botón para buscar los componentes de la tabla-->
            <button type="submit" >Buscar</button>
        </form>

        <!-- Botón para seleccionar todos los componentes de la tabla-->
        <div class="column">
            <div class="form-group"><br>
            <input type="button" value="Seleccionar todo" class="btn btn-warning btn-sm" id="seleccionarTodo" onclick="seleccionarTodos();">
            </div>
        </div>  
        <br>

        <!--Tabla con sus respectivos componentes-->
        <div class="collapse show" id="collapseTable">
            <div class="table-wrapper">
                <table class="table-light">
                    <thead>
                        <tr>
                            <th scope="col">Seleccionar</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Especialidad</th>
                            <th scope="col">Telefono</th>
                            <th scope="col">Direccion</th>
                            <th scope="col">Ciudad</th>
                            <th scope="col" style="background-color: rgb(97, 0, 130);">Ver / Actualizar datos</th>
                            <th scope="col" style="background-color: rgb(97, 0, 130);">Borrar formulario</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($datos as $dato)
                        <tr>
                            <th scope="row"><input type="checkbox" class="checkbox" name="seleccionar[]"></th>
                            <td>{{ $dato->nombre }}</td>
                            <td>{{ $dato->especialidad }}</td>
                            <td>{{ $dato->telefono }}</td>
                            <td>{{ $dato->direccion }}</td>
                            <td>{{ $dato->ciudad }}</td>
                            <td><a href ="{{route('actualizar')}}" id="boton_melo" class="boton_melo" name="butons">Actualizar</a></td>
                            <td>
                                <form id="eliminarForm_" method="post">
                                    <!-- Agregamos un input hidden para enviar el ID del elemento a eliminar -->
                                    <input type="hidden" name="eliminar" value="">
                                    <!-- Botón de eliminación -->
                                    <button type="button" class="fa-solid fa-xmark btn-lg" id="boton_borrar" name="butons" onclick="confirmarEliminacion(this);"></button>              
                                </form>
                            </td>
                        </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    <br><br>
        <div class="titulo1">
            <input href="{{ route('registrados')}}" name="boton_excel" type="button" value="Descargar Excel" class="btn btn-warning btn-sm" id="boton_excel">
        </div>
    </body>
</html>