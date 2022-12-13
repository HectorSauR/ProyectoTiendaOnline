//Registrar Cotizacion
document.querySelector(".TOTAL").addEventListener("submit", (e) => {
  e.preventDefault();

  //OBTENER DATOS DEL FORM
  var data = new FormData(e.target);

  if(document.getElementById('email_cliente') && !document.getElementById('email_cliente').disabled){
    var email = document.getElementById('email_cliente').value;
    var nombre = document.getElementById('nombre_cliente').value;
    if( !email || !nombre){
      let timerInterval;
      Swal.fire({
        title: "Porfavor ingresa tus datos",
        html: "Asegurate de haber ingresado tus datos correctamente.",
        icon: "error",
        timer: 2000,
        timerProgressBar: true,
        didOpen: () => {
          Swal.showLoading();
        },
        willClose: () => {
          clearInterval(timerInterval);
        },
      });
      return
    }
  
    if(!email.match(/^[^@]+@[^@]+\.[a-zA-Z]{2,}$/)){
      let timerInterval;
      Swal.fire({
        title: "Correo inválido",
        html: "Porfavor ingresa un correo valido ej cliente@gmail.com",
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
      return
    }

    data.append('nombre', nombre);
    data.append('email', email);
  }

  //VERIFICA QUE HAY STOCK DEL PRODUCTO
  fetch("./php/registrarCotizacion.php", {
    method: "POST",
    body: data,
  })
    .then((response) => response.text())
    .then(async(data) => {
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
      //OBTENER DATOS DEL HTML
      var data = new FormData();
      let email = document.getElementById('email_cliente').value
      let nombre = document.getElementById('nombre_cliente').value

      let pdf = doc.output()
      // console.log(pdf)
      data.append('tabla', elementHTML)
      data.append('correo', email)
      data.append('nombre', nombre)
      data.append('doc', pdf)

      const response = await fetch("./php/mandarCorreo.php", {
        method: "POST",
        body: data,
      })
      const msg = await response.text()
      console.log(msg)
      // Save the PDF
      doc.save("document.pdf");
      setTimeout("document.location.reload()", 3000);
      // hector.sauceda.01@gmail.com
    });
});
