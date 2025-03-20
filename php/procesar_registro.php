<?php
session_start();
include 'conexion.php'; // Incluir conexión a la base de datos

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $doc_paciente = $_POST["doc_paciente"];
    $contrasena_paciente = $_POST["contrasena_paciente"];

    // Buscar el usuario en la base de datos
    $ruta = "SELECT * FROM pacientes WHERE doc_paciente = ?";
    $rutaDefinida = $conn->prepare($ruta);
    $rutaDefinida->bind_param("s", $doc_paciente);
    $rutaDefinida->execute();
    $resultado = $rutaDefinida->get_result();

    if ($resultado->num_rows == 1) {
        $usuario = $resultado->fetch_assoc();

        // Verificar la contraseña (si está encriptada con password_hash)
        if (password_verify($contrasena_paciente, $usuario["contrasena_paciente"])) {
            $_SESSION["usuario"] = $usuario["nombre_paciente"];
            header("Location: ../registroCitas.html"); // Redirige a la página principal
            exit();
        } else {
            echo "Contraseña incorrecta";
        }
    } else {
        echo "Usuario no encontrado";
        echo "<script>alert('Usuario no encontrado'); window.location.href='../ingreso.html';</script>";
    }

    $rutaDefinida->close();
}

$conn->close();
