<?php
// Incluir la clase PhpSpreadsheet
require 'PhpSpreadsheet/vendor/autoload.php';
require 'qrlib.php'; // Incluye la biblioteca para generar códigos QR

use PhpOffice\PhpSpreadsheet\IOFactory;

// Cargar el archivo Excel
$archivoExcel = "campamento.xlsx";
$documento = IOFactory::load($archivoExcel);

// Obtener la hoja activa del documento
$hoja = $documento->getActiveSheet();
// Incluir la cabecera HTML
echo <<<HTML
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tarjetas de Campistas</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .card {
            width: 300px;
            margin: 20px;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="row">
HTML;

// Iterar sobre las filas del archivo Excel
foreach ($hoja->getRowIterator() as $fila) {
    // Obtener los datos de cada fila
    $nombre = $hoja->getCellByColumnAndRow(0, $fila->getRowIndex())->getValue();
    $apellidos = $hoja->getCellByColumnAndRow(1, $fila->getRowIndex())->getValue();
    $qr_data = "Nombre: $nombre, Apellidos: $apellidos";

    // Generar el nombre del archivo QR
    $qr_file = "qr_codes/{$nombre}_{$apellidos}.png";

    // Generar el código QR
    QRcode::png($qr_data, $qr_file);

    // Mostrar la tarjeta de campista
    echo <<<CARD
    <div class="col-sm-4">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">$nombre $apellidos</h5>
                <img src="$qr_file" class="card-img-top" alt="Código QR">
            </div>
        </div>
    </div>
CARD;
}

// Incluir el cierre HTML
echo <<<HTML
    </div>
</div>
</body>
</html>
HTML;
?>

