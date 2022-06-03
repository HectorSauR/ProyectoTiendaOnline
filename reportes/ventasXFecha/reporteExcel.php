<?php 
require 'conexion.php';
$frmPago = $_REQUEST['frmPago'];
$usr = $_POST['nameUsr'];
$fecha = $_REQUEST['fecha'];
$resultado = mysqli_query($conectar,"SELECT venta.FECHA, venta.ID_VENTA, venta.ID_FORMA_PAGO, venta.ID_USUARIO,
                                            detallesVenta.PRECIO,
                                            usuario.USUARIO,
                                            forma_pago.DESCRIPCION
                                            FROM venta venta 
                                            INNER JOIN detalle_venta detallesVenta ON venta.ID_VENTA = detallesVenta.ID_VENTA
                                            INNER JOIN usuario usuario ON venta.ID_USUARIO = usuario.ID_USUARIO
                                            INNER JOIN forma_pago forma_pago ON venta.ID_FORMA_PAGO = forma_pago.ID_FORMA_PAGO
                                            WHERE venta.FECHA = '$fecha' AND venta.ID_FORMA_PAGO = '$frmPago'");

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