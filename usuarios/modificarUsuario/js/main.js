//ARRAY usuarios 
var arrayUsuarios;

fetch("../../recursos/PHP/metodos/obtenerUsuariosBD.php")
  .then((res) => res.json())
  .then((data) => {
    arrayUsuarios = data
    mostrarUsuariosDom(arrayUsuarios);

    document
      .querySelector(".contenedor-tabla-usuarios")
      .addEventListener("click", (e) => {
        //EDITAR USUARIO
        if (e.target.tagName == "BUTTON") {
          document.querySelector(".contenedor-modal").style.display = "flex";
          var contenedor = e.target.parentNode.parentNode;

          //console.log(contenedor);
          var nombre = contenedor.querySelector(".nombre p").innerText;
          var usuario = contenedor.querySelector(".usuario p").innerText;
          var imagen = contenedor.querySelector(".imagen > p").innerText;
          var contra = contenedor.querySelector(".contra p").innerText;
          var correo = contenedor.querySelector(".correo p").innerText;
          var nivel = contenedor.querySelector(".nivel p").innerText;

          document.getElementById("nombre").value = nombre;
          document.getElementById("usuario").value = usuario;
          document.getElementById("imagen").value = imagen;
          document.getElementById("clave").value = contra;
          document.getElementById("correo").value = correo;
          document.getElementById("nivel").value = nivel;

          //LOGICA PARA EDITAR USUARIO

          document
            .getElementById("formEditarUsuario")
            .addEventListener("submit", (e) => {
              e.preventDefault();

              var data = new FormData(e.target);
              data.append("id", usuario);

              if (data.get("nivel") == "Cliente") {
                data.append("nivelN", "0");
              } else if (data.get("nivel") == "Admin") {
                data.append("nivelN", "1");
              } else {
                data.append("nivelN", "2");
              }

              fetch("../../recursos/PHP/metodos/EditarUsuarioBD.php", {
                method: "POST",
                body: data,
              })
                .then((response) => response.text())
                .then((data) => {
                  document.querySelector(".contenedor-modal").style.display =
                    "none";
                  console.log(data);
                  window.location.reload();
                });
            });
        }
        //DAR DE BAJA A USUARIO
        else if (e.target.tagName == "INPUT") {
          var contenedor = e.target.parentNode.parentNode;
          var usuario = contenedor.querySelector(".usuario p").innerText;
          var data = new FormData();
          data.append("id", usuario);

          fetch("../../recursos/PHP/metodos/eliminarUsuario.php", {
            method: "POST",
            body: data,
          })
            .then((res) => res.text())
            .then((data) => {
              if (data == "2") {
                Swal.fire(
                  "El sistema no puede quedarse sin usuarios",
                  "",
                  "error"
                );
              } else {
                window.location.reload();
              }
            });
        }
      });
  }); //FIN DE FETCH

document
  .getElementById("btnCancelarEditarUsuario")
  .addEventListener("click", () => {
    document.querySelector(".contenedor-modal").style.display = "none";
  });

  //MOSTRAR HEADER TABLA USUARIOS 
  function mostrarHeaderTablaUsuarios(){
    document.querySelector(".contenedor-tabla-usuarios").innerHTML = `
    <div class="contenedor-usuarios">
        <div class="header-nombre">
          <p>Nombre</p>
        </div>
        <div class="header-usuario">
          <p>Usuario</p>
        </div>
        <div class="header-imagen">
          <p>IMAGEN</p>
                  <!-- <img src="../../recursos/imagenes/productos/mcr/mcr.jpg" alt="asdasd"> -->
        </div>
        <div class="header-contra">
          <p>Contraseña</p>
        </div>

        <div class="header-correo">
          <p>Correo</p>
        </div>

        <div class="header-nivel">
          <p>Nivel</p>
        </div>

        <div class="header-opcion">
          <p>Opcion</p>
        </div>
      </div>
    
      `
  }

  //FUNCION PARA RECORRER USUARIOS Y MOSTRARLOS EN PANTALLA
  function mostrarUsuariosDom(data){
    mostrarHeaderTablaUsuarios()
    
    for (var item of data) {
      //VERIFICAR EL NIVEL DE PRIVILEGIO
      var nivel = "";
      if (item.NIVEL == "0") {
        nivel = "Cliente";
      } else if (item.NIVEL == "1") {
        nivel = "Admin";
      } else {
        nivel = "Ventas";
      }
      document.querySelector(".contenedor-tabla-usuarios").innerHTML += `
        <div class="contenedor-usuarios" id="contenedor-usuarios">
          <div class="nombre">
            <p>${item.NOMBRE}</p>
          </div>
          <div class="usuario">
            <p>${item.USUARIO}</p>
          </div>
          <div class="imagen" >
          <img src="../../${item.IMAGEN}" width="60" height="60" alt="IMAGEN">
          <p>${item.IMAGEN}</p>

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
      `;
    }
  }

  const formBuscarUsuario = document.querySelector(".contenedor-buscar");

  formBuscarUsuario.addEventListener("submit",(e)=>{
    e.preventDefault()

    var data = new FormData(e.target)

    var busqueda = data.get("inputNombreUsuario").toUpperCase()

    var longitudBusqueda = busqueda.length

  var usuarioEncontrado = false

  var nombreUsuario;


  document.querySelector(".contenedor-tabla-usuarios").innerHTML = ""
  mostrarHeaderTablaUsuarios()

  for(var i =0; i < arrayUsuarios.length; i++){
    nombreUsuario = arrayUsuarios[i].NOMBRE.toUpperCase()
    for(var j = 0; j < nombreUsuario.length; j++){
      if(nombreUsuario.substring(j,longitudBusqueda + j) == busqueda){
        usuarioEncontrado = true

         //VERIFICAR EL NIVEL DE PRIVILEGIO
      var nivel = "";
      if (arrayUsuarios[i].NIVEL == "0") {
        nivel = "Cliente";
      } else if (arrayUsuarios[i].NIVEL == "1") {
        nivel = "Admin";
      } else {
        nivel = "Ventas";
      }
        //MOSTRAMOS USUARIO 
        document.querySelector(".contenedor-tabla-usuarios").innerHTML += `
        <div class="contenedor-usuarios" id="contenedor-usuarios">
        <div class="nombre">
          <p>${arrayUsuarios[i].NOMBRE}</p>
        </div>
        <div class="usuario">
          <p>${arrayUsuarios[i].USUARIO}</p>
        </div>
        <div class="imagen" >
        <img src="../../${arrayUsuarios[i].IMAGEN}" alt="asdasd">
        <p>${arrayUsuarios[i].IMAGEN}</p>

      </div>
        <div class="contra">
          <p>${arrayUsuarios[i].CONTRA}</p>
        </div>
        <div class="correo">
          <p>${arrayUsuarios[i].CORREO}</p>
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
    }
  }

  //--A
  if(!usuarioEncontrado){
    Swal.fire(
      'Error al buscar usuario.',
      'Ningun usuario fue encontrado con ese nombre.',
      'error'
    )
  }

    //console.log(buscarUsuario)


  })


  //EVENTO CHANGE DE INPUT BUSCAR PRODUCTO
document.getElementById("inputNombreUsuario").addEventListener("keyup",(e)=>{
  if(e.target.value == ""){
    mostrarUsuariosDom(arrayUsuarios)
  }
})

  //BUSCAR USUARIO POR NOMBRE 
  function mostrarUsuariosPorNombre(data){

  }
