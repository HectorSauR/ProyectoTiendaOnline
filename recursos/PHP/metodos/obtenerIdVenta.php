<?php
include("../clases/conexion.php");


  $formaPago = $_POST['formaPago'];
  $fecha = $_POST['fecha'];

  //OBTENER EL ULTIMO ID
  $obtenerUltimoId= "select ID_VENTA from venta order by ID_VENTA desc limit 1;";
  $Execute = $conexion->query($obtenerUltimoId);

  $r = $Execute->fetchall(PDO::FETCH_ASSOC);

  if(count($r) == 0){
    $id = 1;
  }else{
    $id = $r[0]['ID_VENTA'];
    $id++;
  }

  //REGISTRAR VENTA
  $agregarVenta = "INSERT INTO venta values(?,?,?,?,?)";
  $consulta =$conexion->prepare($agregarVenta);
  $arregloDatos = array($id,"1",$formaPago,"CURDATE()","1");
  $res = $consulta->execute($arregloDatos);

  echo $id;
 ?>
