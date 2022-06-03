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
  <link rel="stylesheet" href="../../recursos/cssprincipal/style.css">
  <link rel="stylesheet" href="css/master.css">
  <title>Venta</title>
</head>
<body onload="checkCookie('<?php echo $_SESSION['usuario'] ?>')">
<script type="text/javascript" src="../../usuarios/modificarTema/js/master.js"></script>
    <?php  include '../../recursos/nav/nav.php' ?>

    <section class="main">
      <div class="contenedor-titulo">
        <h1>Venta</h1>
      </div>

      <div class="contenedor-info-venta">
        <div class="contenedor-buscar-cotizacion">
          <label>Cotizacion:</label>
          <input type="text" name="" value="" id="txtIdCotizacion" placeholder="ID">
          <button type="button" id="btnBuscarCotizacion" name="button">Buscar</button>
        </div>
        <div class="contenedor-datos-cliente">
          <label for="">Datos del cliente:</label>
          <div class="datos-cliente">
            <label>Nombre:</label>
            <input type="text" name="" value="" id="txtNombre">
            <label>Correo:</label>
            <input type="text" name="" value="" id="txtCorreo">
          </div>
        </div>
      </div>

      <div class="contenedor-datos-producto">
        <label>ID Cotizacion:</label>
        <div class="contenedor-tabla-productos">
          <div class="cabecera-tabla">
            <div>
              <p>Codigo</p>
            </div>
            <div>
              <p>Nombre</p>
            </div>
            <div>
              <p>Cantidad</p>
            </div>
            <div>
              <p>Precio</p>
            </div>
            <div>
              <p>Importe</p>
            </div>
          </div>



           <!-- LOGICA PARA AGREGAR FILAS DE PRODUCTOS A LA TABLA-->




        </div>

        <div class="contenedor-finalizar-venta">
          <div class="contenedor-tipo-pago">
            <div class="tipo-pago">
              <label>Tipo de pago:</label> <br>
              <input type="radio" id="Efectivo" name="fav_language" value="Efectivo" checked>
              <label for="Efectivo">Efectivo</label><br>
              <input type="radio" id="Transferencia" name="fav_language" value="Transferencia">
              <label for="Transferencia">Transferencia</label><br>
            </div>

          </div>

          <div class="finalizar-venta">
            <p id="total">Total</p>
            <button type="button" name="button" id="btnFinalizarVenta">Finalizar venta</button>
          </div>
        </div>
      </div>


    </section>

    <script type="text/javascript" src="js/main.js">

    </script>

</body>
</html>
