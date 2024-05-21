<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenido al Campamento</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body, html {
            height: 100%;
            margin: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
        }
        .container {
            max-width: 500px;
        }
        .btn {
            width: 100%;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1 class="mb-4">Bienvenido al Campamento</h1>
        <p class="mb-5">Seleccione una opción para continuar:</p>
        <a href="generar_tarjetas.php" class="btn btn-primary btn-lg mb-3">Generar Tarjetas de Alumnos</a>
        <a href="index.php" class="btn btn-success btn-lg mb-3">Editar Alumno</a>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
