<?php
    include '../../../recursos/PHP/clases/conexion.php';
    session_start();

    $id_cotizacion = intval($_POST['id_cot']);

    
    if(isset($_SESSION["cotizacion"])){

        $nombre = $_POST['nombre'];
        $email = $_POST['email'];
        
        $agregarCotizacion = "INSERT INTO cotizacion values($id_cotizacion,CURRENT_DATE,'$nombre','$email','4')";
        $consulta =$conexion->prepare($agregarCotizacion);
        $res = $consulta->execute();
        
        $array_cotizacion = explode("|", $_SESSION["cotizacion"]);
        foreach ($array_cotizacion as $cotizacion) {
            $cotizacion = json_decode($cotizacion);
            
            $agregarDcot = "INSERT INTO detalle_cotizacion values($id_cotizacion,$cotizacion->ID_PRODUCTO,$cotizacion->CANTIDAD,$cotizacion->PRECIO_VENTA)";
            $consulta =$conexion->prepare($agregarDcot);
            $res = $consulta->execute();
        }

        unset($_SESSION['id_cotizacion']);
        unset($_SESSION['cotizacion']);
        return;
    }
    //id de cotizacion

    //MODIFICAR ESTADO DE LA COTIZACION
    $modificarCarrito = "UPDATE cotizacion SET `ID_ESTATUS` = 3 WHERE id_cotizacion = $id_cotizacion";
    $consulta =$conexion->prepare($modificarCarrito);
    $r = $consulta->execute();
?>