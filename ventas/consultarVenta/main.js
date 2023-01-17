var data = new FormData();
generarTabla();
function generarTabla() {
  fetch("../../recursos/PHP/metodos/consultarVenta.php", {
    method: "POST",
    body: data,
  })
    .then((res) => res.json())
    .then((data) => {
      document.querySelector(".row-table").innerHTML = "";
      for (var item of data) {
        let total =
          item.Total_Venta + item.Total_Venta * 0.16;

        document.querySelector(".row-table").innerHTML += `
        <tr>
          <td>${item.ID_VENTA}</td>
          <td>${item.NOMBRE}</td>
          <td>${
            item.ID_FORMA_PAGO == 1
              ? "Efectivo"
              : "Transferencia"
          }</td>
          <td>${item.FECHA}</td>
          <td>${item.DESCRIPCION}</td>
          <td>$${total}</td>
        </tr>
  
  
        `;
      }
    });
}

$(document).ready(function () {
  $("#table_id").DataTable({
    paging: false,
    searching: false,
    info: false,
  });
});

//VARIABLES
let fecha, usuario, formaPago, importe;
document
  .querySelector(".btn-buscar-venta")
  .addEventListener("click", () => {
    const id = document.querySelector("#venta").value;

    if (id == "") {
      generarTabla();
    } else {
      var data = new FormData();
      data.append("opc", "1");
      data.append("id", id);
      fetch(
        "../../recursos/PHP/metodos/obtenerInfoVenta.php",
        {
          method: "POST",
          body: data,
        }
      )
        .then((res) => res.json())
        .then((data) => {
          document.querySelector(".row-table").innerHTML =
            "";
          for (var item of data) {
            let total =
              item.Total_Venta + item.Total_Venta * 0.16;

            document.querySelector(
              ".row-table"
            ).innerHTML += `
        <tr>
          <td>${item.ID_VENTA}</td>
          <td>${item.NOMBRE}</td>
          <td>${
            item.ID_FORMA_PAGO == 1
              ? "Efectivo"
              : "Transferencia"
          }</td>
          <td>${item.FECHA}</td>
          <td>${item.DESCRIPCION}</td>
          <td>$${total}</td>
        </tr>
  
  
        `;
          }
        });
    }
  });
