<?php
$host = "localhost";
$db = "grupo401";
$user = "root";
$pass = "";
$charset = "utf8mb4";

$dsn = "mysql:host=$host;dbname=$db;cahrset=$charset;";

$options = [
    PDO::ATTR_ERRMODE               => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE    => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES      => false,
];

try {
    $conn = new PDO($dsn,$user,$pass,$options);
    echo "Conexion exitosa a la base de datos:".$db;
    } catch (PDOException $e){
     die("Error critico de conexion:". $e->getMessage());
    }
?>