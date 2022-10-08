<?php
  include("../clases/conexion.php");

  $nombre = $_POST["nombre"];
  $usuario = $_POST["usuario"];
  $imagen = $_POST["imagen"];
  $imagen_File = $_FILES["img_env"];
  //$clave = $_POST["clave"];
  $correo = $_POST["correo"];
  $nivel = $_POST["nivelN"];
  $id = $_POST["id"];

  
  if ($imagen_File["name"]==''){

    
    $sql = "UPDATE usuario SET NOMBRE=?,USUARIO=?,NIVEL=?,IMAGEN=?,CORREO=? WHERE USUARIO=?";
    $stmt= $conexion->prepare($sql);
    $result = $stmt->execute([$nombre, $usuario,$nivel, $imagen,$correo, $id]);
    echo $result;
  
  } else
  {
  
    $fileContent = file_get_contents($imagen_File['tmp_name']);
    $path = "../../../recursos/imagenes/usuarios/".$usuario;
    $extension = pathinfo("../../../recursos/imagenes/usuarios/".$usuario."/".$imagen_File["name"], PATHINFO_EXTENSION);
    $pathimg = "  ../../recursos/imagenes/usuarios/".$usuario."/".$usuario.".".$extension;
  
    if (!file_exists($path)) {
     
      mkdir($path, 0777, true);
      file_put_contents("../../../recursos/imagenes/usuarios/".$usuario."/".$usuario.".".$extension,$fileContent);
      $sql = "UPDATE usuario SET NOMBRE=?, USUARIO=?,NIVEL=?,IMAGEN=?,CORREO=? WHERE USUARIO=?";
      $stmt= $conexion->prepare($sql);
      $result = $stmt->execute([$nombre, $usuario,$nivel, $imagen,$correo, $id]);
    echo $result;
    }else{
  
      if (!file_exists($pathimg)) {
    
        file_put_contents("../../../recursos/imagenes/usuarios/".$usuario."/".$usuario.".".$extension,$fileContent);
        $sql = "UPDATE usuario SET NOMBRE=?, USUARIO=?,NIVEL=?,IMAGEN=?,CORREO=? WHERE USUARIO=?";
        $stmt= $conexion->prepare($sql);
        $result = $stmt->execute([$nombre, $usuario,$nivel, $imagen,$correo, $id]);
        echo $result;
      }else{
        
         $old = getcwd(); 
         chdir($path);
          unlink($nombre.".".$extension);
          chdir($old); 
          file_put_contents("../../../recursos/imagenes/usuarios/".$usuario."/".$usuario.".".$extension,$fileContent);
          $sql = "UPDATE usuario SET NOMBRE=?, USUARIO=?,NIVEL=?,IMAGEN=?,CORREO=? WHERE USUARIO=?";
          $stmt= $conexion->prepare($sql);
          $result = $stmt->execute([$nombre, $usuario,$nivel, $imagen,$correo, $id]);
    echo $result;
      }
     
  
    }
  }

 ?>
