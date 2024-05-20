<?php
include_once("index.php"); // Asegúrate de incluir el archivo index.php donde se define la clase GestionAlumnos

$conexion = new mysqli("localhost", "root", "1234", "campamento");

if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

if (isset($_POST['nombre']) && isset($_POST['apellido']) && isset($_POST['saldo'])) {
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $saldo = $_POST['saldo'];

    // Crear una instancia de GestionAlumnos para manejar las operaciones de base de datos
    $gestionAlumnos = new GestionAlumnos($conexion);
    $gestionAlumnos->crearAlumno($nombre, $apellido, $saldo);

    header("Location: index.php");
    exit();
}

if (isset($_POST['idActualizar']) && isset($_POST['nuevoSaldo'])) {
    $id = $_POST['idActualizar'];
    $nuevoSaldo = $_POST['nuevoSaldo'];

    // Crear una instancia de GestionAlumnos para manejar las operaciones de base de datos
    $gestionAlumnos = new GestionAlumnos($conexion);
    $gestionAlumnos->actualizarSaldo($id, $nuevoSaldo);

    header("Location: index.php");
    exit();
}

if (isset($_POST['idEliminar'])) {
    $id = $_POST['idEliminar'];

    // Crear una instancia de GestionAlumnos para manejar las operaciones de base de datos
    $gestionAlumnos = new GestionAlumnos($conexion);
    $gestionAlumnos->eliminarAlumno($id);

    header("Location: index.php");
    exit();
}

$conexion->close();
?>
