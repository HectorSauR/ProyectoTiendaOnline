/* CREAR NUEVA COOKIE */
function setCookie(cname, cvalue, exdays) {
  const d = new Date();
  d.setTime(d.getTime() + exdays * 24 * 60 * 60 * 1000);
  let expires = "expires=" + d.toUTCString();
  document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}

/* LEER COOKIES */
function getCookie(cname) {
  let name = cname + "=";
  let decodedCookie = decodeURIComponent(document.cookie);
  let ca = decodedCookie.split(";");
  for (let i = 0; i < ca.length; i++) {
    let c = ca[i];
    while (c.charAt(0) == " ") {
      c = c.substring(1);
    }
    if (c.indexOf(name) == 0) {
      return c.substring(name.length, c.length);
    }
  }
  return "";
}

/* ELIMINAR COOKIES */
function eraseCookie(name) {
  setCookie(name, "", -1);
}

/* ESTABLECER COOKIES EN LA PAGINA */
function checkCookie(nombre) {
  //Leer Cookies fondo
  let colorPrincipal = getCookie("colorPrincial" + nombre);
  let colorSecundario = getCookie("colorSecundario" + nombre);

  if (colorPrincipal != null && (colorSecundario == undefined || colorSecundario == null)) {
    document
      .querySelector(":root")
      .style.setProperty("--ColorPrincipal", colorPrincipal);
  }

  if (colorSecundario != null) {
    document
      .querySelector(":root")
      .style.setProperty("--ColorSecundario", colorSecundario);
  }
}
