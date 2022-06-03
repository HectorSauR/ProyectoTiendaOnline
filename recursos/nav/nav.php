
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
    <a href="<?php echo $pathHost ?>usuarios/modificarTema"><img id="btn-usr" src="https://bluemadness.000webhostapp.com/img_proyecto/usr.png" alt=""></a>
    <a href="<?php echo $pathHost ?>configuracion/ModificarDatosEmpresa"><img id="" src="https://bluemadness.000webhostapp.com/img_proyecto/conf.png" alt=""></a>
    <img class="btn-menu" id="btn-menu" src="https://bluemadness.000webhostapp.com/img_proyecto/icon-menu.png" alt="">
  </div>


</header>

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

    <?php if(isset($_SESSION['userAdmin'])){?>
    <li><a href="#">Usuarios</a>
      <ul>
        <li><a href="<?php echo $pathHost ?>Usuarios/registrarUsuario/">Registrar Usuario</a></li>
        <li><a href="<?php echo $pathHost ?>Usuarios/modificarUsuario/">Modificar Usuario</a></li>

      </ul>
    </li>
    <?php } ?>

    <li><a href="<?php echo $pathHost ?>">Inicio</a></li>
  </ul>
</nav>

<!--LOGIN-->
<div class="nav-login-background">
  <div class="nav-login-contenedor">
      <form  id="formRegistro">
        <h1>Iniciar Sesion</h1>
        <div>
          <img src="<?php echo $pathHost ?>recursos/imagenes/user.svg" alt="">
          <input type="text" name="user" placeholder="Usuario" value="">
        </div>
        <div>
          <img src="<?php echo $pathHost ?>recursos/imagenes/lock.svg" alt="">
          <input type="password" name="clave" placeholder="Contrasena" value="">
        </div>

        <div>
            <button type="submit" name="button">Ingresar</button>
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


        document.querySelector("#formRegistro").addEventListener("submit" ,(e)=>{
          e.preventDefault();

            var data = new FormData(e.target)



            fetch('<?php echo $pathHost ?>recursos/PHP/metodos/BuscarUsuarioBD.php', {
              method: 'POST',
              body: data
            }).then(response => response.text()).then(data => {
              console.log(data)
              if(data == "1"){
                window.location.reload();
              }else if(data == "0"){
                //alert("Error en inicio de sesion ,verifique porfavor.")
                Swal.fire(
                  'Error en inicio de sesion!',
                  'Verfique porfavor!',
                  'error'
                  )
              }else{
                  Swal.fire(
                  'Error en inicio de sesion!',
                  'Su cuenta fue dada de baja, comuniquese con el administrador!',
                  'error'
                )
              }
            })//FIN DE FETCH
          })//FIN DE EVENTO SUBMIT DE FORMULARIO


    <?php } ?>


</script>

<!--<script src="<?php echo "/ProyectoTiendaOnline/recursos/nav/login.js"; ?>" type="text/javascript"></script>-->
