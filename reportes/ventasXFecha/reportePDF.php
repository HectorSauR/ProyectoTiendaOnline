<?php
require('../../fpdf/fpdf.php');

class PDF extends FPDF
{
// Cabecera de página
function Header()
{
    // Arial bold 15
    $this->SetFont('Arial','B',15);
    // Movernos a la derecha
    $this->Cell(60);
    // Título
    $this->Cell(75,10,'Reporte de ventas por fecha',1,0,'C');
    // Salto de línea
    $this->Ln(20);

    $this -> Cell(30, 10, 'ID VENTA', 1, 0, 'C', 0);
    $this -> Cell(40, 10, 'FECHA', 1, 0, 'C', 0);
    $this -> Cell(40, 10, 'USUARIO', 1, 0, 'C', 0);
    $this -> Cell(40, 10, 'DESCRIPCION', 1, 0, 'C', 0);
    $this -> Cell(40, 10, 'PRECIO', 1, 1, 'C', 0);

}

// Pie de página
function Footer()
{
    // Posición: a 1,5 cm del final
    $this->SetY(-15);
    // Arial italic 8
    $this->SetFont('Arial','I',8);
    // Número de página
    $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
}
}
require "../../recursos/PHP/clases/conexion.php";

$conexion2 = new Conexion();
$conectar = $conexion2->getConectionMysql();

$frmPago = $_REQUEST['frmPago'];
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



$pdf = new PDF();
$pdf->AddPage();
$pdf->SetFont('Arial','',16);


while($consultas = mysqli_fetch_array($resultado)){
    $pdf -> Cell(30, 10, $consultas['ID_VENTA'], 1, 0, 'C', 0);
    $pdf -> Cell(40, 10, $consultas['FECHA'], 1, 0, 'C', 0);
    $pdf -> Cell(40, 10, $consultas['USUARIO'], 1, 0, 'C', 0);
    $pdf -> Cell(40, 10, $consultas['DESCRIPCION'], 1, 0, 'C', 0);
    $pdf -> Cell(40, 10, $consultas['PRECIO'], 1, 1, 'C', 0);
}
$pdf->Output();
?>