<?php
  include '../../recursos/PHP/configuracionDelSitioWeb/conf.php';
  include '../../recursos/PHP/clases/conexion.php';
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="../../recursos/cssprincipal/style.css">
  <link rel="stylesheet" href="css/master.css">
  <title>Registrar usuario</title>
</head>
<body onload="checkCookie('<?php echo $_SESSION['usuario'] ?>')">
<script type="text/javascript" src="../../Usuarios/modificarTema/js/master.js"></script>
  <?php  include '../../recursos/nav/nav.php' ?>

  <div class="main">
    <h1>Registro de usuario</h1>

      <form id="formRegistroUsuario" class="contenedor-app">
      <div class="contenedor-form">

            <label>Nombre:</label>
            <input type="text" name="nombre" value="" required>
            <label>Usuario:</label>
            <input type="text" name="usuario" value="" required>
            <label>Contraseña:</label>
            <input type="password" name="clave" value="" required>
            <label>Correo:</label>
            <input type="text" name="correo" value="" >
            <label>Nivel:</label>
            <select name="nivel">
              <option>CLIENTE</option>
              <option>ADMIN</option>
              <option>VENTAS</option>
            </select>
            <button type="submit">Registrar</button>

      </div>

      <div class="contenedor-imagen">
        <h1>Imagen</h1>
        <div class="imagen">

        </div>
        <button type="button" id="activarAgreagarImagen">Examinar</button>
        <input type="file" value="" name="imagen" id="agregarImagen">
      </div>
        </form>
    </div>



  <script type="text/javascript" src="js/main.js">

  </script>
</body>
</html>
