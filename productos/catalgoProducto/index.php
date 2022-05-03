<?php
  include '../../recursos/PHP/configuracionDelSitioWeb/conf.php';
  include '../../recursos/PHP/clases/conexion.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../../recursos/cssprincipal/style.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>

<?php  include '../../recursos/nav/nav.php' ?>

<div class="main">

    <!-- DIV PARA LA BARRA DE BUSQUEDA DE LOS PRODUCTOS -->
    <div class="search">
        <p>Buscar: </p>
        <div class="input_search">
            <input type="text" class="text">
            <img src="https://bluemadness.000webhostapp.com/img_proyecto/lupa.png" class="icon_search">
        </div>
    </div>

    <!-- DIV PARA LOS CONTENEDORES CON EL DISPLAY DE LOS PRODUCTOS -->
    <div class="Prod">

        <?php

        $query = 'SELECT productos.ID_PRODUCTO, productos.NOMBRE, categoria_productos.DESCRIPCION, productos.PRECIO, productos.IMAGEN FROM `productos` INNER JOIN `categoria_productos` ON productos.ID_CATEGORIA=categoria_productos.ID_CATEGORIA WHERE productos.ID_ESTATUS="1" LIMIT 6;';
        $statement = $conexion->prepare($query);
        $statement->execute();
        $result = $statement->fetchall();

        foreach($result as $row)
        { 
            $id = $row['ID_PRODUCTO'];
            ?>

        <div class="P_info">
            <img src=" <?php echo $row['IMAGEN']; ?> " class="P_img">
            <div class="P_info_Text">
                <h1 class="Prod_Title"> <?php echo $row['NOMBRE'];  ?> </h1>
                <p class="Prod_info"> <?php echo $row['DESCRIPCION']; ?> </p>
                <span class="price"> $<?php echo $row['PRECIO'] ?> </span>
                <div>
                    <button class="btn_info"> Agregar </button>
                </div>
            </div>
        </div>
        <?php
        }
        ?>
    </div>

    <!-- button -->
    <div class="button_showMore">
        <button type="button" class="btn" data-id="<?php echo $id; ?>"> MOSTRAR MÁS </button>
    </div>
</div>

<script type="text/javascript" src="../../recursos/librerias/jquery/jquery-3.6.0.min.js"></script>
<script  type='text/javascript'>
    $(document).ready(function(){
        $(document).on('click','.btn',function(event){
            event.preventDefault();

            var id = $('.btn').data('id');
            $.ajax({
                type : 'post',
                url : 'showMore.php',
                data : {id:id},
                success:function(result){
                    $('.Prod').append(result);
                    alert( <?php echo $id; ?>);
                },
                error:function(result){
                    alert('dlakfjhsdfklj');
                }
            });
        });
    });
</script>

</body>
</html>