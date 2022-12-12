<?php
    include("../clases/conexion.php");

    $cotizaciones = explode(",",$_POST['cotizaciones']);

    foreach($cotizaciones as $cotizacion){
        //UPDATE ESTATUS COTIZACION
        $sql = "UPDATE cotizacion SET ID_ESTATUS=2 WHERE ID_COTIZACION=$cotizacion"; 
        $stmt= $conexion->prepare($sql);
        $stmt->execute();
    }
    
