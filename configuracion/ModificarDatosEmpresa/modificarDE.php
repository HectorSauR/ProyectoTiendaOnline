<?php

require '../../recursos/PHP/clases/conexion.php';
require '../../recursos/PHP/configuracionDelSitioWeb/conf.php';

$nombre = $_POST['txtnom'];
$slogan = $_POST['txtslogan'];
$decripcion = $_POST['txtDesc'];
$telefono = $_POST['txttelefono'];
$correo = $_POST['txtcorreo'];
$web = $_POST['txtweb'];
$face = $_POST['txtFace'];
$twitter = $_POST['txtTwitter'];
$imagen = $_FILES['img-elg'];
$imagenv = $_POST['img'];



if ($imagenv=="1"){
$regproducto = "UPDATE info_empresa set NOMBRE=? , SLOGAN=? , DESCRIPCION=? , TELEFONO=? , CORREO=? , WEBSITE=? , FACEBOOK=? , TWITER=?";
$consulta = $conexion->prepare($regproducto);
$arregloprod = array($nombre,$slogan,$decripcion,$telefono,$correo,$web,$face,$twitter);
$res = $consulta->execute($arregloprod);

}else{
$fileContent = file_get_contents($imagen['tmp_name']);
$path = "$pathHost/recursos/imagenes/LOGO/".$nombre;

$extension = pathinfo("$pathHost/recursos/imagenes/LOGO/".$nombre."/".$imagen["name"], PATHINFO_EXTENSION);

$pathimg = "$pathHost/recursos/imagenes/LOGO/".$nombre.".". $extension;
   
    file_put_contents("../../recursos/imagenes/LOGO/".$nombre.".".$extension,$fileContent);
      $regproducto = "UPDATE info_empresa set NOMBRE=? ,LOGO = ? , SLOGAN=? , DESCRIPCION=? , TELEFONO=? , CORREO=? , WEBSITE=? , FACEBOOK=? , TWITER=?";
    $consulta = $conexion->prepare($regproducto);
    $arregloprod = array($nombre,$pathimg,$slogan,$decripcion,$telefono,$correo,$web,$face,$twitter);
    $res = $consulta->execute($arregloprod);


}



  

echo $res;


?>
