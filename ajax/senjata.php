<?php
sleep(1);
require '../functions.php';

$keyword = $_GET["keyword"];

$query = "SELECT * FROM tokosenjata 
            WHERE 
            nama_senjata LIKE '%$keyword%' OR
            type_senjata LIKE '%$keyword%' OR
            warna LIKE '%$keyword%'
            ";
$weapon = query($query);

?>
<table border="5" cellpadding="5" cellspacing="5">
    <tr>
        <th>No</th>
        <th>Aksi</th>
        <th>Id Barang</th>
        <th>Nama Senjata</th>
        <th>Gambar</th>
        <th>Type Senjata</th>
        <th>Warna</th>
        <th>Stock Awal</th>
        <th>Sisa Stock</th>
        <th>Harga</th>
        <th>Tanggal Update</th>
        <th>Tanggal Input</th>
    </tr>
    <?php $i = 1; ?>
    <?php foreach ($weapon as $row) : ?>
       <tr>
    <td><?= $i; ?></td>
    <td>
    <a href="ubah.php?id=<?= $row["id"]; ?>">ubah</a> |
            <a href="hapus.php?id=<?= $row["id"]; ?>" onclick="
                return confirm('sure?');">hapus</a>
            <a href="beli.php?id=<?= $row["id"];?>">beli ?</a>
        </td>
        <td><?= $row["id_barang"];?></td>
        <td><?= $row["nama_senjata"];?></td>
        <td><img src="img/<?= $row["gambar"];?>"width="100"></td>
        <td><?= $row["type_senjata"];?></td>
        <td><?= $row["warna"];?></td>
        <td><?= $row["stock"];?></td>
        <td><?= $row["sisa_stock"];?></td>
        <td><?= $row["harga"];?></td>
        <td><?= $row["tgl_update"];?></td>
        <td><?= $row["tgl_input"];?></td>
       </tr>
    <?php $i++; ?>
    <?php endforeach; ?>
    </table>