<?php
include '../../recursos/PHP/configuracionDelSitioWeb/conf.php';
?>
<?php include '../../recursos/PHP/metodos/verificarSesionUsuario.php' ?>
<?php require 'pmv.php' ?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Ventas por tiempo</title>
  <link rel="stylesheet" href="../../recursos/cssprincipal/style.css">
  <link rel="stylesheet" href="../../recursos/librerias/jquery/plug-in/datables/datatables.css">
  <link rel="stylesheet" href="./css/master.css">
  <link rel="stylesheet" href="./style.css">
  <link rel="stylesheet" href="../../iconos/font-awesome-4.7.0/css/font-awesome.min.css">
</head>

<body onload="">
  <script type="text/javascript" src="../../usuarios/modificarTema/js/master.js"></script>

  <?php include '../../recursos/nav/nav.php' ?>

  <section class="main">
    <div class="contenedor-consultar-productos">
      <h1>REPORTE DE VENTAS POR PERIODO DE TIEMPO</h1>
      <div class="contenedor-interaccion">
        <div id="prin" class="contenedor-inputs">
          <form action="index.php" method="post" name="form1">
            <label for="periodo">Mes:</label>
            <select name="periodo" id="periodo">
              <option value="1">01</option>
              <option value="2">02</option>
              <option value="3">03</option>
              <option value="4">04</option>
              <option value="5">05</option>
              <option value="6">06</option>
              <option value="7">07</option>
              <option value="8">08</option>
              <option value="9">09</option>
              <option value="10">10</option>
              <option value="11">11</option>
              <option value="12">12</option>
            </select>
            <label for="msg">Forma de pago:</label>
            <select name="FP" id="FP">
              <?php
              foreach ($datos as $dat) {
                echo '<option value="' . $dat['ID_FORMA_PAGO'] . '">' . $dat['DESCRIPCION'] . '</option>';
              } //end foreach
              ?>
            </select>
            <label for="msg">Usuario:</label>
            <select name="usr" id="usr">
              <?php
              foreach ($datos1 as $dat) {
                echo '<option value="' . $dat['ID_USUARIO'] . '">' . $dat['USUARIO'] . '</option>';
              } //end foreach
              ?>
            </select>
            <button id="btnGenerar" type="submit" name="generar">Generar Reporte</button>
        </div>
        <div id="export" class="contenedor-exports">
          <h2>Exportar como</h2>
          <div class="contenedor-iconos">
            <a type="button" href="#" target="_blank" name="reportePdf" onclick="document.form1.action = './reportePDF.php';
              document.form1.submit()">
              <i class="fa fa-file-pdf-o" aria-hidden="true"></i>
            </a>
            <a target="_blank" name="reporteExcel" onclick="document.form1.action = './reporteExcel.php';
              document.form1.submit()">
              <i class="fa fa-file-excel-o" aria-hidden="true"></i>

            </a>
          </div>
        </div>
      </div>
      <table border="1">
        <tr>
          <td><b>
              <center>ID Venta</center>
            </b></td>
          <td><b>
              <center>Fecha</center>
            </b></td>
          <td><b>
              <center>Usuario</center>
            </b></td>
          <td><b>
              <center>Forma de pago</center>
            </b></td>
          <td><b>
              <center>Importe</center>
            </b></td>
        </tr>
        </form>
        <?php
        if (isset($_POST['generar'])) {

          $conexion2 = new Conexion();
          $conexion2 = $conexion2->getConectionMysql();

          $mes = $_REQUEST['periodo'];
          $formaPago = $_REQUEST['FP'];
          $usr = $_REQUEST['usr'];

          $resultado = mysqli_query(
            $conexion2,
            "SELECT * FROM reporte_por_tiempo
            WHERE MONTH(FECHA)='$mes' 
            AND ID_FORMA_PAGO = '$formaPago'
            AND ID_USUARIO = '$usr'"
          );

          while ($consultas = mysqli_fetch_array($resultado)) {
            echo
            "

          <tr>
            <td>" . $consultas['ID_VENTA'] . "</td>
            <td>" . $consultas['FECHA'] . "</td>
            <td>" . $consultas['USUARIO'] . "</td>
            <td>" . $consultas['DESCRIPCION'] . "</td>
            <td>" . $consultas['PRECIO'] . "</td>
          </tr>
      ";
          }
        ?>
      </table>
    <?php
        }
    ?>
  </section>
  <script src="https://kit.fontawesome.com/167cc065d2.js" crossorigin="anonymous"></script>
  <script type="text/javascript" src="../../recursos/librerias/jquery/jquery-3.6.0.min.js"></script>
  <script type="text/javascript" charset="utf8" src="../../recursos/librerias/jquery/plug-in/datables/datatables.js"></script>
  <script src="./js/main.js" charset="utf-8"></script>
</body>

</html>