<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        <link rel="icon" href="{{ asset('img/favicon.png')}}">
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="https://kit.fontawesome.com/6608247b8b.js" crossorigin="anonymous"></script>
        <title>Formularios Registrados</title>
        @vite(['resources/css/formulariosRegistrados.css'])
    </head>
    <body>
        <div class="heading">
            <h1 class="filtrar">Formularios Registrados</h1>
            <a href="{{ route('volver1')}}" class="cerrar" id="cerrar">Volver</a>
        </div>
        <section method="POST" class="registro"><br><br>
            <div class="titulo1">
                <label class="titulo_2">Filtrar formularios por:</label>
            </div><br><br>
            <div class="row">
                    <div class="column">
            <form><!-- Formulario para hacer las respectivas busquedas -->
                    <div class="column">
                        <div class="form-group">
                            <input type="search" class="documento_campo" name="documento_campo" id="documento_campo" value="{{ $filtro_nombre }}" placeholder="Nombre del especialista: "><br><br><br>
                            <input type="search" class="fechacreacion_campo" name="especialidad_campo" id="especialidad_campo" value="{{ $filtro_especialidad }}" placeholder="Especialista: "><br><br><br>
                            <input type="search" class="fechacreacion_campo" name="ciudad_campo" id="ciudad_campo" value="{{ $filtro_ciudad }}" placeholder="Ciudad: "><br><br>
                        </div>
                    </div>
            
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
                <input type="button" value="Seleccionar todo" class="btn btn-warning btn-sm" id="seleccionarTodo" onclick="toggleSeleccionTodos();"><br><br> <!--Scrip para el botón de seleccionar todos los campos en el checkbox-->
                <button class="btn btn-warning btn-sm" id="boton_buscar" type="submit" >Buscar</button><!-- Botón para buscar los componentes de la tabla-->
                <input type="hidden" name="seleccionados" id="seleccionados" value=""><!-- Campo oculto para almacenar los IDs de los elementos seleccionados -->
                </form>
            </div>
            </div><br><br>
            <!--Tabla con sus respectivos componentes-->
            <form method="post" action="{{ route('exportar') }}" id="formDescargarExcel" onsubmit="return validarSeleccion();"><!-- Agrega una función de validación para exportar en JavaScript -->
                @csrf
                <!-- Aquí se guardan los datos filtrados para ser exportados -->
                <input type="hidden" name="documento_campo" value="{{ $filtro_nombre }}">
                <input type="hidden" name="especialidad_campo" value="{{ $filtro_especialidad }}">
                <input type="hidden" name="ciudad_campo" value="{{ $filtro_ciudad }}">
                <input type="hidden" id="select" name="select" class="select" value="{{ $filtro_select }}"><br>
                <div class="collapse show" id="collapseTable">
                    <div class="table-wrapper">
                        <table class="table-light" id="tabla">
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
                                @foreach ($datos as $dato) <!--recorre la tabla y muestra todos los datos -->
                                <tr class="fila-datos" data-id="{{ $dato->id }}">
                                    <td><input type="checkbox" class="checkbox" name="seleccionados[]" value="{{ $dato->id }}"></td>
                                    <td>{{ $dato->nombre }}</td>
                                    <td>{{ $dato->especialidad }}</td>
                                    <td>{{ $dato->telefono }}</td>
                                    <td>{{ $dato->direccion }}</td>
                                    <td>{{ $dato->ciudad }}</td>
                                    <td><a href="{{ route('actualizar', ['id' => $dato->id]) }}" class="fas fa-pencil-alt boton_melo"></a></td>
                                
                                    <td>
                                    <a href="javascript:void(0);" class="fa-solid fa-trash borrar" onclick="mostrarAlertaEliminar('{{ $dato->id }}');"></a></td> <!-- Se envía al JS para mostrar la confirmación de eliminación -->
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div><br><br>
                <div class="titulo1">
                    <button type="submit" class="btn btn-warning btn-sm" id="boton_excel">Descargar Excel</button><!-- Botón para exportar el excel -->
                </div><br>
            </form><br><br>
        </section>
    </body>
    <script>
                function mostrarAlertaEliminar(id) {
            Swal.fire({
                title: '¿Estás seguro?',
                text: 'No podrás revertir esto.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sí, Bórralo'
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire(
                        '¡Borrado!',
                        'El registro ha sido eliminado',
                        'success'
                    );
                    // Si el usuario confirmó la eliminación, redirige al controlador de eliminación en 1,5 segundos
                    setTimeout(function () { window.location.href = `{{ url('medicos/formularios-registrados/Eliminar/') }}/${id}`; }, 1500);
                }
            });
        }
        function toggleSeleccionTodos() {/* Función para el botón "seleccionar todos" para checkbox */
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
            document.getElementById('seleccionados').value = seleccionados.join(','); // Almacena los IDs de los elementos seleccionados en el campo oculto
            document.getElementById('formDescargarExcel').action = "{{ route('exportar') }}"; // Actualiza la acción del formulario para enviar solo los elementos seleccionados
        }
        function validarSeleccion() {/* Función para validar los checkbox antes de exportar "Por lo menos 1 checkbox seleccionado" */
            const checkboxes = document.querySelectorAll('.checkbox:checked');
            if (checkboxes.length === 0) {
                Swal.fire({
                title: '¡Ups. Algo salio mal!',
                text: 'Selecciona mínimo un dato',
                icon: 'warning',
                });
                return false; // Evita enviar el formulario si no hay checkboxes seleccionados
            }
            return true;// Continúa con el envío del formulario si al menos un checkbox está seleccionado
        }
    </script>
</html>