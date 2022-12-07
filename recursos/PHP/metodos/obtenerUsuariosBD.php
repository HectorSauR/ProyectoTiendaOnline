<?php
include("../clases/conexion.php");


$obtenerUsuarios = "select * from usuario";
$Execute = $conexion->query($obtenerUsuarios);

$r = $Execute->fetchall(PDO::FETCH_ASSOC);

echo json_encode($r);

 ?>
