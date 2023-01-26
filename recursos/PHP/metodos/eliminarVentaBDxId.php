<?php

include("../clases/conexion.php");

$id =  $_POST["id"];

$eliminarProducto = "UPDATE venta SET ID_ESTATUS = '2' WHERE ID_VENTA ='$id';";
$Execute = $conexion->query($eliminarProducto);
$r = $Execute->fetchall(PDO::FETCH_ASSOC);



 ?>
