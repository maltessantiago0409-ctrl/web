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

?>

<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Registro exitoso</title>

    <style>

        body {
            background-color: black;
            color: white;
            font-family: Arial, sans-serif;
            text-align: center;
        }

        .contenedor {
            width: 500px;
            margin: 150px auto;
            padding: 40px;
            border: 2px solid white;
            border-radius: 15px;
        }

        h1 {
            font-size: 40px;
            margin-bottom: 20px;
        }

        p {
            font-size: 20px;
            margin-bottom: 30px;
        }

        .boton {
            display: inline-block;
            padding: 15px 30px;
            margin: 10px;
            background-color: white;
            color: black;
            text-decoration: none;
            border-radius: 8px;
            font-size: 18px;
        }

        .boton:hover {
            background-color: gray;
            color: white;
        }

    </style>

</head>

<body>

    <div class="contenedor">

        <h1>Registro exitoso</h1>

        <p>El cliente se registro correctamente.</p>

        <a class="boton" href="productos.html">
            Ir a productos
        </a>

        <br>

        <a class="boton" href="usuarios.html">
            Registrar otro cliente
        </a>

    </div>

</body>

</html>

<?php

    } catch (PDOException $e) {

        echo "Error al guardar el usuario: " . $e->getMessage();

    }

} else {

    echo "Acceso denegado";

}

?>