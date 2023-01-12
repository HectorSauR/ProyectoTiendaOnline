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

  fetch("./php/registrarCotizacion.php", {
    method: "POST",
    body: data,
  })
    .then((response) => response.text())
    .then(async(data) => {
      //alerta
      console.log(data)

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
      //OBTENER DATOS DEL HTML
      var info = new FormData();
      let email = document.getElementById('email_cliente').value
      let nombre = document.getElementById('nombre_cliente').value
      let total = document.getElementById('total_cotizacion').innerText
      
      info.append('correo', email)
      info.append('nombre', nombre)
      info.append('id_cot', data)
      info.append('total', total)

      fetch("./php/mandarCorreo.php", {
        method: "POST",
        body: info,
      })
        .then((response) => response.text())
        .then((data) => {
          let URLactual = window.location
          
          let url = URLactual + 'php/pdfs/' + data

          window.open(url, "_blank");

          setTimeout("document.location.reload()", 3000);
        })
    });
});
