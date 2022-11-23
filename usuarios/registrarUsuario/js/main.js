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

  //BLOQUEAR BUTTON PARA EVITAR ERROR CON RED
  let btnRegistro = document.querySelector('#btnRegistrar')

  btnRegistro.classList.toggle('deshabilitarBtnRegistro')
  //DATOS DEL FORMULARIO
  var data = new FormData(e.target);

  console.log(data.get("imagen").name);
  if (data.get("imagen").name==""){
    Swal.fire(
      'Error al registrar producto.',
      'Tienes que elegir una imagen para el producto',
      'error'
    )
  }
  else{

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
      }else {
        //PROCESAR LOS DATOS A PHP
        //alert(data.get("imagen").name);
        var data = new FormData(e.target);

        if(data.get("nivel").toUpperCase() == "CLIENTE"){
          data.append("nivelA","0")
        }else if(data.get("nivel").toUpperCase() == "ADMIN"){
          data.append("nivelA","1")
        }else{
          data.append("nivelA","2")
        }
        fetch("../../recursos/PHP/metodos/registrarUsuarioBD.php", {
          method: 'POST',
          body: data
        }).then(response => response.text()).then(data => {
          btnRegistro.classList.toggle('deshabilitarBtnRegistro')

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

  }
})
//LOGJICA PARA HACER FUNCIONAR EL MOSTRAR PASSWORD DE INPUT EN FORMULARIO 
const ojo = document.querySelector(".icon-ojo"); //icono mostrar
const inputPassword = document.getElementById("clave");

ojo.addEventListener("click", ()=> {

  if(inputPassword.type == "password") {
    inputPassword.type = "text"
  }else {
    inputPassword.type = "password"
  }
})


//LOGICA PARA IMPLEMMETAR MODAL PARA INFO DE CAMPOS DE FORMULARIO
document.querySelector('.btn-info-campos-form').addEventListener('click',(e) => {
  

  document.querySelector('.contenedor-info-campos-form').classList.toggle('show-info-campos-form')

})

document.querySelector('.btn-cerrar').addEventListener('click',()=> {
  document.querySelector('.contenedor-info-campos-form').classList.toggle('show-info-campos-form')
})