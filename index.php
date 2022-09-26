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
   <link rel="stylesheet" href="style.css">
   <title>Inicio</title>
 </head>

 <body onload="checkCookie('<?php echo $_SESSION['usuario'] ?>')">
   <?php  include './recursos/nav/nav.php' ?>

    <?php
      $BuscarUsuario = "SELECT * FROM info_empresa;";
      $Execute = $conexion->query($BuscarUsuario);
      
      $r = $Execute->fetchall(PDO::FETCH_ASSOC);
    ?>
    <div class="main">
      <div class="info">
        <img src="<?php echo $r[0]['LOGO'] ?>" alt="">
        <h2><b>Nombre:</b>  <?php echo $r[0]['NOMBRE'] ?></h2>
        <h2><b>Slogan:</b>  <?php echo $r[0]['SLOGAN'] ?></h2>
        <h2><b>Descripcion:</b>  <?php echo $r[0]['DESCRIPCION'] ?></h2>
        <h2><b>Telefono:</b>  <?php echo $r[0]['TELEFONO'] ?></h2>
        <h2><b>Correo:</b>  <?php echo $r[0]['CORREO'] ?></h2>
        <h2><b>Website:</b>  <?php echo $r[0]['WEBSITE'] ?></h2>
        <h2><b>Facebook:</b>  <?php echo $r[0]['FACEBOOK'] ?></h2>
        <h2><b>Twitter:</b>  <?php echo $r[0]['TWITER'] ?></h2>
      </div>

    </div>




   <script type="text/javascript" src="./Usuarios/modificarTema/js/master.js"></script>
 </body>

 </html>
