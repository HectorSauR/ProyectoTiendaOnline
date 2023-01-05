<?php 

//INICIO DE HEADER DE DATOS DE EMPRESA <-------------------->

$this->SetFont('Arial', 'B', 16);

// Añadir el nombre de la empresa al documento
$this->Cell(40, 10, 'FERREMOSA SA DE CV');
$this->Ln(10);
// Establecer el tamaño y el tipo de fuente para el subtítulo
$this->SetFont('Arial', '', 12);

// Añadir un subtítulo al documento
$this->Cell(40, 10, 'VENTA DE PRODUCTOS VARIADOS');

$this->Ln(10);

// Insertar una imagen en el documento
$this->Image('https://bluemadness.000webhostapp.com/img_proyecto/logo_empresa.png', 185, 10, 15, 0);
// Añadir una línea horizontal para separar el header del contenido
$this->Line(10, 30, 200, 30);


$this->Cell(40, 10, 'CORREO:FERREMOSA@OUTLOOK.COM');

$this->Ln(10);
$this->Cell(40, 10, 'TELEFONO:1115555555');

$this->Ln(10);
$this->Cell(40, 10, 'DIRECCION:Av. Lopez S/N, colonia Centro, CP 67899');

$this->Ln(15);

//FIN DE HEADER DE DATOS DE EMPRESA <-------------------->