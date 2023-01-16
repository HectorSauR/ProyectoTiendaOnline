//ARRAY usuarioscontenedor-buscar
var arrayProductos;
var arrayCategorias;

//VARIABLES PARA MODIFICAR UN USUARIO
var contenedor;
var nombre;
var imagen;
var precio_compra;
var precio;
var stock;
var stock_minimo;
var codigo_barras;



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


fetch("../../recursos/PHP/metodos/buscarProductoBD.php")
  .then((res) => res.json())
  .then((data) => {
    arrayProductos = data;
    mostrarProductoDom(arrayProductos);
}); //FIN DE FETCH

fetch("../../recursos/PHP/metodos/obtenerCategoriaProductos.php")
  .then((res) => res.json())
  .then((data) => {
    arrayCategorias = data;
    mostrarCategoriaProductos(arrayCategorias);
}); //FIN DE FETCH

  document
  .querySelector(".contenedor-tabla-producto")
  .addEventListener("click", (e) => {
    //EDITAR USUARIO
    if (e.target.tagName == "BUTTON") {
      document.querySelector(".contenedor-modal").style.display = "flex";

      contenedor = e.target.parentNode.parentNode;

      //console.log(contenedor);
      id = contenedor.querySelector(".id p").innerText;
      nombre = contenedor.querySelector(".nombre p").innerText;
      categoria = contenedor.querySelector(".id_cat p").innerText;
      imagen = contenedor.querySelector(".imagen > p").innerText;
      precio = contenedor.querySelector(".precio p").innerText;
      precio_c = contenedor.querySelector(".precio_compra p").innerText;
      stock = contenedor.querySelector(".stock p").innerText;
      stock_m = contenedor.querySelector(".stock_m p").innerText;
      codigo = contenedor.querySelector(".codigo p").innerText;
      estatus = contenedor.querySelector(".estatus p").innerText;

      document.getElementById("nombre").value = nombre;
      document.getElementById('categoria').value = categoria;

      document.getElementById("imagen").value = imagen;
      imgUser.src = `../../${imagen}?timestamp=${new Date().getTime()}`;

      document.getElementById("precio").value = precio;
      document.getElementById("precio_c").value = precio_c;
      document.getElementById("stock").value = stock;
      document.getElementById("stock_m").value = stock_m;
      document.getElementById("codigo").value = codigo;
      document.getElementById("estatus").value = estatus;

    }
    //DAR DE BAJA A USUARIO
    else if (e.target.tagName == "INPUT") {
      var contenedor1 = e.target.parentNode.parentNode;
      var id_producto = contenedor1.querySelector(".id p").innerText;
      var data = new FormData();

      data.append("id", id_producto);
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
          fetch("../../recursos/PHP/metodos/eliminarProductoBDxId.php", {
            method: "POST",
            body: data,
          })
            .then((res) => res.text())
            .then((data) => {
              Swal.fire('El preducto fue dado de baja', '', 'success')
              window.location.reload();
            });
        
        } else if (result.isDenied) {
          //Swal.fire('', '', 'info')
        }
      })
      

     
    }
  });

