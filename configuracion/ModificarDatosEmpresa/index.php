<?php
  include '../../recursos/PHP/configuracionDelSitioWeb/conf.php';
  include '../../recursos/PHP/clases/conexion.php';
?>
<?php // include '../../recursos/PHP/metodos/verificarSesionUsuario.php' ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Producto</title>
    <!-- <link rel="stylesheet" href="../recursos/cssprincipal/style.css"> -->
    <link rel="stylesheet" href="ModificarDE.css">
    <link rel="stylesheet" href="../../recursos/cssprincipal/style.css" />

</head>

<body onload="checkCookie('<?php echo $_SESSION['usuario'] ?>')" >
<script type="text/javascript" src="../../Usuarios/modificarTema/js/master.js"></script>
<script src='//cdn.jsdelivr.net/npm/sweetalert2@11'></script>
    <?php  include '../../recursos/nav/nav.php' ?>
    <div class="main">
        <h1   style="color: white" >MODIFICAR DATOS DE LA EMPRESA</h1>

        <form class="contenido" >
            <div class="input">
               
              <div  class="textos">
             <!--  <img src="https://bluemadness.000webhostapp.com/img_proyecto/logo_empresa.png" alt="">-->
                    <div class="linea">
                            <label for="name">Nombre: </label>
                            <input type="text" name="txtnom" id="txtnom">

                            <label for="name">slogan: </label>
                            <input type="text" name="txtslogan" id="txtslogan">

                            <label for="name"> Descripcion: </label>
                            <textarea name="txtDesc" id="txtDesc" cols="30" rows="8"></textarea>

                            <label for="name">Telefono: </label>
                            <input type="tel" name="txttelefono" id="txttelefono" minlength="10" maxlength="10"   >

                            
                            <label for="name">Correo: </label>
                            <input type="email" name="txtcorreo" id="txtcorreo">

                            <label for="name">Website: </label>
                            <input type="text" name="txtweb" id="txtweb">

                            <label for="name">Facebook: </label>
                            <input type="text" name="txtFace" id="txtfac">

                            <label for="name">Twitter: </label>
                            <input type="text" name="txtTwitter" id="txttw">
                   
                    </div>
                  
                    <input type="submit" class="btn" value="Guardar">
               </div>
               
                
            </div>

            

            <div class="imagen" >
                <div class="imgelg" >
                    <div class="img-mostrar">
                        <img src="" alt="" class="imagenselec" name="imagenselec" id="imagenselec">
                    </div>
                    <!-- <button class="examinar">examinar</button> -->
                    <input type="file" name="img-elg" id="img-elg" class="img-elg">

                    
                 </div>
              
            </div>
            
        </form>   
    </div>

    <script src="modificarDE.js"></script>
</body>
</html>