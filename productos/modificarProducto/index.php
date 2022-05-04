<?php
  include '../../recursos/PHP/configuracionDelSitioWeb/conf.php';
  include '../../recursos/PHP/clases/conexion.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../recursos/cssprincipal/style.css">
    <link rel="stylesheet" href="Estilo.css" />

    <title>Document</title>
</head>
<body>
    

<?php include '../../recursos/nav/nav.php' ?>
    <div class="dt">


      <section class="datos">
        <h2>GESTIÓN DE USUSARIOS</h2>
        <br>
        <br>
          <label for="">Buscar</label>
         <input type="search" id="ibuscar" name="buscar">
        <br>
        <br>

        <section class="ingr">
            <article>
                <label > Nombre:</label>
                <input type="text" id="inombre" name="nombre"> </article>
                <br>
                <label > Usuario:</label>
                <input type="text" id="iUsuario" name="usuario"> </article>
                <br>
                <br>
                <label > Contraseña:</label>
                <input type="password" id="icontraseña" name="contraseña"></article>
                <br>
                <br>
                <label > Correo:</label>
                <input type="email" id="icorreo" name="correo"> </article>
                <br>
                <br>
                <label > Rol:</label> 
                <div class="select">
                    <select name="rol" id="irol">
                       <option selected disabled>Selecciona un Rol</option>
                       <option value="administrador">administrador</option>
                       <option value="vendedor">vendedor</option>
                       <option value="##">y eso no</option>
                    </select>
                 </div> 
        </section>
       
      </section>

     
      <aside class="imgn">
        <input type="image" id="iImage" name="imagen" src="usuario.png">
        
        <input type="button" name="examinar" id="examinarbtn" value="Examinar">

        
   </aside>

   <footer class="botones"> <input type="button" value="Guardar">
    <input type="button" value="Modificar">
    <input type="button" value="Eliminar">
</footer>
  
   
    </div>
    
   
</body>
</html>