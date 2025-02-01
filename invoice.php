<?php
require_once __DIR__ . '/vendor/autoload.php';

require 'functions.php';
$id = $_GET["id"];
$weapon = query("SELECT * FROM penjualan WHERE id_penjualan = $id");

$mpdf = new \Mpdf\Mpdf();

$html = '<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice</title>
    <style>
        body {
            font-family: sans-serif;
            margin: 20px; /* Add some margin for printing */
        }
        .invoice-container {
            width: 800px; /* Adjust width as needed */
            margin: 0 auto;
            border: 1px solid #ccc;
            padding: 20px;
            box-sizing: border-box; /* Include padding in width calculation */
        }
        .invoice-header {
            text-align: center;
            margin-bottom: 20px;
        }
        .invoice-details {
            margin-bottom: 20px;
        }
        .invoice-items {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        .invoice-items th, .invoice-items td {
            border: 1px solid #ccc;
            padding: 8px;
            text-align: left; /* Default left alignment */
        }
        .invoice-items th {
            background-color: #f0f0f0; /* Light gray background for headers */
        }
        .invoice-total {
            text-align: right;
            font-weight: bold;
        }
        .footer {
            text-align: center;
            font-size: smaller;
        }

        @media print {
            .invoice-container {
                width: 100%; /* Full width when printing */
                border: none; /* Remove border when printing */
            }
            body {
                margin: 0; /* Remove margins when printing */
            }
            /* other print specific styles */
            .no-print { /* Example class to hide elements on print */
                display: none;
            }
        }
    </style>
</head>
<body>

<div class="invoice-container">
    <div class="invoice-header">
        <h1>Invoice</h1>
    </div>

    <div class="invoice-details">
        <p><strong>Invoice Number:</strong> INV-2023-10-001</p>
        <p><strong>Date:</strong><?= $row["tgl_input"]; ?></p>
        <p><strong>Bill to:</strong> John Doe<br>
           123 Main Street<br>
           Anytown, CA 91234</p>
        <p><strong>Bill from:</strong> Your Company Name<br>
            Your Company Address</p>
    </div>

    <table class="invoice-items">
        <thead>
            <tr>
                <th>Item</th>
                <th>Quantity</th>
                <th>Unit Price</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Product A</td>
                <td>2</td>
                <td>$10.00</td>
                <td>$20.00</td>
            </tr>
            <tr>
                <td>Product B</td>
                <td>1</td>
                <td>$25.00</td>
                <td>$25.00</td>
            </tr>
            </tbody>
    </table>
</div>

</body>
</html>';
    $i = 1;
    foreach($weapon as $row) {
        $html .= '<tr>
            <td>'. $i++ .'</td>
            <td>'. $row["nama_senjata"].'</td>
            <td><img src="img/'. $row["gambar"] .'" width="50"></td>
            <td>'. $row["type_senjata"].'</td>
            <td>'. $row["warna"].'</td>
            <td>'. $row["qty_beli"].'</td>
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

