<?php
// Conexión a la base de datos
$conn = new mysqli("localhost", "root", "", "centro_medico");

// Verifica si hay errores en la conexión
if ($conn->connect_error) {
    die("Error al conectar con la base de datos: " . $conn->connect_error);
}

// Verifica si se enviaron los datos del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitización de entradas
    $doc_paciente = trim($_POST["doc_paciente"]);
    $nombre_paciente = trim($_POST["nombre_paciente"]);
    $apellido_paciente = trim($_POST["apellido_paciente"]);
    $celular_paciente = trim($_POST["celular_paciente"]);
    $nombre_medico = trim($_POST["nombre_medico"]);
    $nombre_clinica = trim($_POST["nombre_clinica"]);
    $fecha_cita = trim($_POST["fecha_cita"]);
    $hora_cita = trim($_POST["hora_cita"]);

    // Validar que los campos no estén vacíos
    if (empty($doc_paciente) || empty($nombre_paciente) || empty($apellido_paciente) || empty($celular_paciente) || empty($nombre_medico) || empty($nombre_clinica) || empty($fecha_cita) || empty($hora_cita)) {
        die("Error: Todos los campos son obligatorios.");
    }

    // Validación: Horarios permitidos e intervalos de 30 minutos
    $horaPartes = explode(":", $hora_cita);
    $minutosTotales = ($horaPartes[0] * 60) + $horaPartes[1];

    $horariosPermitidos = [
        ["inicio" => 8 * 60, "fin" => 11 * 60 + 30], // 08:00 a 11:30
        ["inicio" => 13 * 60, "fin" => 16 * 60 + 30] // 13:00 a 16:30
    ];

    $horaValida = false;
    foreach ($horariosPermitidos as $rango) {
        if ($minutosTotales >= $rango["inicio"] && $minutosTotales <= $rango["fin"]) {
            $horaValida = true;
            break;
        }
    }

    if (!$horaValida || ($minutosTotales % 30 !== 0)) {
        die("Error: La hora ingresada no es válida. Debe estar en intervalos de 30 minutos y en horarios permitidos.");
    }

    // Validación: Evitar duplicados
    $sql = "SELECT * FROM citas 
            WHERE doc_paciente = '$doc_paciente' 
            AND nombre_medico = '$nombre_medico' 
            AND fecha_cita = '$fecha_cita' 
            AND hora_cita = '$hora_cita'";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        die("Error: Ya existe una cita registrada con los mismos datos.");
    }

    // Preparar la consulta para evitar inyecciones SQL
    $stmt = $conn->prepare("INSERT INTO citas (doc_paciente, nombre_paciente, apellido_paciente, celular_paciente, nombre_medico, nombre_clinica, fecha_cita, hora_cita) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");

    if (!$stmt) {
        die("Error en la preparación de la consulta: " . $conn->error);
    }

    // Enlazar los parámetros
    $stmt->bind_param("ssssssss", $doc_paciente, $nombre_paciente, $apellido_paciente, $celular_paciente, $nombre_medico, $nombre_clinica, $fecha_cita, $hora_cita);

    // Ejecutar la consulta
    if ($stmt->execute()) {
        echo "¡Cita registrada correctamente!";
        header("Location: ../registroCitas.html"); // Redirige a registroCitas.html
        exit(); // Asegura que el script se detenga después de la redirección
    } else {
        echo "Error al guardar la cita: " . $stmt->error;
    }


    // Cerrar la consulta preparada
    $stmt->close();
}

// Cierra la conexión
$conn->close();
