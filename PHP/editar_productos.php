<?php
require_once 'conexion_productos.php';

$mensaje = "";
$error = "";

// Recibe el id del producto que viene por GET
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id = $_GET['id'];

    try {
        $sql = "SELECT id, categoria, descripcion FROM productos WHERE id = :id";
        $stmt = $conn->prepare($sql);
        $stmt->execute([':id' => $id]);
        $producto = $stmt->fetch();

        // Si no existe ningún producto con ese id, redirige al listado
        if (!$producto) {
            header("Location: lista_producto.php");
            exit;
        }
    } catch (PDOException $e) {
        die("Error al consultar el producto: " . $e->getMessage());
    }
} else if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: lista_producto.php");
    exit;
}

// Procesar el formulario cuando se envían los cambios por POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_producto       = $_POST['id_producto'] ?? null;
    $categoria_final   = trim($_POST['categoria'] ?? '');
    $descripcion_total = trim($_POST['descripcion'] ?? '');

    if (!empty($categoria_final) && !empty($descripcion_total) && !empty($id_producto)) {
        try {
            $sql = "UPDATE productos 
                    SET categoria = :categoria, 
                        descripcion = :descripcion 
                    WHERE id = :id";

            $stmt = $conn->prepare($sql);
            $resultado = $stmt->execute([
                ':categoria'   => $categoria_final,
                ':descripcion' => $descripcion_total,
                ':id'          => $id_producto
            ]);

            if ($resultado) {
                header("Location: lista_producto.php");
                exit;
            } else {
                $error = "Ocurrió un error al actualizar el producto.";
            }
        } catch (PDOException $e) {
            $error = "Error de base de datos: " . $e->getMessage();
        }
    } else {
        $error = "Por favor, completa los campos obligatorios.";
    }

    // Mantener los datos escritos si ocurre un error
    $producto = [
        'id'          => $id_producto,
        'categoria'   => $categoria_final,
        'descripcion' => $descripcion_total
    ];
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Producto</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 30px; background-color: #f4f6f9; color: #333; }
        .container { max-width: 500px; margin: 0 auto; background: white; padding: 25px; border-radius: 8px; box-shadow: 0 2px 5px rgba(0,0,0,0.1); }
        h2 { margin-top: 0; color: #333; }
        .form-group { margin-bottom: 15px; }
        label { display: block; margin-bottom: 5px; font-weight: bold; color: #555; }
        input[type="text"], textarea { width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box; }
        .btn-container { display: flex; justify-content: space-between; align-items: center; margin-top: 20px; }
        .btn-guardar { background-color: #28a745; color: white; padding: 10px 15px; border: none; border-radius: 4px; font-weight: bold; cursor: pointer; }
        .btn-guardar:hover { background-color: #218838; }
        .btn-cancelar { background-color: #6c757d; color: white; padding: 10px 15px; text-decoration: none; border-radius: 4px; font-weight: bold; }
        .btn-cancelar:hover { background-color: #5a6268; }
        .error { background-color: #f8d7da; color: #721c24; padding: 10px; border-radius: 4px; margin-bottom: 15px; border: 1px solid #f5c6cb; }
    </style>
</head>
<body>

<div class="container">
    <h2>Editar Producto</h2>

    <?php if (!empty($error)): ?>
        <div class="error"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <form action="editar.php" method="POST">
        <!-- Campo oculto para conservar el ID del producto -->
        <input type="hidden" name="id_producto" value="<?= htmlspecialchars($producto['id'] ?? '') ?>">

        <div class="form-group">
            <label for="categoria">Categoría:</label>
            <input type="text" id="categoria" name="categoria" value="<?= htmlspecialchars($producto['categoria'] ?? '') ?>" required>
        </div>

        <div class="form-group">
            <label for="descripcion">Descripción:</label>
            <textarea id="descripcion" name="descripcion" rows="5" required><?= htmlspecialchars($producto['descripcion'] ?? '') ?></textarea>
        </div>

        <div class="btn-container">
           <a href="lista_producto.php" class="btn-cancelar">Cancelar</a>
            <button type="submit" class="btn-guardar">Actualizar Registro</button>
        </div>
    </form>
</div>

</body>
</html>