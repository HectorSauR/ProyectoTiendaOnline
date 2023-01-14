<?php
include("../clases/conexion.php");

$nombre = $_POST["nombre"];
$descripcion = $_POST["descripcion"];

//RUTA IMAGEN
$imagen = $_POST["imagen"];

$imagen_File = $_FILES["img_env"];

$id = $_POST["id"]; //ID ES NOMBRE DE CATEGORIA;

//VERIFICAR QUE NO ALLA MODIFICACION DE IMAGEN
if ($imagen_File["name"] == '') {


  $sql = "UPDATE categoria_productos SET NOMBRE=?,DESCRIPCION=?,IMAGEN=? WHERE NOMBRE=?";

  try {
    $stmt = $conexion->prepare($sql);
    $stmt->execute([$nombre,$descripcion,$imagen,$id]);

    $miArray = array("0" => true, "1" => '', "2" => false);

    echo json_encode($miArray);
  } catch (PDOException $Exception) {
    //echo $Exception->getMessage();
    echo  json_encode($Exception->errorInfo);
  }
}else{
  //LOGICA PARA CUANDO IMAGEN SEA MODIFICADA
  $fileContent = file_get_contents($imagen_File['tmp_name']);
  $path = "../../../recursos/imagenes/regCategoria/".$nombre;
  $extension = pathinfo("../../../recursos/imagenes/regCategoria/".$nombre."/".$imagen_File["name"], PATHINFO_EXTENSION);
  $pathimg = "  ../../recursos/imagenes/regCategoria/".$nombre."/".$nombre.".".$extension;
  $pathimgBD = "recursos/imagenes/regCategoria/" . $nombre . "/" . $nombre . "." . $extension;

  $miArray = array("0" => true, "1" => $pathimgBD, "2" => false , "3" => $pathimg);

    //VERIFICA SI NO EXISTE LA RUTA DONDE SE GUARDA LA IMAGEN DE USUARIO ACTUAL
    if (!file_exists($path)) {

      mkdir($path, 0777, true);
      file_put_contents("../../../recursos/imagenes/regCategoria/" . $nombre . "/" . $nombre . "." . $extension, $fileContent);
      $sql = "UPDATE categoria_productos SET NOMBRE=?,DESCRIPCION=?,IMAGEN=? WHERE NOMBRE=?";

  
      try {
        $stmt = $conexion->prepare($sql);
        $stmt->execute([$nombre,$descripcion,$pathimgBD,$id]);

        echo json_encode($miArray);
      } catch (PDOException $Exception) {
        echo  json_encode($Exception->errorInfo);
      }
      //RUTA EXISTE
    }else{
      //ELIMINO LA(S) IMAGENES DEL USUAURIO ACTUAL
    deleteDirectory($path);

    //GUARDO LA IMAGEN EN EL DIRECTORIO
    file_put_contents("../../../recursos/imagenes/regCategoria/" . $nombre . "/" . $nombre . "." . $extension, $fileContent);
    $sql = "UPDATE categoria_productos SET NOMBRE=?,DESCRIPCION=?,IMAGEN=? WHERE NOMBRE=?";

  
      try {
        $stmt = $conexion->prepare($sql);
        $stmt->execute([$nombre,$descripcion,$pathimgBD,$id]);

        echo json_encode($miArray);
      } catch (PDOException $Exception) {
        echo  json_encode($Exception->errorInfo);
      }

    } 
  
}




//ESTA FUNCION ELIMINA TODOS LOS ARCHIVOS DE UN DIRECTORIO
function deleteDirectory($dir)
{
  if (!$dh = @opendir($dir)) return;
  while (false !== ($current = readdir($dh))) {
    if ($current != '.' && $current != '..') {
      //echo 'Se ha borrado el archivo '.$dir.'/'.$current.'<br/>';
      if (!@unlink($dir . '/' . $current))
        deleteDirectory($dir . '/' . $current);
    }
  }
  closedir($dh);
  //echo 'Se ha borrado el directorio '.$dir.'<br/>';
  //@rmdir($dir);
}
