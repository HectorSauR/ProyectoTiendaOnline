<?php include '../../recursos/PHP/configuracionDelSitioWeb/conf.php' ?>
<?php include '../../recursos/PHP/metodos/verificarSesionUsuario.php' ?>
<?php require 'pmv.php' ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estilo.css">
    <link rel="stylesheet" href="../../recursos/cssprincipal/style.css">
    <title>Productos mas vendidos</title>

    <!-- LINKS PARA EXPORTAR EN EXCEL -->
    <link rel="stylesheet" href="../../iconos/font-awesome-4.7.0/css/font-awesome.min.css">

</head>

<body onload="checkCookie('<?php echo $_SESSION['usuario'] ?>')">
    <script type="text/javascript" src="../../Usuarios/modificarTema/js/master.js"></script>
    <script src='//cdn.jsdelivr.net/npm/sweetalert2@11'></script>
    <?php include '../../recursos/nav/nav.php' ?>

    <div class="main">
            <h2>REPORTE DE PRODUCTOS MÁS VENDIDOS</h2>

            <div class="contenedor-form">
                <form action="" class="formulario">
                    <div class="contenedor-inputs">
                        <label for="categorias">Categoría</label>
                        <select class="categorias">
                            <option selected disabled></option>
                            <?php
                            foreach ($datos as $dat) {
                                echo '<option value="' . $dat['ID_CATEGORIA'] . '">' . $dat['NOMBRE'] . '</option>';
                            } //end foreach
                            ?>
                        </select>
                        <label for="estatus">Estatus</label>
                        <select class="estatus">
                            <option selected disabled></option>
                            <option value="1">Activo</option>
                            <option value="2">Fuera de linea</option>
                        </select>
                        <label for="NProducto">Numero de productos</label>
                        <input type="number" name="NProducto" id="NProducto" class="NProducto">
                        <input type="button" value="Generar reporte" id="btn-generarReporte">
                    </div>
                </form>
                <div id="export" class="contenedor-exports">
                    <h2>Exportar como</h2>
                    <div class="contenedor-iconos">
                        <!-- CAMBIAR -->
                        <a class="pdf_reporte"><i class="fa fa-file-pdf-o" aria-hidden="true"></i></a>
                        <a class="excel_reporte"><i class="fa fa-file-excel-o" aria-hidden="true"></i></a>
                    </div>
                </div>
            </div>



            <div class="tabla-consulta" id="tabla-consulta">

                <table class="ProductosMasVendidos" id="tbl-ProductMasVendidos">
                    <thead>
                        <tr>
                            <td>ID PRODUCTO</td>
                            <td>Nombre</td>
                            <td>STOCK</td>
                            <td>PRECIO DE COMPRA</td>
                            <td>PRECIO AL PUBLICO</td>
                            <td>NUMERO DE VENTAS</td>
                            <td>CANTIDAD VENDIDA</td>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>

            <div id="elementH"></div>

        </div>
        <script src="tableexport.min.js"></script>
        <script src="jquery-3.6.0.js"></script>
        <script src="jspdf.min.js"></script>
        <script src="jquery.tableToExcel.js"></script>
        <script src="pmv.js"></script>
</body>

</html>