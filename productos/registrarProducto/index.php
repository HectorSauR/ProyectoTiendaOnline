<?php
  include '../../recursos/PHP/configuracionDelSitioWeb/conf.php';
  include '../../recursos/PHP/clases/conexion.php';
?>
<?php include '../../recursos/PHP/metodos/verificarSesionUsuario.php' ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Producto</title>
    <link rel="stylesheet" href="../../recursos/cssprincipal/style.css">
    <link rel="stylesheet" href="RegistroDeProducto.css">
</head>
<body onload="checkCookie('<?php echo $_SESSION['usuario'] ?>')">
<script type="text/javascript" src="../../usuarios/modificarTema/js/master.js"></script>
    <?php include '../../recursos/nav/nav.php' ?>
    <div class="main">
        <h1>REGISTRO DE PRODUCTO</h1>

        <form class="contenido" action="registrarP.php" method="post" enctype="multipart/form-data">
            <div class="input">
               
              <div  class="textos">
                    <label for="name">Id categotria: </label>
                    <input type="text" name="txtcat" id="txtnom">
                    <label for="name">nombre: </label>
                    <input type="text" name="txtnom" id="txtdesc">
                    <label for="name">Precio Compra: </label>
                    <input type="text" name="txtprecc" id="txtprecc">
                    <label for="name">precio: </label>
                    <input type="text" name="txtprecv" id="txtcat">
                    <label for="name">stock: </label>
                    <input type="text" name="txtstock" id="txtcant">
                    <label for="name">Stock minimo: </label>
                    <input type="text" name="txtstockm" id="txtundm">
                    <label for="name">Estatus: </label>
                    <input type="text" name="txtstatus" id="txtstatus">
                     
                    <input type="submit" class="btn" value="Registrar">
                 </div>
               
                
            </div>

            

            <div class="imagen" >
                <div class="imgelg" action="registrarimagen.php" method="post" >
                    <div class="img-mostrar">
                    <img src="../../recursos/imagenes/regalo.png" alt="" class="imagenselec" name="imagenselec">
                    </div>
                    <!-- <button class="examinar">examinar</button> -->
                    <input type="file" name="img-elg" id="img-elg" class="img-elg">

                    
                 </div>
              
            </div>
            
        </form>   
    </div>





    <!-- 
         <form>
                   <div>
                      
                   </div>
                   <div>
                   
                </div>
                <div>
                  
                </div>
                <div>
                
                </div>
                <div>
                  
                </div>
                <div>
                   
                </div>
                <div>
                  
                </div>
                <div>
                 
                </div>
                </form>
    -->

    <script src="registrarproducto.js"></script>
</body>
</html>