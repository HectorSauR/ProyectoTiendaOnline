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
  <title>Consulatar Productos</title>
  <link rel="stylesheet" href="../../recursos/cssprincipal/style.css">
  <link rel="stylesheet" href="../../recursos/librerias/jquery/plug-in/datables/datatables.css">
  <link rel="stylesheet" href="css/master.css">
</head>

<body onload="checkCookie('<?php echo $_SESSION['usuario'] ?>')">
<script type="text/javascript" src="../../Usuarios/modificarTema/js/master.js"></script>

  <?php include '../../recursos/nav/nav.php' ?>

  <section class="main">
    <div class="contenedor-consultar-productos">
      <h1>Consultar Productos</h1>
      <div class="contenedor-tabla-productos">
        <table id="table_id" class="display">
          <thead>
          <tr>
            <th>Codigo</th>
            <th>Nombre</th>
            <th>Descripcion</th>
            <th>Precio Compra</th>
            <th>Precio Venta</th>
            <th>Stock</th>

          </tr>
          </thead>
            <tbody>

            <?php

              $query = 'SELECT productos.ID_PRODUCTO, productos.NOMBRE, categoria_productos.DESCRIPCION, productos.PRECIO, productos.PRECIO_COMPRA, productos.STOCK FROM `productos` INNER JOIN `categoria_productos` ON productos.ID_CATEGORIA=categoria_productos.ID_CATEGORIA WHERE productos.ID_ESTATUS="1"';
              $statement = $conexion->prepare($query);
              $statement->execute();
              $result = $statement->fetchall();

              foreach($result as $row)
              { ?>
                <tr>
                  <td> <?php echo $row["ID_PRODUCTO"]; ?> </td>
                  <td> <?php echo $row["NOMBRE"]; ?> </td>
                  <td> <?php echo $row["DESCRIPCION"]; ?> </td>
                  <td> <?php echo $row["PRECIO"]; ?> </td>
                  <td> <?php echo $row["PRECIO_COMPRA"]; ?> </td>
                  <td> <?php echo $row["STOCK"]; ?> </td>
                </tr>
           <?php
              } 
            ?>
        </tbody>
        </table>
      </div>
    </div>
  </section>

  <script type="text/javascript" src="../../recursos/librerias/jquery/jquery-3.6.0.min.js"></script>
  <script type="text/javascript" charset="utf8" src="../../recursos/librerias/jquery/plug-in/datables/datatables.js"></script>
  <script src="js/main.js" charset="utf-8"></script>
</body>

</html>