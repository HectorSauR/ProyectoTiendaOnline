<?php

include("../clases/conexion.php");



$BuscarVenta = "SELECT * FROM CONSULTA_VENTA;";
$Execute = $conexion->query($BuscarVenta);

$r = $Execute->fetchall(PDO::FETCH_ASSOC);

  echo json_encode($r);

