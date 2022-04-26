<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Producto</title>
    <link rel="stylesheet" href="../../recursos/cssprincipal/style.css">
    <link rel="stylesheet" href="RegistroDeProducto.css">
</head>
<body>
   
    <?php include '../../recursos/nav/nav.php' ?>
    <div class="main">
        <h1>REGISTRO DE PRODUCTO</h1>
        <div class="contenido">
            <div class="input">
                <form>
                   <div>
                       <label for="name">Nombre: </label>
                       <input type="text">
                   </div>
                   <div>
                    <label for="name">Descripcion: </label>
                    <input type="text">
                </div>
                <div>
                    <label for="name">Precio Venta: </label>
                    <input type="number" >
                </div>
                <div>
                    <label for="name">Precio Compra: </label>
                    <input type="number">
                </div>
                <div>
                    <label for="name">Categoria: </label>
                    <select name="" id=""></select>
                </div>
                <div>
                    <label for="name">Cantidad: </label>
                    <input type="text">
                </div>
                <div>
                    <label for="name">Unidad De Medida: </label>
                    <input type="text">
                </div>
                <div>
                    <label for="name">Estatus: </label>
                    <select name="" id=""></select>
                </div>
                </form>
            </div>
            <div class="img">
                <img src="#" alt="#">
                <div class="btn_examinar">
                    <input type="button" class="btn" value="Examinar">
                </div>
            </div>
            <div class="btn_registrar">
                <input type="button" class="btn" value="Registrar">
            </div>
        </div>   
    </div>
</body>
</html>