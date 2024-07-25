<?php
require 'includes/db.php';

$tipo_mascota = $_GET['tipo_mascota'];
$query = "SELECT id, raza FROM razas WHERE tipo_mascota = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param('s', $tipo_mascota);
$stmt->execute();
$result = $stmt->get_result();

$razas = [];
while ($row = $result->fetch_assoc()) {
    $razas[] = $row;
}

echo json_encode($razas);

$stmt->close();
$conn->close();
?>
