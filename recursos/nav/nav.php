
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<header class="contenedor-header">
  <div>
  <?php
    //VERIFICAMOS SI EL USUARIO TIENE EL PRODUCTO AGREGADO
    $BuscarLogo = "SELECT LOGO FROM `info_empresa`;";
    $Execute = $conexion->query($BuscarLogo);
    $r = $Execute->fetchall(PDO::FETCH_ASSOC);

    if(count($r) >= 1){?>
      <img src="<?php echo $r[0]['LOGO']; ?>" alt="">
    <?php
    }
    else { ?>
    <img src="https://bluemadness.000webhostapp.com/img_proyecto/logo_empresa.png" alt="">
    <?php
    }
  ?>
  </div>
  <div>
    <a><img id="btn-usr" src="https://bluemadness.000webhostapp.com/img_proyecto/usr.png" alt=""></a>

    <?php
      if( isset($_SESSION['userAdmin']) && $_SESSION['userAdmin'] == "1" ){
        ?>
          <a href="<?php echo $pathHost ?>configuracion/ModificarDatosEmpresa"><img id="" src="https://bluemadness.000webhostapp.com/img_proyecto/conf.png" alt=""></a>
        <?php
      } 
    ?>
    <img class="btn-menu" id="btn-menu" src="https://bluemadness.000webhostapp.com/img_proyecto/icon-menu.png" alt="">
  </div>


</header>


<script type="text/javascript">
    document.querySelector("#btn-usr").addEventListener("click",()=>{
    document.querySelector(".loal-contenedor-modal").classList.toggle("transition-modal")
    event.stopPropagation()
  })

  document.body.addEventListener("click", function (evt) {
      if(document.querySelector(".loal-contenedor-modal").classList.contains('transition-modal')){
        document.querySelector(".loal-contenedor-modal").classList.remove("transition-modal")
      }
  })
</script>

<?php 
  $uri = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
  if( $_SESSION['userAdmin'] == "0" ){
    if( !isset($_GET['page'])  ) {
      if( !isset($_GET['var']) ) {
        if(  $uri != $pathHost && $uri != $pathHost."productos//" && $uri != $pathHost."productos/catalgoProducto/" &&  $uri != $pathHost."cotizaciones/realizarCotizacion/" && $uri != $pathHost."Usuarios/modificarTema/" ){
          echo "<script>console.log('Debug Objects: " . $pathHost . "' );</script>";
          header("Location: ". $pathHost );
        }
        echo "<script>console.log('entro aqui Objects: " . $pathHost . "' );</script>";
      }
    }
  } else if ( $_SESSION['userAdmin'] == "2") {
    if( !isset($_GET['page'])  ) {
      if( !isset($_GET['var']) ) {
        if(  $uri != $pathHost && $uri != $pathHost."productos/consultarProductos/" &&  $uri != $pathHost."ventas/realizarVenta/" && $uri != $pathHost."ventas/modificarVenta/" && $uri != $pathHost."ventas/consultarVenta/" ){
          echo "<script>console.log('Debug Objects: " . $pathHost . "' );</script>";
          header("Location: ". $pathHost );
        }
        echo "<script>console.log('entro aqui Objects: " . $pathHost . "' );</script>";
      }
    }
  }
?>

<?php if(isset($_SESSION['usuario'])){?>
<!--MODAL PARA MOSTRAR INFO DE USUARIO -->
<div class="loal-contenedor-modal">
  <div class="loal-modal">
    <!--
    <div class="loal-header">
      <button type="button" name="button">x</button>
    </div> -->
    <div class="loal-body">
        <img src="<?php echo $pathHost.$_SESSION['rutaImagenUsuario']?>?timestamp=<?php echo time() ?>" alt="">
        <p><?php echo $_SESSION['usuario'] ?></p>
    </div>
    <div class="loal-footer">
        
        
        <a href="<?php echo $pathHost ?>Usuarios/modificarTema">TEMAS</a>

        <button type="button" id="btnCerrarSesion">CERRAR SESIÓN</button>
    </div>
  </div>
</div>

<!--LOGICA PARA CERRAR SESION -->
<script type="text/javascript">
  document.querySelector("#btnCerrarSesion").addEventListener("click",()=>{
    fetch('<?php echo $pathHost ?>recursos/PHP/metodos/cerrarSesion.php').then(res => res.text()).then(data =>{
      window.location.href = "<?php  echo $pathHost ?>"
    })

  })
</script>
<?php } ?>


