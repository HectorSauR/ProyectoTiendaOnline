//Registrar Cotizacion
document.querySelector(".TOTAL").addEventListener("submit", (e) => {
  e.preventDefault();

  //OBTENER DATOS DEL FORM
  var data = new FormData(e.target);

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

      var doc = new jsPDF({
        orientation: "landscape",
        format: "a2",
        precision: 3,
      });

      //OBTENER DATOS DEL FORM
      var data = new FormData(e.target);

      doc.text("COTIZACION", 30, 30);

      var elementHTML = $(".table").html();
      var specialElementHandlers = {
        "#elementH": function (element, renderer) {
          return true;
        },
      };
      doc.fromHTML(elementHTML, 30, 30, {
        width: 170,
        elementHandlers: specialElementHandlers,
      });

      // Save the PDF
      doc.save("document.pdf");
    });
});
