<?php
  include '../../recursos/PHP/clases/conexion.php';

    //id de producto
    $nombre = $_POST['prod'];

    if($nombre != null){
        $BuscarUsuario = "SELECT ID_PRODUCTO FROM productos WHERE productos.ID_ESTATUS='1' and productos.NOMBRE like '$nombre%';";
        $Execute = $conexion->query($BuscarUsuario);
    
        $r = $Execute->fetchall(PDO::FETCH_ASSOC);
    
        if(count($r) > 0){
    
            //OTENEMOS LOS DATOS DE LOS PRODUTOS EN LA BD
            $query = "SELECT productos.ID_PRODUCTO, productos.NOMBRE, categoria_productos.DESCRIPCION, productos.PRECIO, productos.IMAGEN FROM `productos` INNER JOIN `categoria_productos` ON productos.ID_CATEGORIA=categoria_productos.ID_CATEGORIA WHERE productos.ID_ESTATUS='1' and productos.NOMBRE like '$nombre%'";
            $statement = $conexion->prepare($query);
            $statement->execute();
            $result = $statement->fetchall();
    
            foreach($result as $row)
            { 
                $id = $row['ID_PRODUCTO'];
                ?>
    
            <div class="P_info">
                <form class="carrito" method="POST">
                    <img src=" <?php echo $row['IMAGEN']; ?> " class="P_img">
                    <div class="P_info_Text">
                        <h1 class="Prod_Title"> <?php echo $row['NOMBRE'];  ?> </h1>
                        <p class="Prod_info"> <?php echo $row['DESCRIPCION']; ?> </p>
                        <span class="price"> $<?php echo $row['PRECIO'] ?> </span>
                        <div>
                            <button class="btn_info" type="submit"> Agregar </button>
                        </div>
                    </div>
                    
                    <input type="hidden" id="index" data-id="<?php echo $id; ?>">
                </form>
            </div>
    
            <input type="hidden" id="index" data-id="<?php echo $id; ?>">
            <?php
            }
    
        }
        else{
            echo 0;
        }
    }
    else{
        echo 0;
    }

?>