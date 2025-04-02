<?php
$host = "localhost"; // Dirección del servidor donde se aloja la base de datos
$user = "root"; // Nombre de usuario de MySQL (puedes cambiarlo si usas otro usuario)
$pass = ""; // Contraseña del usuario (si no tienes, déjalo vacío)
$db = "centro_medico"; // Nombre de la base de datos que se utilizará

// Crear conexión
$conn = new mysqli($host, $user, $pass, $db); // Crea una instancia de conexión usando MySQLi

// Verificar conexión
if ($conn->connect_error) {
    // Detiene la ejecución y muestra un mensaje de error si la conexión falla
    die("Error de conexión: " . $conn->connect_error);
}

// Establecer el conjunto de caracteres a utf8
$conn->set_charset("utf8"); // Configura el juego de caracteres para garantizar compatibilidad con caracteres especiales
