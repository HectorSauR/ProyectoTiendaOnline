<?php

include '../../../recursos/PHP/clases/conexion.php';
    class Cotizacion {
        public $ID_PRODUCTO;
        public $CANTIDAD;
        public $PRECIO_VENTA;
        public $NOMBRE;
    }

    session_start();

    //id de producto
    $id_prod = $_POST['id'];
    $precio = $_POST['precio'];
    $usuario = $_SESSION['usuario'];

    
    if($_SESSION['userAdmin'] == "0"){
        
        if(!isset($_SESSION['id_cotizacion'])){
            $obtenerUltimoId= "SELECT ID_COTIZACION from cotizacion order by ID_COTIZACION desc limit 1;";
            $Execute = $conexion->query($obtenerUltimoId);
    
            $r = $Execute->fetchall(PDO::FETCH_ASSOC);
            $id = $r[0]['ID_COTIZACION'];
            $id++;
            $_SESSION['id_cotizacion'] = $id;
        }

        $array_cotizacion = [];
        $query = "SELECT * FROM `productos` WHERE `ID_PRODUCTO` = $id_prod;";
        $Execute = $conexion->query($query);

        $producto = $Execute->fetchall(PDO::FETCH_ASSOC);
        $producto = $producto[0];
        
        if($_SESSION["cotizacion"]) $array_cotizacion = explode("|", $_SESSION["cotizacion"]);
        
        foreach($array_cotizacion as $cotizacion){
            $cotizacion = json_decode($cotizacion);
            if($cotizacion->ID_PRODUCTO == $id_prod) return;
        }

        $cotizacion = new Cotizacion();
        $cotizacion->ID_PRODUCTO = $id_prod;
        $cotizacion->CANTIDAD = 1;
        $cotizacion->PRECIO_VENTA = $producto['PRECIO'];
        $cotizacion->NOMBRE = $producto['NOMBRE'];

        array_push($array_cotizacion, json_encode($cotizacion));

        if(!(count($array_cotizacion) > 1)){
            $_SESSION["cotizacion"] = $array_cotizacion[0];
            return;
        }
        $_SESSION["cotizacion"] = implode("|", $array_cotizacion);
        return;
    }

    //OBTENER DATOS DEL USUARIO
    $BuscarUsuario = "select * from usuario where USUARIO = '$usuario'";
    $Execute = $conexion->query($BuscarUsuario);
    $r = $Execute->fetchall(PDO::FETCH_ASSOC);
    
    $nombre = $r[0]['NOMBRE'];
    $correo = $r[0]['CORREO'];

    //VERIFICAMOS SI TIENE UNA COTIZACION
    $BuscarUsuario = "SELECT ID_COTIZACION FROM `cotizacion` WHERE NOMBR_CLIENTE = '$nombre' and ID_ESTATUS = 4;";
    $Execute = $conexion->query($BuscarUsuario);
    
    $r = $Execute->fetchall(PDO::FETCH_ASSOC);

    if(count($r) >= 1){
        $id = $r[0]['ID_COTIZACION'];
        
        //VERIFICAMOS SI EL USUARIO TIENE EL PRODUCTO AGREGADO
        $BuscarUsuario = "SELECT CANTIDAD FROM `detalle_cotizacion` WHERE ID_PRODUCTO = $id_prod and ID_COTIZACION = $id;";
        $Execute = $conexion->query($BuscarUsuario);
        $r = $Execute->fetchall(PDO::FETCH_ASSOC);

        if(count($r) == 1){
            //AUMENTAR LA CANTIDAD DEL CARRITO
            $cantidad = $r[0]['CANTIDAD'] + 1;

            $modificarCotizacion = "UPDATE  detalle_cotizacion SET `CANTIDAD` = '$cantidad' WHERE `ID_COTIZACION` = $id and ID_PRODUCTO = $id_prod";
            $consulta =$conexion->prepare($modificarCotizacion);
            $res = $consulta->execute();
        }
        else{
            //AGREGAR PRODUCTO A LA COTIZACION
            $agregarDcot = "INSERT INTO detalle_cotizacion values($id,$id_prod,1,$precio)";
            $consulta =$conexion->prepare($agregarDcot);
            $res = $consulta->execute();
        }
    }
    else{
        //AGREGAR LA COTIZACION
        $obtenerUltimoId= "SELECT ID_COTIZACION from cotizacion order by ID_COTIZACION desc limit 1;";
        $Execute = $conexion->query($obtenerUltimoId);

        $r = $Execute->fetchall(PDO::FETCH_ASSOC);
        $id = $r[0]['ID_COTIZACION'];
        $id++;

        $agregarCotizacion = "INSERT INTO cotizacion values($id,CURRENT_DATE,'$nombre','$correo','4')";
        $consulta =$conexion->prepare($agregarCotizacion);
        $res = $consulta->execute();

            //AGREGAR PRODUCTO A LA COTIZACION
            $agregarDcot = "INSERT INTO detalle_cotizacion values($id,$id_prod,1,$precio)";
            $consulta =$conexion->prepare($agregarDcot);
            $res = $consulta->execute();
    }

?>