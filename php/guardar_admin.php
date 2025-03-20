<?php
session_start();
include 'conexion.php'; // Asegúrate de que este archivo tenga la conexión a tu base de datos

// Verificar que sea una solicitud POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recibir los datos enviados desde el formulario
    $usuario_admin = $_POST["usuario_admin"];
    $contrasena_admin = $_POST["contrasena_admin"];

    // Generar el hash de la contraseña
    $hash_contrasena = password_hash($contrasena_admin, PASSWORD_DEFAULT);

    // Insertar el nuevo administrador en la base de datos
    $datostb = $conn->prepare("INSERT INTO administrador (usuario_admin, contrasena_admin) VALUES (?, ?)");
    $datostb->bind_param("ss", $usuario_admin, $hash_contrasena);

    if ($datostb->execute()) {
        // Mensaje de éxito
        echo "<script>alert('Administrador guardado con éxito'); window.location.href='../ingresar_admin.html';</script>";
    } else {
        // Mensaje de error
        echo "<script>alert('Error al guardar el administrador: " . $stmt->error . "'); window.location.href='../ingresar_admin.html';</script>";
    }

    $datostb->close();
    $conn->close();
}
