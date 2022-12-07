//ARRAY usuarios
var arrayUsuarios;

//VARIABLES PARA MODIFICAR UN USUARIO
var contenedor;
var nombre;
var usuario;
var imagen;
var correo;
var nivel;

btnExaminarImagen.addEventListener("click", () => {
  img_env.click();
});

img_env.addEventListener("change", (e) => {
  console.log(e.target.files);

  var imagen = e.target.files[0];

  //VISTA PREVIA DE IMAGEN
  var imgCodificada = URL.createObjectURL(imagen);

  imgUser.src = imgCodificada;
});

fetch("../../recursos/PHP/metodos/obtenerUsuariosBD.php")
  .then((res) => res.json())
  .then((data) => {
    arrayUsuarios = data;
    mostrarUsuariosDom(arrayUsuarios);
  }); //FIN DE FETCH

document
  .querySelector(".contenedor-tabla-usuarios")
  .addEventListener("click", (e) => {
    //EDITAR USUARIO
    if (e.target.tagName == "BUTTON") {
      document.querySelector(".contenedor-modal").style.display = "flex";

      contenedor = e.target.parentNode.parentNode;

      //console.log(contenedor);
      nombre = contenedor.querySelector(".nombre p").innerText;
      usuario = contenedor.querySelector(".usuario p").innerText;
      imagen = contenedor.querySelector(".imagen > p").innerText;
      correo = contenedor.querySelector(".correo p").innerText;
      nivel = contenedor.querySelector(".nivel p").innerText;

      document.getElementById("nombre").value = nombre;
      document.getElementById("usuario").value = usuario;

      document.getElementById("imagen").value = imagen;
      imgUser.src = `../../${imagen}?timestamp=${new Date().getTime()}`;
      document.getElementById("correo").value = correo;
      document.getElementById("nivel").value = nivel;

      console.log(imagen)
    }
    //DAR DE BAJA A USUARIO
    else if (e.target.tagName == "INPUT" && e.target.value == "Eliminar") {
      var contenedor1 = e.target.parentNode.parentNode;
      var usuario1 = contenedor1.querySelector(".usuario p").innerText;
      var data = new FormData();

      data.append("id", usuario1);
      Swal.fire({
        title: '¿Seguro que lo desea dar de baja?',
        showDenyButton: true,
        showCancelButton: false,
        confirmButtonText: 'Si',
        denyButtonText: 'No',
        customClass: {
          actions: 'my-actions',
          cancelButton: 'order-1 right-gap',
          confirmButton: 'order-2',
          denyButton: 'order-3',
        }
      }).then((result) => {
        if (result.isConfirmed) {
          fetch("../../recursos/PHP/metodos/eliminarUsuario.php", {
            method: "POST",
            body: data,
          })
            .then((res) => res.text())
            .then((data) => {
              if (data == "2") {
                Swal.fire("Por motivos de seguridad usted mismo no se puede dar de baja", "", "info");
              } else {
                Swal.fire('El usuario fue dado de baja', '', 'success')
                window.location.reload();
              }
            });
        
        } else if (result.isDenied) {
          //Swal.fire('', '', 'info')
        }
      })
      

     
    }else if (e.target.tagName == "INPUT" && e.target.value == "Activar") {
      Swal.fire({
        title: '¿Seguro que desea activar la cuenta?',
        showDenyButton: true,
        showCancelButton: false,
        confirmButtonText: 'Si',
        denyButtonText: 'No',
        customClass: {
          actions: 'my-actions',
          cancelButton: 'order-1 right-gap',
          confirmButton: 'order-2',
          denyButton: 'order-3',
        }
      }).then((result) => {
        if (result.isConfirmed) {
          var contenedor1 = e.target.parentNode.parentNode;
          var usuario1 = contenedor1.querySelector(".usuario p").innerText;
          var data = new FormData();
    
          data.append("usuario", usuario1);

          fetch("../../recursos/PHP/metodos/activarCuentaUsuario.php", {
            method: "POST",
            body: data,
          })
            .then((res) => res.text())
            .then(() => {
              window.location.reload();
            });
        
        } else if (result.isDenied) {
          //Swal.fire('', '', 'info')
        }
      })
    }
  });

