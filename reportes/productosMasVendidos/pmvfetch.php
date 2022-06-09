<?php

require "../../recursos/PHP/clases/conexion.php";

$dato = json_decode(file_get_contents('php://input'),true);

// print_r ($dato);

$id = $dato["id"];
$ids = $dato["ids"];
$qr =  $dato["qr"];

if ($qr == 1) {
   $productos = "select * from productos where ID_CATEGORIA= $id";
   $Execute = $conexion->query($productos);
   $r = $Execute->fetchall();
}else if ($qr == 2) {
   $productos = "select * from productos where ID_ESTATUS= $ids";
   $Execute = $conexion->query($productos);
   $r = $Execute->fetchall();
}else if ($qr == 3) {
   $productos = "select * from productos where ID_ESTATUS= $ids and ID_CATEGORIA= $id";
   $Execute = $conexion->query($productos);
   $r = $Execute->fetchall();
}



foreach($r as $row){
 

   $query1 = current($conexion -> query("SELECT COUNT(*) FROM detalle_venta WHERE ID_PRODUCTO = '$row[ID_PRODUCTO]'")->fetch());

   $query2 = current($conexion -> query("SELECT SUM(CANTIDAD) FROM detalle_venta WHERE ID_PRODUCTO = '$row[ID_PRODUCTO]'")->fetch());

   $datos[] = [
    'ID_PRODUCTO' => $row['ID_PRODUCTO'],
    'ID_CATEGORIA' => $row['ID_CATEGORIA'],
    'NOMBRE' => $row['NOMBRE'],
    'PRECIO_COMPRA' => $row['PRECIO_COMPRA'],
    'STOCK' => $row['STOCK'],
    'STOCK_MIN' => $row['STOCK_MIN'],
    'ID_ESTATUS' => $row['ID_ESTATUS'],
    'PRECIO' => $row['PRECIO'],
    'ventrealizadas' => $query1,
    'CANTIDAD' => $query2,
   ];
}

echo json_encode($datos);











    
// $productos = "select * from productos where ID_CATEGORIA= $id";
// $Execute = $conexion->query($productos);
// $r = $Execute->fetchall();





?>