<?php

require 'functions.php';

$id = $_GET["id"];
$weapon = query("SELECT * FROM penjualan WHERE id_penjualan = $id");
?>
<!DOCTYPE html>
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
        <?php foreach($weapon as $row) : ?>
        <p><strong>Invoice Number:</strong><?php echo generateInvoiceNumber();?></p>
        <p><strong>Date:</strong><?= $row["tgl_input"];?></p>
        <?php endforeach; ?>
    </div>

    <table class="invoice-items">
        <thead>
            <tr>
                <th>No</th>
                <th>Id Barang</th>
                <th>Nama Senjata</th>
                <th>Gambar</th>
                <th>Type Senjata</th>
                <th>Warna</th>
                <th>Qty Beli</th>
                <th>Harga</th>
                <th>Tanggal Transaksi</th>
            </tr>
        </thead>
        <tbody>
            <?php $i = 1; ?>
    <?php foreach ($weapon as $row) : ?>
       <tr>
    <td><?= $i; ?></td>
        <td><?= $row["id_barang"];?></td>
        <td><?= $row["nama_senjata"];?></td>
        <td><img src="img/<?= $row["gambar"];?>"width="100"></td>
        <td><?= $row["type_senjata"];?></td>
        <td><?= $row["warna"];?></td>
        <td><?= $row["qty_beli"];?></td>
        <td><?= $row["harga"];?></td>
        <td><?= $row["tgl_input"];?></td>
       </tr>
       
    <?php $i++; ?>
    <?php endforeach; ?>
            </tbody>
    </table>
        
    <div class="invoice-total">
        <strong>Total:Rp.</strong><?= $row["total"];?>
    </div>

    <div class="no-print" style="margin-top: 20px;">  <button onclick="window.print()">Print Invoice</button>
    </div>
</div>

</body>
</html>