//LOGICA PARA EDITAR USUARIO
document.getElementById("formEditarProducto").addEventListener("submit", (e) => {
  e.preventDefault();

  //DESHABILITAR BUTTON GUARDAR Y CANCELAR HASTA QUE SE SEA RETORNADO ALGO POR EL METODO FETCH
  document.querySelector(
    ".contenedor-modal .modal form .contenedor-button button:first-child"
  ).disabled = true;
  document.querySelector(
    ".contenedor-modal .modal form .contenedor-button button:last-child"
  ).disabled = true;

  var data = new FormData(e.target);

  if (data.get("estatus") == "Activo") {
    data.append("ID_estatus", "1");
  } else {
    data.append("ID_estatus", "2");
  }
  data.append("id", id);


  fetch("../../recursos/PHP/metodos/EditarProductoBD.php", {
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
        categoria = contenedor.querySelector(".id_cat p").innerText = 
        document.getElementById('categoria').value;
        
        contenedor.querySelector(".precio p").innerText = 
        document.getElementById("precio").value;
        contenedor.querySelector(".precio_compra p").innerText = 
        document.getElementById("precio_c").value;

        contenedor.querySelector(".stock p").innerText = 
          document.getElementById("stock").value;
        contenedor.querySelector(".stock_m p").innerText = 
          document.getElementById("stock_m").value;

        contenedor.querySelector(".codigo p").innerText = 
          document.getElementById("codigo").value;
        
        contenedor.querySelector(".estatus p").innerText = 
          document.getElementById("estatus").value;

        if (!document.getElementById("alert").classList.contains("alertShow"))
          document.getElementById("alert").classList.add("alertShow");

        document.querySelector(".container-alert .alert p").innerText =
          "Producto modificado.";
        setTimeout(ocultarModalEditarProducto, 1500);

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
function ocultarModalEditarProducto() {
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
  .getElementById("btnCancelarEditarProducto")
  .addEventListener("click", () => {
    ocultarModalEditarProducto();
});

//MOSTRAR HEADER TABLA USUARIOS
function mostrarHeaderTablaProducto() {
  document.querySelector(".contenedor-tabla-producto").innerHTML = `
    <div class="contenedor-usuarios">
        <div class="header-nombre">
          <p>Nombre</p>
        </div>
        <div class="header-imagen">
          <p>Imagen</p>
                  <!-- <img src="../../recursos/imagenes/productos/mcr/mcr.jpg" alt="asdasd"> -->
        </div>

        <div class="header-nivel">
          <p> Precio Venta </p>
        </div>
        <div class="header-nivel">
          <p> Precio Compra </p>
        </div>

        <div class="header-opcion">
          <p> Estatus </p>
        </div>
        
        <div class="header-opcion">
          <p>Opcion</p>
        </div>
      </div>
    
      `;
}

function mostrarCategoriaProductos(data) {
  for( var item of data ){
    document.querySelector("#categoria").innerHTML += `
  
      <option value="${item.ID_CATEGORIA}"> ${item.NOMBRE} </option>

    `;
  }
}

//FUNCION PARA RECORRER USUARIOS Y MOSTRARLOS EN PANTALLA
function mostrarProductoDom(data) {
  mostrarHeaderTablaProducto();

  for (var item of data) {
    var estatus = "";
    if (item.ID_ESTATUS == "1") {
      estatus = "Activo";
    } else if (item.ID_ESTATUS == "2") {
      estatus = "Eliminado";
    }

    document.querySelector(".contenedor-tabla-producto").innerHTML += `
        <div class="contenedor-usuarios" id="contenedor-usuarios">
          <div class="nombre">
            <p>${item.NOMBRE}</p>
          </div>
          <div class="imagen" >
          <img src="../../${
              item.IMAGEN
            }?timestamp=${new Date().getTime()}" width="60" height="60" alt="IMAGEN">
            <p>${item.IMAGEN}</p>

          </div>
          <div class="precio">
            <p>${item.PRECIO}</p>
          </div>
          <div class="precio_compra">
            <p>${item.PRECIO_COMPRA}</p>
          </div>
          <div class="estatus">
            <p>${estatus}</p>
          </div>
          <div class="opcion">
            <button>Editar</button>
            <input type="button" value="Eliminar">
          </div>

          <div class="id oculto">
            <p> ${item.ID_PRODUCTO} </p>
          </div>
          <div class="id_cat oculto">
            <p> ${item.ID_CATEGORIA} </p>
          </div>
          <div class="stock oculto">
            <p> ${item.STOCK} </p>
          </div>
          <div class="stock_m oculto">
            <p> ${item.STOCK} </p>
          </div>
          <div class="codigo oculto">
            <p> ${item.CODIGO_BARRAS} </p>
          </div>
        </div>
      `;
  }
}

const formBuscarProducto = document.querySelector(".contenedor-buscar");
formBuscarProducto.addEventListener("submit", (e) => {
  e.preventDefault();

  var data = new FormData(e.target);
  var busqueda = data.get("inputProducto").toUpperCase();
  var longitudBusqueda = busqueda.length;

  var productoEncontrado = false;

  var Producto;

  document.querySelector(".contenedor-tabla-producto").innerHTML = "";
  mostrarHeaderTablaProducto();

  for (var i = 0; i < arrayProductos.length; i++) {
    Producto = arrayProductos[i].NOMBRE.toUpperCase();
    for (var j = 0; j < arrayProductos.length; j++) {
      if (Producto.substring(j, longitudBusqueda + j) == busqueda) {
        productoEncontrado = true;

        var estatus = "";
        if (arrayProductos[i].ID_ESTATUS == "1") {
          estatus = "Activo";
        } else if (arrayProductos[i].ID_ESTATUS == "2") {
          estatus = "Eliminado";
        }

        //MOSTRAMOS USUARIO
        document.querySelector(".contenedor-tabla-producto").innerHTML += `
        <div class="contenedor-usuarios" id="contenedor-producto">

        <div class="nombre">
            <p>${arrayProductos[i].NOMBRE}</p>
          </div>
          <div class="imagen" >
          <img src="../../${arrayProductos[i].IMAGEN}" alt="asdasd">
            <p>${arrayProductos[i].IMAGEN}</p>

          </div>
          <div class="precio">
            <p>${arrayProductos[i].PRECIO}</p>
          </div>
          <div class="precio_compra">
            <p>${arrayProductos[i].PRECIO_COMPRA}</p>
          </div>
          <div class="estatus">
            <p>${estatus}</p>
          </div>
          <div class="opcion">
            <button>Editar</button>
            <input type="button" value="Eliminar">
          </div>

          <div class="id oculto">
            <p> ${arrayProductos[i].ID_PRODUCTO} </p>
          </div>
          <div class="id_cat oculto">
            <p> ${arrayProductos[i].ID_CATEGORIA} </p>
          </div>
          <div class="stock oculto">
            <p> ${arrayProductos[i].STOCK} </p>
          </div>
          <div class="stock_m oculto">
            <p> ${arrayProductos[i].STOCK} </p>
          </div>
          <div class="codigo oculto">
            <p> ${arrayProductos[i].CODIGO_BARRAS} </p>
          </div>
      </div>

        `;
      }
    }
  }

  //--A
  if (!productoEncontrado) {
    Swal.fire(
      "Error al buscar usuario.",
      "Ningun usuario fue encontrado con ese nombre.",
      "error"
    );
  }

  //console.log(buscarUsuario)
});

//EVENTO CHANGE DE INPUT BUSCAR PRODUCTO
document.getElementById("inputProducto").addEventListener("keyup", (e) => {
  if (e.target.value == "") {
    mostrarProductoDom(arrayProductos);
  }
});

function mostrarProductosPorNombre(data) {}
