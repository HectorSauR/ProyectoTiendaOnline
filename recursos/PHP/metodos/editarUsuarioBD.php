<?php
  include("../clases/conexion.php");

  $nombre = $_POST["nombre"];
  $usuario = $_POST["usuario"];

  //RUTA IMAGEN
  $imagen = $_POST["imagen"];

  $imagen_File = $_FILES["img_env"];

  $correo = $_POST["correo"];
  $nivel = $_POST["nivelN"];
  $id = $_POST["id"];//ID ES NOMBRE DE USUARIO;

  
  if ($imagen_File["name"]==''){

    
    $sql = "UPDATE usuario SET NOMBRE=?,USUARIO=?,NIVEL=?,IMAGEN=?,CORREO=? WHERE USUARIO=?";
   
    try {
      $stmt= $conexion->prepare($sql);
      $stmt->execute([$nombre, $usuario,$nivel, $imagen,$correo, $id]);
      $miArray = array("0"=>true, "1"=>'' ,"2"=>false);

      echo json_encode($miArray);

    }catch( PDOException $Exception ) {
      //echo $Exception->getMessage();
      echo  json_encode($Exception->errorInfo);
    }
    
    //echo $result;

    
  
  } else
  {

   
  
    $fileContent = file_get_contents($imagen_File['tmp_name']);
    $path = "../../../recursos/imagenes/usuarios/".$usuario;
    $extension = pathinfo("../../../recursos/imagenes/usuarios/".$usuario."/".$imagen_File["name"], PATHINFO_EXTENSION);
    $pathimg = "  ../../recursos/imagenes/usuarios/".$usuario."/".$usuario.".".$extension;
    $pathimgBD = "recursos/imagenes/usuarios/".$usuario."/".$usuario.".".$extension;

    //ARREGLO PARA REGRESAR DEL METODO FETCH JS
    $miArray = array("0"=>true, "1"=>$pathimgBD ,"2"=>true);

     //ACTUALIZAR RUTA DE IMAGEN DE USURIO
     session_start();
     $_SESSION['rutaImagenUsuario'] = $pathimgBD;
    
    //VERIFICA SI NO EXISTE LA RUTA DONDE SE GUARDA LA IMAGEN DE USUARIO ACTUAL
    if (!file_exists($path)) {
     
      mkdir($path, 0777, true);
      file_put_contents("../../../recursos/imagenes/usuarios/".$usuario."/".$usuario.".".$extension,$fileContent);
      $sql = "UPDATE usuario SET NOMBRE=?, USUARIO=?,NIVEL=?,IMAGEN=?,CORREO=? WHERE USUARIO=?";
      
      try {
        $stmt= $conexion->prepare($sql);
        $result = $stmt->execute([$nombre, $usuario,$nivel, $pathimgBD,$correo, $id]);
        
        echo json_encode($miArray);
      }catch(PDOException $Exception){
        echo  json_encode($Exception->errorInfo);
      }
     //RUTA EXISTE
    }else{

      //ELIMINO LA(S) IMAGENES DEL USUAURIO ACTUAL
      deleteDirectory($path);

      //GUARDO LA IMAGEN EN EL DIRECTORIO
      file_put_contents("../../../recursos/imagenes/usuarios/".$usuario."/".$usuario.".".$extension,$fileContent);
      $sql = "UPDATE usuario SET NOMBRE=?, USUARIO=?,NIVEL=?,IMAGEN=?,CORREO=? WHERE USUARIO=?";
      try {
        $stmt= $conexion->prepare($sql);
        $result = $stmt->execute([$nombre, $usuario,$nivel, $pathimgBD,$correo, $id]);
      
        echo json_encode($miArray);
      }catch(PDOException $Exception){
        echo  json_encode($Exception->errorInfo);
      }

  
      /* CODIGO MENOS OPTIMIZADO
      if (!file_exists($pathimg)) {
    
        file_put_contents("../../../recursos/imagenes/usuarios/".$usuario."/".$usuario.".".$extension,$fileContent);
        $sql = "UPDATE usuario SET NOMBRE=?, USUARIO=?,NIVEL=?,IMAGEN=?,CORREO=? WHERE USUARIO=?";
        try {
          $stmt= $conexion->prepare($sql);
          $result = $stmt->execute([$nombre, $usuario,$nivel, $imagen,$correo, $id]);
        echo true;
        }catch(PDOException $Exception){
          echo  json_encode($Exception->errorInfo);
        }
      }else{
        
         $old = getcwd(); 
         chdir($path);
          unlink($nombre.".".$extension);
          chdir($old); 
          file_put_contents("../../../recursos/imagenes/usuarios/".$usuario."/".$usuario.".".$extension,$fileContent);
          $sql = "UPDATE usuario SET NOMBRE=?, USUARIO=?,NIVEL=?,IMAGEN=?,CORREO=? WHERE USUARIO=?";
          try {
            $stmt= $conexion->prepare($sql);
            $result = $stmt->execute([$nombre, $usuario,$nivel, $imagen,$correo, $id]);
          echo true;
          }catch(PDOException $Exception){
            echo  json_encode($Exception->errorInfo);
          }
      }
        FIN DE CODIGO MENOS OPTIMIZADO
        (PODRIA OCUPAR UNA PARTE DE EL..)
      */
     
  
    }
  }

  //ESTA FUNCION ELIMINA TODOS LOS ARCHIVOS DE UN DIRECTORIO
  function deleteDirectory($dir) {
    if(!$dh = @opendir($dir)) return;
    while (false !== ($current = readdir($dh))) {
        if($current != '.' && $current != '..') {
            //echo 'Se ha borrado el archivo '.$dir.'/'.$current.'<br/>';
            if (!@unlink($dir.'/'.$current)) 
                deleteDirectory($dir.'/'.$current);
        }       
    }
    closedir($dh);
    //echo 'Se ha borrado el directorio '.$dir.'<br/>';
    //@rmdir($dir);
}

 ?>
