<?php include '../../recursos/PHP/configuracionDelSitioWeb/conf.php'?>
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
<body>
  
  <?php include '../../recursos/nav/nav.php'?>

    <div id="prin">

        <h1>Registro de categorias</h1>
        <form id="frm" action="/my-handling-form-page" method="post">
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
            </div>
              <div id="btn">
                <button type ="submit" id="but">Registrar</button>
              </div>
        </form>
        <div id="area">
            <textarea name="" id="text2" cols="30" rows="10"></textarea>
            <input type="file" id="btn1" accept="image/*"/>
            
            <input type="button" id="btn2" value="Examinar" onclick="document.getElementById('btn1').click()">
        </div>
    </div>
</body>
</html>
