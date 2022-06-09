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
$imagenv = $_FILES['img'];


// if($nombre =="" || $slogan=="" || $decripcion=="" || $telefono=="" || $correo=="" || $web=="" || $face=="" || $twitter=="" ){
//     echo "<script> alert('VERIFICA SI LOS DATOS ESTAN CORRECTOS PORFAVOR');
//     location.href='index.php';
//     </script>";
//     return;
//   }
  

if ($imagenv=="1"){
    

    echo "no";
// $regproducto = "UPDATE info_empresa set NOMBRE=? , SLOGAN=? , DESCRIPCION=? , TELEFONO=? , CORREO=? , WEBSITE=? , FACEBOOK=? , TWITER=?";
// $consulta = $conexion->prepare($regproducto);
// $arregloprod = array($nombre,$slogan,$decripcion,$telefono,$correo,$web,$face,$twitter);
// $res = $consulta->execute($arregloprod);

}else{
    echo "si";
// $fileContent = file_get_contents($imagen['tmp_name']);
// $path = "../../recursos/imagenes/LOGO/".$nombre;

// $extension = pathinfo("../../recursos/imagenes/LOGO/".$nombre."/".$imagen["name"], PATHINFO_EXTENSION);

// $pathimg = "../../recursos/imagenes/LOGO/".$nombre.".". $extension;

// if (!file_exists($pathimg)) {
    
//     file_put_contents("../../recursos/imagenes/LOGO/".$nombre.".".$extension,$fileContent);
//   }


}



  
echo $res;


?>
