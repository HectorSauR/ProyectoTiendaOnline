const btnRegistro = document.querySelector('#btnRegistrar')


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
 

  btnRegistro.classList.toggle('deshabilitarBtnRegistro')
  //DATOS DEL FORMULARIO
  var data = new FormData(e.target);

 
  //VALIDAR INPUT POR SEGURIDAD
  if(data.get('nombre') == "" || data.get('nombre').length < 2){
    Swal.fire(
      'Error en formulario.',
      'Campo nombre incorrecto ,verifique el formato solicitado',
      'error'
    )
    btnRegistro.classList.toggle('deshabilitarBtnRegistro')
    return false
  }

  if(data.get('usuario') == "" || data.get('usuario').length < 4){
    Swal.fire(
      'Error en formulario.',
      'Campo usuario incorrecto ,verifique el formato solicitado',
      'error'
    )
    btnRegistro.classList.toggle('deshabilitarBtnRegistro')
    return false

  }

  if(data.get('clave') == "" || data.get('clave').length < 8){
    Swal.fire(
      'Error en formulario.',
      'Campo clave incorrecto ,verifique el formato solicitado',
      'error'
    )
    btnRegistro.classList.toggle('deshabilitarBtnRegistro')
  return false
    }


    const regExp = /[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?/g;
    if(data.get('correo') == "" || !regExp.test(data.get('correo'))){
      Swal.fire(
        'Error en formulario.',
        'Campo correo incorrecto ,verifique el formato solicitado',
        'error'
      )
      btnRegistro.classList.toggle('deshabilitarBtnRegistro')
      return false
    }




  if (data.get("imagen").name==""){
    Swal.fire(
      'Error al registrar producto.',
      'Tienes que elegir una imagen para el producto',
      'error'
    )
    btnRegistro.classList.toggle('deshabilitarBtnRegistro')
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
        btnRegistro.classList.toggle('deshabilitarBtnRegistro')
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
            console.log(data)
            Swal.fire(
              'Error al registrar usuario.',
              'El correo electronico no esta disponible.',
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