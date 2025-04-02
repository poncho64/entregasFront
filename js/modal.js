// Obtener elementos del DOM
const registrarBtn = document.getElementById("registrar-btn"); // Botón para abrir el modal de registro
const modal = document.getElementById("registro-modal"); // Modal de registro
const closeBtn = document.querySelector(".close"); // Botón para cerrar el modal
const inputFoto = document.getElementById("foto_paciente"); // Campo de entrada para la imagen
const preview = document.getElementById("preview"); // Elemento para mostrar la vista previa de la imagen

// Abrir el modal
registrarBtn.addEventListener("click", () => {
    // Cambia el estilo del modal para que sea visible
    modal.style.display = "block";
});

// Cerrar el modal
closeBtn.addEventListener("click", () => {
    // Cambia el estilo del modal para ocultarlo
    modal.style.display = "none";
});

// Cerrar modal al hacer clic fuera del contenido
window.addEventListener("click", (event) => {
    // Verifica si el clic fue fuera del contenido del modal y lo cierra
    if (event.target === modal) {
        modal.style.display = "none";
    }
});

// Vista previa de la imagen
inputFoto.addEventListener("change", (event) => {
    // Obtiene el archivo seleccionado por el usuario
    const archivo = event.target.files[0];
    if (archivo) {
        const lector = new FileReader();
        lector.onload = (e) => {
            // Actualiza la vista previa con la imagen cargada
            preview.src = e.target.result;
            preview.style.display = "block"; // Muestra el elemento de la vista previa
        };
        lector.readAsDataURL(archivo); // Convierte el archivo a una URL en base64
    } else {
        // Si no hay archivo seleccionado, oculta la vista previa
        preview.src = "";
        preview.style.display = "none";
    }
});
