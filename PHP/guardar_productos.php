<?php
include_once "conexion_productos.php";

if ($_SERVER["REQUEST_METHOD"] == "POST"){

    if (isset($_POST['productos']) && is_array($_POST['productos'])) {
        try {
            $descripcion_total = "";
            $categorias_seleccionadas = [];

            // 1. Recorremos los datos para agrupar todo en un solo texto
            foreach ($_POST['productos'] as $categoria => $items) {
                foreach ($items as $producto => $cantidad) {
                    
                    if ($cantidad > 0) {
                        // Agregamos el producto y salto de línea al texto total
                        $descripcion_total .= "- $producto | Cantidad: $cantidad\n";
                        
                        // Guardamos la categoría si no la hemos guardado antes
                        if (!in_array($categoria, $categorias_seleccionadas)) {
                            $categorias_seleccionadas[] = $categoria;
                        }
                    }
                }
            }

            // 2. Si se seleccionó al menos un producto, hacemos un solo INSERT
            if ($descripcion_total != "") {
                
                // Unimos las categorías con una coma (ej: "Plomería, Electricidad")
                $categoria_final = implode(", ", $categorias_seleccionadas);

                $sql = "INSERT INTO productos (categoria, descripcion) VALUES (:categoria, :descripcion)";
                $stmt = $conn->prepare($sql);

                $stmt->execute([
                    ':categoria'   => $categoria_final,
                    ':descripcion' => $descripcion_total
                ]);

                echo "¡El pedido completo se guardó en un solo registro!";
                echo "<br><br>";
                echo "<a href='../productos.html'>Volver al formulario</a>";
            } else {
                echo "No ingresaste ninguna cantidad mayor a 0. <a href='../productos.html'>Volver</a>";
            }

        } catch (PDOException $e) {
            echo "Error al guardar el producto: " . $e->getMessage();
        }

    } else {
        echo "No se recibieron datos.";
    }

} else {
    echo "Acceso denegado";
}
?>