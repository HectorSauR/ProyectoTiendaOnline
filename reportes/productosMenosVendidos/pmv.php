<?php
  
  require "../../recursos/PHP/clases/conexion.php";

 

  $query = 'SELECT *  FROM `categoria_productos`;';
  $statement = $conexion->prepare($query);
  $statement->execute();
  $result = $statement->fetchall();

     $datos = [];
        foreach($result as $row){
            $datos[] = [
              
                'ID_CATEGORIA' => $row['ID_CATEGORIA'],
                'NOMBRE' => $row['NOMBRE'],
            ];
        }


        
?>

