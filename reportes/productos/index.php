<?php
  include '../../recursos/PHP/configuracionDelSitioWeb/conf.php';
  include '../../recursos/PHP/clases/conexion.php';
?>
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
      <h1>REPORTE DE PRODUCTOS</h1>
      <div id="prin">
        <form action="index.php" method="post" name="form1">
            
            <ul>
             <li>
               <label for="periodo">Categoria:</label>
               <select name="periodo" id="periodo">
                  <option value="1">1</option>
                  <option value="2">2</option>
                  <option value="3">3</option>
                  <option value="4">4</option>
                  <option value="5">5</option>
                  <option value="6">6</option>
                  <option value="7">7</option>
                  <option value="8">8</option>
                  <option value="9">9</option>
                  <option value="10">10</option>
               </select>
             </li>
             <li>
               <label for="msg">Estatus (1.- Activo 2.- Baja):</label>
               <select name="FP" id="FP">
                <option value="1">1</option>
                <option value="2">2</option>
               </select>
             </li>
              <li>
                <button id="btnGenerar" type="submit" name="generar">Generar Reporte</button>
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
    $categoria = $_REQUEST['periodo'];
    $estatus = $_REQUEST['FP'];
    //$BuscarUsuario = "select * from usuario where USUARIO = '$usuario' and CONTRA = '$pass'";
    $resultado = mysqli_query($conectar,"SELECT prod.ID_PRODUCTO, prod.NOMBRE, prod.PRECIO_COMPRA, prod.PRECIO, prod.STOCK,
                                                cat.DESCRIPCION
                                            FROM productos prod 
                                            INNER JOIN categoria_productos cat ON prod.ID_CATEGORIA = cat.ID_CATEGORIA
                                            WHERE prod.ID_CATEGORIA = '$categoria' AND prod.ID_ESTATUS = '$estatus'");
    
    while($consultas = mysqli_fetch_array($resultado)){
      echo 
      "
        <table width=\"100%\" border=\"1\">
          <tr>
            <td><b><center>ID PRODCUTO</center></b></td>
            <td><b><center>NOMBRE</center></b></td>
            <td><b><center>PRECIO DE COMPRA</center></b></td>
            <td><b><center>PRECIO DE VENTA</center></b></td>
            <td><b><center>STOCK</center></b></td>
            <td><b><center>CATEGORIA</center></b></td>
          </tr>
          <tr>
            <td>".$consultas['ID_PRODUCTO']."</td>
            <td>".$consultas['NOMBRE']."</td>
            <td>".$consultas['PRECIO_COMPRA']."</td>
            <td>".$consultas['PRECIO']."</td>
            <td>".$consultas['STOCK']."</td>
            <td>".$consultas['DESCRIPCION']."</td>
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
