<?php

include("../clases/conexion.php");


$obtenerProducto = "select * from info_empresa";
$Execute = $conexion->query($obtenerProducto);

$r = $Execute->fetchall(PDO::FETCH_ASSOC);

 echo json_encode($r);

// echo $r;
 ?>