<?php
// Conexión a la base de datos
$conn = new mysqli("localhost", "root", "", "centro_medico"); // Crea una nueva conexión a la base de datos "centro_medico"

if ($conn->connect_error) {
    // Verifica si hay un error en la conexión y responde con un mensaje de error en formato JSON
    echo json_encode(["success" => false, "message" => "Error al conectar con la base de datos."]);
    exit(); // Detiene la ejecución del script si hay error
}

// Consulta para obtener las clínicas
$datos = "SELECT nombre_clinica FROM clinicas"; // Consulta SQL para obtener los nombres de las clínicas
$resultados = $conn->query($datos); // Ejecuta la consulta

if ($resultados->num_rows > 0) {
    // Si se encuentran resultados, crea un array para almacenar las clínicas
    $clinicas = [];
    while ($row = $resultados->fetch_assoc()) {
        $clinicas[] = $row["nombre_clinica"]; // Agrega cada clínica al array
    }
    // Responde con éxito y los datos de las clínicas en formato JSON
    echo json_encode(["success" => true, "data" => $clinicas]);
} else {
    // Si no hay resultados, responde con un mensaje en formato JSON
    echo json_encode(["success" => false, "message" => "No hay clínicas disponibles."]);
}

// Cierra la conexión a la base de datos
$conn->close();
