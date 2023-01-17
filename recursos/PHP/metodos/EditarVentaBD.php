<?php
include("../clases/conexion.php");

$usuario = $_POST["usuario"];
$forma_pago = $_POST["forma_pago"];
$id_prd = $_POST["id_prd"];
$cantidad = $_POST["cantidad"];
$status = $_POST["status"];
$id = $_POST["id"];

$sql = "UPDATE
  venta
  INNER JOIN
  detalle_venta
  ON
  venta.ID_VENTA = detalle_venta.ID_VENTA
  SET
  venta.ID_USUARIO = '$usuario', 
  venta.ID_FORMA_PAGO = '$forma_pago',
  venta.ID_ESTATUS = '$status',
  detalle_venta.ID_PRODUCTO = '$id_prd',
  detalle_venta.CANTIDAD = '$cantidad'
  WHERE
  venta.ID_VENTA = $id";
$stmt = $conexion->prepare($sql);
$stmt->execute();
