fetch("../../recursos/PHP/metodos/buscarProductoBd.php")
  .then((res) => res.json())
  .then((data) => {
    for (var item of data) {
      //VERIFICAR EL NIVEL DE PRIVILEGIO

      document.querySelector(".contenedor-productosD").innerHTML += `

      <div class="contenedor-productos" id="contenedor-productos">
        <div class="id-prd">
          <p>${item.ID_PRODUCTO}</p>
        </div>
        <div class="id-categoria">
          <p>${item.ID_CATEGORIA}</p>
        </div>
        <div class="nombre">
          <p>${item.NOMBRE}</p>
        </div>
        <div class="imagen" >
          <img src="${item.IMAGEN}" alt="asdasd">
          <p>${item.IMAGEN}</p>

        </div>
        <div class="precioc">
          <p>${item.PRECIO_COMPRA}</p>
        </div>
        <div class="precio">
        <p>${item.PRECIO}</p>
        </div>
        <div class="stock">
        <p>${item.STOCK}</p>
        </div>
        <div class="stockm">
        <p>${item.STOCK_MIN}</p>
        </div>
        <div class="status">
        <p>${item.ID_ESTATUS}</p>
        </div>
        <div class="codigo_barras">
        <p>${item.CODIGO_BARRAS}</p>
        </div>
        <div class="opcion" >
          <button class="editarS">Editar</button>
          <input class="eliminarS" type="button" value="Eliminar">
        </div>

      </div>
    `;
      //
    }

    document.getElementById("main").addEventListener("click", (e) => {
      //EDITAR USUARIO

      console.log(e.target);

      //       let opcion = document.querySelectorAll(".opcion");
      //   opcion.forEach((btn) =>  {
      // btn.addEventListener("click", () =>{

      if (e.target.className == "editarS") {
        //var imgCodificada;

        document.querySelector(".contenedor-modal").style.display = "flex";
        var contenedor = e.target.parentNode.parentNode;

        var idprd = contenedor.querySelector(".id-prd > p").innerText;

        // alert(idprd)
        var categorias =
          contenedor.querySelector(".id-categoria > p").innerText;
        var nombre = contenedor.querySelector(".nombre > p").innerText;
        var imagen = contenedor.querySelector(".imagen > p").innerText;
        var precioc = contenedor.querySelector(".precioc > p").innerText;
        var precio = contenedor.querySelector(".precio > p").innerText;
        var stock = contenedor.querySelector(".stock > p").innerText;
        var stockm = contenedor.querySelector(".stockm > p").innerText;
        var status = contenedor.querySelector(".status > p").innerText;
        var cb = contenedor.querySelector(".codigo_barras > p").innerText;

        // console.log(contenedor)

        document.getElementById("categoria").value = categorias;
        document.getElementById("nombre").value = nombre;
        document.getElementById("imagen").value = imagen;
        document.getElementById("precioc").value = precioc;
        document.getElementById("precio").value = precio;
        document.getElementById("stock").value = stock;
        document.getElementById("stockm").value = stockm;

        // ---------------------------
        document.querySelector("#img_env").addEventListener("change", (e) => {
          // console.log(e.target.files)
          var imagen_env = e.target.files[0];
          var archivosSoportados = ["image/jpeg", "image/png", "image/jpg"];

          console.log(imagen_env);
          var seEncontraronElementoNoValidos = false;

          if (archivosSoportados.indexOf(imagen_env.type) != -1) {
            var path_img =
              "../../recursos/imagenes/productos/" +
              document.getElementById("nombre").value +
              "/" +
              imagen_env.name;
            document.getElementById("imagen").value = path_img;
          } else {
            seEncontraronElementoNoValidos = true;
          }

          if (seEncontraronElementoNoValidos) {
            alert("EL ARCHIVO NO ES VALIDO");
            // Swal.fire(
            //   'El archivo seleccionado no es valido!',
            //   'Seleccione una imagen con formato jpeg o png',
            //   'error'
            // )
          }
        });

        // ---------------------

        //console.log(status);

        if (status == 1) {
          document.getElementById("status").value = 1;
        } else if (status == 2) {
          document.getElementById("status").value = 2;
        } else if (status == 3) {
          document.getElementById("status").value = 3;
        } else if (status == 4) {
          document.getElementById("status").value = 4;
        }

        document
          .getElementById("formEditarProducto")
          .addEventListener("submit", (e) => {
            e.preventDefault();

            var data = new FormData(e.target);
            data.append("id", idprd);

            // data.append("categoria2",categorias)

            console.log(data.get("id"));
            console.log(data.get("categoria"));
            console.log(data.get("nombre"));
            console.log(data.get("imagen"));
            console.log(data.get("img_env"));
            console.log(data.get("precioc"));
            console.log(data.get("precio"));
            console.log(data.get("stock"));
            console.log(data.get("stockm"));
            console.log(data.get("status"));

            data.append("txtnom", data.get("nombre"));

            fetch(
              "../../recursos/PHP/metodos/verificarProductoRegistrado.php",
              {
                method: "POST",
                body: data,
              }
            )
              .then((response) => response.text())
              .then((data) => {
                if (data == "1") {
                  Swal.fire(
                    "Error al registrar producto.",
                    "Es posible que el producto ya este registrado con ese nombre verifique",
                    "error"
                  );
                } else {
                  var data = new FormData(e.target);
                  data.append("id", idprd);
                  fetch("../../recursos/PHP/metodos/EditarProductoBD.php", {
                    method: "POST",
                    body: data,
                  })
                    .then((response) => response.text())
                    .then((data) => {
                      document.querySelector(
                        ".contenedor-modal"
                      ).style.display = "none";
                      window.location.reload();
                    });
                }
              });
          });
      }
      //DAR DE BAJA A USUARIO
      else if (e.target.className == "eliminarS") {
        var contenedor = e.target.parentNode.parentNode;
        var idprd = contenedor.querySelector(".id-prd > p").innerText;
        Swal.fire({
          title:
            "Estas completamente seguro que quieres eliminar este producto?",
          showDenyButton: true,
          showCancelButton: true,
          confirmButtonText: "Save",
          denyButtonText: `Don't save`,
        }).then((result) => {
          /* Read more about isConfirmed, isDenied below */
          if (result.isConfirmed) {
            var data2 = new FormData();
            data2.append("id", idprd);
            console.log(data2.get("id"));

            fetch("../../recursos/PHP/metodos/eliminarProductoBDxId.php", {
              method: "POST",
              body: data2,
            })
              .then((response) => response.text())
              .then((data2) => {
                console.log(data2);
                Swal.fire("Se a eliminado el producto.", "", "success");
                setTimeout(funcionConRetraso, 2000);
              });
          } else if (result.isDenied) {
            Swal.fire("Se a cancelado la operación", "", "info");
          }
        });
      } else if (e.target.className == "btnBuscar") {
        //alert(e.target);
        var data2 = new FormData();
        var idB = document.querySelector(".inpbuscar").value;
        data2.append("id_prd_b", idB);
        fetch("../../recursos/PHP/metodos/BuscarProductoBDxId.php", {
          method: "POST",
          body: data2,
        })
          .then((response) => response.text())
          .then((data2) => {
            data2 = JSON.parse(data2);
            for (var item of data2) {
              //VERIFICAR EL NIVEL DE PRIVILEGIO

              document.querySelector(".contenedor-productosD").innerHTML = `
  
        <div class="contenedor-productos" id="contenedor-productos">
            <div class="id-prd">
              <p>${item.ID_PRODUCTO}</p>
            </div>
            <div class="id-categoria">
              <p>${item.ID_CATEGORIA}</p>
            </div>
            <div class="nombre">
              <p>${item.NOMBRE}</p>
            </div>
            <div class="imagen" >
              <img src="${item.IMAGEN}" alt="asdasd">
              <p>${item.IMAGEN}</p>
  
            </div>
            <div class="precioc">
              <p>${item.PRECIO_COMPRA}</p>
            </div>
            <div class="precio">
            <p>${item.PRECIO}</p>
            </div>
            <div class="stock">
            <p>${item.STOCK}</p>
            </div>
            <div class="stockm">
            <p>${item.STOCK_MIN}</p>
            </div>
            <div class="status">
            <p>${item.ID_ESTATUS}</p>
            </div>
            <div class="codigo_barras">
            <p>${item.CODIGO_BARRAS}</p>
            </div>
            <div class="opcion" >
              <button class="editarS">Editar</button>
              <input class="eliminarS" type="button" value="Eliminar">
            </div>
  
            </div>
        `;
              //
            }
          });
      } else {
      }
    });
  });

//LOGICA PARA EDITAR USUARIO

//     })
// }) //FIN DE FETCH

document
  .getElementById("btnCancelarEditarUsuario")
  .addEventListener("click", () => {
    document.querySelector(".contenedor-modal").style.display = "none";
    window.location.reload();
    //  data.append("id","")
    //   data.append("categoria","")
    //   data.append("nombre","")
    //  data.append("imagen","")
    //  data.append("img_env","")
    //   data.append("precioc","")
    //   data.append("precio","")
    //   data.append("stock","")
    //   data.append("stockm","")
    //   data.append("status","")

    //   console.log(data.get("id"))
    //   console.log(data.get("categoria"))
    //   console.log(data.get("nombre"))
    //   console.log(data.get("imagen"))
    //   console.log(data.get("img_env"))
    //   console.log(data.get("precioc"))
    //   console.log(data.get("precio"))
    //   console.log(data.get("stock"))
    //   console.log(data.get("stockm"))
    //   console.log(data.get("status"))
  });

function funcionConRetraso() {
  window.location.reload();
}
