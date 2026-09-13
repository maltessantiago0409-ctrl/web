<?php
include 'conexion_productos.php';

try{
$sql = "SELECT categoria, descripcion FROM productos";
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
    <style>
    body {
        background-color: black;
        color: white;
    }

    table {
        color: white;
    }

    th {
        color: white;
    }

    td {
        color: white;
    }

    a {
        color: white;
    }
</style>
</head>
<body bgcolor="BLACK" style="color: white;">
    <center>
    <h1 style="color: white;">Lista de productos</h1>
    <table border="1" style="color: white;">
        <tr>
            <th>Categoria</th>
            <th>Descripción</th>

        </tr>
        <?php
            if(count($usuarios) > 0):
                foreach($usuarios as $usuario):
        ?>
        <tr>
            <td><?= htmlspecialchars($usuario['categoria']) ?></td>
            <td><?= htmlspecialchars($usuario['descripcion']) ?></td>

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