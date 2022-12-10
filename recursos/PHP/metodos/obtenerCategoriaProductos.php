<?php
include("../clases/conexion.php");


$query = 'SELECT * FROM `categoria_productos`; ';
$Execute = $conexion->query($query);

$r = $Execute->fetchall(PDO::FETCH_ASSOC);

echo json_encode($r);
 
?>
