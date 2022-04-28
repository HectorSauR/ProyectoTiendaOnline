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
  <body>
    <div class="main">
      <?php include "../../recursos/nav/nav.php" ?>

      <h1 class="tittle">CATEGORIAS PARA MOSTRAR</h1>

      <!-- DIV DE LA TABLA DE LOS PRODUCTOS -->
      <div class="table">
        <table id="table_id" class="display">
          <thead>
            <tr>
              <th>Codigo</th>
              <th>Descripcion</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>0000</td>
              <td>fsdfdsdsf</td>
              <td>asasaddsd</td>
            </tr>

            <tr>
              <td>fsdfdsdsf</td>
              <td>Cargador</td>
              <td>2anhos</td>
            </tr>

            <tr>
              <td>asasaddsd</td>
              <td>Cargador</td>
              <td>1anho</td>
            </tr>

            <tr>
              <td>200</td>
              <td>Corte</td>
              <td>Vigente</td>
            </tr>

            <tr>
              <td>250</td>
              <td>Corte</td>
              <td>Vigente</td>
            </tr>
            <tr>
              <td>500</td>
              <td>Corte</td>
              <td>Vigente</td>
            </tr>
            <tr>
              <td>500</td>
              <td>Corte</td>
              <td>Vigente</td>
            </tr>
            <tr>
              <td>500</td>
              <td>Corte</td>
              <td>Vigente</td>
            </tr>
            <tr>
              <td>500</td>
              <td>Corte</td>
              <td>Vigente</td>
            </tr>
            <tr>
              <td>500</td>
              <td>Corte</td>
              <td>Vigente</td>
            </tr>
            <tr>
              <td>500</td>
              <td>Corte</td>
              <td>Vigente</td>
            </tr>
            <tr>
              <td>500</td>
              <td>Corte</td>
              <td>Vigente</td>
            </tr>
          </tbody>
        </table>
      </div>

      <!-- DIV BOTONES GUERDAR / ELIMINAR -->
      <div class="TOTAL">
        <button type="button" class="btn">REGISTRAR</button>
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
