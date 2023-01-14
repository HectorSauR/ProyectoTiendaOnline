<?php
  include '../../recursos/PHP/configuracionDelSitioWeb/conf.php';
?>
<?php include '../../recursos/PHP/metodos/verificarSesionUsuario.php'?>
<?php include 'obtDatos.php'?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../recursos/cssprincipal/style.css">
    <link rel="stylesheet" href="style.css">
    <title>Modificar Categoria</title>
</head>
<body onload="checkCookie('<?php echo $_SESSION['usuario'] ?>')">
<script type="text/javascript" src="../../Usuarios/modificarTema/js/master.js"></script>
  
  <?php include '../../recursos/nav/nav.php'?>

   
  <div class="main">
    <h1>Gestión de categorias</h1>
    <form class="contenedor-buscar">
      <!--<label>Buscar:</label>-->
      <input type="text" name="inputNombreUsuario" id="inputNombreUsuario" value="" placeholder="Nombre"  required>
      <button type="submit">Buscar</button>
    </form>

    <div class="contenedor-scroll">
    <div class="contenedor-tabla-usuarios">
      
      </div>
    </div>
    



  </div>

  <!--MODAL PARA EDITAR USUARIO -->

  <div class="contenedor-modal">
    <div class="modal">
      <h1>Editar categoria</h1>
      <form id="formEditarUsuario">
        <label for="">Nombre</label>
        <input type="text" name="nombre" value="" id="nombre" >
        <label for="">Descripcion</label>
        <input type="text" name="descripcion" value="" id="usuario" >
        <label for="">Imagen</label>
        <input type="text" name="imagen" value="" id="imagen" class="ruta-imagen-form" >
        <input type="file" name="img_env" id="img_env" accept="image/png,image/jpg,image/jpeg">
       
        <div class="contenedor-imagen">
        <input type="button" value="Examinar" id="btnExaminarImagen">
        <img id="imgUser" src="" alt="">
        </div>
        
       
        <div class="contenedor-button">
          <button type="submit">Guardar</button>
            <button type="button" id="btnCancelarEditarUsuario">Cancelar</button>
        </div>
      </form>

      <div class="container-alert" id="alert">
        <div class="alert">
          <p>Error</p>
        </div>
      </div>
    </div>
  </div>   

    

    <script src="main.js"></script>
</body>

</html>

