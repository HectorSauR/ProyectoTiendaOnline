<?php
  
  require "../../recursos/PHP/clases/conexion.php";

 

  $query = 'SELECT *  FROM `forma_pago` ;';
  $statement = $conexion->prepare($query);
  $statement->execute();
  $result = $statement->fetchall();

     $datos = [];
        foreach($result as $row){
            $datos[] = [
              
                'ID_FORMA_PAGO' => $row['ID_FORMA_PAGO'],
                'DESCRIPCION' => $row['DESCRIPCION'],
            ];
        }

        $query = 'SELECT * FROM usuario WHERE ( NIVEL = 1 OR NIVEL = 2 ) AND ID_ESTATUS = 1;';
        $statement = $conexion->prepare($query);
        $statement->execute();
        $result = $statement->fetchall();
      
           $datos1 = [];
              foreach($result as $row){
                  $datos1[] = [
                    
                      'ID_USUARIO' => $row['ID_USUARIO'],
                      'USUARIO' => $row['USUARIO'],
                  ];
              }


        
?>

