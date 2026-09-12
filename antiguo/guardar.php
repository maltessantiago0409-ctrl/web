<?php
include_once "conexion.php";

if ($_SERVER["REQUEST_METHOD"] == "POST"){

    $nombre = $_POST['nombre'];
    $telefono = $_POST['telefono'];
    $correo = $_POST['correo'];
    $fecha = $_POST['fecha'];
    $color = $_POST['color'];
    $dia = $_POST['dia'];
    $comentarios = $_POST['comentarios'];

    try {
        $sql = "INSERT INTO estudiantes (nombre, telefono,correo,fecha,color,dia,comentarios)
                VALUES (:nombre, :telefono, :correo, :fecha, :color, :dia, :comentarios)";
        
        $stmt= $conn->prepare($sql);
        $stmt->execute([
            ':nombre' => $nombre,
            ':telefono' => $telefono,
            ':correo' => $correo,
            ':fecha' => $fecha,
            ':color' => $color,
            ':dia' => $dia,
            ':comentarios' => $comentarios
        ]);

        echo "El estudiante se registro";
        echo "<br>";
        echo "<a herf='index.html'>volver al formulario</a>";

        } catch (PDOException $e) {
        echo "Error al guardar el estudiante" .$e->getMessage();
    }

} else {
    echo "Acceso denegado";
}
?>