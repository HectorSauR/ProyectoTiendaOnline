<?php
  include("../clases/conexion.php");

  $usuario = $_POST["usuario"];
  $forma_pago = $_POST["forma_pago"];
  $fecha = $_POST["fecha"];
  $id_prd = $_POST["id_prd"];
  $cantidad = $_POST["cantidad"];
  $precio = $_POST["precio"];
  $status = $_POST["status"];
  $id = $_POST["id"];



  $sql = "UPDATE
  venta
  INNER JOIN
  detalle_venta
  ON
  venta.ID_VENTA = detalle_venta.ID_VENTA
  SET
  venta.ID_USUARIO = '$usuario', venta.ID_FORMA_PAGO = '$forma_pago',venta.FECHA = '$fecha',venta.ID_ESTATUS = '$status',detalle_venta.ID_PRODUCTO = '$id_prd',detalle_venta.CANTIDAD = '$cantidad',detalle_venta.PRECIO = '$precio'
  WHERE
  venta.ID_VENTA = $id";
  
  $stmt= $conexion->prepare($sql);
  $stmt->execute([$usuario, $forma_pago, $fecha,$id_prd,$cantidad, $precio, $status,$id]);

 ?>