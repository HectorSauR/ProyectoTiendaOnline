const btnRegistro = document.querySelector('#btnRegistrar')
//document.querySelector(".examinar").addEventListener("click",(e) => {
//document.querySelector(".img-elg").click();
//})
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


  
  
  //LOGICA PARA EL FORMULARIO
  document.querySelector("#formRegistroCategoria").addEventListener("submit", (e) => {
    e.preventDefault()
  
    //DATOS DEL FORMULARIO
    var data = new FormData(e.target);

    console.log(data.get("imagen").name)
  if (data.get("imagen").name==""){
    Swal.fire(
      'Error al registrar producto.',
      'Tienes que elegir una imagen para el producto',
      'error'
    )
  }else{

    btnRegistro.classList.toggle('deshabilitarBtnRegistro')
//VERIFICAR SI USUARIO INGRESADO EXISTE EN LA BD
fetch("../../recursos/PHP/metodos/verificarProductoRegistrado.php", {
  method: 'POST',
  body: data
}).then(response => response.text()).then(data => {
  if (data == "1") {
    btnRegistro.classList.toggle('deshabilitarBtnRegistro')
    Swal.fire(
      'Error al registrar producto.',
      'Es posible que el producto ya este registrado con ese nombre verifique',
      'error'
    )
  } else {
    //PROCESAR LOS DATOS A PHP
    //alert(data.get("imagen").name);
    var data = new FormData(e.target);

    

    fetch("registrarP.php", {
      method: 'POST',
      body: data
    }).then(response => response.text()).then(data => {
      btnRegistro.classList.toggle('deshabilitarBtnRegistro')
      console.log(data);
      if (data == "1") {
        Swal.fire(
          'El producto fue registrado.',
          '',
          'success'
        )


        
    document.querySelector("#txtcat").value = 1;
    document.querySelector("#txtnom").value = "";
    document.querySelector("#txtprecc").value = "";
    document.querySelector("#txtprecv").value = "";
    document.querySelector("#txtstock").value = "";
    document.querySelector("#txtstockm").value = "";
    document.querySelector("#txtcb").value = "";
    document.querySelector("#txtstatus").value = 1;
    document.querySelector(".imagenselec").src="../../recursos/imagenes/regalo.png";
    console.log();
    
      } else {
        Swal.fire(
          'Error al registrar Producto.',
          'porfavor verifique los datos ingresados en el formulario',
          'error'
        )
      }

    })
  }
})

  }
    
  
  
  
  
  
  })
  