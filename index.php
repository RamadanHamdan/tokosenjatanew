<?php
session_start();
if( !isset($_SESSION["login"]) ) {
    header("Location: login.php");
    exit;
}
require 'functions.php';
// konfigurasi pagination

$jumlahDataPerHalaman = 10;
$jumlahData = count(query("SELECT * FROM tokosenjata"));
$jumlahHalaman = ceil($jumlahData / $jumlahDataPerHalaman);
$halamanAktif = (isset($_GET["halaman"]) ) ? $_GET["halaman"] : 1;
$awalData = ($jumlahDataPerHalaman * $halamanAktif) - $jumlahDataPerHalaman;


$weapon = query("SELECT * FROM tokosenjata LIMIT $awalData, $jumlahDataPerHalaman ");


if(isset($_POST["cari"]) ) {
    $weapon = cari($_POST["keyword"]);
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Senjata</title>
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
    <script src="js/script.js"></script>
</head>
<body>
    <a href="logout.php" class="logout">Logout</a> | <a href="cetak.php" target="blank">Cetak</a> | <a href="penjualan.php" target="blank">Penjualan</a>
    <h1>Daftar Senjata</h1>
    <a href="tambah.php">Tambah Data Senjata</a><br><br>

    <form action="" method="post" class="form-cari">

        <input type="text" name="keyword" size="30"
        autofocus placeholed="input here" autofocus="off" id="keyword">
        <button type="submit" name="cari" id="tombol-cari">Cari</button>

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
    </div>
</body>
</html>