<?php
include_once("alumno.php");
session_start();

class GestionAlumnos {
    private $conexion;

    public function __construct($conexion) {
        $this->conexion = $conexion;
    }

    public function crearAlumno($nombre, $apellido, $saldo) {
        $stmt = $this->conexion->prepare("INSERT INTO alumnos (nombre, apellido, saldo) VALUES (?, ?, ?)");
        $stmt->bind_param("ssi", $nombre, $apellido, $saldo);
        $stmt->execute();
        $stmt->close();
    }

    public function obtenerAlumnoPorId($id) {
        $stmt = $this->conexion->prepare("SELECT * FROM alumnos WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $alumno = $result->fetch_assoc();
        $stmt->close();
        return $alumno;
    }

    public function obtenerTodosLosAlumnos() {
        $alumnos = array();
        $result = $this->conexion->query("SELECT id, nombre, apellido, saldo FROM alumnos");
        while ($alumno = $result->fetch_assoc()) {
            $alumnos[] = $alumno;
        }
        return $alumnos;
    }

    public function actualizarSaldo($id, $nuevoSaldo) {
        $stmt = $this->conexion->prepare("UPDATE alumnos SET saldo = ? WHERE id = ?");
        $stmt->bind_param("ii", $nuevoSaldo, $id);
        $stmt->execute();
        $stmt->close();
    }

    public function eliminarAlumno($id) {
        $stmt = $this->conexion->prepare("DELETE FROM alumnos WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->close();
    }
}

$conexion = new mysqli("localhost", "root", "1234", "campamento");
$gestionAlumnos = new GestionAlumnos($conexion);
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Interfaz de Usuario - Gestión de Alumnos</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h1 class="text-center">Gestión de Alumnos</h1>

                <h2>Crear Nuevo Alumno</h2>
                <form id="formCrearAlumno" action="procesar_alumno.php" method="POST">
                    <div class="form-group">
                        <label for="nombre">Nombre:</label>
                        <input type="text" id="nombre" name="nombre" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="apellido">Apellido:</label>
                        <input type="text" id="apellido" name="apellido" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="saldo">Saldo:</label>
                        <input type="number" id="saldo" name="saldo" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Crear Alumno</button>
                </form>

                <h2 class="mt-5">Actualizar Saldo de Alumno</h2>
                <form id="formActualizarSaldo" action="procesar_alumno.php" method="POST">
                    <div class="form-group">
                        <label for="idActualizar">ID del Alumno:</label>
                        <input type="number" id="idActualizar" name="idActualizar" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="nuevoSaldo">Nuevo Saldo:</label>
                        <input type="number" id="nuevoSaldo" name="nuevoSaldo" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Actualizar Saldo</button>
                </form>

                <h2 class="mt-5">Eliminar Alumno</h2>
                <form id="formEliminarAlumno" action="procesar_alumno.php" method="POST">
                    <div class="form-group">
                        <label for="idEliminar">ID del Alumno:</label>
                        <input type="number" id="idEliminar" name="idEliminar" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-danger">Eliminar Alumno</button>
                </form>

                <h2 class="mt-5">Lista de Alumnos</h2>
                <div id="listaAlumnos">
                    <?php
                    $alumnos = $gestionAlumnos->obtenerTodosLosAlumnos();
                    if (!empty($alumnos)) {
                        echo "<table class='table table-striped'>";
                        echo "<thead><tr><th>ID</th><th>Nombre</th><th>Apellido</th><th>Saldo</th></tr></thead>";
                        echo "<tbody>";
                        foreach ($alumnos as $alumno) {
                            echo "<tr>";
                            echo "<td>" . $alumno["id"] . "</td>";
                            echo "<td>" . $alumno["nombre"] . "</td>";
                            echo "<td>" . $alumno["apellido"] . "</td>";
                            echo "<td>" . $alumno["saldo"] . "</td>";
                            echo "</tr>";
                        }
                        echo "</tbody>";
                        echo "</table>";
                    } else {
                        echo "<p>No se encontraron alumnos.</p>";
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
