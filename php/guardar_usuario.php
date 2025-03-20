<?php
session_start();
include 'conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $doc_paciente = $_POST["doc_paciente"];
    $nombre_paciente = $_POST["nombre_paciente"];
    $apellido_paciente = $_POST["apellido_paciente"];
    $celular_paciente = $_POST["celular_paciente"];
    $correo_paciente = $_POST["correo_paciente"];
    $contrasena_paciente = password_hash($_POST["contrasena_paciente"], PASSWORD_DEFAULT);

    if (isset($_FILES["foto_paciente"]) && $_FILES["foto_paciente"]["error"] == 0) {
        $directorio_destino = "../imagenes/fotos/";
        $nombre_archivo = uniqid() . "_" . basename($_FILES["foto_paciente"]["name"]);
        $ruta_completa = $directorio_destino . $nombre_archivo;

        if (move_uploaded_file($_FILES["foto_paciente"]["tmp_name"], $ruta_completa)) {
            $datos = "INSERT INTO pacientes (doc_paciente, nombre_paciente, apellido_paciente, celular_paciente, correo_paciente, contrasena_paciente, foto_paciente)
                    VALUES (?, ?, ?, ?, ?, ?, ?)";
            $resultados = $conn->prepare($datos);
            $resultados->bind_param("sssssss", $doc_paciente, $nombre_paciente, $apellido_paciente, $celular_paciente, $correo_paciente, $contrasena_paciente, $ruta_completa);

            if ($resultados->execute()) {
                echo "<script>alert('Usuario registrado correctamente.'); window.location.href='../ingreso.html';</script>";
            } else {
                echo "<script>alert('Error al registrar el usuario.'); window.location.href='../ingreso.html';</script>";
            }
        } else {
            echo "<script>alert('Error al subir la foto.'); window.location.href='../ingreso.html';</script>";
        }
    } else {
        echo "<script>alert('No se pudo procesar la foto.'); window.location.href='../ingreso.html';</script>";
    }

    $resultadost->close();
}

$conn->close();
