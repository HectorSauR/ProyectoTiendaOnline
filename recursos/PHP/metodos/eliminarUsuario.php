<?php
include("../clases/conexion.php");

$usuario = $_POST['id'];

//VERIFICAR QUE NO SE QUEDE SIN USUARIOS EL SISTEMA
/* CODIGO NO NECESARIO POR EL MOMENTO
$cantidadUsuarios = "select count(*) from usuario where ID_ESTATUS='1'";
$Execute = $conexion->query($cantidadUsuarios);

$r = $Execute->fetchall(PDO::FETCH_ASSOC);

$totalUsuarios = $r[0]['count(*)'];
*/

//VERIFICAR QUE USUARIO RECIBIDO NO SEA IGUAL AL USUARIO ACTIVO
//GUARDADO EN VARIABLE DE SESSION
//UN ADMIN NO SE PUEDE DAR DE BAJA EL MISMO
session_start();
$usuarioActivo = $_SESSION['usuario'];


if($usuario == $usuarioActivo){
  echo "2";
}else{
  $eliminarUsuario = "UPDATE usuario SET ID_ESTATUS='2' WHERE USUARIO=?";
  $consulta =$conexion->prepare($eliminarUsuario);
  $consulta->execute([$usuario]);
    echo "1";
}







 ?>
