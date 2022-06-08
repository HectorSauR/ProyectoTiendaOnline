
//document.querySelector(".examinar").addEventListener("click",(e) => {
//document.querySelector(".img-elg").click();
//})
  
   document.querySelector("#img-elg").addEventListener("change", (e) => {
    console.log(e.target.files)
    var imagen = e.target.files[0]
    var archivosSoportados = ['image/jpeg', 'image/png', 'image/jpg']
  
    var seEncontraronElementoNoValidos = false
  
    if (archivosSoportados.indexOf(imagen.type) != -1) {
      //VISTA PREVIA DE IMAGEN
      var imgCodificada = URL.createObjectURL(imagen)
  
      document.querySelector(".imagen .imgelg .img-mostrar").innerHTML =
        `
        <img src="${imgCodificada}" alt="" class="imagenselec" name="imagenselec">
      `
  
      document.querySelector(".main .contenido .imagen .imgelg .img-mostrar .imagenselec").addEventListener("click", (e) => {
        e.target.src="../../recursos/imagenes/regalo.png";
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
  document.querySelector(".contenido").addEventListener("submit", (e) => {
    e.preventDefault()
  
    //DATOS DEL FORMULARIO
    var data = new FormData(e.target);

    
  
    
  
    //VERIFICAR SI USUARIO INGRESADO EXISTE EN LA BD
    fetch("../../recursos/PHP/metodos/verificarProductoRegistrado.php", {
      method: 'POST',
      body: data
    }).then(response => response.text()).then(data => {
      if (data == "1") {
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
  
          console.log(data);
          if (data == "1") {
            Swal.fire(
              'El producto fue registrado.',
              '',
              'success'
            )
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
  
  
  
  
  
  })
  