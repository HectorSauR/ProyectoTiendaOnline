<?php
include("../clases/conexion.php");

$nombre = $_POST["usuario"];


$sql = "UPDATE categoria_productos SET ID_ESTATUS=1 WHERE NOMBRE='$nombre'";
  $stmt= $conexion->prepare($sql);
  $stmt->execute();