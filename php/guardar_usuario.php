<?php
session_start(); // Inicia una sesión para el usuario
include 'conexion.php'; // Incluye el archivo de conexión con la base de datos

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recupera los datos enviados desde el formulario
    $doc_paciente = $_POST["doc_paciente"]; // Documento del paciente
    $nombre_paciente = $_POST["nombre_paciente"]; // Nombre del paciente
    $apellido_paciente = $_POST["apellido_paciente"]; // Apellido del paciente
    $celular_paciente = $_POST["celular_paciente"]; // Número de celular del paciente
    $correo_paciente = $_POST["correo_paciente"]; // Correo electrónico del paciente
    $contrasena_paciente = password_hash($_POST["contrasena_paciente"], PASSWORD_DEFAULT); // Cifra la contraseña del paciente

    // Verifica si se ha subido una foto y no hay errores
    if (isset($_FILES["foto_paciente"]) && $_FILES["foto_paciente"]["error"] == 0) {
        $directorio_destino = "../imagenes/fotos/"; // Directorio donde se guardará la foto
        $nombre_archivo = uniqid() . "_" . basename($_FILES["foto_paciente"]["name"]); // Genera un nombre único para la foto
        $ruta_completa = $directorio_destino . $nombre_archivo; // Ruta completa donde se almacenará la foto

        // Mueve la foto al directorio destino
        if (move_uploaded_file($_FILES["foto_paciente"]["tmp_name"], $ruta_completa)) {
            // Inserta los datos del paciente en la base de datos
            $datos = "INSERT INTO pacientes (doc_paciente, nombre_paciente, apellido_paciente, celular_paciente, correo_paciente, contrasena_paciente, foto_paciente)
                    VALUES (?, ?, ?, ?, ?, ?, ?)";
            $resultados = $conn->prepare($datos); // Prepara la consulta
            $resultados->bind_param("sssssss", $doc_paciente, $nombre_paciente, $apellido_paciente, $celular_paciente, $correo_paciente, $contrasena_paciente, $ruta_completa);

            // Ejecuta la consulta e informa del resultado
            if ($resultados->execute()) {
                echo "<script>alert('Usuario registrado correctamente.'); window.location.href='../ingreso.html';</script>";
            } else {
                echo "<script>alert('Error al registrar el usuario.'); window.location.href='../ingreso.html';</script>";
            }
        } else {
            // Muestra un mensaje si la foto no se pudo subir
            echo "<script>alert('Error al subir la foto.'); window.location.href='../ingreso.html';</script>";
        }
    } else {
        // Muestra un mensaje si la foto no fue procesada correctamente
        echo "<script>alert('No se pudo procesar la foto.'); window.location.href='../ingreso.html';</script>";
    }

    $resultadost->close(); // Cierra la preparación de la consulta
}

$conn->close(); // Cierra la conexión con la base de datos
