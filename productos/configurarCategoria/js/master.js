//CANFIGURAR CATEOGRIA
document
  .querySelector(".modificarCategoria")
  .addEventListener("submit", (e) => {
    e.preventDefault();

    //OBTENER DATOS DEL FORM
    var data = new FormData(e.target);

    //BUSCAR PRODUCTO EN LA BD
    fetch("./php/modificarCategoria.php", {
      method: "POST",
      body: data,
    })
      .then((response) => response.text())
      .then((data) => {
        //LE PRODUCTO NO SE ENCONTRO
        if (data == 0) {
          //alerta
          let timerInterval;
          Swal.fire({
            title: "Categoria modificada",
            html: "La categoria fue modificada con exito!",
            icon: "success",
            timer: 5000,
            timerProgressBar: true,
            didOpen: () => {
              Swal.showLoading();
            },
            willClose: () => {
              clearInterval(timerInterval);
            },
          });

          setTimeout("document.location.reload()", 3000);
        }
      });
  });
