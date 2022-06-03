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
    <title>Document</title>
</head>
<body onload="checkCookie('<?php echo $_SESSION['usuario'] ?>')">
<script type="text/javascript" src="../../usuarios/modificarTema/js/master.js"></script>
  
  <?php include '../../recursos/nav/nav.php'?>

    <div id="prin">

        <h1>Registro de categorias</h1>
        <form id="frm" action="ingresarDatosBd.php" method="post" enctype="multipart/form-data">
            <div id="dataFF">
            <ul>
             <li>
               <label for="name">Nombre:</label>
               <input type="text" id="name" name="user_name" />
             </li>
             <li>
               <label for="msg">Descripción:</label>
               <textarea id="msg" name="user_message"></textarea>
             </li>
            </ul>
            <button type ="submit" id="but">Registrar</button>
            </div>
                
                  
                
                <div id="area">
                      <div id="areaImagen">

                      </div>
                    <input type="file" id="btn1" name="imagen" accept="image/*"/>
            
                    <input type="button" id="btn2" value="Examinar" onclick="document.getElementById('btn1').click()">
                </div>
        </form>

    </div>
    <script src="main.js"></script>

</body>
</html>
