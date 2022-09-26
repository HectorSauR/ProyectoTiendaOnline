<?php
  include("../clases/conexion.php");

  $nombre = $_POST["nombre"];
  $usuario = $_POST["usuario"];
  $imagen = $_POST["imagen"];
  $imagen_File = $_FILES["img_env"];
  $clave = $_POST["clave"];
  $correo = $_POST["correo"];
  $nivel = $_POST["nivelN"];
  $id = $_POST["id"];



  //$sql = "UPDATE usuario SET NOMBRE='$nombre', USUARIO='$usuario', CONTRA='$clave',NIVEL='011$nivel',CORREO='$correo' WHERE USUARIO='$id'";


  
  if ($imagen_File["name"]==''){

    //$path = "../../../recursos/imagenes/productos/".$nombre;
    echo "entro";
    $sql = "UPDATE usuario SET NOMBRE=?,USUARIO=?, CONTRA=?,NIVEL=?,IMAGEN=?,CORREO=? WHERE USUARIO=?";
    $stmt= $conexion->prepare($sql);
    $stmt->execute([$nombre, $usuario, $clave,$nivel, $imagen,$correo, $id]);
  
  } else
  {
    echo "entro1";
    $fileContent = file_get_contents($imagen_File['tmp_name']);
    $path = "../../../recursos/imagenes/usuarios/".$usuario;
    $extension = pathinfo("../../../recursos/imagenes/usuarios/".$usuario."/".$imagen_File["name"], PATHINFO_EXTENSION);
    $pathimg = "  ../../recursos/imagenes/usuarios/".$usuario."/".$usuario.".".$extension;
  
    if (!file_exists($path)) {
      echo "entro2";
      mkdir($path, 0777, true);
      file_put_contents("../../../recursos/imagenes/usuarios/".$usuario."/".$usuario.".".$extension,$fileContent);
      $sql = "UPDATE usuario SET NOMBRE=?, USUARIO=?, CONTRA=?,NIVEL=?,IMAGEN=?,CORREO=? WHERE USUARIO=?";
      $stmt= $conexion->prepare($sql);
      $stmt->execute([$nombre, $usuario, $clave,$nivel, $imagen,$correo, $id]);
    }else{
  
      if (!file_exists($pathimg)) {
        echo "entro3";
        file_put_contents("../../../recursos/imagenes/usuarios/".$usuario."/".$usuario.".".$extension,$fileContent);
        $sql = "UPDATE usuario SET NOMBRE=?, USUARIO=?, CONTRA=?,NIVEL=?,IMAGEN=?,CORREO=? WHERE USUARIO=?";
        $stmt= $conexion->prepare($sql);
        $stmt->execute([$nombre, $usuario, $clave,$nivel, $imagen,$correo, $id]);
        
      }else{
        echo "entro4";
         $old = getcwd(); 
         chdir($path);
          unlink($nombre.".".$extension);
          chdir($old); 
          file_put_contents("../../../recursos/imagenes/usuarios/".$usuario."/".$usuario.".".$extension,$fileContent);
          $sql = "UPDATE usuario SET NOMBRE=?, USUARIO=?, CONTRA=?,NIVEL=?,IMAGEN=?,CORREO=? WHERE USUARIO=?";
          $stmt= $conexion->prepare($sql);
          $stmt->execute([$nombre, $usuario, $clave,$nivel, $imagen,$correo, $id]);
      }
     
  
    }
  }

 ?>
