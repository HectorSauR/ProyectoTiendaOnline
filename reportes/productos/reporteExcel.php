<?php 
require '../../recursos/PHP/clases/conexion.php';
$conectar = $conexion -> getConectionMysql();
$categoria = $_REQUEST['periodo'];
$estatus = $_REQUEST['FP'];
$resultado = mysqli_query($conectar,"SELECT prod.ID_PRODUCTO, prod.NOMBRE, prod.PRECIO_COMPRA, prod.PRECIO, prod.STOCK,
                                            cat.DESCRIPCION
                                        FROM productos prod 
                                        INNER JOIN categoria_productos cat ON prod.ID_CATEGORIA = cat.ID_CATEGORIA
                                        WHERE prod.ID_CATEGORIA = '$categoria' AND prod.ID_ESTATUS = '$estatus'");

header ("Content-Type: application/vnd.ms-excel; charset=iso-8859-1");
header ("Content-Disposition: attachment; filename=reporte_producto.xls");       
?>

<table>
    <caption>Reporte de productos</caption>
          <tr>
            <th>ID PRODUCTO</th>
            <th>NOMBRE</th>
            <th>PRECIO COMPRA</th>
            <th>PRECIO VENTA</th>
            <th>STOCK</th>
            <th>DESCRIPCION</th>
          </tr>

          <?php 
          while($consultas = mysqli_fetch_array($resultado)){ ?>
          <tr>
            <td><?php echo $consultas['ID_PRODUCTO']; ?> </td>
            <td><?php echo $consultas['NOMBRE']; ?> </td>
            <td><?php echo $consultas['PRECIO_COMPRA']; ?> </td>
            <td><?php echo $consultas['PRECIO']; ?> </td>
            <td><?php echo $consultas['STOCK']; ?> </td>
            <td><?php echo $consultas['DESCRIPCION']; ?> </td>

          </tr>

          <?php } 
          mysqli_free_result($resultado);?>

</table>