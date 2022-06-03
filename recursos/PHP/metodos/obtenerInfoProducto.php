<?php
include("../clases/conexion.php");


$id = $_POST['id'];

$BuscarVenta = "select * from productos where CODIGO_BARRAS = '$id'";
$Execute = $conexion->query($BuscarVenta);

$r = $Execute->fetchall(PDO::FETCH_ASSOC);

  echo json_encode($r);







 ?>
