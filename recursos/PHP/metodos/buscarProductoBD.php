<?php

include("../clases/conexion.php");


$obtenerProducto = "select * from productos";
$Execute = $conexion->query($obtenerProducto);

$r = $Execute->fetchall(PDO::FETCH_ASSOC);

echo json_encode($r);


 ?>
