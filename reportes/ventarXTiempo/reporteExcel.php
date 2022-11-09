<?php 
require "../../recursos/PHP/clases/conexion.php";
$conexion2 = new Conexion();
$conectar = $conexion2->getConectionMysql();
$mes = $_REQUEST['periodo'];
$formaPago = $_REQUEST['FP'];
$usr = $_REQUEST['usr'];
$resultado = mysqli_query($conectar,"SELECT * FROM reporte_por_tiempo
                                      WHERE MONTH(FECHA)='$mes' 
                                      AND ID_FORMA_PAGO = '$formaPago' 
                                      AND ID_USUARIO = '$usr'");

header ("Content-Type: application/vnd.ms-excel; charset=iso-8859-1");
header ("Content-Disposition: attachment; filename=datos-ventas.xls");       
?>

<table>
    <caption>Reporte de ventas por fecha</caption>
          <tr>
            <th>ID Venta</th>
            <th>Fecha</th>
            <th>Usuario</th>
            <th>Forma de pago</th>
            <th>Importe</th>
          </tr>

          <?php 
          while($consultas = mysqli_fetch_array($resultado)){ ?>
          <tr>
            <td><?php echo $consultas['ID_VENTA']; ?> </td>
            <td><?php echo $consultas['FECHA']; ?> </td>
            <td><?php echo $consultas['USUARIO']; ?> </td>
            <td><?php echo $consultas['DESCRIPCION']; ?> </td>
            <td><?php echo $consultas['PRECIO']; ?> </td>
          </tr>

          <?php } 
          mysqli_free_result($resultado);?>

</table>