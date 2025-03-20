<?php
session_start();
include 'conexion.php'; // Incluye tu archivo de conexión a la base de datos

// Verificar que sea una solicitud POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recibir los datos enviados desde el formulario
    $nombre_clinica = $_POST["nombre_clinica"];
    $direccion_clinica = $_POST["direccion_clinica"];
    $celular_clinica = $_POST["celular_clinica"];
    $fijo_clinica = $_POST["fijo_clinica"];
    $contacto_clinica = $_POST["contacto_clinica"];

    // Preparar la consulta para insertar los datos en la tabla de clínicas
    $stmt = $conn->prepare("INSERT INTO clinicas (nombre_clinica, direccion_clinica, celular_clinica, fijo_clinica, contacto_clinica) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $nombre_clinica, $direccion_clinica, $celular_clinica, $fijo_clinica, $contacto_clinica);

    // Ejecutar la consulta y verificar si fue exitosa
    if ($stmt->execute()) {
        echo "<script>alert('¡Clínica registrada con éxito!'); window.location.href='../ingresarmedicosclinica.html';</script>";
    } else {
        echo "<script>alert('Error al registrar la clínica: " . $stmt->error . "'); window.location.href='../ingresarmedicosclinica.html';</script>";
    }

    // Cerrar la declaración y la conexión
    $stmt->close();
    $conn->close();
} else {
    echo "<script>alert('Método no permitido'); window.location.href='../ingresarmedicosclinica.html';</script>";
}
