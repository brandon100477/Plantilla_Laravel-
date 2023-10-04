const accordion_item = document.querySelectorAll(".accordion_item");
accordion_item.forEach((item) => {
    const accordion_header_item = item.querySelector(".accordion_header");
    accordion_header_item.addEventListener("click", () => {
    const accordion_content_item = item.querySelector(".accordion_content");
    const item_actived = document.querySelector(".active");
    VerifyActive(item, accordion_content_item, item_actived);
    });
});

function VerifyActive(item, content, content_actived, fondo) {
    const icon_item = item.querySelector(".icon");
    const icon_item_active = document.querySelectorAll(".icon");
    icon_item_active.forEach((item) => (item.innerHTML = "+"));
    if (content_actived) {
        content_actived.style.height = 0;
        content_actived.classList.remove("active");
    }
    if (content !== content_actived) {
        icon_item.innerHTML = "-";
        content.classList.add("active");
        content.style.height = content.scrollHeight + 20 + "px";
    }
}

 //Función para mostrar la alerta de registro éxitoso
 function mostrarAlerta() {
    // Muestra el alerta
    Swal.fire( '¡Buen trabajo!', 'Registro guardado con éxtio', 'success' );}
//Obtiene los datos del formulario
document.addEventListener("DOMContentLoaded", function () {
    const form = document.querySelector("form");
    const errorMessage = document.getElementById("error-message");
    form.addEventListener("submit", function (event) {
        event.preventDefault(); // Evita que el formulario se envíe automáticamente
        const nombreInput = document.getElementById("nombre"); // Obtiene el valor del campo "nombre"
        const nombre = nombreInput.value;
        // Realiza la validación
        if (!nombre || nombre.trim() === "") {
            Swal.fire({ icon: 'error', title: 'Oops...', text: 'Algo salió mal, ¿Agregaste por lo menos el nombre?'});
            // Lleva al usuario al principio del scroll o al inicio de la página
            window.scrollTo({
                top: 0, // Posición vertical (en píxeles) a la que quieres desplazarte
                behavior: "smooth"
            });
            errorMessage.textContent = "Por favor, ingrese al menos el nombre."; //Mensaje de error de color rojo.
            return; // Evita el envío del formulario
        } else { 
            mostrarAlerta(); // Llama a la función de la alerta
            setTimeout(function () { errorMessage.textContent = ""; form.submit(); }, 1500); // Retrasa el envío del formulario por 1 segundo
        }
    });
});