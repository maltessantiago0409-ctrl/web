<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body bgcolor="white">
    
    
</body>
</html>


<?php

    require_once("conexion.php");

$nombre = $_POST['nombre'];
$telefono = $_POST['telefono'];
$correo = $_POST['correo'];      
$fecha = $_POST['fecha'];
$color = $_POST['color'];
$dia = $_POST['dia'];
$comentarios = $_POST['comentarios'];

echo "<center>";
echo "TUS DATOS SON:";
echo "<br>";
echo "Nombre:".$nombre;
echo "<br>";
echo "Telefono:".$telefono;
echo "<br>";
echo "Correo:".$correo;
echo "<br>";
echo "Fecha:".$fecha;
echo "<br>";
echo "color:".$color;
echo "<br>";
echo "Dia:".$dia;
echo "<br>";
echo "Comentarios:".$comentarios;
echo "<br>";
echo "<a href='index.html'>Formulario</a>";
echo "</center>";
?>