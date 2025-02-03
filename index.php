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


// $weapon = query("SELECT tokosenjata.id_barang,
//                         penjualan.id_barang
//                         FROM 
//                         tokosenjata 
//                         LEFT JOIN penjualan ON tokosenjata.id_barang = penjualan.id_barang GROUP BY tokosenjata.id_barang,
//                         SELECT tokosenjata.nama_senjata,
//                         penjualan.nama_senjata
//                         FROM
//                         tokosenjata
//                         LEFT JOIN penjualan ON tokosenjata.nama_senjata = penjualan.nama_senjata GROUP BY tokosenjata.nama_senjata");
                        $weapon = query("SELECT
                                            tokosenjata.id, 
                                            tokosenjata.id_barang,
                                            tokosenjata.nama_senjata,
                                            tokosenjata.gambar,
                                            tokosenjata.type_senjata,
                                            tokosenjata.warna,
                                            tokosenjata.stock,
                                            SUM(tokosenjata.sisa_stock) AS sisa_stock,
                                            SUM(tokosenjata.stock - penjualan.qty_beli) AS sisa_stock,
                                            tokosenjata.harga,
                                            tokosenjata.tgl_input,
                                            tokosenjata.tgl_update
                                        FROM 
                                            tokosenjata
                                        LEFT JOIN 
                                            penjualan 
                                        ON 
                                            tokosenjata.id_barang = penjualan.id_barang 
                                        GROUP BY 
                                            tokosenjata.id,
                                            tokosenjata.id_barang,
                                            tokosenjata.nama_senjata,
                                            tokosenjata.gambar,
                                            tokosenjata.type_senjata,
                                            tokosenjata.warna,
                                            tokosenjata.stock,
                                            tokosenjata.sisa_stock,
                                            tokosenjata.harga,
                                            tokosenjata.tgl_input,
                                            tokosenjata.tgl_update LIMIT 0, $jumlahDataPerHalaman");



if(isset($_POST["cari"]) ) {
    $weapon = cari($_POST["keyword"]);
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Daftar Senjata</title>
    <script src="https://cdn.jsdelivr.net/npm/@floating-ui/core@1.6.9"></script>
    <script src="https://cdn.jsdelivr.net/npm/@floating-ui/dom@1.6.13"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"></script>
    <script src="js/jquery-3.7.1.min.js"></script>
    <script src="js/script.js"></script>
</head>
<body>
<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Adan Gunshop</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="index.php">Dashboard</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="cetak.php">Cetak</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Dropdown
          </a>
          <div class=".dropdown">
    <ul class="dropdown-menu">
    <li><a class="dropdown-item" href="tambah.php">Tambah Data</a></li>
    <li><a class="dropdown-item" href="penjualan.php">Penjualan</a></li>
    <li><a class="dropdown-item" href="adjusment_stock.php">Adjusment Stock</a></li>
    </ul>
    </div>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="logout.php">Logout</a>
        </li>
      </ul>
      <form action="" class="form-cari" method="post" role="search">
        <input class="form-control me-2" type="search" id="keyword" name="keyword" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success" name="cari" id="tombol-cari" type="submit">Search</button>
      </form>
    </div>
  </div>
</nav>
    <h1>Daftar Senjata</h1>
    <!-- <form action="" method="post" class="form-cari">

        <input type="text" name="keyword" size="30"
        autofocus placeholed="input here" autofocus="off" id="keyword">
        <button type="submit" name="cari" id="tombol-cari">Cari</button>
    </form><br> -->
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
    
    <table class="table table-striped-columns" border="5" cellpadding="5" cellspacing="5">
    <tr>
        <th>No</th>
        <th>Aksi</th>
        <th>Id Barang</th>
        <th>Nama Senjata</th>
        <th>Gambar</th>
        <th>Type Senjata</th>
        <th>Warna</th>
        <th>Stock</th>
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