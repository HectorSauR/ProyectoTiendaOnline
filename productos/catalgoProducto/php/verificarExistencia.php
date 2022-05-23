<?php
    include '../../../recursos/PHP/clases/conexion.php';

    //id de producto
    $id_prod = $_POST['id'];
    $cantidad = $_POST['cantidad'];

    $BuscarUsuario = "SELECT STOCK FROM productos WHERE id_producto = $id_prod  ;";
    $Execute = $conexion->query($BuscarUsuario);
    
    $r = $Execute->fetchall(PDO::FETCH_ASSOC);
    echo $r[0]['STOCK'];
?>