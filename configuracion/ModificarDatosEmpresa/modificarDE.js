
  
fetch('../../recursos/PHP/metodos/buscardatosEmpresaBd.php').then(res => res.json()).then(data => {

  //data = JSON.parse(data);

  for (var item of data) {
document.getElementById("txtnom").value = item.NOMBRE;
document.getElementById("imagenselec").src = item.LOGO;
document.getElementById("txtslogan").value = item.SLOGAN;
document.getElementById("txtDesc").value = item.DESCRIPCION;
document.getElementById("txttelefono").value = item.TELEFONO;
document.getElementById("txtcorreo").value = item.CORREO;
document.getElementById("txtweb").value = item.WEBSITE;
document.getElementById("txtfac").value = item.FACEBOOK;
document.getElementById("txttw").value = item.TWITER;

  }

})
  
  
  
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
        e.target.src="https://bluemadness.000webhostapp.com/img_proyecto/logo_empresa.png";
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


  document.querySelector(".contenido").addEventListener("submit", (e) => {
    e.preventDefault()
  
  
    
  
        var data = new FormData(e.target);

       if (data.get("txtnom")=="" || data.get("txtslogan")=="" || data.get("txtDesc")=="" || data.get("txttelefono")=="" || data.get("txtcorreo")=="" || data.get("txtweb")=="" || data.get("txtfac")=="" || data.get("txttw")=="" ) {
        Swal.fire({
          title: 'Falto un campo por completar estas seguro que quieres guardar?',
          showDenyButton: true,
          showCancelButton: true,
          confirmButtonText: 'Save',
          denyButtonText: `Don't save`,
        }).then((result) => {
          /* Read more about isConfirmed, isDenied below */
          if (result.isConfirmed) {
            fetch("modificarDE.php", {
              method: 'POST',
              body: data
            }).then(response => response.text()).then(data => {
      
              console.log(data);
              if (data == "1") {
                Swal.fire(
                  'Se a realizado la modificación.',
                  '',
                  'success'
                )
                setTimeout(funcionConRetraso, 3000);
                
              } else {
                Swal.fire(
                  'Error al modificar datos.',
                  'porfavor verifique los datos ingresados en el formulario',
                  'error'
                )
              }
      
            })
           
          } else if (result.isDenied) {
            Swal.fire('Los cambios no se han guardado', '', 'info')
            setTimeout(funcionConRetraso, 2000);
          }
        })
       }else{
        fetch("modificarDE.php", {
          method: 'POST',
          body: data
        }).then(response => response.text()).then(data => {
  
          console.log(data);
          if (data == "1") {
            Swal.fire(
              'Se a realizado la modificación.',
              '',
              'success'
            )
            setTimeout(funcionConRetraso, 3000);
            
          } else {
            Swal.fire(
              'Error al modificar datos.',
              'porfavor verifique los datos ingresados en el formulario',
              'error'
            )
          }
  
        })
       }


        
       
    })
  

  
    
    function funcionConRetraso() {
      window.location.reload();
    }
  
  
  
  
  
  