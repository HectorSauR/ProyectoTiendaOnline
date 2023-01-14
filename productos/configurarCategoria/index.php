<?php
  include '../../recursos/PHP/configuracionDelSitioWeb/conf.php';
  include '../../recursos/PHP/clases/conexion.php';
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Configurar Categoria</title>

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
      <h1 class="tittle">CATEGORIAS PARA MOSTRAR</h1>

      <!-- DIV DE LA TABLA DE LOS PRODUCTOS -->
      <div class="table">
        <table id="table_id" class="display">
          <thead>
            <tr>
              <th>Codigo</th>
              <th>Nombre</th>
              <th>Ocultar</th>
            </tr>

          </thead>
          <tbody>
            <?php

              $query = 'SELECT ID_CATEGORIA, NOMBRE, ID_ESTATUS FROM `categoria_productos`';
              $statement = $conexion->prepare($query);
              $statement->execute();
              $result = $statement->fetchall();

              foreach($result as $row)
              { ?>
                  <tr>
                    <form class="modificarCategoria" method="POST">
                      <input type="hidden" name = "id_cat" value="<?php echo $row["ID_CATEGORIA"]; ?>">

                      <td> <?php echo $row["ID_CATEGORIA"]; ?> </td>
                      <td> <?php echo $row["NOMBRE"]; ?> </td>
                      <?php
                        if( $row['ID_ESTATUS'] == 1){?>
                          <input type="hidden" name = "estatus" value="1">
                          <td> <button class="btn_ocultar"> Ocultar Categoria </button> </td>
                      <?php
                        }
                        else{?>
                          <input type="hidden" name = "estatus" value="2">
                          <td> <button class="btn_mostrar"> Mostrar Categoria </button> </td>
                      <?php

                        }
                      ?>
                    </form>
                  </tr>

              <?php
              } 
            ?>
          </tbody>
        </table>
      </div>

    </div>

    <!-- Scripts para la tabla -->
    <script type="text/javascript" src="../../recursos/librerias/jquery/jquery-3.6.0.min.js"></script>
    <script type="text/javascript" charset="utf8" src="../../recursos/librerias/jquery/plug-in/datables/datatables.js"></script>
    <!-- SCRIPT PARA DATOS DE LA TABLA -->
    <script type="text/javascript" src="./main.js"></script>
    <script type="text/javascript" src="./js/master.js"></script>
  </body>
</html>
