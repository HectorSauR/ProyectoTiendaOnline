<?php ob_start(); ?>
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
  <title>Ventas por fecha</title>
  <link rel="stylesheet" href="../../recursos/cssprincipal/style.css">
  <link rel="stylesheet" href="../../recursos/librerias/jquery/plug-in/datables/datatables.css">
  <link rel="stylesheet" href="css/master.css">
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="../../iconos/font-awesome-4.7.0/css/font-awesome.min.css">
</head>

<body onload="checkCookie('<?php echo $_SESSION['usuario'] ?>')">
  <script type="text/javascript" src="../../Usuarios/modificarTema/js/master.js"></script>

  <?php include '../../recursos/nav/nav.php' ?>

  <section class="main">
    <div class="contenedor-consultar-productos">
      <h1>REPORTE DE VENTAS POR PERIODO DE TIEMPO</h1>
      <div class="contenedor-form">
        <div id="prin">
          <form action="index.php" method="post" name="form1">
            <div class="contenedor-inputs">
              <label for="Periodo">Fecha:</label>
              <input id="party" type="date" name="fecha">
              <label for="msg">Forma de pago (1.- Efectivo, 2.- Tarjeta):</label>
              <select id="FP" name="frmPago">
                <?php
                foreach ($datos as $dat) {
                  echo '<option value="' . $dat['ID_FORMA_PAGO'] . '">' . $dat['DESCRIPCION'] . '</option>';
                } //end foreach
                ?>
              </select>
              <label for="msg">Usuario:</label>
              <select name="usr1" id="usr">
                <?php
                foreach ($datos1 as $dat) {
                  echo '<option value="' . $dat['ID_USUARIO'] . '">' . $dat['USUARIO'] . '</option>';
                } //end foreach
                ?>
              </select>
              <button id="btnGenerar" name="generar" type="input">Generar Reporte</button>
            </div>
        </div>
        <div id="export" class="contenedor-exports">
          <h2>Exportar como</h2>
          <div class="contenedor-iconos">
            <a target="_blank" name="reportePdf" onclick= "document.form1.action = 'reportePDF.php'; document.form1.submit()">
              <i class="fa fa-file-pdf-o" aria-hidden="true"></i>
            </a>
            <a target="_blank" name="reporteExcel" onclick= "document.form1.action = 'reporteExcel.php'; document.form1.submit()">
              <i class="fa fa-file-excel-o" aria-hidden="true"></i>
            </a>
          </div>
        </div>
      </div>
      <table width="100%" border="1">
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
        if (isset($_POST['generar'])) {?>
          
          <script>
                    
                    document.querySelector('#party').value = "<?php echo $_POST['fecha']?>"
                    document.querySelector('#FP').value = "<?php echo $_POST['frmPago']?>"
                    document.querySelector('#usr').value = "<?php echo $_POST['usr1']?>"
                    
        
          </script>
          <?php

          $conexion2 = new Conexion();
          $conexion2 = $conexion2->getConectionMysql();

          $frmPago = $_REQUEST['frmPago'];
          $usr = $_REQUEST['usr1'];
          $fecha = $_REQUEST['fecha'];
          //$BuscarUsuario = "select * from usuario where USUARIO = '$usuario' and CONTRA = '$pass'";
          $resultado = mysqli_query($conexion2, "SELECT venta.FECHA, venta.ID_VENTA, venta.ID_FORMA_PAGO, venta.ID_USUARIO,
                                                detallesVenta.PRECIO,
                                                usuario.USUARIO,
                                                forma_pago.DESCRIPCION
                                            FROM venta venta 
                                            INNER JOIN detalle_venta detallesVenta ON venta.ID_VENTA = detallesVenta.ID_VENTA
                                            INNER JOIN usuario usuario ON venta.ID_USUARIO = usuario.ID_USUARIO
                                            INNER JOIN forma_pago forma_pago ON venta.ID_FORMA_PAGO = forma_pago.ID_FORMA_PAGO
                                            WHERE venta.FECHA = '$fecha' AND venta.ID_FORMA_PAGO = '$frmPago' AND venta.ID_USUARIO='$usr'");

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



  <script type="text/javascript" src="../../recursos/librerias/jquery/jquery-3.6.0.min.js"></script>
  <script type="text/javascript" charset="utf8" src="../../recursos/librerias/jquery/plug-in/datables/datatables.js"></script>
  <script src="js/main.js" charset="utf-8"></script>
</body>

</html>
<?php ob_end_flush(); ?>