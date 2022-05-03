<?php include '../../recursos/PHP/configuracionDelSitioWeb/conf.php' ?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="../../recursos/cssprincipal/style.css">
  <link rel="stylesheet" href="css/master.css">
  <title>Document</title>
</head>
<body>
  <?php  include '../../recursos/nav/nav.php' ?>
  <div class="main">
    <h1>Gestión de usuarios</h1>
    <div class="contenedor-buscar">
      <label>Buscar:</label>
      <input type="text" name="" value="">
      <button type="button">Buscar</button>
    </div>
    <div class="contenedor-usuarios">
      <div class="header-nombre">
        <p>Nombre</p>
      </div>
      <div class="header-usuario">
        <p>Usuario</p>
      </div>

      <div class="header-contra">
        <p>Contraseña</p>
      </div>

      <div class="header-correo">
        <p>Correo</p>
      </div>

      <div class="header-nivel">
        <p>Nivel</p>
      </div>

      <div class="header-opcion">
        <p>Opcion</p>
      </div>
    </div>


  </div>

  <!--MODAL PARA EDITAR USUARIO -->

  <div class="contenedor-modal">
    <div class="modal">
      <h1>Editar Usuario</h1>
      <form id="formEditarUsuario">
        <label for="">Nombre</label>
        <input type="text" name="nombre" value="" id="nombre">
        <label for="">Usuario</label>
        <input type="text" name="usuario" value="" id="usuario">
        <label for="">Contraseña</label>
        <input type="text" name="clave" value="" id="clave">
        <label for="">Correo</label>
        <input type="text" name="correo" value="" id="correo">
        <label for="">Nivel</label>
        <select name="nivel" id="nivel">
          <option>Usuario</option>
          <option>Admin Principal</option>
        </select>
        <div class="contenedor-button">
          <button type="submit">Guardar</button>
            <button type="button" id="btnCancelarEditarUsuario">Cancelar</button>
        </div>
      </form>
    </div>
  </div>

  <script type="text/javascript" src="js/main.js"></script>
</body>
</html>
