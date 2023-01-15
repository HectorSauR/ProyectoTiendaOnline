<?php
  include '../../recursos/PHP/configuracionDelSitioWeb/conf.php';
  include '../../recursos/PHP/clases/conexion.php';


  
 $query = 'SELECT *  FROM `categoria_productos` WHERE ID_ESTATUS = "1"';
 $statement = $conexion->prepare($query);
 $statement->execute();
 $result = $statement->fetchall();

    $datos = [];
       foreach($result as $row){
           $datos[] = [
               
               'idcategoria' => $row['ID_CATEGORIA'],
               'nombre'=> $row['NOMBRE'],
           ];
       }
?>
<?php include '../../recursos/PHP/metodos/verificarSesionUsuario.php' ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Producto</title>
    <link rel="stylesheet" href="../../recursos/cssprincipal/style.css">
    <link rel="stylesheet" href="RegistroDeProducto.css">
</head>

<body onload="checkCookie('<?php echo $_SESSION['usuario'] ?>')" >
<script type="text/javascript" src="../../Usuarios/modificarTema/js/master.js"></script>

    
  
    <?php include '../../recursos/nav/nav.php' ?>
    <div class="main">
        <h1>Registro de producto</h1>

        <form id="formRegistroCategoria" class="contenedor-app" >
            <div class="contenedor-form">
               
            <label>Id categotria: </label>
                    <!-- <input type="text" name="txtcat" id="txtnom"> -->
                    <select name="txtcat" id="txtcat"> 
                        <?php
                            foreach ($datos as $dat) {
                                echo '<option value="' . $dat['idcategoria'] . '">'.$dat['idcategoria'].' > ' . $dat['nombre'] . '</option>';
                            } 
                        ?>
                    </select>

                    <label >nombre: </label>
                    <input type="text" name="txtnom" id="txtnom" required>
                    <label >Precio Compra: </label>
                    <input type="text" name="txtprecc" id="txtprecc"  pattern="^[.]?\d+(?:[.]\d*?)?$" required>
                    <label >precio: </label>
                    <input type="text" name="txtprecv" id="txtprecv"  pattern="^[.]?\d+(?:[.]\d*?)?$" required>
                    <label >stock: </label>
                    <input type="number" name="txtstock" id="txtstock" min="0" pattern="^[0-9]+">
                    <label >Stock minimo: </label>
                    <input type="number" name="txtstockm" id="txtstockm" min="0" pattern="^[0-9]+">
                    <label >CODIGO DE BARRAS: </label>
                    <input type="number" name="txtcb" id="txtcb" min="0" pattern="^[0-9]+">
                    <label >Estatus: </label>
                    <!-- <input type="text" name="txtstatus" id="txtstatus"> -->
                    <select name="txtstatus" id="txtstatus">
                        <option value="1">ACTIVO</option>
                        <option value="2">INACTIVO</option>
                    </select>
                   
                    <button type="submit" class="btn" id="btnRegistrar"> Registrar </button>
                
            </div>

            <div class="contenedor-imagen">
            <h1>Imagen</h1>
            <div class="imagen">
    
            </div>
            <button type="button" id="activarAgreagarImagen">Examinar</button>
            <input type="file" value="" name="imagen" id="agregarImagen" accept="image/*">
          </div>
            

           
            
        </form>   
    </div>




    <script src="registrarproducto.js"></script>
</body>
</html>