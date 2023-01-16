var data = new FormData();

fetch("../../recursos/PHP/metodos/consultarVenta.php", {
  method: "POST",
  body: data,
})
  .then((res) => res.json())
  .then((data) => {
    fecha = data[0].FECHA;
    formaPago = data[0].ID_FORMA_PAGO == "1" ? "Efectivo" : "transferencia";
    console.log(data);
    console.log(fecha);
    console.log(formaPago);

    document.querySelector(".row-table").innerHTML = "";
    for (var item of data) {
      var total = parseFloat(item.PRECIO) * parseInt(item.CANTIDAD);
      total = total + total * 0.16;

      document.querySelector(".row-table").innerHTML += `
      <tr>
        <td>${item.ID_VENTA}</td>
        <td>${item.FECHA}</td>
        <td>${item.ID_PRODUCTO}</td>
        <td>${item.CANTIDAD}</td>
        <td>${item.PRECIO}</td>
        <td>${total}</td>
      </tr>


      `;
    }
  });

$(document).ready(function () {
  $("#table_id").DataTable({
    paging: false,
    searching: false,
    info: false,
  });
});

//VARIABLES
let fecha, usuario, formaPago, importe;
document.querySelector(".btn-buscar-venta").addEventListener("click", () => {
  const id = document.querySelector("#venta").value;

  if (id == "") {
    Swal.fire("ERROR!", "iNGRESE EL ID DE LA VENTA", "error");
  } else {
    var data = new FormData();
    data.append("opc", "1");
    data.append("id", id);
    fetch("../../recursos/PHP/metodos/obtenerInfoVenta.php", {
      method: "POST",
      body: data,
    })
      .then((res) => res.json())
      .then((data) => {
        fecha = data[0].FECHA;
        formaPago = data[0].ID_FORMA_PAGO == "1" ? "Efectivo" : "transferencia";
        console.log(data);
        console.log(fecha);
        console.log(formaPago);

        document.querySelector(".row-table").innerHTML = "";
        for (var item of data) {
          var total = parseFloat(data[0].PRECIO) * parseInt(data[0].CANTIDAD);

          document.querySelector(".row-table").innerHTML += `
            <tr>
              <td>${item.ID_VENTA}</td>
              <td>${item.FECHA}</td>
              <td>${item.ID_PRODUCTO}</td>
              <td>${item.CANTIDAD}</td>
              <td>${item.PRECIO}</td>
              <td>${total}</td>
            </tr>


            `;
        }
      });
  }
});
