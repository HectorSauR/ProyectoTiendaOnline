<?php
  include("../clases/conexion.php");

  $nombre = $_POST["nombre"];
  $usuario = $_POST["usuario"];
  $clave = $_POST["clave"];
  $correo = $_POST["correo"];
  $nivel = $_POST["nivelN"];
  $id = $_POST["id"];



  //$sql = "UPDATE usuario SET NOMBRE='$nombre', USUARIO='$usuario', CONTRA='$clave',NIVEL='011$nivel',CORREO='$correo' WHERE USUARIO='$id'";
  $sql = "UPDATE usuario SET NOMBRE=?, USUARIO=?, CONTRA=?,NIVEL=?,CORREO=? WHERE USUARIO=?";
  $stmt= $conexion->prepare($sql);
  $stmt->execute([$nombre, $usuario, $clave,$nivel,$correo, $id]);

 ?>
