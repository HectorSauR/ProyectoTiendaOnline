<?php
    include '../../../recursos/PHP/clases/conexion.php';
    session_start();

    //id de cotizacion
    $cotizacion = $_POST['id_cot'];

    //MODIFICAR ESTADO DE LA COTIZACION
    $modificarCarrito = "UPDATE cotizacion SET `ID_ESTATUS` = 3 WHERE id_cotizacion = $cotizacion";
    $consulta =$conexion->prepare($modificarCarrito);
    $r = $consulta->execute();
?>