<!--VERIFICAR SI ROL ES IGUAL A ADMIN-->
<?php if(isset($_SESSION['userAdmin']) && $_SESSION['userAdmin'] == "1"){?>
  <nav>
      <ul class="nav-enlaces">


      <li><a href="#">Productos</a>
        <ul>
          <li><a href="<?php echo $pathHost ?>productos/consultarProductos/">Consultar Productos</a></li>
          <li><a href="<?php echo $pathHost ?>productos/registrarProducto/">Registrar Producto</a></li>
          <li><a href="<?php echo $pathHost ?>productos/modificarProducto/">Modificar Producto</a></li>
          <li><a href="<?php echo $pathHost ?>productos/registrarCategoria/">Registrar Categoria</a></li>
          <li><a href="<?php echo $pathHost ?>productos/modificarCategoria/">Modificar Categoria</a></li>
          <li><a href="<?php echo $pathHost ?>productos/configurarCategoria/">Configurar Categoria</a></li>
          <li><a href="<?php echo $pathHost ?>productos/catalgoProducto/">Catalogo Producto</a></li>
        </ul>
      </li>

      <li><a href="#">Cotizaciones</a>
        <ul>
          <li><a href="<?php echo $pathHost ?>cotizaciones/realizarCotizacion">Realizar Cotizacion</a></li>
        </ul>
      </li>


      <li><a href="#">Ventas</a>
        <ul>
          <li><a href="<?php echo $pathHost ?>ventas/realizarVenta">Realizar Venta</a></li>
          <li><a href="<?php echo $pathHost ?>ventas/modificarVenta">Gestionar Venta</a></li>
          <li><a href="<?php echo $pathHost ?>ventas/consultarVenta">Consultar Venta</a></li>
        </ul>
      </li>

      <li><a href="#">Reportes</a>
        <ul>
          <li><a href="<?php echo $pathHost ?>reportes/ventarXTiempo">Ventas Por Tiempo</a></li>
          <li><a href="<?php echo $pathHost ?>reportes/ventasXFecha">Ventas Por Fecha</a></li>
          <li><a href="<?php echo $pathHost ?>reportes/productos">Productos</a></li>
          <li><a href="<?php echo $pathHost ?>reportes/productosMasVendidos">Productos Mas Vendidos</a></li>
          <li><a href="<?php echo $pathHost ?>reportes/productosMenosVendidos">Productos Menos Vendidos</a></li>
        </ul>
      </li>


      <li><a href="#">usuarios</a>
        <ul>
          <li><a href="<?php echo $pathHost ?>Usuarios/registrarUsuario/">Registrar Usuario</a></li>
          <li><a href="<?php echo $pathHost ?>Usuarios/modificarUsuario/">Modificar Usuario</a></li>

        </ul>
      </li>


      <li><a href="<?php echo $pathHost ?>">Inicio</a></li>
    </ul>
  </nav>
<?php } ?>
<!--VERIFICAR SI ROL ES IGUAL A VENTA-->
<?php if(isset($_SESSION['userAdmin']) && $_SESSION['userAdmin'] == "2"){?>
  <nav>
      <ul class="nav-enlaces">


      <li><a href="#">Productos</a>
        <ul>
          <li><a href="<?php echo $pathHost ?>productos/consultarProductos/">Consultar Productos</a></li>
          </ul>
      </li>



      <li><a href="#">Ventas</a>
        <ul>
          <li><a href="<?php echo $pathHost ?>ventas/realizarVenta">Realizar Venta</a></li>
          <li><a href="<?php echo $pathHost ?>ventas/modificarVenta">Gestionar Venta</a></li>
          <li><a href="<?php echo $pathHost ?>ventas/consultarVenta">Consultar Venta</a></li>
        </ul>
      </li>






      <li><a href="<?php echo $pathHost ?>">Inicio</a></li>
    </ul>
  </nav>
<?php } ?>


<!--VERIFICAR SI ROL ES IGUAL A CLIENTE-->
<?php if(isset($_SESSION['userAdmin']) && $_SESSION['userAdmin'] == "0"){?>
  <nav>
      <ul class="nav-enlaces">


      <li><a href="#">Productos</a>
        <ul>
          <li><a href="<?php echo $pathHost ?>productos/catalgoProducto/">Catalogo Producto</a></li>
      </ul>
      </li>

      <li><a href="#">Cotizaciones</a>
        <ul>
          <li><a href="<?php echo $pathHost ?>cotizaciones/realizarCotizacion">Realizar Cotizacion</a></li>
        </ul>
      </li>







      <li><a href="<?php echo $pathHost ?>">Inicio</a></li>
    </ul>
  </nav>
<?php } ?>

