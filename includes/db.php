<?php
$host = 'localhost'; // Cambia esto si tu base de datos no está en localhost
$dbname = 'veterinaria'; // Nombre de tu base de datos
$username = 'root'; // Tu usuario de base de datos
$password = ''; // Tu contraseña de base de datos

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo 'Error de conexión: ' . $e->getMessage();
    exit();
}
?>
