<?php

include("../clases/conexion.php");

$id = $_POST["id_prd_b"];

$obtenerProducto = "select * from productos WHERE ID_PRODUCTO = '$id'";
$Execute = $conexion->query($obtenerProducto);

$r = $Execute->fetchall(PDO::FETCH_ASSOC);

echo json_encode($r);


 ?>
