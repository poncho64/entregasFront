<?php
// Conexión a la base de datos
$conn = new mysqli("localhost", "root", "", "centro_medico"); // Establece conexión con la base de datos "centro_medico"

if ($conn->connect_error) {
    // Muestra un mensaje de error si la conexión falla y finaliza la ejecución
    echo json_encode(["success" => false, "message" => "Error al conectar con la base de datos."]);
    exit();
}

// Verificar si se proporcionó el documento
if (isset($_GET["doc_paciente"])) {
    // Escapa caracteres especiales para evitar inyección SQL
    $doc_paciente = $conn->real_escape_string($_GET["doc_paciente"]);

    // Consulta para buscar el paciente en la base de datos usando su documento
    $datos = "SELECT nombre_paciente, apellido_paciente, celular_paciente 
            FROM pacientes 
            WHERE doc_paciente = '$doc_paciente'";

    $resultados = $conn->query($datos); // Ejecuta la consulta

    if ($resultados->num_rows > 0) {
        // Si se encuentran resultados, los devuelve en formato JSON
        $paciente = $resultados->fetch_assoc();
        echo json_encode([
            "success" => true,
            "nombre" => $paciente["nombre_paciente"],
            "apellido" => $paciente["apellido_paciente"],
            "celular" => $paciente["celular_paciente"]
        ]);
    } else {
        // Mensaje en formato JSON si no se encuentra el paciente
        echo json_encode(["success" => false, "message" => "Paciente no encontrado."]);
    }
} else {
    // Mensaje en formato JSON si no se proporciona el documento del paciente
    echo json_encode(["success" => false, "message" => "Documento no proporcionado."]);
}

$conn->close(); // Cierra la conexión a la base de datos
