<?php
 require 'conexion.php';

$nombreImagen=$_FILES['imagen']['name'];
$tipoImagen=$_FILES['imagen']['type'];
$tamImagen=$_FILES['imagen']['size'];

$carpeta=$_SERVER['DOCUMENT_ROOT'] . '/ProyectoTiendaOnline/recursos/imagenes/regCategoria/';

move_uploaded_file($_FILES['imagen']['tmp_name'],$carpeta.$nombreImagen);

 $nombre  = $_POST['user_name'];
 $Descripcion  = $_POST['user_message'];
 $rutaImagen="../../recursos/cssprincipal/style.css/".$nombreImagen;

$insertar = "INSERT INTO categoria_productos VALUES ('8','$nombre','$Descripcion','$rutaImagen')";

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