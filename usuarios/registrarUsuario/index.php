<?php include '../../recursos/PHP/configuracionDelSitioWeb/conf.php' ?>
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
<body>
  <?php  include '../../recursos/nav/nav.php' ?>

  <div class="main">
    <h1>Registro de usuario</h1>
    <div class="contenedor-form">
        <form>
          <label>Nombre:</label>
          <input type="text" name="" value="">
          <label>Usuario:</label>
          <input type="text" name="" value="">
          <label>Contraseña:</label>
          <input type="text" name="" value="">
          <label>Correo:</label>
          <input type="text" name="" value="">
          <label>Nivel:</label>
          <select>
            <option>1</option>
            <option>2</option>
            <option>3</option>
          </select>
          <button type="submit">Registrar</button>
        </form>
    </div>
  </div>
</body>
</html>
