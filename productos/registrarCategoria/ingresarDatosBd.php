<?php
include '../../recursos/PHP/clases/conexion.php';

$conexion2 = new Conexion();

$conectar = $conexion2 -> getConectionMysql();

$nombreImagen=$_FILES['imagen']['name'];
$tipoImagen=$_FILES['imagen']['type'];
$tamImagen=$_FILES['imagen']['size'];   

$carpeta=$_SERVER['DOCUMENT_ROOT'] . '/ProyectoTiendaOnline/recursos/imagenes/regCategoria/';

move_uploaded_file($_FILES['imagen']['tmp_name'],$carpeta.$nombreImagen);

 $nombre  = $_POST['user_name'];
 $Descripcion  = $_POST['user_message'];
 $rutaImagen="../../recursos/imagenes/regCategoria/".$nombreImagen;

 $obtenerUltimoId= "SELECT ID_CATEGORIA from categoria_productos order by ID_CATEGORIA desc limit 1;";

 $r = mysqli_query($conectar, $obtenerUltimoId);
 $resultado = mysqli_fetch_array($r);
 $id = $resultado[0]['ID_CATEGORIA'];
 $id++;

$insertar = "INSERT INTO categoria_productos VALUES ($id,'$nombre','$Descripcion','$rutaImagen',1)";

$query = mysqli_query($conectar, $insertar);

if($query){

   echo "<script> alert('correcto');
    location.href = 'index.php';
   </script>";

}else{
    echo "<script> alert('incorrecto');
    location.href = 'index.php';
    </script>";
}
?>