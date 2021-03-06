

fetch('../../recursos/PHP/metodos/obtenerUsuariosBD.php').then(res => res.json()).then(data => {




    for (var item of data) {

      //VERIFICAR EL NIVEL DE PRIVILEGIO
      var nivel = ""
      if(item.NIVEL == "0"){
        nivel = "Cliente"
      }else if(item.NIVEL == "1"){
        nivel = "Admin"
      }else{
        nivel = "Ventas"
      }
      document.querySelector(".contenedor-tabla-usuarios").innerHTML +=
      `
        <div class="contenedor-usuarios" id="contenedor-usuarios">
          <div class="nombre">
            <p>${item.NOMBRE}</p>
          </div>
          <div class="usuario">
            <p>${item.USUARIO}</p>
          </div>
          <div class="contra">
            <p>${item.CONTRA}</p>
          </div>
          <div class="correo">
            <p>${item.CORREO}</p>
          </div>
          <div class="nivel">
            <p>${nivel}</p>
          </div>
          <div class="opcion">
            <button>Editar</button>
            <input type="button" value="Eliminar">
          </div>
        </div>
      `


    }
    document.querySelector(".contenedor-tabla-usuarios").addEventListener("click",(e)=>{
      //EDITAR USUARIO
      if(e.target.tagName == "BUTTON"){
        document.querySelector(".contenedor-modal").style.display = "flex";
        var contenedor = e.target.parentNode.parentNode

        console.log(contenedor)
        var nombre = contenedor.querySelector(".nombre p").innerText
        var usuario = contenedor.querySelector(".usuario p").innerText
        var contra = contenedor.querySelector(".contra p").innerText
        var correo = contenedor.querySelector(".correo p").innerText
        var nivel = contenedor.querySelector(".nivel p").innerText

        document.getElementById("nombre").value = nombre
        document.getElementById("usuario").value = usuario
        document.getElementById("clave").value = contra
        document.getElementById("correo").value = correo
        document.getElementById("nivel").value = nivel



        //LOGICA PARA EDITAR USUARIO

        document.getElementById("formEditarUsuario").addEventListener("submit",(e)=>{
          e.preventDefault()

          var data = new FormData(e.target);
          data.append("id" ,usuario)



          if(data.get("nivel") == "Cliente"){
            data.append("nivelN" ,"0")
          }else if(data.get("nivel") == "Admin"){
            data.append("nivelN" ,"1")
          }else{
            data.append("nivelN" ,"2")
          }

          fetch("../../recursos/PHP/metodos/EditarUsuarioBD.php", {
            method: 'POST',
            body: data
          }).then(response => response.text()).then(data =>{
            document.querySelector(".contenedor-modal").style.display = "none";
            window.location.reload();
          })



        })

      }
      //DAR DE BAJA A USUARIO
      else if(e.target.tagName == "INPUT"){
        var contenedor = e.target.parentNode.parentNode
        var usuario = contenedor.querySelector(".usuario p").innerText
        var data = new FormData();
        data.append("id" ,usuario)


        fetch("../../recursos/PHP/metodos/eliminarUsuario.php", {
          method: 'POST',
          body: data
        }).then(res => res.text()).then(data => {

          if(data == "2"){
            Swal.fire(
              'El sistema no puede quedarse sin usuarios',
              '',
              'error')
          }else{
            window.location.reload();
          }


        })

      }

    })
}) //FIN DE FETCH


document.getElementById("btnCancelarEditarUsuario").addEventListener("click", ()=>{
  document.querySelector(".contenedor-modal").style.display = "none";
})
