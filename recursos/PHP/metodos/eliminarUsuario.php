<?php
include("../clases/conexion.php");

$usuario = $_POST['id'];

//VERIFICAR QUE NO SE QUEDE SIN USUARIOS EL SISTEMA
$cantidadUsuarios = "select count(*) from usuario where ID_ESTATUS='1'";
$Execute = $conexion->query($cantidadUsuarios);

$r = $Execute->fetchall(PDO::FETCH_ASSOC);

$totalUsuarios = $r[0]['count(*)'];

if($totalUsuarios == "1"){
  echo "2";
}else{
  $eliminarUsuario = "UPDATE usuario SET ID_ESTATUS='2' WHERE USUARIO=?";
  $consulta =$conexion->prepare($eliminarUsuario);
  $consulta->execute([$usuario]);
    echo "1";
}







 ?>
