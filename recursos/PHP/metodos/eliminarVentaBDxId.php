<?php

include("../clases/conexion.php");



$id =  $_POST["id"];

$eliminarProducto = "DELETE FROM venta WHERE ID_VENTA='$id';";
$Execute = $conexion->query($eliminarProducto);
$r = $Execute->fetchall(PDO::FETCH_ASSOC);


$eliminarProducto = "DELETE FROM detalle_venta WHERE ID_VENTA='$id';";
$Execute = $conexion->query($eliminarProducto);
$r = $Execute->fetchall(PDO::FETCH_ASSOC);



 ?>
