// Obtener elementos del DOM
const registrarBtn = document.getElementById("registrar-btn");
const modal = document.getElementById("registro-modal");
const closeBtn = document.querySelector(".close");
const inputFoto = document.getElementById("foto_paciente");
const preview = document.getElementById("preview");

// Abrir el modal
registrarBtn.addEventListener("click", () => {
    modal.style.display = "block";
});

// Cerrar el modal
closeBtn.addEventListener("click", () => {
    modal.style.display = "none";
});

// Cerrar modal al hacer clic fuera del contenido
window.addEventListener("click", (event) => {
    if (event.target === modal) {
        modal.style.display = "none";
    }
});

// Vista previa de la imagen
inputFoto.addEventListener("change", (event) => {
    const archivo = event.target.files[0];
    if (archivo) {
        const lector = new FileReader();
        lector.onload = (e) => {
            preview.src = e.target.result;
            preview.style.display = "block";
        };
        lector.readAsDataURL(archivo);
    } else {
        preview.src = "";
        preview.style.display = "none";
    }
});
