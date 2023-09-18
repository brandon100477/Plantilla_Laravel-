<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        <link rel="icon" href="{{ asset('img/favicon.png')}}">
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



<div class="row">
        <div class="column">
            <div class="form-group">
            <label class="nombre_especialista">Nombre del especialista:</label>
            <input type="text" class="documento_campo" name="documento_campo" id="nombre_campo">
            </div>
        </div>

        <div class="column">
            <div class="form-group">
            <label class="fechacreacion">Ciudad:</label>
            <input type="text" class="fechacreacion_campo" name="fecha_campo" id="ciudad_campo">
            </div>
        </div>

        <div class="column">
            <div class="form-group">
            <label class="fechacreacion">Especialista:</label>
            <input type="text" class="fechacreacion_campo" name="fecha_campo" id="especialista_campo">
            </div>
        </div>
</div>

<div class="row">
        <div class="column">
            <div class="form-group">
                <label class="estados">Categorias:</label><br>
                <select id="select" name="select" class="select" onchange="actualizar(this)">	
                    <option selected readonly>Seleccione una categoria</option>
                    <option value="2">Medicos</option>
                    <option value="3">Instituciones</option>
                    <option value="4">Centro deportivo</option>
                </select>
                </div>
        </div>

        <div class="column">
            <div class="form-group"><br>
            <input type="button" value="Seleccionar todo" class="btn btn-warning btn-sm" id="seleccionarTodo" onclick="seleccionarTodos();">
            </div>
        </div>

        <div class="column">
            <div class="form-group"><br>
            <input type="button" value="Buscar" class="btn btn-warning btn-sm" id="boton_buscar" onclick="filtrarTabla();">
            </div>
        </div>
</div>

<br>

<div class="collapse show" id="collapseTable">

    <div class="table-wrapper">

    <table class="table-light">
  <thead>
    <tr>
      <th scope="col">Seleccionar</th>
      <th scope="col">Especialidad</th>
      <th scope="col">Telefono</th>
      <th scope="col">Direccion</th>
      <th scope="col">Ciudad</th>
      <th scope="col" style="background-color: rgb(97, 0, 130);">Ver / Actualizar datos</th>
      <th scope="col" style="background-color: rgb(97, 0, 130);">Borrar formulario</th>
    </tr>
  </thead>
  <tbody>
    <tr>
        <th scope="row"><input type="checkbox" class="checkbox" name="seleccionar[]"></th>
        <td>Mark</td>
        <td>Otto</td>
        <td>@mdo</td>
        <td>ciudad</td>
        <td><a href ="descripcion_suceso.php" id="boton_melo" class="boton_melo" name="butons">Actualizar</a></td>
        <td>
            <form id="eliminarForm_" method="post">
                <!-- Agregamos un input hidden para enviar el ID del elemento a eliminar -->
                <input type="hidden" name="eliminar" value="">
                <!-- Botón de eliminación -->
                <button type="button" class="fa-solid fa-xmark btn-lg" id="boton_borrar" name="butons" onclick="confirmarEliminacion(this);"></button>              
            </form>
        </td>
    </tr>
    <tr>
        <th scope="row"><input type="checkbox" class="checkbox" name="seleccionar[]"></th>
        <td>Jacob</td>
        <td>Thornton</td>
        <td>@fat</td>
        <td>ciudad</td>
        <td><a href ="descripcion_suceso.php" id="boton_melo" class="boton_melo" name="butons">Actualizar</a></td>
        <td>
            <form id="eliminarForm_" method="post">
                <!-- Agregamos un input hidden para enviar el ID del elemento a eliminar -->
                <input type="hidden" name="eliminar" value="">
                <!-- Botón de eliminación -->
                <button type="button" class="fa-solid fa-xmark btn-lg" id="boton_borrar" name="butons" onclick="confirmarEliminacion(this);"></button>              
            </form>
        </td>
    </tr>
    <tr>
        <th scope="row"><input type="checkbox" class="checkbox" name="seleccionar[]"></th>
        <td colspan="2">Larry the Bird</td>
        <td>@twitter</td>
        <td>ciudad</td>
        <td><a href ="descripcion_suceso.php" id="boton_melo" class="boton_melo" name="butons">Actualizar</a></td>
        <td>
            <form id="eliminarForm_" method="post">
                <!-- Agregamos un input hidden para enviar el ID del elemento a eliminar -->
                <input type="hidden" name="eliminar" value="">
                <!-- Botón de eliminación -->
                <button type="button" class="fa-solid fa-xmark btn-lg" id="boton_borrar" name="butons" onclick="confirmarEliminacion(this);"></button>              
            </form>
        </td>              
            </form>
        </td>
    </tr>
    </tbody>
</table>

</table>
</div>
</div>

<br><br>

<div class="titulo1">

<input type="button" value="Descargar Excel" class="btn btn-warning btn-sm" id="boton_excel">

</div>
        </section>

