<?php

include("../clases/conexion.php");

$id =  $_POST["id"];

$eliminarProducto = "UPDATE productos SET ID_ESTATUS='2' WHERE ID_PRODUCTO = ?;";
$consulta =$conexion->prepare($eliminarProducto);
$consulta->execute([$id]);


?>
