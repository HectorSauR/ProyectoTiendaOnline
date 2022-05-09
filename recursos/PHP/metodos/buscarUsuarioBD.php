<?php

session_start();
include("../clases/conexion.php");
//variables post

$usuario = $_POST['user'];
$pass = $_POST['clave'];



$BuscarUsuario = "select * from usuario where USUARIO = '$usuario' and CONTRA = '$pass'";
$Execute = $conexion->query($BuscarUsuario);

$r = $Execute->fetchall(PDO::FETCH_ASSOC);

if(count($r) == 1){

  if($r[0]['NIVEL'] == "1"){
    $_SESSION['userAdmin'] = "1";
  }

  if($r[0]['ID_ESTATUS'] == "2"){
    echo "3";
  }else{
    echo count($r);
  }

    //Variables de session
  $_SESSION['usuario'] = $usuario;
}else{
  echo count($r);
}

 ?>
