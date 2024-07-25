<?php
// Conectar a la base de datos
include 'includes/db.php';

// Configurar las cabeceras para la descarga del archivo Excel
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="registro_completo.xls"');
header('Cache-Control: max-age=0');

// Función para escribir una tabla HTML
function exportTable($pdo, $tableName, $headers) {
    $output = "<h2>" . htmlspecialchars($tableName) . "</h2>";
    $output .= "<table>";
    $output .= "<tr>";
    foreach ($headers as $header) {
        $output .= "<th>" . htmlspecialchars($header) . "</th>";
    }
    $output .= "</tr>";

    $query = "SELECT * FROM " . $tableName;
    $stmt = $pdo->query($query);

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $output .= "<tr>";
        foreach ($headers as $header) {
            $column = strtolower(str_replace(' ', '_', $header));
            $output .= "<td>" . htmlspecialchars($row[$column] ?? '') . "</td>";
        }
        $output .= "</tr>";
    }

    $output .= "</table>";
    return $output;
}

// Crear un manejador de archivo
echo "<html xmlns:x=\"urn:schemas-microsoft-com:office:excel\">";
echo "<head>";
echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\">";
echo "<style>";
echo "table {border-collapse: collapse; width: 100%; margin-bottom: 20px;}";
echo "th, td {border: 1px solid black; padding: 8px; text-align: left;}";
echo "th {background-color: #f2f2f2;}";
echo "</style>";
echo "</head>";
echo "<body>";

// Exportar cada tabla
echo exportTable($pdo, 'mascotas', [
    'ID', 'Nombre', 'Sexo', 'Fecha de Nacimiento', 'Edad', 'Peso', 'Raza', 'Tamaño', 'Foto', 'Alergias',
    'Documento Tipo', 'Documento Número', 'Apellidos y Nombres', 'Teléfono', 'Correo', 'Dirección', 'Referencia'
]);
echo exportTable($pdo, 'internamientos', [
    'ID', 'Mascota ID', 'Motivo', 'Fecha de Ingreso', 'Fecha de Salida', 'Peso', 'Temperatura', 'Diagnóstico', 'Comentarios', 'Total a Pagar'
]);
echo exportTable($pdo, 'vacunas', [
    'ID', 'Mascota ID', 'Fecha', 'Tipo', 'Comentarios'
]);
echo exportTable($pdo, 'propietarios', [
    'Documento Tipo', 'Documento Número', 'Apellidos y Nombres', 'Teléfono', 'Correo', 'Dirección', 'Referencia'
]);
echo exportTable($pdo, 'razas', [
    'Tipo de Mascota', 'Raza'
]);

// Cerrar el documento HTML
echo "</body>";
echo "</html>";

exit;
