<?php

include("../clases/conexion.php");


$obtenerVenta = "SELECT * FROM venta INNER JOIN detalle_venta ON venta.ID_VENTA = detalle_venta.ID_VENTA ORDER BY venta.ID_VENTA DESC;";
$Execute = $conexion->query($obtenerVenta);

$r = $Execute->fetchall(PDO::FETCH_ASSOC);



echo json_encode($r);


 ?>
