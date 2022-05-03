<?php
  include '../../recursos/PHP/clases/conexion.php';

    $query = 'SELECT MAX(ID_PRODUCTO) AS "ID_PRODUCTO" FROM `productos`;';
    $statement = $conexion->prepare($query);
    $statement->execute();
    $result = $statement->fetchall();

    foreach($result as $row){
        if( $row['ID_PRODUCTO'] > $_POST["id"] ){
            $query = 'SELECT productos.ID_PRODUCTO, productos.NOMBRE, categoria_productos.DESCRIPCION, productos.PRECIO, productos.IMAGEN FROM `productos` INNER JOIN `categoria_productos` ON productos.ID_CATEGORIA=categoria_productos.ID_CATEGORIA WHERE productos.ID_ESTATUS="1" and productos.ID_PRODUCTO > "'.$_POST["id"].'" LIMIT 6;';
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
        
        <input type="hidden" id="index" data-id="<?php echo $id; ?>">
        <?php
        }
        else{
            ?>
            <input type="hidden" id="index" data-id="10">
            <?php
        }
    }
?>