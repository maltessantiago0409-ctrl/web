<?php
require_once 'conexion.php';

$mensaje = "";
$error = "";

// recibe el id del estudinate que viene por GET
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id_estudiante = $_GET['id'];

    // Consultar la información actual del estudiante
    try {
        $sql = "SELECT id_estudiante, documento, nombre, telefono, correo, direccion 
                FROM estudiantes WHERE id_estudiante = :id";
        $stmt = $conn->prepare($sql);
        $stmt->execute([':id' => $id_estudiante]);
        $estudiante = $stmt->fetch();

        // Si no existe ningún estudiante con ese id lo redirige al listado nuevamente
        if (!$estudiante) {
            header("Location: listar.php");
            exit;
        }
    } catch (PDOException $e) {
        die("Error al consultar el estudiante: " . $e->getMessage());
    }
} else if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    // Si no viene ningún id y tampoco se está enviando el formulario, redirigir
    header("Location: listar.php");
    exit;
}

// Procesar el formulario cuando el usuario presiona "Guardar Cambios" (método POST)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_estudiante = $_POST['id_estudiante'];
    $documento     = trim($_POST['documento']);
    $nombre       = trim($_POST['nombre']);
    $telefono      = trim($_POST['telefono']);
    $correo        = trim($_POST['correo']);
    $direccion     = trim($_POST['direccion']);
    

    // Validar que los campos obligatorios no estén vacíos
    if (!empty($documento) && !empty($nombre) && !empty($correo)) {
        try {
            $sql = "UPDATE estudiantes 
                    SET documento = :documento, 
                        nombre   = :nombre, 
                        telefono  = :telefono,
                        correo    = :correo, 
                        direccion = :direccion 
                        
                    WHERE id_estudiante = :id";

            $stmt = $conn->prepare($sql);
            $resultado = $stmt->execute([
                ':documento' => $documento,
                ':nombre'   => $nombre,
                ':telefono'  => $telefono,
                ':correo'    => $correo,
                ':direccion' => $direccion,
                ':id'        => $id_estudiante
            ]);

            if ($resultado) {
                // Redirigir a la lista tras actualizar con éxito
                header("Location: listar.php");
                exit;
            } else {
                $error = "Ocurrió un error al actualizar el estudiante.";
            }
        } catch (PDOException $e) {
            $error = "Error de base de datos: " . $e->getMessage();
        }
    } else {
        $error = "Por favor, completa los campos obligatorios.";
    }

    // Si hubo un error en el POST, reasignamos los datos ingresados para no perder lo digitado en el formulario
    $estudiante = [
        'id_estudiante' => $id_estudiante,
        'documento'     => $documento,
        'nombre'       => $nombre,
        'telefono'      => $telefono,
        'correo'        => $correo,
        'direccion'     => $direccion
        
    ];
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Estudiante</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 30px; background-color: #f4f6f9; }
        .container { max-width: 500px; margin: 0 auto; background: white; padding: 25px; border-radius: 8px; box-shadow: 0 2px 5px rgba(0,0,0,0.1); }
        h2 { margin-top: 0; color: #333; }
        .form-group { margin-bottom: 15px; }
        label { display: block; margin-bottom: 5px; font-weight: bold; color: #555; }
        input[type="text"], input[type="email"] { width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box; }
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
    <h2>Editar Estudiante</h2>

    <?php if (!empty($error)): ?>
        <div class="error"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <form action="editar.php" method="POST">
        <!-- Campo oculto para conservar el id_estudiante durante el envío -->
        <input type="hidden" name="id_estudiante" value="<?= htmlspecialchars($estudiante['id_estudiante']) ?>">

        <div class="form-group">
            <label for="documento">Documento:</label>
            <input type="text" id="documento" name="documento" value="<?= htmlspecialchars($estudiante['documento']) ?>" required>
        </div>

        <div class="form-group">
            <label for="nombres">Nombres:</label>
            <input type="text" id="nombre" name="nombre" value="<?= htmlspecialchars($estudiante['nombre']) ?>" required>
        </div>

        <div class="form-group">
            <label for="telefono">Teléfono:</label>
            <input type="text" id="telefono" name="telefono" value="<?= htmlspecialchars($estudiante['telefono']) ?>">
        </div>

        <div class="form-group">
            <label for="correo">Correo Electrónico:</label>
            <input type="email" id="correo" name="correo" value="<?= htmlspecialchars($estudiante['correo']) ?>" required>
        </div>

        <div class="form-group">
            <label for="direccion">Dirección:</label>
            <input type="text" id="direccion" name="direccion" value="<?= htmlspecialchars($estudiante['direccion']) ?>">
        </div>

        <div class="btn-container">
            <a href="listar.php" class="btn-cancelar">Cancelar</a>
            <button type="submit" class="btn-guardar">Actualizar Registro</button>
        </div>
    </form>
</div>

</body>
</html>