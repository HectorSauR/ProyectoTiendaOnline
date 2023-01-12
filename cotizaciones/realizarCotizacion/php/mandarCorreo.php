<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require '../../../phpmailer/src/Exception.php';
require '../../../phpmailer/src/PHPMailer.php';
require '../../../phpmailer/src/SMTP.php';
require '../../../fpdf/fpdf.php';
require '../../../recursos/PHP/clases/conexion.php';

class PDF extends FPDF
{
    // Cabecera de página
    public $id_cotizacion;

    function Header()
    {

        include '../../../fpdf/headerEmpresa/header.php';

        // Arial bold 15
        $this->SetFont('Arial', 'B', 12);
        // Movernos a la derecha
        $this->Cell(60);
        // Título
        $this->Cell(75, 10, 'Cotizacion ' . $this->id_cotizacion, 1, 0, 'C');
        // Salto de línea
        $this->Ln(20);

        $this->Cell(30, 10, 'CODIGO', 1, 0, 'C', 0);
        $this->Cell(60, 10, 'NOMBRE', 1, 0, 'C', 0);
        $this->Cell(30, 10, 'PRECIO', 1, 0, 'C', 0);
        $this->Cell(35, 10, 'CANTIDAD', 1, 0, 'C', 0);
        $this->Cell(35, 10, 'IMPORTE', 1, 1, 'C', 0);
    }

    // Pie de página
    function Footer()
    {
        // Posición: a 1,5 cm del final
        $this->SetY(-15);
        // Arial italic 8
        $this->SetFont('Arial', 'I', 8);
        // Número de página
        $this->Cell(0, 10, 'Page ' . $this->PageNo() . '/{nb}', 0, 0, 'C');
    }
}

$email = $_POST['correo'];
$nombre = $_POST['nombre'];
$id_cotizacion = $_POST['id_cot'];
$total = $_POST['total'];

$conexion2  = new Conexion();
$conectar = $conexion2->getConectionMysql();

$resultado = mysqli_query(
    $conectar,
    "SELECT * FROM info_cotizacion where COTIZACION = $id_cotizacion;"
);
$mail = new PHPMailer(true);

$pdf = new PDF();
$pdf->id_cotizacion = $id_cotizacion;
$pdf->AddPage();
$pdf->SetFont('Arial', '', 16);

while ($consultas = mysqli_fetch_array($resultado)) {
    $precio = floatval($consultas['PRECIO']);
    $cantidad = intval($consultas['CANTIDAD']);
    $iva = ($precio * $cantidad) * .16;

    $importe = ($precio * $cantidad) + $iva;
    $pdf->Cell(30, 10, $consultas['ID'], 1, 0, 'C', 0);
    $pdf->Cell(60, 10, $consultas['NOMBRE'], 1, 0, 'C', 0);
    $pdf->Cell(30, 10, '$' . $consultas['PRECIO'], 1, 0, 'C', 0);
    $pdf->Cell(35, 10, $consultas['CANTIDAD'], 1, 0, 'C', 0);
    $pdf->Cell(35, 10, '$' . $importe, 1, 1, 'C', 0);
}
$pdf->Ln(10);

$pdf->Cell(0, 10, 'Total ' . $total, 0, 0, 'R');

$pdf->Output("F", "./pdfs/Cotizacion" . $id_cotizacion . ".pdf");

echo "Cotizacion" . $id_cotizacion . ".pdf";

try {
    //$mail->SMTPDebug = SMTP::DEBUG_SERVER;
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'uasventasresearch@gmail.com';
    $mail->Password = 'pnqggavknytpkeya';
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;

    $mail->setFrom('uasventasresearch@gmail.com', 'Admin ResearchSoft');
    $mail->addAddress($email, 'Cliente');
    $mail->addAttachment(
        "./pdfs/Cotizacion" . $id_cotizacion . ".pdf",
        "Cotizacion" . $id_cotizacion . ".pdf"
    );
    $mail->isHTML(true);
    $mail->Subject = "COTIZACION VENTAS RESEARCH $nombre";
    $mail->Body = 'Cotizacion productos';
    $mail->send();
} catch (Exception $e) {
    echo 'Mensaje: ' . $mail->ErrorInfo;
}
