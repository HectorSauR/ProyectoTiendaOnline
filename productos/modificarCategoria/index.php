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

        <form id="frm" action="index.php" method="post" enctype="multipart/form-data">
        <div id="buscarDiv">
        <h3>Buscar</h3>
        <input type="text" id="buscar" name="consulta">
        </div>
            <div id="dataFF">
            <ul>
             <li>
               <label for="name">Nombre:</label>
               <input type="text" id="name" name="user_name" value="Holap" />
             </li>
             <li>
               <label for="msg">Descripción:</label>
               <textarea id="msg" name="user_message"></textarea>
             </li>
            </ul>
            <button type ="submit" id="but" name="consulta">Consultar</button>
            </div>
                
        </form>

    </div>
    <div id="areaImagen">

    </div>
    <form action="index.php" id="botones">
        <div id="area">

        <input type="file" id="btn1" name="imagen" accept="image/*"/>
        <input type="button" id="btn2" value="Examinar" onclick="document.getElementById('btn1').click()">
        </div>
        <input type="button" name="btnModificar" value="Modificar" class="abc">
        <input type="button" name="btnEliminar" value="Eliminar" class="abc">
    </form>

    <script src="main.js"></script>
</body>

<?php 
if (isset($_POST['consulta'])) {
    require 'conexion.php';
    $dato=$_POST['consulta'];
    $resultado = mysqli_query($conectar,"SELECT * FROM 'categoria_productos' WHERE NOMBRE= $dato");
    while($consulta = mysqli_fetch_array($resultado))
    {
        echo $consulta['DESCRIPCION'];

    }
    
}

?>

</html>
