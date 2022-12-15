<?php
  include '../../recursos/PHP/configuracionDelSitioWeb/conf.php';
  include '../../recursos/PHP/clases/conexion.php';
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Cotizaciones</title>

    <link rel="stylesheet" href="./index.css" />
    <link rel="stylesheet" href="../../recursos/cssprincipal/style.css" />
    <link
      rel="stylesheet"
      href="../../recursos/librerias/jquery/plug-in/datables/datatables.css"
    />
  </head>
  <body onload="checkCookie('<?php echo $_SESSION['usuario'] ?>')">
<script type="text/javascript" src="../../Usuarios/modificarTema/js/master.js"></script>
  <?php include "../../recursos/nav/nav.php";
    $prueba = $_SESSION["cotizacion"];

    if( isset( $_SESSION["cotizacion"] ) ) {
      $prueba2 = explode("|", $_SESSION["cotizacion"]);
      $prueba2 = json_decode($prueba2[0]);
    }

  ?>

    <div class="main">

    <div class="page_cont" >
      <h1 class="tittle">COTIZACIÓN</h1>

      <!-- DIV PARA INGRESAR EL ID_VENTA -->
      <div class="info" id="main">
        <!-- DIS PARA INGRESAR LOS DATOS DEL CLIENTE -->

        <?php
        
          $usuario = $_SESSION['usuario'];
          //OBTENER DATOS DEL USUARIO
          $BuscarUsuario = "select * from usuario where USUARIO = '$usuario'";
          $Execute = $conexion->query($BuscarUsuario);
          $r = $Execute->fetchall(PDO::FETCH_ASSOC);

          if($r[0]['NOMBRE'] != ""){
            $nombre = $r[0]['NOMBRE'];
            $correo = $r[0]['CORREO'];
          }
          else{
            $nombre = "ANONIMO";
            $correo = "ANONIMO";
          }
          if($_SESSION["userAdmin"]!=0){
        ?>
        <p id="first">Datos del cliente:</p>
        <div class="client">
          <div class="input" id="first">
            <p id="p_nom">Nombre:</p>
            <input type="text" class="client_info" disabled="disabled"  value= "<?php echo $nombre ?>" />
          </div>
          <div class="input">
            <p id="p_mail">Correo:</p>
            <input type="email" class="client_info" disabled="disabled" value= "<?php echo $correo ?>" />
          </div>
        </div>
      </div>
      <?php
          }else{
            ?>
            <p id="first">Datos del cliente:</p>
            <div class="client">
              <div class="input" id="first">
                <p id="p_nom">Nombre:</p>
                <input type="text" class="client_info" id="nombre_cliente" placeholder="Ingresa tu nombre" required/>
              </div>
              <div class="input">
                <p id="p_mail">Correo:</p>
                <input type="email" class="client_info" id="email_cliente" placeholder="Ingresa tu email" required/>
              </div>
            </div>
          </div>
            <?php
          }
      ?>

    </div>
      <!-- DIV DE LA TABLA DE LOS PRODUCTOS -->
      <div class="table">
        <table class="tabla" id="table_id" class="display">
          <thead>
            <tr>
              <th>Codigo</th>
              <th>Nombre</th>
              <th>Cantidad</th>
              <th>Precio</th>
              <th>Importe</th>
              <th></th>
            </tr>
          </thead>

          <tbody>

          <?php
            $total = 0;
            $id = 0;            
            if($_SESSION['userAdmin'] != "0"){
  
              $BuscarUsuario = "SELECT ID_COTIZACION FROM `cotizacion` WHERE NOMBR_CLIENTE = '$nombre' and ID_ESTATUS = 4;";
              $Execute = $conexion->query($BuscarUsuario);
  
              $r = $Execute->fetchall(PDO::FETCH_ASSOC);

            }
            if(count($r) >= 1 && $_SESSION['userAdmin'] != "0"){
              $id = $r[0]['ID_COTIZACION'];
              
              $query = "SELECT detalle_cotizacion.ID_PRODUCTO, 
                          productos.NOMBRE, 
                          detalle_cotizacion.CANTIDAD ,
                          detalle_cotizacion.PRECIO_VENTA 
                          FROM `detalle_cotizacion` 
                          INNER JOIN productos 
                          ON detalle_cotizacion.ID_PRODUCTO = productos.ID_PRODUCTO 
                          where ID_COTIZACION = $id;";
              $statement = $conexion->prepare($query);
              $statement->execute();
              $result = $statement->fetchall();
              
              foreach($result as $row)
              {
                $importe = $row['PRECIO_VENTA'] * $row['CANTIDAD'];
                $importe = $importe + ($importe * 0.16);

                ?>

                  <tr>
                    <td><?php echo $row['ID_PRODUCTO'] ?></td>
                    <td><?php echo $row['NOMBRE'] ?></td>
                    <form class="producto" action="./php/modificarCotizacion.php" method="POST">
                      
                      <input type="hidden" name="id_prod" value= "<?php echo $row['ID_PRODUCTO'] ?>">
                      <input type="hidden" name="id_cot" value= "<?php echo $id ?>">

                      <td><p class="hidden"><?php echo $row['CANTIDAD'] ?></p> <input type="number" name="cantidad" value = "<?php echo $row['CANTIDAD'] ?>" class = "cantidad"><button class="borrar" type="submit"><i class="fa-solid fa-pen icon_change"></button></i></td>
                    </form>
                    <td>$<?php echo $row['PRECIO_VENTA'] ?></td>
                    <td>$<?php echo $importe ?></td>
                    <form class="producto" action="./php/borrarCotizacion.php" method="POST">
                      <input type="hidden" name="id_prod" value= "<?php echo $row['ID_PRODUCTO'] ?>">
                      <input type="hidden" name="id_cot" value= "<?php echo $id ?>">
                      <td ><button class="borrar"><i class="fa-solid fa-trash"></i></button>  </td>
                    </form>
                  </tr>

                <?php
                $total = $total + $importe;
              }
            }else if($_SESSION['userAdmin'] == "0" && isset($_SESSION['cotizacion'])){
              $id = $_SESSION['id_cotizacion'];
              $result = explode("|", $_SESSION["cotizacion"]);
              
              foreach($result as $row)
              {
                $row = json_decode($row);
                $importe = $row->PRECIO_VENTA * $row->CANTIDAD;
                $importe = $importe + ($importe * 0.16);
                
                ?>
                  <tr>
                    <td><?php echo $row->ID_PRODUCTO ?></td>
                    <td><?php echo $row->NOMBRE ?></td>
                    <form 
                      class="producto" 
                      action="./php/modificarCotizacionCliente.php" 
                      method="POST">
                      
                      <input type="hidden" name="id_prod" value= "<?php echo $row->ID_PRODUCTO?>">

                      <td>
                        <p class="hidden"><?php echo $row->CANTIDAD?></p> 
                        <input 
                          type="number"
                          name="cantidad" 
                          value = "<?php echo $row->CANTIDAD?>" 
                          class = "cantidad">
                        <button class="borrar" type="submit">
                          <i class="fa-solid fa-pen icon_change"></i>
                        </button>
                      </td>
                    </form>
                    <td>$<?php echo $row->PRECIO_VENTA?></td>
                    <td>$<?php echo $importe ?></td>
                    <form 
                      class="producto" 
                      action="./php/borrarCotizacionCliente.php" 
                      method="POST">
                      <input 
                        type="hidden" 
                        name="id_prod" 
                        value= "<?php echo $row->ID_PRODUCTO?>">
                      <td ><button class="borrar"><i class="fa-solid fa-trash"></i></button></td>
                    </form>
                  </tr>

                <?php
                $total = $total + $importe;
            }
          }
          ?>


          </tbody>

        </table>

        <h2 class="hidden" > ID de la cotizacion: </h2>
        <h3 class= "hidden"> <?php echo $id ?> </h3>
      </div>

      <div class = "Bottom">

        <!-- DIV BOTONES GUERDAR / ELIMINAR -->
        <div class="TOTAL">
          <p>TOTAL: $<?php echo $total ?></p>
          <form class="producto" method="POST">
            <?php
              if($id != 0 && !isset($_SESSION["id_cotizacion"])){
                ?>            
                <input type="hidden" name="id_cot" value= "<?php echo $id ?>">
                <button type="submit" class="btn">REGISTRAR</button>
                <?php
              }

              if(isset($_SESSION["id_cotizacion"])){
                ?>            
                <input type="hidden" name="id_cot" value="<?php echo $_SESSION["id_cotizacion"]?>">
                <button type="submit" class="btn">REGISTRAR</button>
                <?php
              }
            ?>
          </form>
        </div>

        </div>


        
  </div>


    <!-- Scripts para la tabla -->
    <script src="tableexport.min.js"></script>
    <script
      type="text/javascript"
      src="../../recursos/librerias/jquery/jquery-3.6.0.min.js"
    ></script>

    <script
      type="text/javascript"
      charset="utf8"
      src="../../recursos/librerias/jquery/plug-in/datables/datatables.js"
    ></script>
    <script src="jspdf.min.js"></script>

    <!-- SCRIPT PARA DATOS DE LA TABLA -->
    <script src="https://kit.fontawesome.com/167cc065d2.js" crossorigin="anonymous"></script>
    <script type="text/javascript" src="./main.js"></script>
    <script type="text/javascript" src="./master.js"></script>

    <?php
        if(isset($_GET['var'])){
            $var = $_GET['var'];
            if($var == 3){
              echo "<script>
              let timerInterval;
              Swal.fire({
              title: 'Producto Borrado con exito',
              html: 'El producto fue borrado de la cotizacion con exito!',
              icon: 'success',
              timer: 5000,
              timerProgressBar: true,
              didOpen: () => {
                  Swal.showLoading();
              },
              willClose: () => {
                  clearInterval(timerInterval);
              },
              });
              </script>";
            }
            elseif($var == 1){
              echo "<script>
              let timerInterval;
              Swal.fire({
              title: 'Error al modificar la cantidad',
              html: 'El producto que intenta agregar esta fuera de stock, por favor intente despues!',
              icon: 'error',
              timer: 5000,
              timerProgressBar: true,
              didOpen: () => {
                  Swal.showLoading();
              },
              willClose: () => {
                  clearInterval(timerInterval);
              },
              });
              </script>";
            }
            elseif($var == 2){
              echo "<script>
              let timerInterval;
              Swal.fire({
              title: 'Cantidad modificada con exito',
              html: 'La cantidad del producto fue modificada con exito!',
              icon: 'success',
              timer: 5000,
              timerProgressBar: true,
              didOpen: () => {
                  Swal.showLoading();
              },
              willClose: () => {
                  clearInterval(timerInterval);
              },
              });
              </script>";
            }
          }
    ?>
  </body>
</html>
