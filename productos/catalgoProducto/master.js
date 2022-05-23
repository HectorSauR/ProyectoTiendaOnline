//AGREGAR PRODUCTO AL CARRITO
let notification = document.querySelector(".notification");

document.querySelector(".Prod").addEventListener("submit", (e) => {
  e.preventDefault();

  //OBTENER DATOS DEL FORM
  var data = new FormData(e.target);

  //VERIFICA QUE HAY STOCK DEL PRODUCTO
  fetch("./php/verificarExistencia.php", {
    method: "POST",
    body: data,
  })
    .then((response) => response.text())
    .then((data) => {
      if (data == "0") {
        //alerta
        let timerInterval;
        Swal.fire({
          title: "No hay existencia del producto",
          html: "El producto que intenta comprar no esta disponible",
          icon: "error",
          timer: 3000,
          timerProgressBar: true,
          didOpen: () => {
            Swal.showLoading();
          },
          willClose: () => {
            clearInterval(timerInterval);
          },
        });
      } else {
        //OBTENER DATOS DEL FORM
        var data = new FormData(e.target);

        //AGREGAR EL PRODUCTO AL CARRITO
        fetch("./php/agregarCotizacion.php", {
          method: "POST",
          body: data,
        })
          .then((response) => response.text())
          .then((data) => {
            notification.classList.toggle("active");
            //alerta
            let timerInterval;
            Swal.fire({
              title: "Producto agregado con exito",
              html: "Producto agregado exitosamente a la cotizacion",
              icon: "success",
              timer: 2500,
              timerProgressBar: true,
              didOpen: () => {
                Swal.showLoading();
              },
              willClose: () => {
                clearInterval(timerInterval);
              },
            });
          });
      }
    });
});

//BUSCAR PRODUCTO
document.querySelector(".buscar").addEventListener("submit", (e) => {
  e.preventDefault();

  //OBTENER DATOS DEL FORM
  var data = new FormData(e.target);

  //BUSCAR PRODUCTO EN LA BD
  fetch("./php/search.php", {
    method: "POST",
    body: data,
  })
    .then((response) => response.text())
    .then((data) => {
      //LE PRODUCTO NO SE ENCONTRO
      if (data == 0) {
        //alerta
        let timerInterval;
        Swal.fire({
          title: "El producto no encontrado",
          html: "El producto que esta buscando no esta disponible o no existe, por favor ingrese de nuevo!",
          icon: "error",
          timer: 5000,
          timerProgressBar: true,
          didOpen: () => {
            Swal.showLoading();
          },
          willClose: () => {
            clearInterval(timerInterval);
          },
        });
      } else {
        $(".P_info").remove();
        $(".paginacion").remove();
        $(".Prod").append(data);
      }
    });
});
