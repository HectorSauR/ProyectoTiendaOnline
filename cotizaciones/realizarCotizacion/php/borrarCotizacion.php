<?php
    include '../../../recursos/PHP/clases/conexion.php';
    session_start();

    //id de producto
    $id_prod = $_POST['id_prod'];
    $cotizacion = $_POST['id_cot'];

    //BORRAMOS UN CARRITO
    $modificarCarrito = "DELETE FROM `detalle_cotizacion` WHERE `detalle_cotizacion`.`ID_PRODUCTO` = $id_prod AND `detalle_cotizacion`.`ID_COTIZACION` = $cotizacion;";
    $consulta =$conexion->prepare($modificarCarrito);
    $r = $consulta->execute();

    echo "<script>
    location.href='../index.php?var=3';
    </script>";
?>