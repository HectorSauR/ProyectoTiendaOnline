<?php
include("../clases/conexion.php");


$id = $_POST['id'];

$BuscarCotizacion = "select * from productos where ID_PRODUCTO = '$id'";
$Execute = $conexion->query($BuscarCotizacion);

$r = $Execute->fetchall(PDO::FETCH_ASSOC);

  echo json_encode($r);
 ?>
