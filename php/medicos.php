<?php
// Conexión a la base de datos
$conn = new mysqli("localhost", "root", "", "centro_medico");

if ($conn->connect_error) {
    echo json_encode(["success" => false, "message" => "Error al conectar con la base de datos."]);
    exit();
}

// Consulta para obtener los médicos
$datos = "SELECT CONCAT(nombre_medico, ' ', apellido_medico) AS nombre_completo FROM medicos";
$resultados = $conn->query($datos);

if ($resultados->num_rows > 0) {
    $medicos = [];
    while ($row = $resultados->fetch_assoc()) {
        $medicos[] = $row["nombre_completo"];
    }
    echo json_encode(["success" => true, "data" => $medicos]);
} else {
    echo json_encode(["success" => false, "message" => "No hay médicos disponibles."]);
}

$conn->close();
