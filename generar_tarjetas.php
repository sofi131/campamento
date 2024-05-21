<?php
// Incluir la clase PhpSpreadsheet y la biblioteca QRCode
require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\IOFactory;
use chillerlan\QRCode\QRCode;
use chillerlan\QRCode\QROptions;

// Cargar el archivo Excel
$archivoExcel = "excel/campamento.xlsx";
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
    $nombre = $hoja->getCell('B' . $fila->getRowIndex())->getValue();
    $apellidos = $hoja->getCell('C' . $fila->getRowIndex())->getValue();
    $qr_data = "Nombre: $nombre, Apellidos: $apellidos";

    // Generar el nombre del archivo QR
    $qr_file = "qr_codes/{$nombre}_{$apellidos}.png";

    // Configurar opciones de QR
    $options = new QROptions([
        'outputType' => QRCode::OUTPUT_IMAGE_PNG,
        'eccLevel' => QRCode::ECC_L,
    ]);

    // Generar el código QR
    (new QRCode($options))->render($qr_data, $qr_file);

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
