<?php

session_start();
include("../clases/conexion.php");
//variables post


$opc = $_POST['opc'];



if ($opc == '1') {
  // code...
  //Variables de session
  $_SESSION['usuario'] = 'cliente';
  $_SESSION['userAdmin'] = "0";
  echo "1";
}else {
  $usuario = $_POST['user'];
  $pass = $_POST['clave'];
  $BuscarUsuario = "select * from usuario where USUARIO = '$usuario' and CONTRA = '$pass'";
  $Execute = $conexion->query($BuscarUsuario);

  $r = $Execute->fetchall(PDO::FETCH_ASSOC);

  if(count($r) == 1){



    if($r[0]['ID_ESTATUS'] == "2"){
      echo "3";
    }else{
      if($r[0]['NIVEL'] == "1"){
        $_SESSION['userAdmin'] = "1";
      }else if($r[0]['NIVEL'] == "2"){
        $_SESSION['userAdmin'] = "2";
      }else{
        $_SESSION['userAdmin'] = "0";
      }
      echo count($r);
    }

      //Variables de session
    $_SESSION['usuario'] = $usuario;
  }else{
    echo count($r);
  }
}





 ?>
