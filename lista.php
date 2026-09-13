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
    </center>


    
</body>
</html>