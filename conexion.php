<?php
// Datos de conexión a la base de datos
$user = 'root';           // Usuario de MAMP
$password = '';       // Contraseña de MAMP
$db = 'boda';             // Nombre de la base de datos (asegúrate de que sea 'boda')
$host = 'localhost';      // Dirección del servidor

// Inicializar la conexión MySQLi
$link = mysqli_init();

// Establecer la conexión con la base de datos
$success = mysqli_real_connect(
    $link,
    $host,
    $user,
    $password,
    $db

);

// Verificar la conexión
if (!$success) {
    die("Error al conectar a la base de datos: " . mysqli_connect_error());
}

// Obtener los datos del formulario
$nombreFamilia = $_POST['nombreFamilia'];
$asistira = $_POST['asistira'];
$numeroAsistentes = $_POST['numeroAsistentes'];

// Evitar inyecciones SQL escapando las entradas del usuario
$nombreFamilia = mysqli_real_escape_string($link, $nombreFamilia);
$asistira = mysqli_real_escape_string($link, $asistira);
$numeroAsistentes = mysqli_real_escape_string($link, $numeroAsistentes);

// SQL para insertar los datos en la tabla
$sql = "INSERT INTO confirmaciones (nombreFamilia, asistira, numeroAsistentes) 
        VALUES ('$nombreFamilia', '$asistira', '$numeroAsistentes')";

// Ejecutar la consulta e insertar los datos
if (mysqli_query($link, $sql)) {
    echo "Confirmación registrada con éxito. ¡Gracias!";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($link);
}

// Cerrar la conexión
mysqli_close($link);
?>
