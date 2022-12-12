<?php
include("../clases/conexion.php");


$id = $_POST['id'];

$BuscarCotizacion = "select * from cotizacion where ID_COTIZACION = '$id'";
$Execute = $conexion->query($BuscarCotizacion);

$r = $Execute->fetchall(PDO::FETCH_ASSOC);

if ($r[0]['ID_ESTATUS'] == 2) {
  echo 0;
  return;
}

echo json_encode($r);
