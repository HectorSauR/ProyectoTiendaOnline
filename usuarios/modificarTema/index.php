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
    <title>Document</title>

    <link rel="stylesheet" href="../../recursos/cssprincipal/style.css" />
    <link rel="stylesheet" href="./index.css" />
  </head>
  <body onload="checkCookie('<?php echo $_SESSION['usuario'] ?>')">

    <?php include "../../recursos/nav/nav.php" ?>

    <div class="main">
      <h1 class="tittle">MODIFICAR TEMA</h1>

      <div class="cont">
        <form class="modificar_tema" data-color="#3E4078" method="POST">
          <!-- TEMA AZUL -->
          <div>
            <button class="hidden">
              <div class="theme" id="Azul">
                <div class="nav">
                  <img
                    src="https://bluemadness.000webhostapp.com/img_proyecto/logo_empresa.png"
                    class="logo"
                  />

                  <div class="settings">
                    <img
                      src="https://bluemadness.000webhostapp.com/img_proyecto/conf.png"
                      class="logo"
                    />
                    <img
                      src="https://bluemadness.000webhostapp.com/img_proyecto/usr.png"
                      class="logo"
                    />
                  </div>
                </div>
                <div class="links">
                  <p class="link">INICIO</p>
                  <p class="link">PRODUCTOS</p>
                  <p class="link">COTIZACIONES</p>
                  <p class="link">VENTAS</p>
                  <p class="link">USUARIOS</p>
                  <p class="link">REPORTES</p>
                </div>
                <div class="space"></div>
              </div>
            </button>
            <h2 class="Name">Azul</h2>
          </div>
        </form>
        <!--/ TEMA AZUL -->

        <form class="modificar_tema" data-color="#2c6235" method="POST">
          <!-- TEMA VERDE -->
          <div>
            <button class="hidden">
              <div class="theme" id="Verde">
                <div class="nav">
                  <img
                    src="https://bluemadness.000webhostapp.com/img_proyecto/logo_empresa.png"
                    class="logo"
                  />

                  <div class="settings">
                    <img
                      src="https://bluemadness.000webhostapp.com/img_proyecto/conf.png"
                      class="logo"
                    />
                    <img
                      src="https://bluemadness.000webhostapp.com/img_proyecto/usr.png"
                      class="logo"
                    />
                  </div>
                </div>
                <div class="links">
                  <p class="link">INICIO</p>
                  <p class="link">PRODUCTOS</p>
                  <p class="link">COTIZACIONES</p>
                  <p class="link">VENTAS</p>
                  <p class="link">USUARIOS</p>
                  <p class="link">REPORTES</p>
                </div>
                <div class="space"></div>
              </div>
            </button>
            <h2 class="Name">Verde</h2>
          </div>
        </form>
        <!--/ TEMA VERDE -->

        <form class="modificar_tema" data-color="#9c4040" method="POST">
          <!-- TEMA ROJO -->
          <div>
            <button class="hidden">
              <div class="theme" id="Rojo">
                <div class="nav">
                  <img
                    src="https://bluemadness.000webhostapp.com/img_proyecto/logo_empresa.png"
                    class="logo"
                  />

                  <div class="settings">
                    <img
                      src="https://bluemadness.000webhostapp.com/img_proyecto/conf.png"
                      class="logo"
                    />
                    <img
                      src="https://bluemadness.000webhostapp.com/img_proyecto/usr.png"
                      class="logo"
                    />
                  </div>
                </div>
                <div class="links">
                  <p class="link">INICIO</p>
                  <p class="link">PRODUCTOS</p>
                  <p class="link">COTIZACIONES</p>
                  <p class="link">VENTAS</p>
                  <p class="link">USUARIOS</p>
                  <p class="link">REPORTES</p>
                </div>
                <div class="space"></div>
              </div>
            </button>
            <h2 class="Name">Rojo</h2>
          </div>
          <!--/ TEMA ROJO -->
        </form>

        <form class="modificar_tema" data-color="#2d312e" method="POST">
          <!-- TEMA OSCURO -->
          <div>
            <button class="hidden">
              <div class="theme" id="Oscuro">
                <div class="nav">
                  <img
                    src="https://bluemadness.000webhostapp.com/img_proyecto/logo_empresa.png"
                    class="logo"
                  />

                  <div class="settings">
                    <img
                      src="https://bluemadness.000webhostapp.com/img_proyecto/conf.png"
                      class="logo"
                    />
                    <img
                      src="https://bluemadness.000webhostapp.com/img_proyecto/usr.png"
                      class="logo"
                    />
                  </div>
                </div>
                <div class="links">
                  <p class="link">INICIO</p>
                  <p class="link">PRODUCTOS</p>
                  <p class="link">COTIZACIONES</p>
                  <p class="link">VENTAS</p>
                  <p class="link">USUARIOS</p>
                  <p class="link">REPORTES</p>
                </div>
                <div class="space"></div>
              </div>
            </button>
            <h2 class="Name">Oscuro</h2>
          </div>
          <!--/ TEMA OSCURO -->
        </form>

        <form class="modificar_tema" data-color="#ffff" sec-color="#978d8d" method="POST">
          <!-- TEMA BLANCO -->
          <div>
            <button class="hidden">
              <div class="theme" id="Blanco">
                <div class="nav" id="Nav_Blanco">
                  <img
                    src="https://bluemadness.000webhostapp.com/img_proyecto/logo_empresa.png"
                    class="logo"
                  />

                  <div class="settings">
                    <img
                      src="https://bluemadness.000webhostapp.com/img_proyecto/conf.png"
                      class="logo"
                    />
                    <img
                      src="https://bluemadness.000webhostapp.com/img_proyecto/usr.png"
                      class="logo"
                    />
                  </div>
                </div>
                <div class="links" id="Links_Blanco">
                  <p class="link" id="p_Blanco">INICIO</p>
                  <p class="link" id="p_Blanco">PRODUCTOS</p>
                  <p class="link" id="p_Blanco">COTIZACIONES</p>
                  <p class="link" id="p_Blanco">VENTAS</p>
                  <p class="link" id="p_Blanco">USUARIOS</p>
                  <p class="link" id="p_Blanco">REPORTES</p>
                </div>
                <div class="space"></div>
              </div>
            </button>
            <h2 class="Name">Blanco</h2>
          </div>
          <!--/ TEMA BLACNO -->
        </div>
      </form>
    </div>

  <script type="text/javascript" src="./js/master.js"></script>
  <script>
    let tema = document.querySelectorAll(".modificar_tema");

    tema.forEach((color) => {
      color.addEventListener("submit", () => {
        //obtenemos el color del tema
        let coloTema = color.getAttribute("data-color");
        let secTema = color.getAttribute("sec-color");

        if(secTema != null){
          document
          .querySelector(":root")
          .style.setProperty("--ColorSecundario", secTema);

        eraseCookie("colorSecundario<?php echo $_SESSION['usuario'] ?>");
        setCookie("colorSecundario<?php echo $_SESSION['usuario'] ?>", secTema, 30);
        }
        else{
          eraseCookie("colorSecundario<?php echo $_SESSION['usuario'] ?>");
        }

        document
          .querySelector(":root")
          .style.setProperty("--ColorPrincipal", coloTema);

        eraseCookie("colorPrincial<?php echo $_SESSION['usuario'] ?>");
        setCookie("colorPrincial<?php echo $_SESSION['usuario'] ?>", coloTema, 30);
      });
    });
  </script>

  </body>
</html>