<!--VERIFICAR SI ROL ES IGUAL A NULL-->
<?php if(!isset($_SESSION['userAdmin'])){?>
  <nav>
      <ul class="nav-enlaces">


      <li><a href="#">Productos</a>
        <ul>
          <li><a href="<?php echo $pathHost ?>productos/consultarProductos/">Consultar Productos</a></li>
          <li><a href="<?php echo $pathHost ?>productos/registrarProducto/">Registrar Producto</a></li>
          <li><a href="<?php echo $pathHost ?>productos/modificarProducto/">Modificar Producto</a></li>
          <li><a href="<?php echo $pathHost ?>productos/registrarCategoria/">Registrar Categoria</a></li>
          <li><a href="<?php echo $pathHost ?>productos/modificarCategoria/">Modificar Categoria</a></li>
          <li><a href="<?php echo $pathHost ?>productos/configurarCategoria/">Configurar Categoria</a></li>
          <li><a href="<?php echo $pathHost ?>productos/catalgoProducto/">Catalogo Producto</a></li>
        </ul>
      </li>

      <li><a href="#">Cotizaciones</a>
        <ul>
          <li><a href="<?php echo $pathHost ?>cotizaciones/realizarCotizacion">Realizar Cotizacion</a></li>
        </ul>
      </li>


      <li><a href="#">Ventas</a>
        <ul>
          <li><a href="<?php echo $pathHost ?>ventas/realizarVenta">Realizar Venta</a></li>
          <li><a href="<?php echo $pathHost ?>ventas/modificarVenta">Gestionar Venta</a></li>
          <li><a href="<?php echo $pathHost ?>ventas/consultarVenta">Consultar Venta</a></li>
        </ul>
      </li>

      <li><a href="#">Reportes</a>
        <ul>
          <li><a href="<?php echo $pathHost ?>reportes/ventarXTiempo">Ventas Por Tiempo</a></li>
          <li><a href="<?php echo $pathHost ?>reportes/ventasXFecha">Ventas Por Fecha</a></li>
          <li><a href="<?php echo $pathHost ?>reportes/productos">Productos</a></li>
          <li><a href="<?php echo $pathHost ?>reportes/productosMasVendidos">Productos Mas Vendidos</a></li>
          <li><a href="<?php echo $pathHost ?>reportes/productosMenosVendidos">Productos Menos Vendidos</a></li>
        </ul>
      </li>


      <li><a href="#">usuarios</a>
        <ul>
          <li><a href="<?php echo $pathHost ?>Usuarios/registrarUsuario/">Registrar Usuario</a></li>
          <li><a href="<?php echo $pathHost ?>Usuarios/modificarUsuario/">Modificar Usuario</a></li>

        </ul>
      </li>


      <li><a href="<?php echo $pathHost ?>">Inicio</a></li>
    </ul>
  </nav>
<?php } ?>


<!--LOGIN-->
<div class="nav-login-background">
  <div class="nav-login-contenedor">
      <form  id="formRegistro">
        <h1>Iniciar Sesión</h1>
        <div>
          <img src="<?php echo $pathHost ?>recursos/imagenes/user.svg" alt="">
          <input type="text" name="user" placeholder="Usuario" value="">
        </div>
        <div>
          <img src="<?php echo $pathHost ?>recursos/imagenes/lock.svg" alt="">
          <input type="password" name="clave" placeholder="Contraseña" value="">
        </div>

        <div id="contenedor-btn-login">
            <button type="submit" name="button">Ingresar</button>
            <p id="loginCliente">Ingresar como cliente</p>
        </div>
      </form>
  </div>
</div>


<script>
  const btnmenu = document.getElementById("btn-menu");
  const navbar = document.querySelector("nav");
  btnmenu.addEventListener("click", () => {
    navbar.classList.toggle("showandhide");
  });

  //LOGIN

  const btnUsr = document.getElementById("btn-usr");
  const navLoginBackground = document.querySelector(".nav-login-background");
  const navLoginContenedor = document.querySelector(".nav-login-contenedor");


  <?php
      if(!isset($_SESSION['usuario'])){?>
        document.querySelector(".contenedor-header").style.pointerEvents = "none";
        document.querySelector("nav").style.pointerEvents = "none";

        navLoginBackground.style.display = "flex";
        navLoginBackground.style.animation = "efectoLogin .5s forwards";
        navLoginContenedor.style.animation = "efectoLogin .5s .5s forwards"

        //LOGICA PARA CUANDO EL SUAURIO SEA UN cliente
        // FIXME: AQUI ESTA EL INICIO DEL CLIENTE
        document.querySelector("#loginCliente").addEventListener("click",(e)=>{
          var data = new FormData()
          data.append("opc","1");
          fetch('<?php echo $pathHost ?>recursos/PHP/metodos/buscarUsuarioBD.php', {
            method: 'POST',
            body: data
          }).then(response => response.text()).then(data => {
            console.log(data)
            if(data == "1"){
              console.log(data)
              window.location.reload();
            }
          })
        })

        document.querySelector("#formRegistro").addEventListener("submit" ,(e)=>{
          e.preventDefault();

            var data = new FormData(e.target)
              data.append("opc","0");


            fetch('<?php echo $pathHost ?>recursos/PHP/metodos/buscarUsuarioBD.php', {
              method: 'POST',
              body: data
            }).then(response => response.text()).then(data => {

              if(data == "1"){
                window.location.reload()
              }else if(data == "0"){
                //alert("Error en inicio de sesion ,verifique porfavor.")
                Swal.fire(
                  '',
                  '<b>Error con credenciales ingresadas , verfique porfavor</b>',
                  'error'
                  )
              }else if(data == "3"){
                  Swal.fire(
                  '',
                  '<b>Su cuenta fue dada de baja, comuniquese con un administrador del sistema</b>',
                  'error'
                )
              }
            })//FIN DE FETCH
          })//FIN DE EVENTO SUBMIT DE FORMULARIO


    <?php } ?>


</script>

<!--<script src="<?php echo "/ProyectoTiendaOnline/recursos/nav/login.js"; ?>" type="text/javascript"></script>-->
