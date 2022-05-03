<?php

require '../../recursos/PHP/clases/conexion.php';

$nombre = $_POST['txtnom'];
$preciovent = $_POST['txtprecv'];
$preciocom = $_POST['txtprecc'];
$categoria = $_POST['txtcat'];
$stock = $_POST['txtstock'];
$stockm = $_POST['txtstockm'];
$status = $_POST['txtstatus'];
$imagen = $_FILES['img-elg'];
$pathimg = "../../recursos/imagenes/productos/".$nombre;

if($nombre ==""  || $preciovent=="" || $preciocom=="" || $categoria=="" || $stock=="" || $stockm=="" || $status=="" ){
  echo "<script> alert('VERIFICA SI LOS DATOS ESTAN CORRECTOS PORFAVOR');
  location.href='index.php';
  </script>";
  return;
}


$regproducto = "INSERT INTO productos VALUES (?,?,?,?,?,?,?,?,?)";
$consulta = $conexion->prepare($regproducto);
$arregloprod = array(null,$categoria,$nombre,$pathimg,$preciocom,$preciovent,$stock,$stockm,,$status);
$res = $consulta->execute($arregloprod);
//$regproducto = "INSERT INTO productos VALUES ('$nombre','$decripcion','$preciovent','$preciocom','$categoria','$cantidad','$unidadM','$status')";
//$Execute = $conexion->query($regproducto);


if($res)
{
    
    echo "<script> alert('correcto');
    location.href='index.php';
    </script>";
 
  $fileContent = file_get_contents($imagen['tmp_name']);
  $path = "../../recursos/imagenes/productos/".$nombre;
  if (!file_exists($path)) {
  mkdir($path, 0777, true);
    
  //OBTENER EXTENCION DE IMAGEN
  $extension = pathinfo("../../recursos/imagenes/productos/".$nombre."/".$imagen["name"], PATHINFO_EXTENSION);
  //ALMACENA LA IMAGEN EN EL SERVIDOR
  file_put_contents("../../recursos/imagenes/productos/".$nombre."/".$nombre.".".$extension,$fileContent);

  }
}else{
    echo "<script> alert('MAL');
    </script>";
}





?>
