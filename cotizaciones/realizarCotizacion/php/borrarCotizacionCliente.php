<?php
include '../../../recursos/PHP/clases/conexion.php';
session_start();
function write_to_console($data)
{
    $console = 'console.log(' . json_encode($data) . ');';
    $console = sprintf('<script>%s</script>', $console);
    echo $console;
}
//id de producto
$id_prod = $_POST['id_prod'];

//BORRAMOS UN CARRITO
$array_cotizacion = explode("|", $_SESSION["cotizacion"]);
$new_array = [];
if (count($array_cotizacion) > 1) {
    foreach ($array_cotizacion as $cotizacion) {
        $cotizacion = json_decode($cotizacion);
        if ($cotizacion->ID_PRODUCTO == $id_prod) {
            continue;
        }
        array_push($new_array, json_encode($cotizacion));
    }
    
    $_SESSION["cotizacion"] = implode("|", $new_array);
}else{
    unset($_SESSION["cotizacion"]);
    unset($_SESSION["id_cotizacion"]);
}

echo "<script>
    location.href='../index.php?var=3';
    </script>";
