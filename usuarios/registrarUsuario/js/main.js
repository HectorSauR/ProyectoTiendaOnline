document.querySelector("#activarAgreagarImagen").addEventListener("click", () => {
  document.querySelector("#agregarImagen").click();
})

document.querySelector("#agregarImagen").addEventListener("change", (e) => {
  console.log(e.target.files)

  var imagen = e.target.files[0]
  var archivosSoportados = ['image/jpeg', 'image/png', 'image/jpg']

  var seEncontraronElementoNoValidos = false

  if (archivosSoportados.indexOf(imagen.type) != -1) {
    //VISTA PREVIA DE IMAGEN
    var imgCodificada = URL.createObjectURL(imagen)

    document.querySelector(".contenedor-imagen .imagen").innerHTML =
      `
      <img src="${imgCodificada}">
    `

    document.querySelector(".main .contenedor-imagen .imagen img").addEventListener("click", (e) => {
      e.target.remove();
    })
  } else {
    seEncontraronElementoNoValidos = true
  }

  if (seEncontraronElementoNoValidos) {
    Swal.fire(
      'El archivo seleccionado no es valido!',
      'Seleccione una imagen con formato jpeg o png',
      'error'
    )
  }
})


//LOGICA PARA EL FORMULARIO
document.querySelector("#formRegistroUsuario").addEventListener("submit", (e) => {
  e.preventDefault()

  //DATOS DEL FORMULARIO
  var data = new FormData(e.target);



  //VERIFICAR SI USUARIO INGRESADO EXISTE EN LA BD
  fetch("../../recursos/PHP/metodos/verificarUsuarioRegistradoBD.php", {
    method: 'POST',
    body: data
  }).then(response => response.text()).then(data => {
    if (data == "1") {
      Swal.fire(
        'Error al registrar usuario.',
        'Usuario no esta disponible',
        'error'
      )
    } else {
      //PROCESAR LOS DATOS A PHP
      //alert(data.get("imagen").name);
      var data = new FormData(e.target);
      fetch("../../recursos/PHP/metodos/registrarUsuarioBD.php", {
        method: 'POST',
        body: data
      }).then(response => response.text()).then(data => {

        if (data == "1") {
          Swal.fire(
            'El usuario fue registrado.',
            '',
            'success'
          )
        } else {
          Swal.fire(
            'Error al registrar usuario.',
            'porfavor verifique los datos ingresados en el formulario',
            'error'
          )
        }

      })
    }
  })





})
