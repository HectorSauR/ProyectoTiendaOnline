<?php
require('../../fpdf/fpdf.php');

class PDF extends FPDF
{
// Cabecera de página
function Header()
{
    // Arial bold 15
    $this->SetFont('Arial','B',12);
    // Movernos a la derecha
    $this->Cell(60);
    // Título
    $this->Cell(75,10,'Reporte de productos',1,0,'C');
    // Salto de línea
    $this->Ln(20);

    $this -> Cell(30, 10, 'ID PRODUCTO', 1, 0, 'C', 0);
    $this -> Cell(20, 10, 'NOMBRE', 1, 0, 'C', 0);
    $this -> Cell(40, 10, 'PRECIO COMPRA', 1, 0, 'C', 0);
    $this -> Cell(40, 10, 'PRECIO VENTA', 1, 0, 'C', 0);
    $this -> Cell(20, 10, 'STOCK', 1, 0, 'C', 0);
    $this -> Cell(40, 10, 'CATEGORIA', 1, 1, 'C', 0);

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
require '../../recursos/PHP/clases/conexion.php';

$conexion2  = new Conexion();
$conectar = $conexion2->getConectionMysql();

$categoria = $_REQUEST['periodo'];
$estatus = $_REQUEST['FP'];
$resultado = mysqli_query($conectar,"SELECT prod.ID_PRODUCTO, prod.NOMBRE, prod.PRECIO_COMPRA, prod.PRECIO, prod.STOCK,
                                            cat.DESCRIPCION
                                        FROM productos prod 
                                        INNER JOIN categoria_productos cat ON prod.ID_CATEGORIA = cat.ID_CATEGORIA
                                        WHERE prod.ID_CATEGORIA = '$categoria' AND prod.ID_ESTATUS = '$estatus'");



$pdf = new PDF();
$pdf->AddPage();
$pdf->SetFont('Arial','',11);


while($consultas = mysqli_fetch_array($resultado)){
    $pdf -> Cell(30, 10, $consultas['ID_PRODUCTO'], 1, 0, 'C', 0);
    $pdf -> Cell(20, 10, $consultas['NOMBRE'], 1, 0, 'C', 0);
    $pdf -> Cell(40, 10, $consultas['PRECIO_COMPRA'], 1, 0, 'C', 0);
    $pdf -> Cell(40, 10, $consultas['PRECIO'], 1, 0, 'C', 0);
    $pdf -> Cell(20, 10, $consultas['STOCK'], 1, 0, 'C', 0);
    $pdf -> Cell(40, 10, $consultas['DESCRIPCION'], 1, 1, 'C', 0);
}
$pdf->Output();
?>