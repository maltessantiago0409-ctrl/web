<?php
include 'conexion.php';

try{
    $sql = "SELECT documento, nombre, telefono, correo, fecha_de_nacimiento FROM clientes";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $registros = $stmt->fetchAll(PDO::FETCH_ASSOC);
}


?>