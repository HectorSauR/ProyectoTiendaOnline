<?php
    include '../../../recursos/PHP/clases/conexion.php';
    session_start();

    //id de producto
    $id_prod = $_POST['id_prod'];
    $cantidad = $_POST['cantidad'];
    $cotizacion = $_POST['id_cot'];

    //CONFIRMAR EXISTENCIA DEL PRODUCTO
    $confirmarStock = "SELECT STOCK FROM PRODUCTOS WHERE id_producto = $id_prod;";
    $Execute = $conexion->query($confirmarStock );
    
    $r = $Execute->fetchall(PDO::FETCH_ASSOC);
    $stock = $r[0]['STOCK'];

    if($cantidad > $stock){
        echo "<script>
        location.href='../index.php?var=1';
        </script>";
    }
    else{
        $modificarCarrito = "UPDATE detalle_cotizacion SET `CANTIDAD` = $cantidad WHERE id_producto = $id_prod and id_cotizacion = $cotizacion";
        $consulta =$conexion->prepare($modificarCarrito);
        $r = $consulta->execute();

        echo "<script>
        location.href='../index.php?var=2';
        </script>";
    }
?>