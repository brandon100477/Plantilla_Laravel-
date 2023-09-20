function seleccionarTodos() {
    // Obtener todos los checkboxes con la clase "checkbox"
    var checkboxes = document.getElementsByClassName("checkbox");

    // Recorrer los checkboxes y establecer su propiedad "checked" según el estado actual
    checkboxesSeleccionados = !checkboxesSeleccionados; // Alternar el estado

    for (var i = 0; i < checkboxes.length; i++) {
    checkboxes[i].checked = checkboxesSeleccionados;
    }
}