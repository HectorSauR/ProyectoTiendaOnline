<?php

include("../clases/conexion.php");



$id =  $_POST["id"];

$eliminarProducto = "DELETE FROM productos WHERE ID_PRODUCTO='$id';";
$Execute = $conexion->query($eliminarProducto);
$r = $Execute->fetchall(PDO::FETCH_ASSOC);



 ?>
