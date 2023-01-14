<?php
  include '../../recursos/PHP/configuracionDelSitioWeb/conf.php';
  include '../../recursos/PHP/clases/conexion.php';
?>
<?php include '../../recursos/PHP/metodos/verificarSesionUsuario.php'?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../recursos/cssprincipal/style.css">
    <link rel="stylesheet" href="style.css">
    <title>Registrar Categoría</title>
</head>
<body onload="checkCookie('<?php echo $_SESSION['usuario'] ?>')">
<script type="text/javascript" src="../../Usuarios/modificarTema/js/master.js"></script>
  
  <?php include '../../recursos/nav/nav.php'?>

    <div class="main">
        <h1>Registro de categoria</h1>
        
        <form id="formRegistroCategoria" class="contenedor-app">
          <div class="contenedor-form">
            <label>Nombre</label>
            <input type="text" name="nombre" id="">
            <label>Descripcion</label>
            
            <textarea name="descripcion" id="" cols="30" rows="10"></textarea>

            <button type="submit" id="btnRegistrar">Registrar</button>
          </div>

          <div class="contenedor-imagen">
            <h1>Imagen</h1>
            <div class="imagen">
    
            </div>
            <button type="button" id="activarAgreagarImagen">Examinar</button>
            <input type="file" value="" name="imagen" id="agregarImagen" accept="image/*">
          </div>
        </form>

    </div>
    <script src="main.js"></script>

</body>
</html>
