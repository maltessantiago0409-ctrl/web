<?php

include_once "conectar.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $documento = $_POST['documento'];
    $nombre = $_POST['nombre'];
    $telefono = $_POST['telefono'];
    $correo = $_POST['correo'];
    $fecha = $_POST['fecha'];

    try {

        $sql = "INSERT INTO usuarios (documento, nombre, telefono, correo, fecha)
                VALUES (:documento, :nombre, :telefono, :correo, :fecha)";

        $stmt = $conn->prepare($sql);

        $stmt->execute([
            ':documento' => $documento,
            ':nombre' => $nombre,
            ':telefono' => $telefono,
            ':correo' => $correo,
            ':fecha' => $fecha
        ]);

        echo "El usuario se registro";
        echo "<br>";
        echo "<a href='usuarios.html'>Volver al formulario</a>";

    } catch (PDOException $e) {

        echo "Error al guardar el usuario: " . $e->getMessage();

    }

} else {

    echo "Acceso denegado";

}

?>