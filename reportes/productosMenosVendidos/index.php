
<?php // include '../../recursos/PHP/configuracionDelSitioWeb/conf.php' ?>
<?php //include '../../recursos/PHP/metodos/verificarSesionUsuario.php' ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link rel="stylesheet" href="estilo.css">
    <title>Document</title>
</head>
<body>
<?php include '../../recursos/nav/nav.php' ?>


<div class="main">
 
<h2>REPORTE DE PRODUCTOS MENOS VENDIDOS</h2>

<form action="" class="formulario">

    <div>
        <label for="categorias">Categoría</label>

        <select class="categorias" >
            <option selected disabled ></option>
            <option value="opc1">OPC1</option>
            <option value="opc2">OPC2</option>
            <option value="opc3">OPC3</option>
        </select>
    </div>
    
     <div>
        <label for="estatus">Estatus</label>

        <select class="estatus" >
            <option selected disabled ></option>
            <option value="act">Activo</option>
            <option value="fdl">Fuera de linea</option>
        </select>
     </div>
     <div>
         <label for="NProducto">Numero de producto</label>
         <input type="number" name="NProducto" id="NProducto">
     </div>

     <input type="button" value="Generar reporte" id="btn-generarReporte">
   
</form>


<div class="exportar">
    <h4>Exportar como:</h4>
    <!-- CAMBIAR -->
    <a href="#"><img src="../../imagenes/PDF IMG.png" alt=""></a>
    <a href="#"><img src="../../imagenes/EXCEL IMG.png" alt=""></a>
</div>



<div class="tabla-consulta">

    <table class="ProductosMasVendidos" id="tbl-ProductMasVendidos">
         <thead>
             <tr>
                 <td>Codigo</td>
                 <td>Nombre</td>
                 <td>Unidad de medida</td>
                 <td>Stock</td>
                 <td>precio de venta</td>
                 <td>Cantidad vedida</td>
             </tr>
         </thead>
     <tbody>
        <tr>
            <td>1</td>
            <td>1</td>
            <td>1</td>
            <td>1</td>
            <td>1</td>
            <td>1</td>
        </tr>
        <tr>
            <td>2</td>
            <td>2</td>
            <td>2</td>
            <td>2</td>
            <td>2</td>
            <td>2</td>
        </tr>
        <tr>
            <td>3</td>
            <td>3</td>
            <td>3</td>
            <td>3</td>
            <td>3 </td>
            <td>3</td>
        </tr>
     </tbody>
     </table>
</div>

</div>

</body>
</html>