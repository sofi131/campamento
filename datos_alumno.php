<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Datos del Alumno</title>
</head>

<body>
    <h1>Datos del Alumno</h1>

    <?php
    // Obtener los datos del alumno desde la URL
    $id = $_GET['id'];
    $nombre = $_GET['nombre'];
    $apellidos = $_GET['apellidos'];
    $saldo = $_GET['saldo'];

    // Mostrar los datos del alumno
    echo "<p><strong>Nombre:</strong> $nombre</p>";
    echo "<p><strong>Apellidos:</strong> $apellidos</p>";
    echo "<p><strong>Saldo:</strong> $saldo</p>";

    // Mostrar el código QR correspondiente
    echo "<img src='qr_codes/{$nombre}_{$apellidos}.png' alt='Código QR'>";
    ?>
</body>

</html>