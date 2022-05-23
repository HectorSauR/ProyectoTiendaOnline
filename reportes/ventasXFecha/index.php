<?php ob_start();?>
<?php  include '../../recursos/PHP/configuracionDelSitioWeb/conf.php' ?>
<?php include '../../recursos/PHP/metodos/verificarSesionUsuario.php' ?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Consulatar Productos</title>
  <link rel="stylesheet" href="../../recursos/cssprincipal/style.css">
  <link rel="stylesheet" href="../../recursos/librerias/jquery/plug-in/datables/datatables.css">
  <link rel="stylesheet" href="css/master.css">
  <link rel="stylesheet" href="style.css">
</head>

<body>

  <?php include '../../recursos/nav/nav.php' ?>

  <section class="main">
    <div class="contenedor-consultar-productos">
      <h1>REPORTE DE VENTAS POR PERIODO DE TIEMPO</h1>
      <div id="prin">
        <form action="index.php" method="post" name="form1">
            
            <ul>
             <li>
               <label for="Periodo">Fecha:</label>
               <input id="party" type="date" name="fecha">
             </li>
             <li>
               <label for="msg">Forma de pago (1.- Efectivo, 2.- Tarjeta):</label>
               <select id="FP" name="frmPago">
                  <option value="1">1</option>
                  <option value="2" selected>2</option>
               </select>
             </li>
             <li>
                <label for="msg">Usuario:</label>
                <input type="text" value="Nombre" id="usr" name="nameUsr">
              </li>

              <li>
                <button id="btnGenerar" name="generar" type="input">Generar Reporte</button>
              </li>
            </ul> 
       

    </div>
    <div id="export">
        <h2>Exportar como</h2>
        <button type="submit" name="reportePdf" onclick= "document.form1.action = 'reportePDF.php'; document.form1.submit()"> <img src="archivo-pdf.png" height ="80" width="100" /></button>
        <button type="submit" name="reporteExcel" onclick= "document.form1.action = 'reporteExcel.php'; document.form1.submit()"> <img src="archivo-excel.png" height ="80" width="100" /></button>
    </div>
    </form>
  
  <?php
  if (isset($_POST['generar'])) {
    require 'conexion.php';
    $frmPago = $_REQUEST['frmPago'];
    $usr = $_POST['nameUsr'];
    $fecha = $_REQUEST['fecha'];
    //$BuscarUsuario = "select * from usuario where USUARIO = '$usuario' and CONTRA = '$pass'";
    $resultado = mysqli_query($conectar,"SELECT venta.FECHA, venta.ID_VENTA, venta.ID_FORMA_PAGO, venta.ID_USUARIO,
                                                detallesVenta.PRECIO,
                                                usuario.USUARIO,
                                                forma_pago.DESCRIPCION
                                            FROM venta venta 
                                            INNER JOIN detalle_venta detallesVenta ON venta.ID_VENTA = detallesVenta.ID_VENTA
                                            INNER JOIN usuario usuario ON venta.ID_USUARIO = usuario.ID_USUARIO
                                            INNER JOIN forma_pago forma_pago ON venta.ID_FORMA_PAGO = forma_pago.ID_FORMA_PAGO
                                            WHERE venta.FECHA = '$fecha' AND venta.ID_FORMA_PAGO = '$frmPago'");
    
    while($consultas = mysqli_fetch_array($resultado)){
      echo 
      "
        <table width=\"100%\" border=\"1\">
          <tr>
            <td><b><center>ID Venta</center></b></td>
            <td><b><center>Fecha</center></b></td>
            <td><b><center>Usuario</center></b></td>
            <td><b><center>Forma de pago</center></b></td>
            <td><b><center>Importe</center></b></td>
          </tr>
          <tr>
            <td>".$consultas['ID_VENTA']."</td>
            <td>".$consultas['FECHA']."</td>
            <td>".$consultas['USUARIO']."</td>
            <td>".$consultas['DESCRIPCION']."</td>
            <td>".$consultas['PRECIO']."</td>
          </tr>
        </table>
      ";

    }
  }
  ?>



  </section>

 

  <script type="text/javascript" src="../../recursos/librerias/jquery/jquery-3.6.0.min.js"></script>
  <script type="text/javascript" charset="utf8" src="../../recursos/librerias/jquery/plug-in/datables/datatables.js"></script>
  <script src="js/main.js" charset="utf-8"></script>
</body>

</html>
<?php ob_end_flush(); ?>