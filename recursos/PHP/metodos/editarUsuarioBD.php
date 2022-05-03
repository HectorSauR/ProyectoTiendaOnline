<?php
  include("../clases/conexion.php");

  $nombre = $_POST["nombre"];
  $usuario = $_POST["usuario"];
  $clave = $_POST["clave"];
  $correo = $_POST["correo"];
  $nivel = $_POST["nivelN"];
  $id = $_POST["id"];



  $sql = "UPDATE usuario SET NOMBRE='$nombre', USUARIO='$usuario', CONTRA='$clave',NIVEL='$nivel',CORREO='$correo' WHERE USUARIO='$id'";
  $stmt= $conexion->prepare($sql);
  $stmt->execute([$nombre, $usuario, $clave,$nivel,$correo, $id]);

 ?>
