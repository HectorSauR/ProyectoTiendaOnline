<?php

require '../../recursos/PHP/clases/conexion.php';

$nombre = $_POST['txtnom'];
$slogan = $_POST['txtslogan'];
$decripcion = $_POST['txtDesc'];
$telefono = $_POST['txttelefono'];
$correo = $_POST['txtcorreo'];
$web = $_POST['txtweb'];
$face = $_POST['txtFace'];
$twitter = $_POST['txtTwitter'];
$imagen = $_FILES['img-elg'];


if($nombre =="" || $slogan=="" || $decripcion=="" || $telefono=="" || $correo=="" || $web=="" || $face=="" || $twitter=="" ){
    echo "<script> alert('VERIFICA SI LOS DATOS ESTAN CORRECTOS PORFAVOR');
    location.href='index.php';
    </script>";
    return;
  }
  


  
$regproducto = "UPDATE info_empresa set NOMBRE=? , SLOGAN=? , DESCRIPCION=? , TELEFONO=? , CORREO=? , WEBSITE=? , FACEBOOK=? , TWITER=?";
$consulta = $conexion->prepare($regproducto);
$arregloprod = array($nombre,$slogan,$decripcion,$telefono,$correo,$web,$face,$twitter);
$res = $consulta->execute($arregloprod);
//$regproducto = "INSERT INTO productos VALUES ('$nombre','$decripcion','$preciovent','$preciocom','$categoria','$cantidad','$unidadM','$status')";
//$Execute = $conexion->query($regproducto);


if($res)
{
    
    echo "<script> alert('correcto');
    location.href='index.php';
    </script>";
 /*
  $fileContent = file_get_contents($imagen['tmp_name']);
  $path = "../../recursos/imagenes/productos/".$nombre;
  if (!file_exists($path)) {
  mkdir($path, 0777, true);
    
  //OBTENER EXTENCION DE IMAGEN
  $extension = pathinfo("../../recursos/imagenes/productos/".$nombre."/".$imagen["name"], PATHINFO_EXTENSION);
  //ALMACENA LA IMAGEN EN EL SERVIDOR
  file_put_contents("../../recursos/imagenes/productos/".$nombre."/".$nombre.".".$extension,$fileContent);
*/
  
}else{
    echo 'mal';
}



?>