<script type="text/javascript">

var checkboxesSeleccionados = false;

function filtrarTabla() {
    var nombre_campo = document.getElementById("nombre_campo").value.toLowerCase();
    var palabrasNombre = nombre_campo.split(" ");

    // Accedemos a la tabla
    var tabla = document.getElementById("tabla");

    for (var i = 1; i < tabla.rows.length; i++) {
        var nombre_bd = tabla.rows[i].cells[1].innerHTML.toLowerCase();
        var coincideNombre = false;

        // Comparamos el nombre con cada palabra ingresada
        for (var j = 0; j < palabrasNombre.length; j++) {
            if (nombre_bd.includes(palabrasNombre[j])) {
                coincideNombre = true;
                break;
            }
        }

        if (palabrasNombre.length > 0 && !coincideNombre) {
            tabla.rows[i].style.display = "none";
        } else {
            tabla.rows[i].style.display = "";
        }
    }


    var ciudad_campo = document.getElementById("ciudad_campo").value;
    var especialista_campo = document.getElementById("especialista_campo").value;
    
    if (ciudad_campo !== '' || especialista_campo !== '') {
        for (var i = 1; i < tabla.rows.length; i++) {
            var ciudad_bs = tabla.rows[i].cells[5].innerHTML;
            var especialista_bs = tabla.rows[i].cells[2].innerHTML;
            
            if (ciudad_campo === ciudad_bs || especialista_campo === especialista_bs) {
                tabla.rows[i].style.display = "";
            } else {
                tabla.rows[i].style.display = "none";
            }     
        }
    }
}


function actualizar(opcion) {
    var valor_select = document.getElementById("select").value;
    var tabla = document.getElementById("tabla");
    var button = document.getElementById("checked"); // Obtén una referencia al botón

    for (var i = 1; i < tabla.rows.length; i++) {
        var estado_tabla = tabla.rows[i].cells[28].innerHTML;

        if (valor_select === "2") {
            if (estado_tabla === "2") {
                tabla.rows[i].style.display = "";
            } else {
                tabla.rows[i].style.display = "none";
            }
        }

        if (valor_select === "3") {
            if (estado_tabla === "3") {
                tabla.rows[i].style.display = "";               
            } else {
                tabla.rows[i].style.display = "none";
            }
        }

        if (valor_select === "4") {
            if (estado_tabla === "4") {
                tabla.rows[i].style.display = "";               
            } else {
                tabla.rows[i].style.display = "none";
            }
        }

    }
}


document.getElementById("boton_excel").addEventListener("click", function () {
    var tabla = document.getElementById("tabla");
    var filasSeleccionadas = [];
    var encabezados = [];

    // Obtener los encabezados de las columnas
    for (var j = 1; j < tabla.rows[0].cells.length; j++) {
      encabezados.push(tabla.rows[0].cells[j].innerText);
    }
    filasSeleccionadas.push(encabezados);

    // Recorre todas las filas de la tabla y verifica si están seleccionadas
    for (var i = 1; i < tabla.rows.length; i++) {
      var checkbox = tabla.rows[i].querySelector('input[type="checkbox"]');
      if (checkbox.checked) {
        // Si la fila está seleccionada, agrega los datos a filasSeleccionadas
        var rowData = [];
        for (var j = 1; j < tabla.rows[i].cells.length; j++) {
          rowData.push(tabla.rows[i].cells[j].innerText);
        }
        filasSeleccionadas.push(rowData);
      }
    }

    // Si hay filas seleccionadas, crea el archivo Excel y descárgalo
    if (filasSeleccionadas.length > 1) { // Verifica que se hayan seleccionado más de los encabezados
      var workbook = XLSX.utils.book_new();
      var worksheet = XLSX.utils.aoa_to_sheet(filasSeleccionadas);
      XLSX.utils.book_append_sheet(workbook, worksheet, "Datos Seleccionados");
      var fechaActual = new Date().toLocaleDateString("en-US").replaceAll("/", "-");
      var nombreArchivo = "datos_seleccionados_" + fechaActual + ".xlsx";
      XLSX.writeFile(workbook, nombreArchivo);
    } else {
      alert("No has seleccionado ninguna fila.");
    }
  });


  function seleccionarTodos() {
  // Obtener todos los checkboxes con la clase "checkbox"
  var checkboxes = document.getElementsByClassName("checkbox");

  // Recorrer los checkboxes y establecer su propiedad "checked" según el estado actual
  checkboxesSeleccionados = !checkboxesSeleccionados; // Alternar el estado

  for (var i = 0; i < checkboxes.length; i++) {
    checkboxes[i].checked = checkboxesSeleccionados;
  }
}

function confirmarEliminacion(button) {
        if (confirm("¿Estás seguro de eliminar esta fila?")) {
            // Si el usuario confirma, enviar el formulario para eliminar
            button.form.submit();
        }
    }

</script>




    
</body>
</html>