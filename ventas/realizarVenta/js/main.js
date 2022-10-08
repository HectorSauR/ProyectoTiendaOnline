const btnBuscarCotizacion = document.getElementById("btnBuscarCotizacion");
const txtIdCotizacion = document.getElementById("txtIdCotizacion");

const nombreUsuario = document.getElementById("txtNombre");
const correoUsuario = document.getElementById("txtCorreo");

var total = 0;

var idProductos = [];

function comprobarExistenciaCotizacionTabla(idProduct) {
  const productos = Array.from(document.querySelectorAll(".tabla"));
  let x = 0;
  // console.log(productos)
  productos.length > 0 &&
    productos.map((producto) => {
      // console.log(`Registrado: ${producto.getAttribute('id-cotizacion')}... NUEVO: ${idProduct}`)
      // console.log(`BOOL: ${producto.getAttribute('id-cotizacion') == idProduct}`)
      if(x == 1) return
      
      if (producto.getAttribute("id-cotizacion") == idProduct) {
        x = 1;
        return
      }
    });
  // console.log(productos.length > 0 && productos[0].getAttribute('id-cotizacion'))
  return x == 0 ? false : true;
}

//EVENTO CLICK PARA BUTTON ENCARGADO DE BUSCAR ID DE COTIZACION
btnBuscarCotizacion.addEventListener("click", () => {
  //VERIFICAR ID
  if (txtIdCotizacion.value == "") {
    Swal.fire("ERROR!", "iNGRESE EL ID DE LA COTIZACION", "error");
  } else {
    //TODO CORRECTO
    let id = txtIdCotizacion.value;

    var data = new FormData();
    data.append("id", id);

    // console.log
    // console.log(comprobarExistenciaCotizacionTabla(id))
    if(comprobarExistenciaCotizacionTabla(id)) {
      Swal.fire("ERROR!", "LA COTIZACION NO SE PUEDE REPETIR", "error");
      return
    }

    fetch("../../recursos/PHP/metodos/buscarCotizacionBD.php", {
      method: "POST",
      body: data,
    })
      .then((response) => response.json())
      .then((data) => {
        // console.log(data);
        if (data == "") {
          Swal.fire("ERROR!", "LA COTIZACION NO SE ENCONTRO", "error");
        } else {
          nombreUsuario.value = data[0].NOMBR_CLIENTE;
          correoUsuario.value = data[0].CORREO_CLIENTE;
          contadorDetallesCotizacion = -1;
          obtenerDetalleDeCotizacion(id);
        }
      });
  }
}); //FIN DE EVENTO CLICK DE BUSCAR COTIZACION

//METODO ENCARGADO DE OBTENER LOS PRODUCTOS DE LA COTIZACION
var arrayDetalleDeCotizacion;
var contadorDetallesCotizacion = 0;
var totalImporte = 0;

function obtenerDetalleDeCotizacion(id) {
  let data = new FormData();
  data.append("id", id);
  fetch("../../recursos/PHP/metodos/obtenerDetalleDeCotizacionBD.php", {
    method: "POST",
    body: data,
  })
    .then((res) => res.json())
    .then((data) => {
      arrayDetalleDeCotizacion = data;
      // console.log(data)
      for (var i of data) {
        // console.log(i.ID_PRODUCTO);
        obtenerProductosDeCotizacion(
          i.ID_PRODUCTO,
          i,
          data.length,
          data[0].ID_COTIZACION
        );
      }

      //
    });
} //FIN METODO ENCARGADO DE OBTENER LOS PRODUCTOS DE LA COTIZACION

function obtenerProductosDeCotizacion(id, indice, lengthData, idCotizacion) {
  let data = new FormData();
  data.append("id", id);
  fetch("../../recursos/PHP/metodos/obtenerProductosDeCotizacionBD.php", {
    method: "POST",
    body: data,
  })
    .then((res) => res.json())
    .then((data) => {
      contadorDetallesCotizacion++;
      // console.log(data)
      var importe =
        parseFloat(data[0].PRECIO) *
        parseInt(arrayDetalleDeCotizacion[contadorDetallesCotizacion].CANTIDAD);
      importe = importe + importe * 0.16;
      totalImporte += importe;

      document.querySelector(".contenedor-tabla-productos").innerHTML += `
      <div class="tabla" id-cotizacion=${idCotizacion}>
        <div class="producto">
          <p>${data[0].ID_PRODUCTO}</p>
        </div>
        <div class="nombre">
          <p>${data[0].NOMBRE}</p>
        </div>
        <div class="cantidad">
          <p>${arrayDetalleDeCotizacion[contadorDetallesCotizacion].CANTIDAD}</p>
        </div>
        <div class="precio">
          <p>${data[0].PRECIO}</p>
        </div>
        <div class="total">
          <p>${importe}</p>
        </div>
      </div>


      `;

      document.querySelector("#total").innerText = "Total: $" + totalImporte;
    });
}

