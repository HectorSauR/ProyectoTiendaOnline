<?php
  include '../../recursos/PHP/configuracionDelSitioWeb/conf.php';
  include  '../../recursos/PHP/clases/conexion.php';





 $query = 'SELECT *  FROM `forma_pago` WHERE ID_ESTATUS = 1;';
 $statement = $conexion->prepare($query);
 $statement->execute();
 $result = $statement->fetchall();

    $datos = [];
       foreach($result as $row){
           $datos[] = [

               'idforma_pago' => $row['ID_FORMA_PAGO'],
               'descripcion' => $row['DESCRIPCION'],

           ];
       }
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="../../recursos/cssprincipal/style.css">
  <link rel="stylesheet" href="css/master.css">
  <title>Document</title>
</head>
<body onload="checkCookie('<?php echo $_SESSION['usuario'] ?>')">
<script type="text/javascript" src="../../Usuarios/modificarTema/js/master.js"></script>
  <?php  include '../../recursos/nav/nav.php' ?>
  <script src='//cdn.jsdelivr.net/npm/sweetalert2@11'></script>
  <div class="main" id="main">
    <h1>Gestión de productos</h1>
    <div class="contenedor-buscar">
      <form  id="frmbuscar">
      <label>Buscar:</label>
      <input type="text" name="id_prd_b" value="" class="inpbuscar">
      <button type="button" class="btnBuscar">Buscar</button>

      </form>

    </div>


        <div class="contenedor-ventas">
                <div class="header-idventa">
                  <p>ID VENTA</p>
                </div>
                <div class="header-usuario">
                  <p>USUARIO</p>
                </div>

                <div class="header-forma_pago">
                  <p>FORMA DE PAGO</p>
                </div>

                <div class="header-fecha">
                  <p>FECHA</p>
                  <!-- <img src="../../recursos/imagenes/productos/mcr/mcr.jpg" alt="asdasd"> -->
                </div>

                <div class="header-id_prd">
                  <p>ID PRODUCTO</p>
                </div>

                <div class="header-cantidad">
                  <p>CANTIDAD</p>
                </div>

                <div class="header-precio">
                  <p>IMPORTE</p>
                </div>

                <div class="header-status">
                  <p>STATUS</p>
                </div>

                <div class="header-opcion">
                  <p>Opcion</p>
                </div>
        </div>




            <div class="contenedor-ventasD"></div>


  </div>

  <!--MODAL PARA EDITAR USUARIO -->

  <div class="contenedor-modal">
    <div class="modal">
      <h1>Editar Producto</h1>
      <form id="formEditarVenta">


        <label for="">Id usuario</label>
        <input type="number" name="usuario" value="" id="usuario"  min="1" pattern="^[0-9]+">

        <label for="">Forma de pago</label>
        <select name="forma_pago" id="forma_pago">
          <?php
              foreach ($datos as $dat) {
                 echo '<option value="' . $dat['idforma_pago'] . '">' . $dat['descripcion'] . '</option>';
              }
          ?>
        </select>
        <label for="">Fecha</label>
        <input type="date" name="fecha" id="fecha">

        <label for="">Id producto</label>
        <input type="number" name="id_prd" value="" id="id_prd" min="0" pattern="^[0-9]+">

        <label for="">Cantidad</label>
        <input type="number" name="cantidad" value="" id="cantidad" min="0" pattern="^[0-9]+">

        <label for="">Precio</label>
        <input type="number" name="precio" value="" id="precio" min="0" pattern="^[0-9]+">

        <label for="">Status</label>
        <select name="status" id="status">
         <option value="1">ACTIVO</option>
         <option value="2">INACTIVO</option>
         <option value="3">EN ESPERA</option>
         <option value="4">EN TRAMITE</option>
        </select>



        <div class="contenedor-button">
           <button type="submit" id = "btnGuardar">Guardar</button>
            <button type="button" id="btnCancelarEditarUsuario">Cancelar</button>
        </div>
      </form>
    </div>
  </div>

  <script type="text/javascript" src="js/main.js"></script>
</body>
</html>