//LOGICA PARA EDITAR USUARIO
document.getElementById("formEditarUsuario").addEventListener("submit", (e) => {
  e.preventDefault();

  //DESHABILITAR BUTTON GUARDAR Y CANCELAR HASTA QUE SE SEA RETORNADO ALGO POR EL METODO FETCH
  document.querySelector(
    ".contenedor-modal .modal form .contenedor-button button:first-child"
  ).disabled = true;
  document.querySelector(
    ".contenedor-modal .modal form .contenedor-button button:last-child"
  ).disabled = true;

  var data = new FormData(e.target);

  data.append("id", usuario);

  if (data.get("nivel") == "Cliente") {
    data.append("nivelN", "0");
  } else if (data.get("nivel") == "Admin") {
    data.append("nivelN", "1");
  } else {
    data.append("nivelN", "2");
  }

  data.append("usuarioActivo", "1");
  // console.log(data);

  fetch("../../recursos/PHP/metodos/editarUsuarioBD.php", {
    method: "POST",
    body: data,
  })
    .then((response) => response.text())
    .then((data) => {
      console.log(data)
      //HABILITAR BUTTON GUARDAR Y CANCELAR
      document.querySelector(
        ".contenedor-modal .modal form .contenedor-button button:first-child"
      ).disabled = false;
      document.querySelector(
        ".contenedor-modal .modal form .contenedor-button button:last-child"
      ).disabled = false;

      var arrData = JSON.parse(data);

      //document.querySelector(".contenedor-modal").style.display = "none";
      // console.log(arrData);
      if (arrData[0] == true) {
        //VERIFICO SI EN EL ARRDATA SE OBTIENE UNA
        // OPCION 'TRUE' DE MODIFICACION DE IMAGEN DE USUARIO
        if (arrData[2] == true) {
          //ACTUALIZO LA RUTA DE IMAGEN EN EL MODAL DE INFO DE USUARIO
          //DONDE SE ENCUENTRA EL CERRAR SESION

          document.querySelector(
            ".loal-contenedor-modal .loal-modal .loal-body img"
          ).src = `../../${arrData[1]}?timestamp=${new Date().getTime()}`;
        }
        //ACTUALIZO LA RUTA DE IMAGEN EN LA LISTA DE USUARIOS
        //(USUARIO SELECCIONADO PARA MODIFICA)
        //SOLO SE MODIFICA SI ES QUE EN EL FOEM EDITAR DATOS DE USUARIO
        //SE MODIFICO LA IMAGEN
        if (arrData[1] !== "") {
          contenedor.querySelector(".imagen img").src = `../../${
            arrData[1]
          }?timestamp=${new Date().getTime()}`;

          contenedor.querySelector(".imagen > p").innerText =
          `${
            arrData[1]
          }`;

          //LIMPIAR INPUT FILE
          img_env.value = "";
        }

        if (document.getElementById("alert").classList.contains("alertDanger"))
          document.getElementById("alert").classList.remove("alertDanger");

        contenedor.querySelector(".nombre p").innerText =
          document.getElementById("nombre").value;
        contenedor.querySelector(".usuario p").innerText =
          document.getElementById("usuario").value;
      

        contenedor.querySelector(".correo p").innerText =
          document.getElementById("correo").value;
        contenedor.querySelector(".nivel p").innerText =
          document.getElementById("nivel").value;

        if (!document.getElementById("alert").classList.contains("alertShow"))
          document.getElementById("alert").classList.add("alertShow");

        document.querySelector(".container-alert .alert p").innerText =
          "Usuario modificado.";
        setTimeout(ocultarModalEditarUsuario, 1500);

        //ACTUALIZAR ARRAY DE USUARIOS PARA LAS BUSQUEDAS LOCALES
      } else {
        document.getElementById("alert").classList.add("alertDanger");
        document.getElementById("alert").classList.add("alertShow");
        document.querySelector(".container-alert .alert p").innerText =
          arrData[2];
      }
    });
});

//FUNCION PARA TIMEOUT CERRAR MODAL EDITAR USUARIO
function ocultarModalEditarUsuario() {
  document.querySelector(".contenedor-modal .modal").style.animation =
    "ocultarModal .3s ease-in-out";

  setTimeout(() => {
    document.querySelector(".contenedor-modal").style.animation =
      "ocultarContenedorModal .3s";
    setTimeout(() => {
      document.querySelector(".contenedor-modal").style.display = "none";

      document.querySelector(".contenedor-modal").style.animation = "";
      document.querySelector(".contenedor-modal .modal").style.animation = "";
    }, 300);
  }, 300);

  document.getElementById("alert").classList.remove("alertShow");
}

document
  .getElementById("btnCancelarEditarUsuario")
  .addEventListener("click", () => {
    ocultarModalEditarUsuario();
  });

//MOSTRAR HEADER TABLA USUARIOS
function mostrarHeaderTablaUsuarios() {
  document.querySelector(".contenedor-tabla-usuarios").innerHTML = `
    <div class="contenedor-usuarios">
        <div class="header-nombre">
          <p>Nombre</p>
        </div>
        <div class="header-usuario">
          <p>Usuario</p>
        </div>
        <div class="header-imagen">
          <p>Imagen</p>
                  <!-- <img src="../../recursos/imagenes/productos/mcr/mcr.jpg" alt="asdasd"> -->
        </div>
        

        <div class="header-correo">
          <p>Correo</p>
        </div>

        <div class="header-nivel">
          <p>Nivel</p>
        </div>

        <div class="header-opcion">
          <p>Opcion</p>
        </div>
      </div>
    
      `;
}

