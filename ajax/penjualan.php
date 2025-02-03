<?php
sleep(1);
require '../functions.php';

$keyword = $_GET["keyword_penjualan"];

$query = "SELECT id_barang,nama_senjata,gambar, type_senjata, warna, qty_beli, harga, total, tgl_input, tgl_update FROM penjualan 
            WHERE
            id_barang LIKE '%$keyword%' OR 
            nama_senjata LIKE '%$keyword%' OR
            type_senjata LIKE '%$keyword%' OR
            warna LIKE '%$keyword%' OR
            tgl_input LIKE '%$keyword%'
            ";
$weapon = query($query);

?>
<table class="table table-bordered">
    <tr>
        <th>No</th>
        <th>Null</th>
        <th>Id Barang</th>
        <th>Nama Senjata</th>
        <th>Gambar</th>
        <th>Type Senjata</th>
        <th>Warna</th>
        <th>Qty_Beli</th>
        <th>Harga</th>
        <th>Total</th>
        <th>Tanggal Update</th>
        <th>Tanggal Input</th>
    </tr>
    <?php $i = 1; ?>
    <?php foreach ($weapon as $row) : ?>
       <tr>
    <td><?= $i; ?></td>
    <td>
        </td>
        <td><?= $row["id_barang"];?></td>
        <td><?= $row["nama_senjata"];?></td>
        <td><img src="img/<?= $row["gambar"];?>"width="100"></td>
        <td><?= $row["type_senjata"];?></td>
        <td><?= $row["warna"];?></td>
        <td><?= $row["qty_beli"];?></td>
        <td><?= $row["harga"];?></td>
        <td><?= $row["total"];?></td>
        <td><?= $row["tgl_update"];?></td>
        <td><?= $row["tgl_input"];?></td>
       </tr>
    <?php $i++; ?>
    <?php endforeach; ?>
    </table>