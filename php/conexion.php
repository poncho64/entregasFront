<?php
$host = "localhost"; // Servidor
$user = "root"; // Usuario de MySQL (cambia si es diferente)
$pass = ""; // Contraseña (dejar vacío si no tiene)
$db = "centro_medico"; // Nombre de la base de datos

// Crear conexión
$conn = new mysqli($host, $user, $pass, $db);

// Verificar conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Establecer el conjunto de caracteres a utf8
$conn->set_charset("utf8");
