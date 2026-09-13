<?php
include 'conexion.php';

try{
    $sql = "SELECT documento, nombre, telefono, correo, fecha, comentarios FROM estudiantes";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $estudiantes = $stmt->fetchALL();
    
}catch(PDOException $e){
    die("Error al listar los estudiantes: " . $e->getMessage());
}


?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Datos</title>
</head>
<body>
    <center>
    <h1 style="color: white;">Lista de clientes</h1>
    <table border="1">
        <tr>
            <th>Documento</th>
            <th>Nombre</th>
            <th>Telefono</th>
            <th>Correo</th>
            <th>Fecha de nacimiento</th>
        </tr>
        <?php
            if(count($estudiantes) > 0):
                foreach($estudiantes as $estudiante):
        ?>
        <tr>
            <td><?= htmlspecialchars($estudiante['documento']) ?></td>
            <td><?= htmlspecialchars($estudiante['nombre']) ?></td>
            <td><?= htmlspecialchars($estudiante['telefono']) ?></td>
            <td><?= htmlspecialchars($estudiante['correo']) ?></td>
            <td><?= htmlspecialchars($estudiante['fecha']) ?></td>
            <td><?= htmlspecialchars($estudiante['comentarios']) ?></td>
        </tr>
        <?php endforeach; ?>
    <?php else: ?>
        <tr>
            <td colspan="6">No hay estudiantes registrados</td>
        </tr>
    <?php endif; ?>
    </table>
    <br><br>
    <a style="color: white;" href="taller.html">Volver al formulario</a>
    </center>


    
</body>
</html>