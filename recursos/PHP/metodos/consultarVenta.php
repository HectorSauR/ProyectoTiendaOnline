<?php

include("../clases/conexion.php");



$BuscarVenta = "select * from detalle_venta";
$Execute = $conexion->query($BuscarVenta);

$r = $Execute->fetchall(PDO::FETCH_ASSOC);

  echo json_encode($r);



 ?>
