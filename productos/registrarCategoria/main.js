const btnRegistro = document.querySelector('#btnRegistrar')


document.querySelector("#activarAgreagarImagen").addEventListener("click", () => {
  document.querySelector("#agregarImagen").click();
})

document.querySelector("#agregarImagen").addEventListener("change", (e) => {
 

  var imagen = e.target.files[0]
  
    //VISTA PREVIA DE IMAGEN
    var imgCodificada = URL.createObjectURL(imagen)

    document.querySelector(".contenedor-imagen .imagen").innerHTML =
      `
      <img src="${imgCodificada}">
    `

    document.querySelector(".main .contenedor-imagen .imagen img").addEventListener("click", (e) => {
      e.target.remove();
    })
  

 
})


//LOGICA PARA PROCESAR DATOS DE FORM REGISTRO DE CATEGORIA
document.querySelector('#formRegistroCategoria').addEventListener('submit' ,(e)=>{
    e.preventDefault();
    

   //DATOS DEL FORMULARIO
  var data = new FormData(e.target);

  //VALIDACIONES

  if(data.get('nombre') == ""){
    Swal.fire(
        'Campo nombre de categoria no puede quedar vacio.',
        '',
        'error'
      )
      return false
  }
  if(data.get('nombre').length > 20){
    Swal.fire(
        'Campo nombre de categoria , su longitud no puede ser mayor a 20 caracteres.',
        '',
        'error'
      )
      return false
  }

  if(data.get('descripcion') == ""){
    Swal.fire(
        'Campo descripcion , no puede quedar vacio.',
        '',
        'error'
      )
      return false
  }

  if(data.get('descripcion') > 20){
    Swal.fire(
        'Campo descripcion , su longitud no puede ser mayor a 20 caracteres.',
        '',
        'error'
      )
      return false
  }

  if (data.get("imagen").name==""){
    Swal.fire(
      'Tienes que elegir una imagen para la categoria',
      '',
      'error'
    )
   return false
  }


  //TODO CORRECTO CON VALIDACIONES

  btnRegistro.classList.toggle('deshabilitarBtnRegistro')

  //REGISTRAR CATEGORIA
  fetch("../../recursos/PHP/metodos/registrarCategoriaBD.php" ,{
      method:'POST',
      body:data
  }).then(r => r.json()).then(data =>{
      btnRegistro.classList.toggle('deshabilitarBtnRegistro')
      if(data.estado == 'error'){
        Swal.fire(
            '' + data.mensaje ,
            '' ,
            'error'
        )
      }else if(data.estado == 'success'){
        Swal.fire(
            '' + data.mensaje ,
            '' ,
            'success'
        )
        e.target.reset()
      }
      
  })







})
