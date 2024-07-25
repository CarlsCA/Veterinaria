<?php
require 'includes/db.php';

$tipo_mascota = $_POST['tipo_mascota'];
$nueva_raza = $_POST['raza'];

$query = "INSERT INTO razas (tipo_mascota, raza) VALUES (?, ?)";
$stmt = $conn->prepare($query);
$stmt->bind_param('ss', $tipo_mascota, $nueva_raza);

if ($stmt->execute()) {
    echo "Raza añadida con éxito.";
} else {
    echo "Error al añadir raza: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
