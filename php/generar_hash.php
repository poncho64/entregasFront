<?php
// Contraseña que quieres hashear
$contraseña = "123456*";

// Generar el hash de la contraseña
$hash = password_hash($contraseña, PASSWORD_DEFAULT);

// Imprimir el resultado
echo "El hash de la contraseña es: " . $hash;
