<?php
require_once __DIR__ . '/vendor/autoload.php';

require 'functions.php';
$weapon = query("SELECT * FROM penjualan");

$mpdf = new \Mpdf\Mpdf();

$html = '<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/print.css">
    <title>Daftar Senjata</title>
</head>
<body>
    <h1>Daftar Penjualan</h1>
    <table border="1" cellpadding="10" cellspacing="0">
    <tr>
        <th>No</th>
        <th>Nama Senjata</th>
        <th>Gambar</th>
        <th>Type Senjata</th>
        <th>Warna</th>
        <th>Qty</th>
        <th>Harga</th>
        <th>Total</th>
        <th>Tanggal Transaksi</th>
    </tr>';
    $i = 1;
    foreach($weapon as $row) {
        $html .= '<tr>
            <td>'. $i++ .'</td>
            <td>'. $row["nama_senjata"].'</td>
            <td><img src="img/'. $row["gambar"] .'" width="50"></td>
            <td>'. $row["type_senjata"].'</td>
            <td>'. $row["warna"].'</td>
            <td>'. $row["qty_beli"].'</td>
            <td>'. $row["harga"].'</td>
            <td>'. $row["total"].'</td>
            <td>'. $row["tgl_input"].'</td>
        </tr>';
    }

$html .= '</table>
</body>
</html>';
$mpdf->WriteHTML($html);
$mpdf->Output('penjualan.pdf', 'I');

?>
