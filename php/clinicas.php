<?php
// Conexión a la base de datos
$conn = new mysqli("localhost", "root", "", "centro_medico");

if ($conn->connect_error) {
    echo json_encode(["success" => false, "message" => "Error al conectar con la base de datos."]);
    exit();
}

// Consulta para obtener las clínicas
$sql = "SELECT nombre_clinica FROM clinicas";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $clinicas = [];
    while ($row = $result->fetch_assoc()) {
        $clinicas[] = $row["nombre_clinica"];
    }
    echo json_encode(["success" => true, "data" => $clinicas]);
} else {
    echo json_encode(["success" => false, "message" => "No hay clínicas disponibles."]);
}

$conn->close();
