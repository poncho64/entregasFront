<?php
session_start();
include 'conexion.php'; // Incluye el archivo de conexión a la base de datos

// Verificar que sea una solicitud POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recibir los datos enviados desde el formulario
    $nombre_medico = $_POST["nombre_medico"];
    $apellido_medico = $_POST["apellido_medico"];
    $celular_medico = $_POST["celular_medico"];
    $contrasena_medico = $_POST["contrasena_medico"];

    // Generar el hash de la contraseña del médico
    $hash_contrasena = password_hash($contrasena_medico, PASSWORD_DEFAULT);

    // Preparar la consulta para insertar los datos en la tabla de médicos
    $resultados = $conn->prepare("INSERT INTO medicos (nombre_medico, apellido_medico, celular_medico, contrasena_medico) VALUES (?, ?, ?, ?)");
    $resultados->bind_param("ssss", $nombre_medico, $apellido_medico, $celular_medico, $hash_contrasena);

    // Ejecutar la consulta y verificar si fue exitosa
    if ($resultados->execute()) {
        echo "<script>alert('¡Médico registrado con éxito!'); window.location.href='../ingresarmedicosclinica.html';</script>";
    } else {
        echo "<script>alert('Error al registrar el médico: " . $stmt->error . "'); window.location.href='../ingresarmedicosclinica.html';</script>";
    }

    // Cerrar la declaración y la conexión
    $resultados->close();
    $conn->close();
} else {
    echo "<script>alert('Método no permitido'); window.location.href='../ingresarmedicosclinica.html';</script>";
}
