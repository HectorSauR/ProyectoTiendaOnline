<?php
include("../clases/conexion.php");


$id = $_POST['id'];

$BuscarVenta = "SELECT * FROM venta INNER JOIN detalle_venta ON venta.ID_VENTA = detalle_venta.ID_VENTA WHERE venta.ID_VENTA = '$id'";
$Execute = $conexion->query($BuscarVenta);

$r = $Execute->fetchall(PDO::FETCH_ASSOC);

  echo json_encode($r);







 ?>
