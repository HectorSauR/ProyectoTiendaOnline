<?php
    include '../../../recursos/PHP/clases/conexion.php';
    session_start();

    //id de cotizacion
    $cotizacion = 1;

    //CONFIRMAR EXISTENCIA DEL PRODUCTO
    $query = "SELECT id_producto, cantidad FROM detalle_cotizacion WHERE id_cotizacion = $cotizacion;";
    $statement = $conexion->prepare($query);
    $statement->execute();
    $result = $statement->fetchall();

    foreach($result as $row){

        $id_prod = $row["id_producto"];
        
        //CONSEGUIR EL STOCK DEL PRODUCTO
        $BuscarProd = "SELECT STOCK FROM productos WHERE id_producto = $id_prod;";
        $Execute = $conexion->query($BuscarProd);
        $r = $Execute->fetchall(PDO::FETCH_ASSOC);
        $nuevo_stock = $r[0]['STOCK'] - $row["cantidad"];

        $agregarStock = "UPDATE `productos` SET `STOCK` = '$nuevo_stock' WHERE id_producto = $id_prod;";
        $consulta =$conexion->prepare($agregarStock);
        $res = $consulta->execute(); 
    }

    $modificarCarrito = "UPDATE cotizacion SET `ID_ESTATUS` = 2 WHERE id_cotizacion = $cotizacion";
    $consulta =$conexion->prepare($modificarCarrito);
    $r = $consulta->execute();
?>