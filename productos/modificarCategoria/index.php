<?php include '../../recursos/PHP/configuracionDelSitioWeb/conf.php'?>
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
    <title>Document</title>
</head>
<body>
  
  <?php include '../../recursos/nav/nav.php'?>

    <div id="prin">

        <h1>Modificar Categoria</h1>

        <form id="frm" action="index.php" method="post" enctype="multipart/form-data">
 
        <div>
        <div>
<h3>Buscar</h3>
              <select name="consultar" id="periodo">
                  <?php
                 foreach ($datos as $dat) {
                 echo '<option value="' . $dat['NOMBRE'] . '">' . $dat['NOMBRE'] . '</option>';
                 } //end foreach
                  ?>
               </select>
</div>
            <div id="dataFF">

            <ul>
             <li>
               <label for="name">Nombre:</label>
               <input type="text" id="name" name="user_name"/>
             </li>
             <li>
               <label for="msg">Descripción:</label>
               <textarea id="msg" name="user_message"></textarea>
             </li>
            </ul>
            <button type ="submit" id="but" name="consulta">Consultar</button>
            </div>
            <div id="btnDatos">

            </div>

        </div>

        <div id="imagenArea">
              <div id="areaImagen">

              </div>
              <div id="area">
                  <input type="submit" name="btnModificar" value="Modificar" class="abc">
                  <input type="submit" name="btnEliminar" value="Eliminar" class="abc">
                  <input type="file" id="btn1" name="imagen" accept="image/*"/>
                  <input type="button" id="btn2" value="Examinar" onclick="document.getElementById('btn1').click()">
              </div>
            </div>
        </form>

        

    </div>

    <form action="index.php" id="botones" method="post">

    </form>

    <script src="main.js"></script>
</body>

</html>

<?php 
if (isset($_POST['btnEliminar'])) {
  require 'conexion.php';
  $nombre=$_POST['user_name'];
  $modificar=mysqli_query($conectar,"UPDATE categoria_productos SET ID_ESTATUS = '2' WHERE NOMBRE = '$nombre'");
}
if (isset($_POST['consulta'])) {
    require 'conexion.php';
    $dato=$_REQUEST['consultar'];
    
    $resultado = mysqli_query($conectar,"SELECT * FROM categoria_productos WHERE NOMBRE = '$dato'");
    
    while($consultas = mysqli_fetch_array($resultado))
    {
        echo 
        "
          <table width=\"100%\" border=\"1\">
            <tr>
              <td><b><center>ID categoria</center></b></td>
              <td><b><center>Nombre</center></b></td>
              <td><b><center>Descripcion</center></b></td>
              <td><b><center>Imagen</center></b></td>
            </tr>
            <tr>
              <td>".$consultas['ID_CATEGORIA']."</td>
              <td>".$consultas['NOMBRE']."</td>
              <td>".$consultas['DESCRIPCION']."</td>
              <td align=\"center\"><img width=100px src=".$consultas['IMAGEN']."></td>
            </tr>
          </table>
        ";

    }
    
}

if (isset($_POST['btnModificar'])) {
    require 'conexion.php';
    $nombre=$_POST['user_name'];
    $desc=$_POST['user_message'];
    $dato=$_REQUEST['consultar'];

    $nombreImagen=$_FILES['imagen']['name'];


    if ($nombre<>"") {
        $modificar=mysqli_query($conectar,"UPDATE categoria_productos SET NOMBRE='$nombre' WHERE NOMBRE = '$dato'");
        if ($desc<>"") {
            $modificar1=mysqli_query($conectar,"UPDATE categoria_productos SET DESCRIPCION ='$desc' WHERE NOMBRE = '$nombre'");
        }
        if ($nombreImagen<>"") {
            $tipoImagen=$_FILES['imagen']['type'];
            $tamImagen=$_FILES['imagen']['size'];
            $carpeta=$_SERVER['DOCUMENT_ROOT'] . '/ProyectoTiendaOnline/recursos/imagenes/regCategoria/';
            move_uploaded_file($_FILES['imagen']['tmp_name'],$carpeta.$nombreImagen);
            $rutaImagen="../../recursos/imagenes/regCategoria/".$nombreImagen;
            $modificar1=mysqli_query($conectar,"UPDATE categoria_productos SET IMAGEN ='$rutaImagen' WHERE NOMBRE = '$nombre'");
        }
    
    }

    if ($desc<>"") {
        $modificar1=mysqli_query($conectar,"UPDATE categoria_productos SET DESCRIPCION ='$desc' WHERE NOMBRE = '$dato'");
    }

    if ($nombreImagen<>"") {
        $tipoImagen=$_FILES['imagen']['type'];
        $tamImagen=$_FILES['imagen']['size'];
        $carpeta=$_SERVER['DOCUMENT_ROOT'] . '/ProyectoTiendaOnline/recursos/imagenes/regCategoria/';
        move_uploaded_file($_FILES['imagen']['tmp_name'],$carpeta.$nombreImagen);
        $rutaImagen="../../recursos/imagenes/regCategoria/".$nombreImagen;
        $modificar1=mysqli_query($conectar,"UPDATE categoria_productos SET IMAGEN ='$rutaImagen' WHERE NOMBRE = '$dato'");
    }


}
?>