//EVENTO DE BTN PARA FINALIZAR VENTA
document.querySelector("#btnFinalizarVenta").addEventListener("click", () => {
  finalizarVenta();
});

//FUNCION ENCARGADA DE FINALIZAR LA VENTA
function finalizarVenta() {
  var tipoPago = 0;
  if (document.querySelector("#Efectivo").checked) {
    tipoPago = 1;
  } else {
    tipoPago = 2;
  }

  var data = new FormData();
  data.append("formaPago", tipoPago);

  let date = new Date();
  data.append("fecha", date.toLocaleDateString());

  fetch("../../recursos/PHP/metodos/obtenerIdVenta.php", {
    method: "POST",
    body: data,
  })
    .then((res) => res.text())
    .then((data) => {
      let idventa = data;
      const dataTabla = document.querySelectorAll(".tabla");

      for (var item of dataTabla) {
        let idproducto = item.querySelector(".producto p").innerText;
        let cantidad = item.querySelector(".cantidad p").innerText;
        let precio = item.querySelector(".precio p").innerText;

        var data = new FormData();
        data.append("idventa", idventa);
        data.append("idproducto", idproducto);
        data.append("cantidad", cantidad);
        data.append("precio", precio);

        fetch("../../recursos/PHP/metodos/insertarRegistroVentaBD.php", {
          method: "POST",
          body: data,
        })
          .then((res) => res.text())
          .then((data) => {
            console.log(data);
          });
      }

      Swal.fire("", "VENTA COMPLETADA", "success");
    });
}

//EVENTO CLICK DE AGREGAR PRODUCTO

document.querySelector("#btnAgregarProducto").addEventListener("click", () => {
  var idproducto = document.querySelector("#txtidproducto").value;
  if (idproducto == "") {
    Swal.fire("Ingrese id.", "", "error");
  } else {
    var data = new FormData();

    data.append("id", idproducto);
    //PETICION FETCH
    fetch("../../recursos/PHP/metodos/obtenerInfoProducto.php", {
      method: "POST",
      body: data,
    })
      .then((res) => res.json())
      .then((data) => {
        //VERIFICAR SI PRODUCTO YA FUE AGREGADO
        const dataTabla = document.querySelectorAll(".tabla");

        for (var i = 0; i < dataTabla.length; i++) {
          let idproducto = dataTabla[i].querySelector(".producto p").innerText;
          let cantidad = dataTabla[i].querySelector(".cantidad p");

          let precio = dataTabla[i].querySelector(".precio p");
          let totalVar = dataTabla[i].querySelector(".total p");

          if (data[0].ID_PRODUCTO == idproducto) {
            var cantidadVar = parseInt(cantidad.innerText) + 1;
            cantidad.innerText = cantidadVar;

            totalVar.innerText =
              parseFloat(precio.innerText) * parseInt(cantidad.innerText);

            total = total + parseFloat(precio.innerText);
            document.querySelector("#total").innerText = "Total: $" + total;
            return;
          }
        }

        /*
      for(var item of dataTabla){
        let idproducto = item.querySelector(".producto p").innerText
        let cantidad = item.querySelector(".cantidad p").innerText

        alert(cantidad)
        let precio = item.querySelector(".precio p").innerText
        let total = item.querySelector(".total p").innerText

          if(data[0].ID_PRODUCTO == idproducto){
            var cantidadVar = parseInt(cantidad) +1
            cantidad = cantidadVar

            total = parseFloat(precio) * parseInt(cantidad)
            return
          }
      }*/

        total = total + parseFloat(data[0].PRECIO);
        document.querySelector(".contenedor-tabla-productos").innerHTML += `
      <div class="tabla">
        <div class="producto">
          <p>${data[0].ID_PRODUCTO}</p>
        </div>
        <div class="nombre">
          <p>${data[0].NOMBRE}</p>
        </div>
        <div class="cantidad">
          <p>1</p>
        </div>
        <div class="precio">
          <p>${data[0].PRECIO}</p>
        </div>
        <div class="total">
          <p>${data[0].PRECIO}</p>
        </div>
      </div>


      `;
        document.querySelector("#total").innerText = "Total: $" + total;
        document.getElementById("txtidproducto").value = "";
      });
  }
});

//EVENTO ENTER EN INPUT
document.querySelector("#txtidproducto").addEventListener("keypress", (e) => {
  if (e.key === "Enter") {
    document.querySelector("#btnAgregarProducto").click();
  }
});
