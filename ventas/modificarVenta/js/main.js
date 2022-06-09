

fetch('../../recursos/PHP/metodos/buscarVentaBD.php').then(res => res.json()).then(data => {

    for (var item of data) {

      //VERIFICAR EL NIVEL DE PRIVILEGIO
    
      document.querySelector(".contenedor-ventasD").innerHTML +=
      `

        <div class="contenedor-ventas" id="contenedor-ventas">
          <div class="id-venta">
            <p>${item.ID_VENTA}</p>
          </div>
          <div class="usuario">
            <p>${item.ID_USUARIO}</p>
          </div>
          <div class="forma_pago">
            <p>${item.ID_FORMA_PAGO}</p>
          </div>
          <div class="fecha" >
            <p>${item.FECHA}</p>
          </div>
          <div class="id_prd">
            <p>${item.ID_PRODUCTO}</p>
          </div>
          <div class="cantidad">
          <p>${item.CANTIDAD}</p>
          </div>
          <div class="precio">
          <p>${item.PRECIO}</p>
          </div>
          <div class="status">
          <p>${item.ID_ESTATUS}</p>
          </div>
          <div class="opcion" >
            <button class="editarS">Editar</button>
            <input class="eliminarS" type="button" value="Eliminar">
          </div>

        </div>
      `
     // 
    }



    document.getElementById("main").addEventListener("click",(e)=>{
      //EDITAR USUARIO
      
       console.log(e.target);

  //       let opcion = document.querySelectorAll(".opcion");
  //   opcion.forEach((btn) =>  {
  // btn.addEventListener("click", () =>{

    



    if(e.target.className == "editarS"){
      //var imgCodificada;


      document.querySelector(".contenedor-modal").style.display = "flex";
      var contenedor = e.target.parentNode.parentNode



      var idventa = contenedor.querySelector(".id-venta > p").innerText;

     // alert(idprd)
       var usuario = contenedor.querySelector(".usuario > p").innerText;
       var forma_pago = contenedor.querySelector(".forma_pago > p").innerText;
       var fecha = contenedor.querySelector(".fecha > p").innerText;
       var id_prd = contenedor.querySelector(".id_prd > p").innerText;
       var cantidad = contenedor.querySelector(".cantidad > p").innerText;
       var precio = contenedor.querySelector(".precio > p").innerText;
       var status = contenedor.querySelector(".status > p").innerText;

     // console.log(contenedor)
     
     document.getElementById("usuario").value = usuario
     document.getElementById("forma_pago").value = forma_pago
     document.getElementById("fecha").value = fecha
     document.getElementById("id_prd").value = id_prd
     document.getElementById("cantidad").value = cantidad
     document.getElementById("precio").value = precio
     document.getElementById("status").value = status


     
     

// ---------------------



      //console.log(status);


    //  if (status == 1){
    //   document.getElementById("status").value = 1
    //  }else if (status == 2){
    //   document.getElementById("status").value = 2
    //  }else if (status == 3){
    //   document.getElementById("status").value = 3
    //  }else if (status == 4){
    //   document.getElementById("status").value = 4 
    //  }
     

      document.getElementById("formEditarVenta").addEventListener("submit",(e)=>{
        e.preventDefault()

        var data = new FormData(e.target);
        //data.append("id" ,idventa)
        
        
        
        console.log(data.get("usuario"))
        fetch("../../recursos/PHP/metodos/verificarUsuarioRegistradoxId.php", {
          method: 'POST',
          body: data
        }).then(response => response.text()).then(data =>{
          console.log(data);
          if (data == "0") {
            Swal.fire(
              'El usuario no se encontro.',
              'Usuario no encontrado',
              'error'
            )
            
          } else{
            var data = new FormData(e.target);
            fetch("../../recursos/PHP/metodos/verificarProductoRegistradoxId.php", {
              method: 'POST',
              body: data
            }).then(response => response.text()).then(data =>{
              console.log(data);
              if (data == "0") {
                Swal.fire(
                  'El producto no se encontro.',
                  'Producto no encontrado',
                  'error'
                )
               
              }else{
                var data = new FormData(e.target);
                data.append("id" ,idventa)
            
        
                fetch("../../recursos/PHP/metodos/EditarVentaBD.php", {
                  method: 'POST',
                  body: data
                }).then(response => response.text()).then(data =>{
                  document.querySelector(".contenedor-modal").style.display = "none";
                  window.location.reload();
                })
        
              } 
            })
          }
        })

      




       


      })

    }
    //DAR DE BAJA A USUARIO
    else if(e.target.className == "eliminarS"){


      
    }else if (e.target.className == "btnBuscar"){
     //alert(e.target);
      var data2 = new FormData();
     var idB =  document.querySelector(".inpbuscar").value;
      data2.append("id_v_b", idB)
      fetch("../../recursos/PHP/metodos/BuscarVentaBDxId.php", {
        method: 'POST',
        body: data2
      }).then(response => response.text()).then(data2 =>{
        data2 = JSON.parse(data2);
        
        for (var item of data2) {
       
          //VERIFICAR EL NIVEL DE PRIVILEGIO
        
          document.querySelector(".contenedor-ventasD").innerHTML =
          `
    
          <div class="contenedor-ventas" id="contenedor-ventas">
          <div class="id-venta">
            <p>${item.ID_VENTA}</p>
          </div>
          <div class="usuario">
            <p>${item.ID_USUARIO}</p>
          </div>
          <div class="forma_pago">
            <p>${item.ID_FORMA_PAGO}</p>
          </div>
          <div class="fecha" >
            <p>${item.FECHA}</p>
          </div>
          <div class="id_prd">
            <p>${item.ID_PRODUCTO}</p>
          </div>
          <div class="cantidad">
          <p>${item.CANTIDAD}</p>
          </div>
          <div class="precio">
          <p>${item.PRECIO}</p>
          </div>
          <div class="status">
          <p>${item.ID_ESTATUS}</p>
          </div>
          <div class="opcion" >
            <button class="editarS">Editar</button>
            <input class="eliminarS" type="button" value="Eliminar">
          </div>

        </div>
          `
         // 
        }
    
      })
    }else{

    }
    
  });
});


        //LOGICA PARA EDITAR USUARIO

     

//     })
// }) //FIN DE FETCH


document.getElementById("btnCancelarEditarUsuario").addEventListener("click", ()=>{
  document.querySelector(".contenedor-modal").style.display = "none";
  window.location.reload();
//  data.append("id","")
//   data.append("categoria","")
//   data.append("nombre","")
//  data.append("imagen","")
//  data.append("img_env","")
//   data.append("precioc","")
//   data.append("precio","")
//   data.append("stock","")
//   data.append("stockm","")
//   data.append("status","")


//   console.log(data.get("id"))
//   console.log(data.get("categoria"))
//   console.log(data.get("nombre"))
//   console.log(data.get("imagen"))
//   console.log(data.get("img_env"))
//   console.log(data.get("precioc"))
//   console.log(data.get("precio"))
//   console.log(data.get("stock"))
//   console.log(data.get("stockm"))
//   console.log(data.get("status"))
  
})









