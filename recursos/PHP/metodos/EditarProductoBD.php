<?php
  include("../clases/conexion.php");

  $nombre = $_POST["nombre"];
  $categoria = $_POST["categoria"];
  $imagen = $_POST["imagen"];
  $imagen_File = $_FILES["img_env"];
  $precio = $_POST["precio"];
  $precioc = $_POST["precio_c"];
  $stock = $_POST["stock"];
  $stockm = $_POST["stockm"];
  $codigo = $_POST["codigo"];
  $estatus = $_POST["estatus"];
  $ID_estatus = $_POST["ID_estatus"];
  $id = $_POST["id"];


  
if ($imagen_File["name"]==''){

  $sql = "UPDATE productos SET NOMBRE=?, IMAGEN=?, ID_CATEGORIA=?,PRECIO_COMPRA=?,PRECIO=?,STOCK=?, STOCK_MIN=?, CODIGO_BARRAS=?, ID_ESTATUS=? WHERE ID_PRODUCTO=?";

  try {
    $stmt = $conexion->prepare($sql);
    $stmt->execute([$nombre, $imagen, $categoria, $precioc, $precio, $stock, $stockm, $codigo, $ID_estatus, $id]);
    $miArray = array("0" => true, "1" => '', "2" => false);

    echo json_encode($miArray);
  } catch (PDOException $Exception) {
    //echo $Exception->getMessage();
    echo  json_encode($Exception->errorInfo);
  }

} else
{

  $fileContent = file_get_contents($imagen_File['tmp_name']);
  $path = "../../../recursos/imagenes/productos/".$nombre;
  $extension = pathinfo("../../../recursos/imagenes/productos/".$nombre."/".$imagen_File["name"], PATHINFO_EXTENSION);
  $pathimg = "  ../../recursos/imagenes/productos/".$nombre."/".$nombre.".".$extension;
  $pathimgBD = "recursos/imagenes/productos/" . $nombre . "/" . $nombre . "." . $extension;

  $miArray = array("0" => true, "1" => $pathimgBD, "2" => true , "3" => $pathimg);

  if (!file_exists($path)) {
    mkdir($path, 0777, true);
    file_put_contents("../../../recursos/imagenes/productos/".$nombre."/".$nombre.".".$extension,$fileContent);

    $sql = "UPDATE productos SET NOMBRE=?, IMAGEN=?, ID_CATEGORIA=?,PRECIO_COMPRA=?,PRECIO=?,STOCK=?, STOCK_MIN=?, CODIGO_BARRAS=?, ID_ESTATUS=? WHERE ID_PRODUCTO=?";    $stmt= $conexion->prepare($sql);
    try {
      $stmt = $conexion->prepare($sql);
      $stmt->execute([$nombre, $pathimgBD, $categoria, $precioc, $precio, $stock, $stockm, $codigo, $ID_estatus, $id]);

      echo json_encode($miArray);
    } catch (PDOException $Exception) {
      echo  json_encode($Exception->errorInfo);
    }


  }else{

    deleteDirectory($path);
    file_put_contents("../../../recursos/imagenes/productos/" . $nombre . "/" . $nombre . "." . $extension, $fileContent);

    $sql = "UPDATE productos SET NOMBRE=?, IMAGEN=?, ID_CATEGORIA=?,PRECIO_COMPRA=?,PRECIO=?, STOCK=?, STOCK_MIN=?, CODIGO_BARRAS=?, ID_ESTATUS=? WHERE ID_PRODUCTO=?";    $stmt= $conexion->prepare($sql);

    try {
      $stmt = $conexion->prepare($sql);
      $stmt->execute([$nombre, $pathimgBD, $categoria, $precioc, $precio, $stock, $stockm, $codigo, $ID_estatus, $id]);

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



  

 ?>


