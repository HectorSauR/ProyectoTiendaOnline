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
    <title>Productos</title>
    <link rel="stylesheet" href="../../recursos/cssprincipal/style.css">
    <link rel="stylesheet" href="style.css">
</head>
<body onload="checkCookie('<?php echo $_SESSION['usuario'] ?>')">
<script type="text/javascript" src="../../Usuarios/modificarTema/js/master.js"></script>

<?php  include '../../recursos/nav/nav.php' ?>

<div class="main">

    <div class = "menu">
        <!-- DIV PARA LA BARRA DE BUSQUEDA DE LOS PRODUCTOS -->
        <form class="buscar" method="POST">
            <div class="search">
                <p>Buscar: </p>
                <div class="input_search">
                    <input type="text" class="text" name="prod">
                    <button class="icon_search" type="submit"><i class="fa-solid fa-magnifying-glass search_icon"></i></button>
                </div>
            </div>
        </form>

        <!-- DIV PARA EL CARRITO DEL CLIENTE -->
        <a href="../../cotizaciones/realizarCotizacion"><i class="fa-solid fa-cart-shopping carrito_icon"><span class="notification"></span></i></a>
    </div>


    <!-- DIV PARA LOS CONTENEDORES CON EL DISPLAY DE LOS PRODUCTOS -->
    <div class="Prod">

        <?php

        //OBTENEMOS LAS PAGINACIONES DE LOS PRODUCTOS
        if(isset($_GET['page'])){
            $page = $_GET['page'];
        }
        else{
            $page = 1;
        }
        
        $num_per_page = 10;
        $start_page = ($page-1)*10;

        $query = "SELECT productos.ID_PRODUCTO, productos.NOMBRE, categoria_productos.DESCRIPCION, productos.PRECIO, productos.IMAGEN FROM `productos` INNER JOIN `categoria_productos` ON productos.ID_CATEGORIA=categoria_productos.ID_CATEGORIA WHERE productos.ID_ESTATUS='1' LIMIT $start_page , $num_per_page;";
        $statement = $conexion->prepare($query);
        $statement->execute();
        $result = $statement->fetchall();
        
        
        foreach($result as $row)
        {      
            ?>
        <div class="P_info">
            <form class="carrito" method="POST">
                <img src=" <?php 
                    if ( file_exists("../../".$row['IMAGEN']) ) {
                        echo $pathHost.$row['IMAGEN']; 
                    }
                    else {
                        echo " https://www.ekoparkotomasyon.com/wp-content/public_html/cart/image/data/uploads/2013/12/default-placeholder.png ";
                    }
                    
                    ?>  " 
                class="P_img">
                <div class="P_info_Text">
                    <h2 class="Prod_Title"> <?php echo $row['NOMBRE'];  ?> </h2>
                    <p class="Prod_info"> <?php echo $row['DESCRIPCION']; ?> </p>
                    <span class="price"> $<?php echo $row['PRECIO'] ?> </span>
                    <div>
                        <button class="btn_info" type="submit"> Agregar </button>
                    </div>
                </div>
                
                <input type="hidden" name="id" value="<?php echo $row['ID_PRODUCTO']; ?>">
                <input type="hidden" name="cantidad" value= "1">
                <input type="hidden" name="precio" value= "<?php echo $row['PRECIO']; ?>">
            </form>
        </div>

        <?php
        }
        ?>


    </div>

        <!-- PAGINACION START -->
        <div class = "paginacion">

        <?php
            //mostramos las paginasiones que tendra la pagina
            $pr_query = "SELECT * FROM `productos` where ID_ESTATUS = '1' ";
            $pr_result = $conexion->query($pr_query);
            $total_record = $pr_result->fetchall(PDO::FETCH_ASSOC);

            $total_page = ceil(count($total_record)/$num_per_page);
            
            if($page > 1){
            ?>
                <a href="./index.php?page=<?php echo ($page - 1) ?>" class="pagg_link"> <i class="fa-solid fa-chevron-left"></i> </a>
            <?php
            }

            for($i = 0; $i < $total_page; $i++){
                ?>
                <a href="./index.php?page=<?php echo $i + 1; ?>" class="pagg_link"> <?php echo $i + 1; ?> </a>
                <?php
            }

            if($i > $page){
                ?>
                    <a href="./index.php?page=<?php echo ($page + 1); ?>" class="pagg_link"> <i class="fa-solid fa-chevron-right"></i> </a>
                <?php
                }
        ?>
        </div>
        <!-- PAGINACION END -->
</div>

<script type="text/javascript" src="./master.js"></script>
<script src="https://kit.fontawesome.com/167cc065d2.js" crossorigin="anonymous"></script>
<script type="text/javascript" src="../../recursos/librerias/jquery/jquery-3.6.0.min.js"></script>
<script  type='text/javascript'>
    $(document).ready(function(){
        $(document).on('click','.btn',function(event){
            event.preventDefault();

            var id = $('#index').data('id');
            $.ajax({
                type : 'post',
                url : 'showMore.php',
                data : {id:id},
                success:function(result){
                    $('#index').remove();
                    $('.Prod').append(result);
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