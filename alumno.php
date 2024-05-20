<?php
class Alumno {
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
?>
