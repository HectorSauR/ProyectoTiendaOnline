<?php
    session_start();
    include '../../../recursos/PHP/clases/conexion.php';

    //id de producto
    $id_prod = $_POST['id_prod'];
    $cantidad = $_POST['cantidad'];

    //CONFIRMAR EXISTENCIA DEL PRODUCTO
    $confirmarStock = "SELECT STOCK FROM productos WHERE ID_PRODUCTO = $id_prod;";
    $Execute = $conexion->query($confirmarStock);
    
    $r = $Execute->fetchall(PDO::FETCH_ASSOC);
    $stock = $r[0]['STOCK'];

    if($cantidad > $stock){
        echo "<script>
        location.href='../index.php?var=1';
        </script>";
    }
    else{
        $array_cotizacion = explode("|", $_SESSION["cotizacion"]);
        $new_array = [];
        foreach ($array_cotizacion as $cotizacion) {
            $cotizacion = json_decode($cotizacion);
            if ($cotizacion->ID_PRODUCTO == $id_prod) {
                $cotizacion->CANTIDAD = $cantidad;
            }
            array_push($new_array, json_encode($cotizacion));
        }

        $_SESSION["cotizacion"] = implode("|", $new_array);

        echo "<script>
        location.href='../index.php?var=2';
        </script>";
    }
?>