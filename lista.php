<?php
include 'conectar.php';

try{
$sql = "SELECT documento, nombre, telefono, correo, fecha FROM usuarios";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $usuarios = $stmt->fetchAll();
    
}catch(PDOException $e){
    die("Error al listar los usuarios: " . $e->getMessage());
}


?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Datos</title>
    
</head>
<body bgcolor="BLACK" style="color: white;">
    <center>
    <h1 style="color: white;">Lista de clientes</h1>
    <table border="1" style="color: white;">
        <tr>
            <th>Documento</th>
            <th>Nombre</th>
            <th>Telefono</th>
            <th>Correo</th>
            <th>Fecha de nacimiento</th>
        </tr>
        <?php
            if(count($usuarios) > 0):
                foreach($usuarios as $usuario):
        ?>
        <tr>
            <td><?= htmlspecialchars($usuario['documento']) ?></td>
            <td><?= htmlspecialchars($usuario['nombre']) ?></td>
            <td><?= htmlspecialchars($usuario['telefono']) ?></td>
            <td><?= htmlspecialchars($usuario['correo']) ?></td>
            <td><?= htmlspecialchars($usuario['fecha']) ?></td>
        </tr>
        <?php endforeach; ?>
    <?php else: ?>
        <tr>
            <td colspan="5">No hay clientes registrados</td>
        </tr>
    <?php endif; ?>
    </table>
    <br><br>
    <a style="color: white;" href="usuarios.html">Volver al formulario</a>

<style>

body {
    font-family: Arial, sans-serif;
    background-color: black;
    color: white;
    margin: 0;
    padding: 40px 20px;
    min-height: 100vh;
}

/* Titulo */

h1 {
    text-align: center;
    color: white;
    font-size: 40px;
    margin-bottom: 40px;
}

/* Tabla */

table {
    width: 90%;
    max-width: 1000px;
    margin: 0 auto;
    border-collapse: collapse;
    background-color: #111;
    border: 1px solid white;
}

/* Encabezados */

th {
    background-color: #333;
    color: white;
    padding: 15px;
    text-align: center;
    font-size: 17px;
    border: 1px solid white;
}

/* Datos */

td {
    padding: 15px;
    text-align: center;
    color: white;
    border: 1px solid #555;
    font-size: 16px;
}

/* Efecto al pasar el mouse */

tr:hover {
    background-color: #222;
}

/* Mensaje cuando no hay clientes */

td[colspan] {
    padding: 20px;
    text-align: center;
    color: white;
    font-size: 17px;
}

/* Boton volver */

a {
    display: block;
    width: 200px;
    margin: 35px auto;
    padding: 12px;
    text-align: center;
    background-color: black;
    color: black;
    text-decoration: none;
    border-radius: 8px;
    font-size: 16px;
    border: 2px solid white;
}

/* Efecto del boton */

a:hover {
    background-color: #cccccc;
}

</style>

   
    
    </center>


    
</body>
</html>