  <?php // include '../../recursos/PHP/configuracionDelSitioWeb/conf.php' ?>
<?php //include '../../recursos/PHP/metodos/verificarSesionUusuario.php' ?>
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
<body>  
    <?php include '../../recursos/nav/nav.php' ?>
    <div class="main">
        <h1>REGISTRO DE PRODUCTO</h1>

        <form class="contenido" action="registrarP.php" method="post" enctype="multipart/form-data">
            <div class="input">
               
              <div  class="textos">
                    <label for="name">Nombre: </label>
                    <input type="text" name="txtnom" id="txtnom">
                    <label for="name">Descripcion: </label>
                    <input type="text" name="txtdesc" id="txtdesc">
                    <label for="name">Precio Venta: </label>
                    <input type="text" name="txtprecv" id="txtprecv">
                    <label for="name">Precio Compra: </label>
                    <input type="text" name="txtprecc" id="txtprecc">
                    <label for="name">Categoria: </label>
                    <input type="text" name="txtcat" id="txtcat">
                    <label for="name">Cantidad: </label>
                    <input type="text" name="txtcant" id="txtcant">
                    <label for="name">Unidad De Medida: </label>
                    <input type="text" name="txtundm" id="txtundm">
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