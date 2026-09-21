<?php
include 'conexion_productos.php';

try {
    // 1. Agregamos 'id' a la consulta
    $sql = "SELECT id, categoria, descripcion FROM productos";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $productos = $stmt->fetchAll(); // Cambiamos $usuarios por $productos para mayor claridad
    
} catch(PDOException $e) {
    die("Error al listar los productos: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Productos</title>
    <link rel="stylesheet" href="../css/diseño_tablas.css">
    <style>
        body { background-color: black; color: white; font-family: Arial, sans-serif; margin: 30px; }
        table { color: white; width: 80%; margin: 0 auto; border-collapse: collapse; }
        th, td { padding: 10px; border: 1px solid #444; text-align: left; }
        th { background-color: #222; }
        a { color: #4CAF50; text-decoration: none; }
        a:hover { text-decoration: underline; }
    </style>
</head>
<body>
    <center>
        <h1>Lista de productos</h1>
        <table>
            <tr>
                <th>Categoria</th>
                <th>Descripción</th>
                <th>Acciones</th>
            </tr>
            <?php if(count($productos) > 0): ?>
                <?php foreach($productos as $producto): ?>
            <tr>
                <td><?= htmlspecialchars($producto['categoria']) ?></td>
                <td><?= htmlspecialchars($producto['descripcion']) ?></td>
                <td>
                    <!-- Enlace que conecta con el archivo de edición pasando el ID -->
                    <a href="editar_productos.php?id=<?= $producto['id'] ?>">Editar</a>
                </td>
            </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="3" style="text-align: center;">No hay productos registrados</td>
            </tr>
        <?php endif; ?>
        </table>
        <br><br>
        <a href="../productos.html">Volver a registrar productos</a>
    </center>
</body>
</html>