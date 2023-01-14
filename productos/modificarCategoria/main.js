//ARRAY usuarios
var arrayUsuarios;

//VARIABLES PARA MODIFICAR UN USUARIO
var contenedor;
var nombre;
var nombreid
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

fetch("../../recursos/PHP/metodos/obtenerCategoriaProductos.php")
  .then((res) => res.json())
  .then((data) => {
    arrayUsuarios = data;
    mostrarUsuariosDom(arrayUsuarios);
  }); //FIN DE FETCH


//MOSTRAR HEADER TABLA USUARIOS
function mostrarHeaderTablaUsuarios() {
    document.querySelector(".contenedor-tabla-usuarios").innerHTML = `
      <div class="contenedor-usuarios">
          <div class="header-nombre">
            <p>Nombre</p>
          </div>
          <div class="header-usuario">
            <p>Descripcion</p>
          </div>
          <div class="header-imagen">
            <p>Imagen</p>
                    <!-- <img src="../../recursos/imagenes/productos/mcr/mcr.jpg" alt="asdasd"> -->
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
              <p>${item.DESCRIPCION}</p>
            </div>
            <div class="imagen" >
            <img src="../../${
              item.IMAGEN
            }?timestamp=${new Date().getTime()}" width="60" height="60" alt="IMAGEN">
            <p>${item.IMAGEN}</p>
  
          </div>
            <div class="opcion">
              <button>Editar</button>
              <input type="button" value="${valueBtnUser}">
            </div>
          </div>
        `;
    }
  }



  document
  .querySelector(".contenedor-tabla-usuarios")
  .addEventListener("click", (e) => {
    //EDITAR USUARIO
    if (e.target.tagName == "BUTTON") {
      document.querySelector(".contenedor-modal").style.display = "flex";

      contenedor = e.target.parentNode.parentNode;

      //console.log(contenedor);
      nombre = contenedor.querySelector(".nombre p").innerText;
      nombreid = contenedor.querySelector(".nombre p").innerText;
      usuario = contenedor.querySelector(".usuario p").innerText;
      imagen = contenedor.querySelector(".imagen > p").innerText;
      
      document.getElementById("nombre").value = nombre;
      document.getElementById("usuario").value = usuario;

      document.getElementById("imagen").value = imagen;
      imgUser.src = `../../${imagen}?timestamp=${new Date().getTime()}`;
      

    }
    //DAR DE BAJA A USUARIO
    else if (e.target.tagName == "INPUT" && e.target.value == "Eliminar") {
      var contenedor1 = e.target.parentNode.parentNode;
      var nombre = contenedor1.querySelector(".nombre p").innerText;
      var data = new FormData();

      data.append("id", nombre);
      
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
          fetch("../../recursos/PHP/metodos/eliminarCategoria.php", {
            method: "POST",
            body: data,
          })
            .then((res) => res.text())
            .then((data) => {
             
                Swal.fire('La categoria fue dado de baja', '', 'success')
                window.location.reload();
              
            });
        
        } else if (result.isDenied) {
          //Swal.fire('', '', 'info')
        }
      })
      

     
    }else if (e.target.tagName == "INPUT" && e.target.value == "Activar") {
      Swal.fire({
        title: '¿Seguro que desea activar la categoria?',
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
          var nombre = contenedor1.querySelector(".nombre p").innerText;
          var data = new FormData();
    
          data.append("usuario", nombre);

          fetch("../../recursos/PHP/metodos/activarCategoriaProducto.php", {
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

    
    data.append("id", nombreid);
  
    // console.log(data);
  
    fetch("../../recursos/PHP/metodos/editarCategoriaProducto.php", {
      method: "POST",
      body: data,
    })
      .then((response) => response.text())
      .then((data) => {
        
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
        
  
          if (!document.getElementById("alert").classList.contains("alertShow"))
            document.getElementById("alert").classList.add("alertShow");
  
          document.querySelector(".container-alert .alert p").innerText =
            "Categoria modificada.";
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