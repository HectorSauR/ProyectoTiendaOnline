<?php

include("../clases/conexion.php");
//variables post

$id = $_POST['id_prd'];

$BuscarUsuario = "SELECT * from productos where ID_PRODUCTO = '$id'";
$Execute = $conexion->query($BuscarUsuario);

$r = $Execute->fetchall(PDO::FETCH_ASSOC);

if(count($r) == 1){

  echo count($r);
}else{
  echo count($r);
}

 ?>