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
        <form action="/my-handling-form-page" method="post">
            
            <ul>
             <li>
               <label for="Periodo">Nombre:</label>
               <select name="periodo" id="periodo"></select>
             </li>
             <li>
               <label for="msg">Forma de pago:</label>
               <select name="FP" id="FP"></select>
             </li>
             <li>
                <label for="msg">Usuario:</label>
                <select name="usr" id="usr"></select>
              </li>
              <li>
                <button id="btnGenerar">Generar Reporte</button>
              </li>
            </ul> 
        </form>

    </div>
    <div id="export">
        <h2>Exportar como</h2>
        <a href=""><img src="archivo-pdf.png" alt=""></a>
        <a href=""><img src="archivo-excel.png" alt=""></a>
    </div>
      <div class="contenedor-tabla-productos">
        <table id="table_id" class="display">
          <thead>
          <tr>
            <th>Codigo de venta</th>
            <th>Fecha</th>
            <th>Usuario</th>
            <th>Forma de pago</th>
            <th>Importe</th>
            <th>Cantidad</th>

          </tr>
          </thead>
            <tbody>

            <tr>
              <td> 0000 </td>
              <td> 24/04/2022</td>
              <td> Admin </td>
              <td> Efectivo </td>
              <td> 250 </td>
              <td> 500 </td>
            </tr>

            <tr>
            <td> 0000 </td>
              <td> 24/04/2022</td>
              <td> Admin </td>
              <td> Efectivo </td>
              <td> 250 </td>
              <td> 500 </td>

            </tr>

            <tr>
            <td> 0000 </td>
              <td> 24/04/2022</td>
              <td> Admin </td>
              <td> Efectivo </td>
              <td> 250 </td>
              <td> 500 </td>
            </tr>

            <tr>
            <td> 0000 </td>
              <td> 24/04/2022</td>
              <td> Admin </td>
              <td> Efectivo </td>
              <td> 250 </td>
              <td> 500 </td>
            </tr>

            <tr>
            <td> 0000 </td>
              <td> 24/04/2022</td>
              <td> Admin </td>
              <td> Efectivo </td>
              <td> 250 </td>
              <td> 500 </td>
            </tr>
            <tr>
            <td> 0000 </td>
              <td> 24/04/2022</td>
              <td> Admin </td>
              <td> Efectivo </td>
              <td> 250 </td>
              <td> 500 </td>
            </tr>


        </tbody>
        </table>
      </div>
    </div>
    <div id="ventasT">
    <h2>Numero de ventas:</h2>
    <h2>Total General:</h2>
    </div>

  </section>

  <script type="text/javascript" src="../../recursos/librerias/jquery/jquery-3.6.0.min.js"></script>
  <script type="text/javascript" charset="utf8" src="../../recursos/librerias/jquery/plug-in/datables/datatables.js"></script>
  <script src="js/main.js" charset="utf-8"></script>
</body>

</html>
