<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        <link rel="icon" href="{{ asset('img/favicon.png')}}">
        <link src="{{ asset('js/formulariosRegistrados.js')}}">
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <title>Formularios Registrados</title>
        <a href="{{ route('volver1')}}" class="cerrar" id="cerrar">Volver</a>
    </head>
    <body>
        <div class="heading">
            <h1 class="filtrar">Formularios Registrados</h1>
        </div>
        <section method="POST" class="registro">
        <br><br>
        <div class="titulo1">
            <label class="titulo_2">Filtrar formularios por:</label>
        </div>
        <br><br>
        <form><!-- Formulario para hacer las respectivas busquedas -->
            <div class="column">
                <div class="form-group">
                    <input type="search" class="documento_campo" name="documento_campo" id="documento_campo" value="{{ $filtro_nombre }}" placeholder="Nombre del especialista: ">
                    <input type="search" class="fechacreacion_campo" name="especialidad_campo" id="especialidad_campo" value="{{ $filtro_especialidad }}" placeholder="Especialista: ">
                    <input type="search" class="fechacreacion_campo" name="ciudad_campo" id="ciudad_campo" value="{{ $filtro_ciudad }}" placeholder="Ciudad: ">
                </div>
            </div>
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
            <button type="submit" >Buscar</button><!-- Botón para buscar los componentes de la tabla-->
            <input type="hidden" name="seleccionados" id="seleccionados" value=""><!-- Se agrega un campo oculto para almacenar los IDs de los elementos seleccionados -->
            <!-- Botón para seleccionar todos los componentes de la tabla -->
            <input type="button" value="Seleccionar todo" class="btn btn-warning btn-sm" id="seleccionarTodo" onclick="toggleSeleccionTodos();">
                <!--Scrip para el botón de seleccionar todos los campos en el checkbox-->
                <script>
                    function toggleSeleccionTodos() {
                    const checkboxes = document.querySelectorAll('.checkbox');
                    const seleccionarTodo = document.getElementById('seleccionarTodo');
                    const seleccionados = [];
                    checkboxes.forEach(checkbox => {
                        checkbox.checked = !checkbox.checked;
                        // Si el checkbox está marcado, agrega su ID a la lista de seleccionados
                        if (checkbox.checked) {
                            seleccionados.push(checkbox.dataset.id);
                        }
                    });
                // Almacena los IDs de los elementos seleccionados en el campo oculto
                document.getElementById('seleccionados').value = seleccionados.join(',');
                // Actualiza la acción del formulario para enviar solo los elementos seleccionados
                document.getElementById('formDescargarExcel').action = "{{ route('exportar') }}";
                    }
                </script>
        </form>
        <br>
        <br>
        <form method="post" action="{{ route('exportar') }}" id="formDescargarExcel" onsubmit="return validarSeleccion();">
            @csrf
            <!-- Aquí se guardan los datos filtrados para ser exportados -->
            <input type="hidden" class="documento_campo" name="documento_campo" value="{{ $filtro_nombre }}" placeholder="Nombre del especialista: ">
            <input type="hidden" class="fechacreacion_campo" name="especialidad_campo" value="{{ $filtro_especialidad }}" placeholder="Especialista: ">
            <input type="hidden" class="fechacreacion_campo" name="ciudad_campo" value="{{ $filtro_ciudad }}" placeholder="Ciudad: ">
            <input type="hidden" id="select" name="select" class="select" value="{{ $filtro_select }}">
            <button type="submit">Descargar Excel</button><!-- Botón para exportar el excel -->
            <br>
        </form>
        <!-- Agrega una función de validación en JavaScript -->
        <script>
        function validarSeleccion() {
            const checkboxes = document.querySelectorAll('.checkbox:checked');
            if (checkboxes.length === 0) {
                Swal.fire({
                title: '¡Ups. Algo salio mal!',
                text: 'Selecciona mínimo un dato',
                icon: 'warning',
        });
                return false; // Evita enviar el formulario si no hay checkboxes seleccionados
            }
            // Continúa con el envío del formulario si al menos un checkbox está seleccionado
            return true;
        }
        </script>
        <br>
        <!--Tabla con sus respectivos componentes-->
        <div class="collapse show" id="collapseTable">
            <div class="table-wrapper">
                <table class="table-light">
                    <thead>
                        <tr >
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
                        @foreach ($datos as $dato) <!--recorre la tabla y muestra todos los datos -->
                        <tr class="fila-datos" data-id="{{ $dato->id }}">
                            <td><input type="checkbox" class="checkbox" name="seleccionados" data-id="{{ $dato->id }}" value="{{ $dato->id }}" {{ $dato->is_selected ? 'checked' : '' }}></td>
                            <td>{{ $dato->nombre }}</td>
                            <td>{{ $dato->especialidad }}</td>
                            <td>{{ $dato->telefono }}</td>
                            <td>{{ $dato->direccion }}</td>
                            <td>{{ $dato->ciudad }}</td>
                            <td>
                            <form id="actualizar_{{ $dato->id }}" method="post" action="{{ route('actualizar') }}">
                                    @csrf
                                    <!-- Agregamos un input hidden para enviar el ID del elemento a actualizar -->
                                    <input type="hidden" name="actualizar_id" value="{{ $dato->id }}">
                                    <!-- Botón para actualizar -->
                                    <button type="submit" class="fa-solid fa-xmark btn-lg" id="boton_borrar" name="butons">actualizar</button>
                            </form>
                            </td>
                            <td>
                                <form id="eliminarForm_{{ $dato->id }}" method="post" action="{{ route('eliminar') }}">
                                    @csrf
                                    <!-- Agregamos un input hidden para enviar el ID del elemento a eliminar -->
                                    <input type="hidden" name="eliminar_id" value="{{ $dato->id }}">
                                    <!-- Botón de eliminación -->
                                    <button type="submit" class="fa-solid fa-xmark btn-lg boton-eliminar" data-id="{{ $dato->id }}" id="boton_borrar" name="butons">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    <br><br>
    </body>
    <!-- botón para eliminar registros -->
    <script>
    async function mostrarAlertaEliminar(id) {
        const result = await Swal.fire({
            title: '¿Estás seguro?',
            text: 'No podrás revertir esto.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sí, Bórralo'
        });
        if (result.isConfirmed) {
            Swal.fire(
                '¡Borrado!',
                'El registro ha sido eliminado',
                'success'
            )
            // El usuario confirmó la eliminación, realiza la acción aquí
            const form = document.getElementById(`eliminarForm_${id}`);
            setTimeout(function () {form.submit(); }, 1400);
        }
    }

    document.addEventListener("DOMContentLoaded", function () {
        const form = document.querySelector("form");
        form.addEventListener("submit", async function (event) {
            await mostrarAlerta(); // Muestra la alerta y espera a que se cierre
            form.submit(); // Envía el formulario después de mostrar la alerta
        });
        const botonesEliminar = document.querySelectorAll(".boton-eliminar"); // Agregar un evento click a los botones de eliminar en cada fila de la tabla
        botonesEliminar.forEach(boton => {
            boton.addEventListener("click", function (event) {
                event.preventDefault(); // Evita que el enlace o botón haga su acción predeterminada
                const id = boton.dataset.id; // Obtén el ID del botón de eliminar
                mostrarAlertaEliminar(id); // Muestra la alerta de confirmación
            });
        });
    });
</script>
</html>