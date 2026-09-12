<?php
include_once "conexion.php";

try{
    $sql = "SELECT nombre, telefono, correo, fecha, color, dia, comentarios FROM estudiantes";
    $stmt = $conn->prepare($sql);
    $stmt->execute();

    $estudiantes = $stmt->fetchALL();

} catch(PDOException $e){
    die("Error al listar los estudiantes: " . $e->getMessage());
}



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <center>
    <h1>Lista de estudiantes</h1>
    <table border="1">
        <tr bgc> 
            <th>ID</th>
            <th>Nombre</th>
            <th>Telefono</th>
            <th>Correo</th>
            <th>Fecha</th>
            <th>Color</th>
            <th>Dia</th>
            <th>Comentarios</th>
        </tr>
        <?php
            if(count($estudiantes) > 0):
                foreach($estudiantes as $estudiante):
        ?>
        <tr>
            <td><?= htmlspecialchars($estudiante['id_estudiante']) ?></td>
            <td><?= htmlspecialchars($estudiante['nombre']) ?></td>
            <td><?= htmlspecialchars($estudiante['telefono']) ?></td>
            <td><?= htmlspecialchars($estudiante['correo']) ?></td>
            <td><?= htmlspecialchars($estudiante['fecha']) ?></td>
            <td><?= htmlspecialchars($estudiante['color']) ?></td>
            <td><?= htmlspecialchars($estudiante['dia']) ?></td>
            <td><?= htmlspecialchars($estudiante['comentarios']) ?></td>
        </tr>
        <?php endforeach; ?>
    <?php else: ?>
        <tr>
            <td colspan="8">No hay estudiantes registrados</td>
        </tr>
    <?php endif; ?>
    </table>
    <br></br>
    <a href="index.html">Volver al formulario</a>
    </center>
</body>
</html>

