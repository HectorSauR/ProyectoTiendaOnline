<?php
include("../clases/conexion.php");

$nombre = $_POST['id'];

$eliminarCategoria = "UPDATE categoria_productos SET ID_ESTATUS='2' WHERE NOMBRE=?";
  $consulta =$conexion->prepare($eliminarCategoria);
  $consulta->execute([$nombre]);
    echo "1";