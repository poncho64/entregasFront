<?php
session_start();
include 'conexion.php'; // Incluir conexión a la base de datos

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario_super = $_POST["usuario_super"];
    $contrasena_super = $_POST["contrasena_super"];

    // Buscar el usuario en la base de datos
    $ruta = "SELECT * FROM superadmin WHERE usuario_super = ?";
    $rutaDefinida = $conn->prepare($ruta);
    $rutaDefinida->bind_param("s", $usuario_super);
    $rutaDefinida->execute();
    $resultado = $rutaDefinida->get_result();

    if ($resultado->num_rows == 1) {
        $usuario = $resultado->fetch_assoc();

        // Verificar la contraseña (si está encriptada con password_hash)
        if (password_verify($contrasena_super, $usuario["contrasena_super"])) {
            $_SESSION["usuario"] = $usuario["usuario_super"];
            header("Location: ../ingresar_admin.html"); // Redirige a la página principal
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
