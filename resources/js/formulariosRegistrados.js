function toggleSeleccionTodos() {
    const checkboxes = document.querySelectorAll('.checkbox');

    // Obtiene el estado actual del primer checkbox
    const primerCheckbox = checkboxes[0];
    const seleccionar = !primerCheckbox.checked;

    // Cambia el estado de todos los checkboxes
    checkboxes.forEach(checkbox => {
        checkbox.checked = seleccionar;
    });
}