<?php // include '../../recursos/PHP/configuracionDelSitioWeb/conf.php' ?>
<?php //include '../../recursos/PHP/metodos/verificarSesionUusuario.php' ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Producto</title>
    <link rel="stylesheet" href="../recursos/cssprincipal/style.css">
    <link rel="stylesheet" href="ModificarDE.css">
</head>
<body>  
    <?php include '../../recursos/nav/nav.php' ?>
    <div class="main">
        <h1   style="color: white" >REGISTRO DE PRODUCTO</h1>

        <form class="contenido" action="modificarDE.php" method="post" enctype="multipart/form-data">
            <div class="input">
               
              <div  class="textos">
             <!--  <img src="https://bluemadness.000webhostapp.com/img_proyecto/logo_empresa.png" alt="">-->
                    <div class="linea">
                            <label for="name">Nombre: </label>
                            <input type="text" name="txtnom" id="txtnom">

                            <label for="name">slogan: </label>
                            <input type="text" name="txtslogan" id="txtdesc">

                            <label for="name"> Descripcion: </label>
                            <textarea name="txtDesc" id="txtDesc" cols="30" rows="8"></textarea>

                            <label for="name">Telefono: </label>
                            <input type="text" name="txttelefono" id="txttelefono">

                            <label for="name">Correo: </label>
                            <input type="text" name="txtcorreo" id="txtprecc">

                            <label for="name">Website: </label>
                            <input type="text" name="txtweb" id="txtweb">

                            <label for="name">Facebook: </label>
                            <input type="text" name="txtFace" id="txtcat">

                            <label for="name">Twitter: </label>
                            <input type="text" name="txtTwitter" id="txtcant">
                   
                    </div>
                  
                    <input type="submit" class="btn" value="Guardar">
               </div>
               
                
            </div>

            

            <div class="imagen" >
                <div class="imgelg" >
                    <div class="img-mostrar">
                        <img src="https://bluemadness.000webhostapp.com/img_proyecto/logo_empresa.png" alt="" class="imagenselec" name="imagenselec">
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