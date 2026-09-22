<?php
require_once 'conexion_productos.php';

// Valida que se reciba el id por el url get
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id_producto = $_GET['id'];

    try {
        // CORREGIDO: Se cambia el estado a 0 (Inactivo) para que se oculte o deshabilite
        $sql = "UPDATE productos SET estado = 0 WHERE id = :id";
        
        $stmt = $conn->prepare($sql);
        $resultado = $stmt->execute([':id' => $id_producto]);

        if ($resultado) {
            // Redirigir a la lista con un parámetro de exito para la alerta
            header("Location: lista_producto.php?mensaje=eliminado");
            exit;
        } else {
            die("Error al deshabilitar el registro.");
        }
    } catch (PDOException $e) {
        die("Error de base de datos: " . $e->getMessage());
    }
} else {
    // Si no hay id, redirigir al listado
    header("Location: lista_producto.php");
    exit;
}
?>