<?php
  include '../../recursos/PHP/configuracionDelSitioWeb/conf.php';
  include '../../recursos/PHP/clases/conexion.php';
?>
<?php include '../../recursos/PHP/metodos/verificarSesionUsuario.php' ?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>

    <link rel="stylesheet" href="./index.css" />
    <link rel="stylesheet" href="../../recursos/cssprincipal/style.css" />
    <link
      rel="stylesheet"
      href="../../recursos/librerias/jquery/plug-in/datables/datatables.css"
    />
  </head>
  <body onload="checkCookie('<?php echo $_SESSION['usuario'] ?>')">
<script type="text/javascript" src="../../Usuarios/modificarTema/js/master.js"></script>

  <?php include "../../recursos/nav/nav.php" ?>

    <div class="main">
      <h1 class="tittle">CONSULTA DE VENTA</h1>

      <!-- DIV PARA INGRESAR EL ID_VENTA -->
      <div class="info" id="main">
        <div class="input_venta">
          <div class="input" id="id_venta">
            <p id="p_nom">Venta:</p>
            <input type="text" class="client_info" id="venta" placeholder="ID" />
            <button type="button" name="button" class="btn-buscar-venta">Buscar</button>
          </div>
        </div>
        <!-- DIS PARA INGRESAR LOS DATOS DEL CLIENTE -->
        <div style="display:none;">
          <p id="first">Datos del cliente:</p>
          <div class="client">
            <div class="input" id="first">
              <p id="p_nom">Nombre:</p>
              <input type="text" class="client_info" />
            </div>
            <div class="input">
              <p id="p_mail">Correo:</p>
              <input type="text" class="client_info" />
            </div>
          </div>
        </div>
      </div>
      <!-- DIV DE LA TABLA DE LOS PRODUCTOS -->
      <div class="table">
        <table id="table_id" class="display">
          <thead>
            <tr>
              <th>Codigo</th>
              <th>Fecha</th>
              <th>Usuario</th>
              <th>Forma de pago</th>
              <th>Importe</th>
            </tr>
          </thead>
          <tbody class="row-table">
            <tr>
              <td>0000</td>
              <td>fsdfdsdsf</td>
              <td>200</td>
              <td>250</td>
              <td>500</td>
            </tr>
          </tbody>
        </table>
      </div>

      <!-- DIV BOTONES GUERDAR / ELIMINAR -->
      <div class="buttons" style="display:none;">
        <input type="button" value="GUARDAR" class="btn" />
        <button type="button" class="btn">ELIMINAR</button>
      </div>
    </div>

    <!-- Scripts para la tabla -->
    <script
      type="text/javascript"
      src="../../recursos/librerias/jquery/jquery-3.6.0.min.js"
    ></script>

    <script
      type="text/javascript"
      charset="utf8"
      src="../../recursos/librerias/jquery/plug-in/datables/datatables.js"
    ></script>

    <!-- SCRIPT PARA DATOS DE LA TABLA -->
    <script type="text/javascript" src="./main.js"></script>
  </body>
</html>
