<?php
  include("../clases/conexion.php");

  $nombre = $_POST["nombre"];
  $imagen = $_POST["imagen"];
  $imagen_File = $_FILES["img_env"];
  $categoria = $_POST["categoria"];
  $precioc = $_POST["precioc"];
  $precio = $_POST["precio"];
  $stock = $_POST["stock"];
  $stockm = $_POST["stockm"];
  $status = $_POST["status"];
  $id = $_POST["id"];


  
if ($imagen_File["name"]=='' ){

  $path = "../../../recursos/imagenes/productos/".$nombre;

  $sql = "UPDATE productos SET NOMBRE='$nombre', IMAGEN='$imagen', ID_CATEGORIA='$categoria',PRECIO_COMPRA='$precioc',PRECIO='$precio',STOCK='$stock',STOCK_MIN='$stockm',ID_ESTATUS='$status' WHERE ID_PRODUCTO='$id'";
  $stmt= $conexion->prepare($sql);
  $stmt->execute([$nombre, $imagen, $categoria,$precioc,$precio,$stock,$stockm,$status,$id]);
} else
{
  
  $fileContent = file_get_contents($imagen_File['tmp_name']);
  $path = "../../../recursos/imagenes/productos/".$nombre;
  $extension = pathinfo("../../../recursos/imagenes/productos/".$nombre."/".$imagen_File["name"], PATHINFO_EXTENSION);
  $pathimg = "  ../../recursos/imagenes/productos/".$nombre."/".$nombre.".".$extension;

  if (!file_exists($path)) {
    mkdir($path, 0777, true);
    file_put_contents("../../../recursos/imagenes/productos/".$nombre."/".$nombre.".".$extension,$fileContent);
    $sql = "UPDATE productos SET NOMBRE='$nombre', IMAGEN='$pathimg', ID_CATEGORIA='$categoria',PRECIO_COMPRA='$precioc',PRECIO='$precio',STOCK='$stock',STOCK_MIN='$stockm',ID_ESTATUS='$status' WHERE ID_PRODUCTO='$id'";
    $stmt= $conexion->prepare($sql);
    $stmt->execute([$nombre, $pathimg, $categoria,$precioc,$precio,$stock,$stockm,$status,$id]);

  }else{

    if (!file_exists($pathimg)) {
      
      file_put_contents("../../../recursos/imagenes/productos/".$nombre."/".$nombre.".".$extension,$fileContent);
      $sql = "UPDATE productos SET NOMBRE='$nombre', IMAGEN='$pathimg', ID_CATEGORIA='$categoria',PRECIO_COMPRA='$precioc',PRECIO='$precio',STOCK='$stock',STOCK_MIN='$stockm',ID_ESTATUS='$status' WHERE ID_PRODUCTO='$id'";
      $stmt= $conexion->prepare($sql);
      $stmt->execute([$nombre, $pathimg, $categoria,$precioc,$precio,$stock,$stockm,$status,$id]);
  
      
    }else{
       $old = getcwd(); 
       chdir($path);
        unlink($nombre.".".$extension);
        chdir($old); 
        file_put_contents("../../../recursos/imagenes/productos/".$nombre."/".$nombre.".".$extension,$fileContent);
        $sql = "UPDATE productos SET NOMBRE='$nombre', IMAGEN='$pathimg', ID_CATEGORIA='$categoria',PRECIO_COMPRA='$precioc',PRECIO='$precio',STOCK='$stock',STOCK_MIN='$stockm',ID_ESTATUS='$status' WHERE ID_PRODUCTO='$id'";
        $stmt= $conexion->prepare($sql);
        $stmt->execute([$nombre, $pathimg, $categoria,$precioc,$precio,$stock,$stockm,$status,$id]);
    
    }
   
  }
}
  


  

 ?>


