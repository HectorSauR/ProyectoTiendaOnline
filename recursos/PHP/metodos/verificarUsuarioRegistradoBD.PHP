<?php

include("../clases/conexion.php");
//variables post

$usuario = $_POST['usuario'];

$BuscarUsuario = "select * from usuario where USUARIO = '$usuario'";
$Execute = $conexion->query($BuscarUsuario);

$r = $Execute->fetchall(PDO::FETCH_ASSOC);

if(count($r) == 1){

  echo count($r);
}else{
  echo count($r);
}

 ?>
