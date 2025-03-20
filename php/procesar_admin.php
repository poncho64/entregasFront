<?php
session_start();
include 'conexion.php'; // Incluir conexión a la base de datos

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario_admin = $_POST["usuario_admin"];
    $contrasena_admin = $_POST["contrasena_admin"];

    // Buscar el usuario en la base de datos
    $ruta = "SELECT * FROM administrador WHERE usuario_admin = ?";
    $rutaDefinida = $conn->prepare($ruta);
    $rutaDefinida->bind_param("s", $usuario_admin);
    $rutaDefinida->execute();
    $resultado = $rutaDefinida->get_result();

    if ($resultado->num_rows == 1) {
        $usuario = $resultado->fetch_assoc();

        // Verificar la contraseña (si está encriptada con password_hash)
        if (password_verify($contrasena_admin, $usuario["contrasena_admin"])) {
            $_SESSION["usuario"] = $usuario["usuario_admin"];
            header("Location: ../ingresarmedicosclinica.html"); // Redirige a la página principal
            exit();
        } else {
            echo "Contraseña incorrecta";
        }
    } else {
        echo "Usuario no encontrado";
        echo "<script>alert('Usuario no encontrado'); window.location.href='../admincentromedico.html';</script>";
    }

    $rutaDefinida->close();
}

$conn->close();
