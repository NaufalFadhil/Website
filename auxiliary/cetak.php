<?php
// Require composer autoload
require_once __DIR__ . '/composer/vendor/autoload.php';

require 'function.php';

// Create an instance of the class:
$mpdf = new \Mpdf\Mpdf();
// $mpdf = new \mPdf();

$animals = query("SELECT * FROM hewan");

$html = '<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>DAFTAR HEWAN</h1>
    <table border="1" cellpadding="10" cellspacing="0">
            <tr>
                <th>ID</th>
                <th>Gambar</th>
                <th>Nama</th>
                <th>Lingkungan</th>
                <th>Makanan</th>
                <th>Kaki</th>
            </tr>';
$i = 1;
foreach ($animals as $animal) {
    $html .= '<tr>
        <td>' . $i++ . ' </td>
        <td><img src="../img/' . $animal["gambar"] . '" width="50px"></td>
        <td>' . $animal["nama"] . '</td>
        <td>' . $animal["lingkungan"] . '</td>
        <td>' . $animal["makanan"] . '</td>
        <td>' . $animal["kaki"] . '</td>
        </tr>';
}
$html .= '</table>
</body>
</html>';
// Write some HTML code:
$mpdf->WriteHTML($html);

// Output a PDF file directly to the browser
$mpdf->Output();
