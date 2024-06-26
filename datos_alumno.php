<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Datos del Alumno</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6 text-center">
                <h1>Datos del Alumno</h1>

                <?php
                // Establecer la conexión a la base de datos (cambia los valores según tu configuración)
                $conexion = new mysqli("localhost", "root", "1234", "campamento");

                // Verificar si la conexión fue exitosa
                if ($conexion->connect_error) {
                    die("Error de conexión: " . $conexion->connect_error);
                }

                // Obtener el ID del alumno desde la URL
                $id = $_GET['id'];

                // Preparar la consulta SQL para obtener los datos del alumno por su ID
                $sql = "SELECT nombre, apellido, saldo FROM alumnos WHERE id = ?";

                // Preparar la declaración SQL
                $stmt = $conexion->prepare($sql);

                // Verificar si la preparación de la consulta fue exitosa
                if ($stmt) {
                    // Vincular el parámetro ID
                    $stmt->bind_param("i", $id);

                    // Ejecutar la consulta
                    $stmt->execute();

                    // Vincular las columnas de resultado a variables
                    $stmt->bind_result($nombre, $apellidos, $saldo);

                    // Obtener el resultado
                    $stmt->fetch();

                    // Cerrar la declaración
                    $stmt->close();

                    // Cerrar la conexión
                    $conexion->close();

                    // Mostrar los datos del alumno
                    echo "<p><strong>Nombre:</strong> $nombre</p>";
                    echo "<p><strong>Apellidos:</strong> $apellidos</p>";
                    echo "<p><strong>Saldo:</strong> $saldo</p>";

                    // Mostrar el código QR correspondiente
                    echo "<img src='qr_codes/{$nombre}_{$apellidos}.png' alt='Código QR' class='mb-3'>";

                    // Botón que lleva a index.php
                    echo "<div class='mt-3'><a href='index.php' class='btn btn-primary'>Modificar datos</a></div>";
                } else {
                    // Si la preparación de la consulta falla, mostrar un mensaje de error
                    echo "Error al preparar la consulta SQL.";
                }
                ?>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
