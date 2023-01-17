<?php
 include '../../recursos/PHP/configuracionDelSitioWeb/conf.php';
  include  '../../recursos/PHP/clases/conexion.php';
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
    <form class="contenedor-buscar">
      <!--<label>Buscar:</label>-->
      <input type="text" name="inputProducto" id="inputProducto" value="" placeholder="Nombre"  required>
      <button type="submit">Buscar</button>
    </form>

    </div>


    <div class="contenedor-scroll">
    <div class="contenedor-tabla-producto">
      
    </div>
    </div>


  </div>

  <!--MODAL PARA EDITAR USUARIO -->

  <div class="contenedor-modal">
    <div class="modal">
      <h1>Editar Producto</h1>
      <form id="formEditarProducto">
        <label for="">Nombre</label>
        <input type="text" name="nombre" value="" id="nombre" pattern="^(?!.*\.\.)(?!.*\.$)[^\W][\w.]{3,20}$" required>
        
        <label for="">CATEGORIA</label>
        <select name="categoria" id="categoria">
        </select>

        <label for="">Imagen</label>
        <input type="text" name="imagen" value="" id="imagen" class="ruta-imagen-form" pattern="([0-9a-zA-Z\/])+([0-9a-zA-Z\._-]+.(png|PNG|jp[e]?g|JP[E]?G))" required>
        <input type="file" name="img_env" id="img_env" accept="image/png,image/jpg,image/jpeg">
       
        <div class="contenedor-imagen">
        <input type="button" value="Examinar" id="btnExaminarImagen">
        <img id="imgUser" src="" alt="">
        </div>
        
        <!-- input coontraseña eliminada por que ningun ADMIN debe poder ver 
        o modificar la cobtra de ningun otro usuario
        <label for="">Contraseña</label>
        <input type="text" name="clave" value="" id="clave">-->
        <label for="">Precio Venta</label>
        <input type="number" name="precio" min= "0" step="0.01" pattern="^\d*(\.\d{0,2})?$" max="999999999" id="precio" required>
        <label for="">Precio Compra</label>
        <input type="number" name="precio_c" min= "0" step="0.01" pattern="^\d*(\.\d{0,2})?$" max="999999999" id="precio_c" required>
        <label for="">Stock</label>
        <input type="number" name="stock" min= "0" max="999999999" id="stock" required>
        <label for="">Stock Minimo</label>
        <input type="number" name="stockm" min= "0" max="999999999" id="stock_m" required>
        <label for="">Codigo de barras</label>
        <input type="text" name="codigo" pattern="^[0-9]+"  id="codigo" required>

        <label for="">Estatus</label>
        <select name="estatus" id="estatus">
          <option>Activo</option>
          <option>Desactivado</option>
        </select>

        <div class="contenedor-button">
          <button type="submit">Guardar</button>
            <button type="button" id="btnCancelarEditarProducto">Cancelar</button>
        </div>
      </form>

      <div class="container-alert" id="alert">
        <div class="alert">
          <p>Error</p>
        </div>
      </div>
    </div>
  </div>

  <script type="text/javascript" src="js/main.js"></script>
</body>
</html>
