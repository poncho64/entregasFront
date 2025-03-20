<?php
// Conexión a la base de datos
$conn = new mysqli("localhost", "root", "", "centro_medico");

if ($conn->connect_error) {
    echo json_encode(["success" => false, "message" => "Error al conectar con la base de datos."]);
    exit();
}

// Consulta para obtener las clínicas
$datos = "SELECT nombre_clinica FROM clinicas";
$resultados = $conn->query($datos);

if ($resultados->num_rows > 0) {
    $clinicas = [];
    while ($row = $resultados->fetch_assoc()) {
        $clinicas[] = $row["nombre_clinica"];
    }
    echo json_encode(["success" => true, "data" => $clinicas]);
} else {
    echo json_encode(["success" => false, "message" => "No hay clínicas disponibles."]);
}

$conn->close();
