<?php
require_once __DIR__ . '/vendor/autoload.php';

require 'functions.php';
$weapon = query("SELECT * FROM tokosenjata");

$mpdf = new \Mpdf\Mpdf();

$html = '<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Senjata</title>
    <link rel="stylesheet" href="css/print.css">
</head>
<body>
    <h1>Daftar Senjata</h1>
    <table border="1" cellpadding="10" cellspacing="0">
    <tr>
        <th>No</th>
        <th>Nama Senjata</th>
        <th>Gambar</th>
        <th>Type Senjata</th>
        <th>Warna</th>
        <th>Stock</th>
    </tr>';
    $i = 1;
    foreach($weapon as $row) {
        $html .= '<tr>
            <td>'. $i++ .'</td>
            <td>'. $row["nama_senjata"].'</td>
            <td><img src="img/'. $row["gambar"] .'" width="50"></td>
            <td>'. $row["type_senjata"].'</td>
            <td>'. $row["warna"].'</td>
            <td>'. $row["stock"].'</td>
        </tr>';
    }

$html .= '</table>
</body>
</html>';
$mpdf->WriteHTML($html);
$mpdf->Output('daftar-senjata.pdf', 'I');

?>
