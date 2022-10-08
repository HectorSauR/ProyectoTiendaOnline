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
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
  <title>Inicio</title>
</head>

<body onload="checkCookie('<?php echo $_SESSION['usuario'] ?>')">
  <?php include './recursos/nav/nav.php' ?>

  <?php
  $BuscarUsuario = "SELECT * FROM info_empresa;";
  $Execute = $conexion->query($BuscarUsuario);

  $r = $Execute->fetchall(PDO::FETCH_ASSOC);
  ?>
  <div class="main">
    <div class="info">
      <!-- <h2>Datos generales</h2>
      <div class="contenedor-texto">
        <p><b>Nombre:</b> <?php echo $r[0]['NOMBRE'] ?></p>
        <p><b>Slogan:</b> <?php echo $r[0]['SLOGAN'] ?></p>
      </div> -->
      <div class="contenedor-img">
        <img src="<?php echo $r[0]['LOGO'] ?>" alt="">
      </div>
      <div class="datos-contacto-empresa">
        <div class="descripcion">
          <h2> <?php echo $r[0]['NOMBRE'] ?></h2>
          <p> <?php echo $r[0]['DESCRIPCION'] ?></p>
        </div>
        <div class="services">
          <h2>Servicios</h2>
          <p><b>Telefono:</b> <?php echo $r[0]['TELEFONO'] ?></p>
          <p><b>Correo:</b> <?php echo $r[0]['CORREO'] ?></p>
        </div>
        <div class="redes-sociales">
          <h2>Redes Sociales</h2>
          <a href="<?php echo $r[0]['FACEBOOK'] ?>"><i class='bx bxl-facebook-circle'></i></a>
          <a href="<?php echo $r[0]['TWITER'] ?>"><i class='bx bxl-twitter'></i></a>
          <!-- <p><b>Website:</b> <?php echo $r[0]['WEBSITE'] ?></p> -->
        </div>
      </div>
    </div>

  </div>

   <script type="text/javascript" src="./usuarios/modificarTema/js/master.js"></script>
 </body>


</html>