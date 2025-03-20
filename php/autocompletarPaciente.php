<?php
// Conexión a la base de datos
$conn = new mysqli("localhost", "root", "", "centro_medico");

if ($conn->connect_error) {
    echo json_encode(["success" => false, "message" => "Error al conectar con la base de datos."]);
    exit();
}

// Verificar si se proporcionó el documento
if (isset($_GET["doc_paciente"])) {
    $doc_paciente = $conn->real_escape_string($_GET["doc_paciente"]);

    // Consulta para buscar el paciente
    $datos = "SELECT nombre_paciente, apellido_paciente, celular_paciente 
            FROM pacientes 
            WHERE doc_paciente = '$doc_paciente'";

    $resultados = $conn->query($datos);

    if ($resultados->num_rows > 0) {
        $paciente = $resultados->fetch_assoc();
        echo json_encode([
            "success" => true,
            "nombre" => $paciente["nombre_paciente"],
            "apellido" => $paciente["apellido_paciente"],
            "celular" => $paciente["celular_paciente"]
        ]);
    } else {
        echo json_encode(["success" => false, "message" => "Paciente no encontrado."]);
    }
} else {
    echo json_encode(["success" => false, "message" => "Documento no proporcionado."]);
}

$conn->close();
