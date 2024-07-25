<?php
$servername = "localhost";
$username = "root";
$password = ""; // Cambia esto según tu configuración
$dbname = "veterinaria";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Comprobar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Captura de datos del formulario
$nombre = $_POST['nombre'];
$sexo = $_POST['sexo'];
$fecha_nacimiento = $_POST['fecha_nacimiento'];
$edad = $_POST['edad'];
$peso = $_POST['peso'];
$tipo_mascota = $_POST['tipo_mascota'];
$raza = $_POST['raza'];
$tamano = $_POST['tamano'];
$foto = $_FILES['foto']['name'];
$alergias = $_POST['alergias'];
$documento_tipo = $_POST['documento_tipo'];
$documento_numero = $_POST['documento_numero'];
$apellidos_nombres = $_POST['apellidos_nombres'];
$telefono = $_POST['telefono'];
$correo = $_POST['correo'];
$direccion = $_POST['direccion'];
$referencia = $_POST['referencia'];
$motivo_internamiento = $_POST['motivo_internamiento'];
$fecha_ingreso = $_POST['fecha_ingreso'];
$fecha_salida = $_POST['fecha_salida'];
$peso_internamiento = $_POST['peso_internamiento'];
$temperatura = $_POST['temperatura'];
$diagnostico = $_POST['diagnostico'];
$comentarios_internamiento = $_POST['comentarios_internamiento'];
$total_a_pagar = $_POST['total_a_pagar'];
$vacuna_fecha = $_POST['vacuna_fecha'];
$vacuna_tipo = $_POST['vacuna_tipo'];
$vacuna_comentarios = $_POST['vacuna_comentarios'];

// Aquí se sube la foto (implementa tu lógica para subir el archivo)
move_uploaded_file($_FILES['foto']['tmp_name'], 'uploads/' . $foto);

// Inserta los datos en la base de datos
$sql = "INSERT INTO mascotas (nombre, sexo, fecha_nacimiento, edad, peso, tipo_mascota, raza, tamano, foto, alergias)
        VALUES ('$nombre', '$sexo', '$fecha_nacimiento', '$edad', '$peso', '$tipo_mascota', '$raza', '$tamano', '$foto', '$alergias')";

if ($conn->query($sql) === TRUE) {
    $mascota_id = $conn->insert_id; // Obtener el ID de la mascota recién insertada

    // Inserta datos del propietario
    $sql_propietario = "INSERT INTO propietarios (mascota_id, documento_tipo, documento_numero, apellidos_nombres, telefono, correo, direccion, referencia)
                        VALUES ('$mascota_id', '$documento_tipo', '$documento_numero', '$apellidos_nombres', '$telefono', '$correo', '$direccion', '$referencia')";

    $conn->query($sql_propietario);

    // Inserta datos del internamiento
    $sql_internamiento = "INSERT INTO internamientos (mascota_id, motivo, fecha_ingreso, fecha_salida, peso, temperatura, diagnostico, comentarios, total_a_pagar)
                         VALUES ('$mascota_id', '$motivo_internamiento', '$fecha_ingreso', '$fecha_salida', '$peso_internamiento', '$temperatura', '$diagnostico', '$comentarios_internamiento', '$total_a_pagar')";

    $conn->query($sql_internamiento);

    // Inserta historial de vacunas
    $sql_vacuna = "INSERT INTO vacunas (mascota_id, fecha, tipo, comentarios)
                   VALUES ('$mascota_id', '$vacuna_fecha', '$vacuna_tipo', '$vacuna_comentarios')";

    $conn->query($sql_vacuna);

    echo "Mascota registrada exitosamente.";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
