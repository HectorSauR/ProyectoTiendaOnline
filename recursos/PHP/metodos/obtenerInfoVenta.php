<?php
include("../clases/conexion.php");


$id = $_POST['id'];

$BuscarVenta = "select * from venta where ID_VENTA = '$id'";
$Execute = $conexion->query($BuscarVenta);

$r = $Execute->fetchall(PDO::FETCH_ASSOC);

  echo json_encode($r);







 ?>
