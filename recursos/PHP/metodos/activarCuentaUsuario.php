<?php

include("../clases/conexion.php");

$usuario = $_POST["usuario"];


$sql = "UPDATE usuario SET ID_ESTATUS=1 WHERE USUARIO='$usuario'";
  $stmt= $conexion->prepare($sql);
  $stmt->execute();