<?php
  include("../clases/conexion.php");

  $nombre = $_POST['nombre'];
  $usuario = $_POST['usuario'];
  $clave = $_POST['clave'];
  $correo = $_POST['correo'];
  $imagen = $_FILES['imagen'];
  $nivel = $_POST['nivelA'];

  //LOGICA PARA ALMCENAR LA IMAGEN EN EL SERVIDOR
  $fileContent = file_get_contents($imagen['tmp_name']);
  $path = "../../../recursos/imagenes/usuarios/".$usuario;
  //VERIFICAR SI CARPETA DE USUARIO EXISTE
  if (!file_exists($path)) {
    mkdir($path, 0777, true);
  }
  //OBTENER EXTENCION DE IMAGEN
  $extension = pathinfo("../../../recursos/imagenes/usuarios/".$usuario."/".$imagen["name"], PATHINFO_EXTENSION);
  //ALMACENA LA IMAGEN EN EL SERVIDOR
  file_put_contents("../../../recursos/imagenes/usuarios/".$usuario."/".$usuario.".".$extension,$fileContent);



  //LOGICA PARA INSERTAR LOS DATOS EN LA BD

  //OBTENER EL ULTIMO ID
  $obtenerUltimoId= "select ID_USUARIO from usuario order by ID_USUARIO desc limit 1;";
  $Execute = $conexion->query($obtenerUltimoId);

  $r = $Execute->fetchall(PDO::FETCH_ASSOC);
  $id = $r[0]['ID_USUARIO'];
  $id++;

  $agregarUsuario = "INSERT INTO usuario values(?,?,?,?,?,?,?,?)";
  $consulta =$conexion->prepare($agregarUsuario);
  $arregloDatos = array($id,$nombre,$usuario,$clave,$nivel ,"recursos/imagenes/usuarios/".$usuario."/".$usuario.".".$extension,$correo,"1");
  $res = $consulta->execute($arregloDatos);

  echo $res;

 ?>
