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

  <!--LIB ICON FONT AWESOME -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
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
            <input type="text" name="nombre" value="" placeholder="Ingrese nombre completo" required>
            <label>Usuario:</label>
            <input type="text" name="usuario" value="" placeholder="Ingrese nombre de usuario" required>
            <label>Contraseña:</label>
            <div class="contenedor-clave">
            <input type="password" name="clave" id="clave" value="" placeholder="Ingrese contraseña" required>
            <i class="fa-solid fa-eye icon-ojo"></i>
            </div>
            <label>Correo:</label>
            <input type="text" name="correo" placeholder="Ingrese correo" value="" >
            <label>Nivel:</label>
            <select name="nivel">
              <option>Cliente</option>
              <option>Admin</option>
              <option>Ventas</option>
            </select>
            <button type="submit">Registrar</button>

      </div>

      <div class="contenedor-imagen">
        <h1>Imagen</h1>
        <div class="imagen">

        </div>
        <button type="button" id="activarAgreagarImagen">Examinar</button>
        <input type="file" name="imagen" id="agregarImagen" accept="image/x-png,image/jpg,image/jpeg"  required>
      </div>

      
        </form>
    </div>



  <script type="text/javascript" src="js/main.js">

  </script>
</body>
</html>
