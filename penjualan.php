<?php 

require 'functions.php';

$jumlahDataPerHalaman = 10;
$jumlahData = count(query("SELECT * FROM penjualan"));
$jumlahHalaman = ceil($jumlahData / $jumlahDataPerHalaman);
$halamanAktif = (isset($_GET["halaman"]) ) ? $_GET["halaman"] : 1;
$awalData = ($jumlahDataPerHalaman * $halamanAktif) - $jumlahDataPerHalaman;

$weapon = query("SELECT id_penjualan, id_barang,nama_senjata,gambar, type_senjata, warna, SUM(qty_beli) AS qty_beli, harga, total, tgl_input, tgl_update 
FROM penjualan GROUP BY id_penjualan, id_barang,nama_senjata,gambar, type_senjata, warna, harga, total, tgl_input, tgl_update  LIMIT 0, $jumlahDataPerHalaman");

if(isset($_POST["cari_penjualan"]) ) {
    $weapon = cari_penjualan($_POST["keyword_penjualan"]);
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Penjualan</title>
    <style>
        .loader {
            width: 100px;
            position: absolute;
            top: 100px;
            z-index: -1;
            display: none;
        }
    </style>
    <script src="js/jquery-3.7.1.min.js"></script>
    <script src="js/script_penjualan.js"></script>
</head>
<body>
    <a href="logout.php" class="logout">Logout</a> | <a href="print_penjualan.php" target="blank">Penjualan</a>
    <h1>Daftar Penjualan</h1>

    <form action="" method="post" class="form-cari-penjualan">

        <input type="text" name="keyword_penjualan" size="30"
        autofocus placeholed="input here" autofocus="off" id="keyword_penjualan">
        <button type="submit" name="cari_penjualan" id="tombol-cari-penjualan">Cari</button>

        <img src="img/loader.gif" class="loader">
    </form><br>
    <div id="container">
    <!-- page navigasi -->
    <?php if( $halamanAktif > 1) : ?>
    <a href="?halaman=<?= $halamanAktif - 1; ?>">&laquo;</a>
    <?php endif; ?>
    
    <?php for($i = 1; $i <= $jumlahHalaman; $i++ ) : ?>
        <?php if( $i == $halamanAktif) : ?>
        <a href="?halaman=<?= $i; ?>" style="font-weight: bold; color: red;
        "><?= $i; ?></a>
        <?php else : ?>
            <a href="?halaman=<?= $i; ?>"><?= $i; ?></a>
        <?php endif; ?>
    <?php endfor; ?>

    <?php if( $halamanAktif < $jumlahHalaman ) : ?>
    <a href="?halaman=<?= $halamanAktif + 1; ?>">&raquo;</a>
    <?php endif; ?>

    </form><br>
    
    <table border="5" cellpadding="5" cellspacing="5">
    <tr>
        <th>No</th>
        <th>Aksi</th>
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
            <a href="print.php?id=<?= $row["id_penjualan"]; ?>">invoice</a> |
            <a href="ubah_transaksi.php?id=<?= $row["id_penjualan"]; ?>">ubah</a> |
            <a href="hapus_transaksi.php?id=<?= $row["id_penjualan"]; ?>" onclick="
                return confirm('sure?');">hapus</a>
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
    </div>
</body>
</html>