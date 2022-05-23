<?php
    include '../../../recursos/PHP/clases/conexion.php';
    session_start();

    //id de cotizacion
    $cotizacion = 1;

    //MODIFICAR ESTADO DE LA COTIZACION
    $modificarCarrito = "UPDATE cotizacion SET `ID_ESTATUS` = 2 WHERE id_cotizacion = $cotizacion";
    $consulta =$conexion->prepare($modificarCarrito);
    $r = $consulta->execute();
?>