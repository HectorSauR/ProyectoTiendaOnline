<?php
 include '../../recursos/PHP/configuracionDelSitioWeb/conf.php';
  include  '../../recursos/PHP/clases/conexion.php';

 $query = 'SELECT *  FROM `categoria_productos`; ';
 $statement = $conexion->prepare($query);
 $statement->execute();
 $result = $statement->fetchall();

    $datos = [];
       foreach($result as $row){
           $datos[] = [

               'idcategoria' => $row['ID_CATEGORIA'],

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
  <title>Modificar Producto</title>
</head>
<body onload="checkCookie('<?php echo $_SESSION['usuario'] ?>')">
<script type="text/javascript" src="../../Usuarios/modificarTema/js/master.js"></script>
  <?php include '../../recursos/nav/nav.php' ?>
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


        <div class="contenedor-productos">
                <div class="header-idprd">
                  <p>ID PRODUCTO</p>
                </div>
                <div class="header-idcategoria">
                  <p>ID CATEGORIA</p>
                </div>

                <div class="header-nombre">
                  <p>NOMBRE</p>
                </div>

                <div class="header-imagen">
                  <p>IMAGEN</p>
                  <!-- <img src="../../recursos/imagenes/productos/mcr/mcr.jpg" alt="asdasd"> -->
                </div>

                <div class="header-precioc">
                  <p>PRECIO C</p>
                </div>

                <div class="header-precio">
                  <p>PRECIO</p>
                </div>

                <div class="header-stock">
                  <p>STOCK</p>
                </div>

                <div class="header-stockmin">
                  <p>STOCK MIN</p>
                </div>

                <div class="header-status">
                  <p>STATUS</p>
                </div>
                <div class="header-cb">
                  <p>CODIGO DE BARRAS</p>
                </div>
                <div class="header-opcion">
                  <p>Opcion</p>
                </div>
        </div>




            <div class="contenedor-productosD"></div>


  </div>

  <!--MODAL PARA EDITAR USUARIO -->

  <div class="contenedor-modal">
    <div class="modal">
      <h1>Editar Producto</h1>
      <form id="formEditarProducto">

       <label for="">CATEGORIA</label>
        <select name="categoria" id="categoria">
          <?php
              foreach ($datos as $dat) {
                echo '<option value="' . $dat['idcategoria'] . '">'.$dat['idcategoria'].' => ' . $dat['nombre'] . '</option>';
              }
          ?>
        </select>
        <label for="">Nombre</label>
        <input type="text" name="nombre" value="" id="nombre">
        <label for="">Imagen</label>
        <input type="text" name="imagen" value="" id="imagen">
        <input type="file" name="img_env" id="img_env"  accept="image/*">
        <label for="">Precio compra</label>
        <input type="number" name="precioc" value="" id="precioc"  min="0" pattern="^[0-9]+">
        <label for="">Precio</label>
        <input type="number" name="precio" value="" id="precio"  min="0" pattern="^[0-9]+">
        <label for="">Stock</label>
        <input type="number" name="stock" value="" id="stock"  min="0" pattern="^[0-9]+">
        <label for="">Stock Min</label>
        <input type="number" name="stockm" value="" id="stockm"  min="0" pattern="^[0-9]+">
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
