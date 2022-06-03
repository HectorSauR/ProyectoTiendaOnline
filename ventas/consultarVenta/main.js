$(document).ready(function () {
  $("#table_id").DataTable({
    paging: false,
    searching: false,
    info: false,
  });
});

//VARIABLES
let fecha ,usuario ,formaPago ,importe
document.querySelector(".btn-buscar-venta").addEventListener("click",()=>{

    const id = document.querySelector("#venta").value;

    if(id == ""){
      Swal.fire(
        'ERROR!',
        'iNGRESE EL ID DE LA VENTA',
        'error'
      )
    }else{

      var data = new FormData()
      data.append("id",id)
      fetch("../../recursos/PHP/metodos/obtenerInfoVenta.php" ,{
        method:"POST",
        body:data
      }).then(res => res.json()).then(data => {

        fecha = data[0].FECHA
        formaPago = (data[0].ID_FORMA_PAGO == "1") ? "Efectivo" : "transferencia"
        console.log(data)
        console.log(fecha)
        console.log(formaPago)



      })
    }


})
