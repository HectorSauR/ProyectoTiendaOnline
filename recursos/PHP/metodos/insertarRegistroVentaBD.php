<?php
  include("../clases/conexion.php");


  $idventa = $_POST['idventa'];
  $idproducto = $_POST['idproducto'];
  $cantidad = $_POST['cantidad'];
  $precio = $_POST['precio'];

  $agregarUsuario = "INSERT INTO detalle_venta values(?,?,?,?)";
  $consulta =$conexion->prepare($agregarUsuario);
  $arregloDatos = array($idventa,$idproducto,$cantidad,$precio);
  $res = $consulta->execute($arregloDatos);

  //UPDATE STOCK PRODUCTO
  $sql = "UPDATE productos SET STOCK=STOCK-? WHERE ID_PRODUCTO=?";
  $stmt= $conexion->prepare($sql);
  $stmt->execute([$cantidad ,$idproducto]);
