<?php 
  include 'recursos/PHP/configuracionDelSitioWeb/conf.php';
  include 'recursos/PHP/clases/conexion.php'; 
?>

 <!DOCTYPE html>
 <html lang="es">
 <head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta http-equiv="X-UA-Compatible" content="ie=edge">
   <link rel="stylesheet" href="./recursos/cssprincipal/style.css">
   <title>Inicio</title>
 </head>

 <body onload="checkCookie('<?php echo $_SESSION['usuario'] ?>')">
   <?php  include './recursos/nav/nav.php' ?>




   <script type="text/javascript" src="./usuarios/modificarTema/js/master.js"></script>
 </body>

 </html>
