<?php
 require 'conexion.php';
 $nombre  = $_POST['user_name'];
 $Descripcion  = $_POST['user_message'];
 

$insertar = "INSERT INTO categoria_productos VALUES ('4','$nombre','$Descripcion','img4')";

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