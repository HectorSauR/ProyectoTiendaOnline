<?php

require '../../recursos/PHP/clases/conexion.php';

$nombre = $_POST['txtnom'];
$decripcion = $_POST['txtdesc'];
$preciovent = $_POST['txtprecv'];
$preciocom = $_POST['txtprecc'];
$categoria = $_POST['txtcat'];
$cantidad = $_POST['txtcant'];
$unidadM = $_POST['txtundm'];
$status = $_POST['txtstatus'];
$imagen = $_FILES['img-elg'];

if($nombre =="" || $decripcion=="" || $preciovent=="" || $preciocom=="" || $categoria=="" || $cantidad=="" || $unidadM=="" || $status=="" ){
  echo "<script> alert('VERIFICA SI LOS DATOS ESTAN CORRECTOS PORFAVOR');
  location.href='index.php';
  </script>";
  return;
}


$regproducto = "INSERT INTO productos VALUES (?,?,?,?,?,?,?,?,?)";
$consulta = $conexion->prepare($regproducto);
$arregloprod = array(null,$nombre,$decripcion,$preciovent,$preciocom,$categoria,$cantidad,$unidadM,$status);
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
