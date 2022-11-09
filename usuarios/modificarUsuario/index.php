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
  <link rel="stylesheet" href="./css/master.css">
  <title>Modificar Usuario</title>
</head>
<body onload="checkCookie('<?php echo $_SESSION['usuario'] ?>')">
<script type="text/javascript" src="../../Usuarios/modificarTema/js/master.js"></script>
  <?php  include '../../recursos/nav/nav.php' ?>
  <div class="main">
    <h1>Gestión de usuarios</h1>
    <form class="contenedor-buscar">
      <!--<label>Buscar:</label>-->
      <input type="text" name="inputNombreUsuario" id="inputNombreUsuario" value="" placeholder="Nombre"  required>
      <button type="submit">Buscar</button>
    </form>

    <div class="contenedor-tabla-usuarios">
      
    </div>



  </div>

  <!--MODAL PARA EDITAR USUARIO -->

  <div class="contenedor-modal">
    <div class="modal">
      <h1>Editar Usuario</h1>
      <form id="formEditarUsuario">
        <label for="">Nombre</label>
        <input type="text" name="nombre" value="" id="nombre" pattern="(-?([A-Z].\s)?([A-Z][a-z]+)\s?)+([A-Z]'([A-Z][a-z]+))?" required>
        <label for="">Usuario</label>
        <input type="text" name="usuario" value="" id="usuario" pattern="^(?!.*\.\.)(?!.*\.$)[^\W][\w.]{3,20}$" required>
        <label for="">Imagen</label>
        <input type="text" name="imagen" value="" id="imagen" class="ruta-imagen-form" pattern="([0-9a-zA-Z\/])+([0-9a-zA-Z\._-]+.(png|PNG|jp[e]?g|JP[E]?G))" required>
        <input type="file" name="img_env" id="img_env" accept="image/png,image/jpg,image/jpeg">
        <!-- input coontraseña eliminada por que ningun ADMIN debe poder ver 
        o modificar la cobtra de ningun otro usuario
        <label for="">Contraseña</label>
        <input type="text" name="clave" value="" id="clave">-->
        <label for="">Correo</label>
        <input type="text" name="correo" value="" id="correo" pattern="[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?" required>
        <label for="">Nivel</label>
        <select name="nivel" id="nivel">
          <option>Cliente</option>
          <option>Admin</option>
          <option>Ventas</option>

        </select>
        <div class="contenedor-button">
          <button type="submit">Guardar</button>
            <button type="button" id="btnCancelarEditarUsuario">Cancelar</button>
        </div>
      </form>

      <div class="container-alert" id="alert">
        <div class="alert">
          <p>Error</p>
        </div>
      </div>
    </div>
  </div>

  <script type="text/javascript" src="js/main.js"></script>
</body>
</html>