//FUNCION PARA RECORRER USUARIOS Y MOSTRARLOS EN PANTALLA
function mostrarUsuariosDom(data) {
  mostrarHeaderTablaUsuarios();

  console.log(data)
  for (var item of data) {
    //VERIFICAR EL NIVEL DE PRIVILEGIO
    var nivel = "";
    if (item.NIVEL == "0") {
      nivel = "Cliente";
    } else if (item.NIVEL == "1") {
      nivel = "Admin";
    } else {
      nivel = "Ventas";
    }

    //VERIFICAR SI EL STATUS ES ACTIVO=1 O BAJA=2
    let valueBtnUser = ""
    if(item.ID_ESTATUS == "1"){
      valueBtnUser = "Eliminar"
    }else if(item.ID_ESTATUS == "2"){
      valueBtnUser = "Activar"
    }
    document.querySelector(".contenedor-tabla-usuarios").innerHTML += `
        <div class="contenedor-usuarios" id="contenedor-usuarios">
          <div class="nombre">
            <p>${item.NOMBRE}</p>
          </div>
          <div class="usuario">
            <p>${item.USUARIO}</p>
          </div>
          <div class="imagen" >
          <img src="../../${
            item.IMAGEN
          }?timestamp=${new Date().getTime()}" width="60" height="60" alt="IMAGEN">
          <p>${item.IMAGEN}</p>

        </div>
          
          <div class="correo">
            <p>${item.CORREO}</p>
          </div>
          <div class="nivel">
            <p>${nivel}</p>
          </div>
          <div class="opcion">
            <button>Editar</button>
            <input type="button" value="${valueBtnUser}">
          </div>
        </div>
      `;
  }
}

const formBuscarUsuario = document.querySelector(".contenedor-buscar");

formBuscarUsuario.addEventListener("submit", (e) => {
  e.preventDefault();

  var data = new FormData(e.target);

  var busqueda = data.get("inputNombreUsuario").toUpperCase();

  var longitudBusqueda = busqueda.length;

  var usuarioEncontrado = false;

  var nombreUsuario;

  document.querySelector(".contenedor-tabla-usuarios").innerHTML = "";
  mostrarHeaderTablaUsuarios();

  for (var i = 0; i < arrayUsuarios.length; i++) {
    nombreUsuario = arrayUsuarios[i].NOMBRE.toUpperCase();
    for (var j = 0; j < nombreUsuario.length; j++) {
      if (nombreUsuario.substring(j, longitudBusqueda + j) == busqueda) {
        usuarioEncontrado = true;

        //VERIFICAR EL NIVEL DE PRIVILEGIO
        var nivel = "";
        if (arrayUsuarios[i].NIVEL == "0") {
          nivel = "Cliente";
        } else if (arrayUsuarios[i].NIVEL == "1") {
          nivel = "Admin";
        } else {
          nivel = "Ventas";
        }

        //VERIFICAR SI EL STATUS ES ACTIVO=1 O BAJA=2
    let valueBtnUser = ""
    if(arrayUsuarios[i].ID_ESTATUS == "1"){
      valueBtnUser = "Eliminar"
    }else if(arrayUsuarios[i].ID_ESTATUS == "2"){
      valueBtnUser = "Activar"
    }
        //MOSTRAMOS USUARIO
        document.querySelector(".contenedor-tabla-usuarios").innerHTML += `
        <div class="contenedor-usuarios" id="contenedor-usuarios">
        <div class="nombre">
          <p>${arrayUsuarios[i].NOMBRE}</p>
        </div>
        <div class="usuario">
          <p>${arrayUsuarios[i].USUARIO}</p>
        </div>
        <div class="imagen" >
        <img src="../../${arrayUsuarios[i].IMAGEN}" alt="asdasd">
        <p>${arrayUsuarios[i].IMAGEN}</p>

      </div>
        <div class="correo">
          <p>${arrayUsuarios[i].CORREO}</p>
        </div>
        <div class="nivel">
          <p>${nivel}</p>
        </div>
        <div class="opcion">
          <button>Editar</button>
          <input type="button" value="${valueBtnUser}">
        </div>
      </div>

        `;
      }
    }
  }

  //--A
  if (!usuarioEncontrado) {
    Swal.fire(
      "Error al buscar usuario.",
      "Ningun usuario fue encontrado con ese nombre.",
      "error"
    );
  }

  //console.log(buscarUsuario)
});

//EVENTO CHANGE DE INPUT BUSCAR PRODUCTO
document.getElementById("inputNombreUsuario").addEventListener("keyup", (e) => {
  if (e.target.value == "") {
    mostrarUsuariosDom(arrayUsuarios);
  }
});

//BUSCAR USUARIO POR NOMBRE
function mostrarUsuariosPorNombre(data) {}
