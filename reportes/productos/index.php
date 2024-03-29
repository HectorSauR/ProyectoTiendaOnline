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
  <title>Reporte Productos</title>
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
    <h1>REPORTE DE PRODUCTOS</h1>
    <div class="contenedor-form">
      <div id="prin">
        <form action="index.php" method="post" name="form1">
          <div class="contenedor-inputs">
            <label for="periodo">Categoria:</label>
            <select name="periodo" id="periodo" value="<?php if (isset($_POST['generar'])) {
                                                          echo $_POST['periodo'];
                                                        } ?>">
              <?php
              foreach ($datos as $dat) {
                echo '<option value="' . $dat['ID_CATEGORIA'] . '">' . $dat['NOMBRE'] . '</option>';
              }
              ?>
            </select>
            <label for="msg">Estatus</label>
            <select name="FP" id="FP">
              <?php
              foreach ($datos1 as $dat) {
                echo '<option value="' . $dat['ID_ESTATUS'] . '">' . $dat['DESCRIPCION'] . '</option>';
              }
              ?>
            </select>
            <button id="btnGenerar" type="submit" name="generar">Generar Reporte</button>
          </div>
      </div>
      <div id="export" class="contenedor-exports">
        <h2>Exportar como</h2>
        <div class="contenedor-iconos">
          <a  target="_blank" name="reportePdf" onclick="document.form1.action = './reportePDF.php';
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
    <table width="100%" border="1">
      <tr>
        <td><b>
            <center>ID PRODCUTO</center>
          </b></td>
        <td><b>
            <center>NOMBRE</center>
          </b></td>
        <td><b>
            <center>PRECIO DE COMPRA</center>
          </b></td>
        <td><b>
            <center>PRECIO DE VENTA</center>
          </b></td>
        <td><b>
            <center>STOCK</center>
          </b></td>
        <td><b>
            <center>CATEGORIA</center>
          </b></td>
      </tr>
      </form>

      <?php
      if (isset($_POST['generar'])) { ?>
        <script>
          document.querySelector('#periodo').value = "<?php echo $_POST['periodo'] ?>"
          document.querySelector('#FP').value = "<?php echo $_POST['FP'] ?>"
        </script>
        <?php

        // require '../../recursos/PHP/clases/conexion.php'
        $conexion2  = new Conexion();
        $conectar = $conexion2->getConectionMysql();
        $categoria = $_REQUEST['periodo'];
        $estatus = $_REQUEST['FP'];
        //$BuscarUsuario = "select * from usuario where USUARIO = '$usuario' and CONTRA = '$pass'";
        $resultado = mysqli_query($conectar, "SELECT prod.ID_PRODUCTO, prod.NOMBRE, prod.PRECIO_COMPRA, prod.PRECIO, prod.STOCK,
                                                cat.DESCRIPCION
                                            FROM productos prod 
                                            INNER JOIN categoria_productos cat ON prod.ID_CATEGORIA = cat.ID_CATEGORIA
                                            WHERE prod.ID_CATEGORIA = '$categoria' AND prod.ID_ESTATUS = '$estatus'");

        while ($consultas = mysqli_fetch_array($resultado)) {
          echo
          "
          <tr>
            <td>" . $consultas['ID_PRODUCTO'] . "</td>
            <td>" . $consultas['NOMBRE'] . "</td>
            <td>" . $consultas['PRECIO_COMPRA'] . "</td>
            <td>" . $consultas['PRECIO'] . "</td>
            <td>" . $consultas['STOCK'] . "</td>
            <td>" . $consultas['DESCRIPCION'] . "</td>
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
  <script src="js/main.js" charset="utf-8"></script>
</body>

</html>