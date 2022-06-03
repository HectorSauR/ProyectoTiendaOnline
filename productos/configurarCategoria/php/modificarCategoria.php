<?php
    include '../../../recursos/PHP/clases/conexion.php';

    //id de la categoria
    $id_cat = $_POST['id_cat'];
    $estatus = $_POST['estatus'];

    if($estatus == 1){
        $new_estatus = "2";
    }
    else{
        $new_estatus = "1";
    }

    $modificarCategoria = "UPDATE categoria_productos SET `ID_ESTATUS` = '$new_estatus' WHERE id_categoria = $id_cat";
    $consulta =$conexion->prepare($modificarCategoria);
    $r = $consulta->execute();

    $modificarProductos = "UPDATE productos SET `ID_ESTATUS` = '$new_estatus' WHERE id_categoria = $id_cat";
    $consulta =$conexion->prepare($modificarProductos);
    $r = $consulta->execute();

?>