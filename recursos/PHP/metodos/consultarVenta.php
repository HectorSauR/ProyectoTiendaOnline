<?php

include("../clases/conexion.php");



$BuscarVenta = "SELECT * FROM venta INNER JOIN detalle_venta ON venta.ID_VENTA = detalle_venta.ID_VENTA ORDER BY venta.FECHA DESC;";
$Execute = $conexion->query($BuscarVenta);

$r = $Execute->fetchall(PDO::FETCH_ASSOC);

  echo json_encode($r);



 ?>
