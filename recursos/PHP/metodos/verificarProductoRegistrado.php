<?php

include("../clases/conexion.php");
//variables post

$nombre = $_POST['txtnom'];
//$id = $_POST['id'];

$BuscarProducto= "select * from productos where NOMBRE = '$nombre'";
$Execute = $conexion->query($BuscarProducto);

$r = $Execute->fetchall(PDO::FETCH_ASSOC);

if(count($r) == 1){

  echo count($r);
}else{
  echo count($r);
}

 ?>