<?php
  include("../clases/conexion.php");

  $nombre = $_POST['nombre']; //NOMBRE DE CATEGORIA
  $descripcion = $_POST['descripcion'];
  $imagen = $_FILES['imagen'];

 

  //VERIFICAR QUE NO ALLA UNA CATEGORIA YA REGISTRADA CON EL MISMO NOMBRE
  $BuscarCategoria = "select * from categoria_productos where NOMBRE = '$nombre'";
  $Execute = $conexion->query($BuscarCategoria);
  $r = $Execute->fetchall(PDO::FETCH_ASSOC);

  if(count($r) == 1){
    //ERROR CATEGORIA YA REGISTRADA
    echo json_encode(array("estado"=>"error" ,"mensaje"=>"Nombre de categoria ya registrada."));
  }else{
    //NO HAY CATEGORIA CON EL MISMO NOMBRE
     //LOGICA PARA ALMCENAR LA IMAGEN EN EL SERVIDOR
  $fileContent = file_get_contents($imagen['tmp_name']);
  $path = "../../../recursos/imagenes/regCategoria/".$nombre;
  //VERIFICAR SI CARPETA DE USUARIO EXISTE
  if (!file_exists($path)) {
    mkdir($path, 0777, true);
  }
  //OBTENER EXTENCION DE IMAGEN
  $extension = pathinfo("../../../recursos/imagenes/regCategoria/".$nombre."/".$imagen["name"], PATHINFO_EXTENSION);
  //ALMACENA LA IMAGEN EN EL SERVIDOR
  file_put_contents("../../../recursos/imagenes/regCategoria/".$nombre."/".$nombre.".".$extension,$fileContent);

  //LOGICA PARA INSERTAR LOS DATOS EN LA BD

  //OBTENER EL ULTIMO ID
  $obtenerUltimoId= "select ID_CATEGORIA from categoria_productos order by ID_CATEGORIA desc limit 1;";
  $Execute = $conexion->query($obtenerUltimoId);

  $r = $Execute->fetchall(PDO::FETCH_ASSOC);
  $id = $r[0]['ID_CATEGORIA'];
  $id++;

  $agregarUsuario = "INSERT INTO categoria_productos values(?,?,?,?,?)";
  $consulta =$conexion->prepare($agregarUsuario);
  $arregloDatos = array($id,$nombre,$descripcion,"recursos/imagenes/regCategoria/".$nombre."/".$nombre.".".$extension ,"1");
  $res = $consulta->execute($arregloDatos);

  echo json_encode(array("estado"=>"success" ,"mensaje"=>"Categoria guardada."));
  }
