<?php

require '../../recursos/PHP/clases/conexion.php';

$nombre = $_POST['txtnom'];
$preciovent = $_POST['txtprecv'];
$preciocom = $_POST['txtprecc'];
$categoria = $_POST['txtcat'];
$stock = $_POST['txtstock'];
$stockm = $_POST['txtstockm'];
$status = $_POST['txtstatus'];
$imagen = $_FILES['imagen'];
$codigo_b = $_POST['txtcb'];





  $fileContent = file_get_contents($imagen['tmp_name']);
  $path = "../../recursos/imagenes/productos/".$nombre;
  //VERIFICAR SI CARPETA DE nombre EXISTE
  if (!file_exists($path)) {
    mkdir($path, 0777, true);
  }
  //OBTENER EXTENCION DE IMAGEN
  $extension = pathinfo("../../recursos/imagenes/productos/".$nombre."/".$imagen["name"], PATHINFO_EXTENSION);
  //ALMACENA LA IMAGEN EN EL SERVIDOR
  file_put_contents("../../recursos/imagenes/productos/".$nombre."/".$nombre.".".$extension,$fileContent);
  $pathimg = "recursos/imagenes/productos/".$nombre."/".$nombre.".".$extension;

  //OBTENER EL ULTIMO ID
  $obtenerUltimoId= "select ID_PRODUCTO from productos order by ID_PRODUCTO desc limit 1;";
  $Execute = $conexion->query($obtenerUltimoId);
  $r = $Execute->fetchall(PDO::FETCH_ASSOC);
  $id = $r[0]['ID_PRODUCTO'];
  $id++;



  $regproducto = "INSERT INTO productos VALUES (?,?,?,?,?,?,?,?,?,?)";
  $consulta = $conexion->prepare($regproducto);
  $arregloprod = array($id,$categoria,$nombre,$pathimg,$preciocom,$preciovent,$stock,$stockm,$status, $codigo_b);
  $res = $consulta->execute($arregloprod);


  echo $res;






?>
