//Registrar Cotizacion
document.querySelector(".TOTAL").addEventListener("submit", (e) => {
  e.preventDefault();

  //OBTENER DATOS DEL FORM
  var data = new FormData(e.target);
  alert("entro");

  //VERIFICA QUE HAY STOCK DEL PRODUCTO
  fetch("./php/registrarCotizacion.php", {
    method: "POST",
    body: data,
  })
    .then((response) => response.text())
    .then((data) => {
      //alerta
      let timerInterval;
      Swal.fire({
        title: "Cotizacion registrada con exito",
        html: "La cotizacion fue registrada con exito!",
        icon: "success",
        timer: 3000,
        timerProgressBar: true,
        didOpen: () => {
          Swal.showLoading();
        },
        willClose: () => {
          clearInterval(timerInterval);
        },
      });
    });
});
