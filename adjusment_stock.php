<?php 

require 'functions.php';

$jumlahDataPerHalaman = 10;
$jumlahData = count(query("SELECT * FROM adjusment_stock"));
$jumlahHalaman = ceil($jumlahData / $jumlahDataPerHalaman);
$halamanAktif = (isset($_GET["halaman"]) ) ? $_GET["halaman"] : 1;
$awalData = ($jumlahDataPerHalaman * $halamanAktif) - $jumlahDataPerHalaman;

$weapon = query("SELECT id_barang,nama_senjata,gambar, type_senjata, warna, stock, harga, tgl_input, tgl_update 
FROM adjusment_stock LIMIT 0 , $jumlahDataPerHalaman");

if(isset($_POST["cari_adjusment"]) ) {
    $weapon = cari_adjusment($_POST["keyword_adjusment"]);
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@floating-ui/core@1.6.9"></script>
    <script src="https://cdn.jsdelivr.net/npm/@floating-ui/dom@1.6.13"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"></script>
    <script src="js/jquery-3.7.1.min.js"></script>
    <script src="js/script.js"></script>
    <title>Daftar Adj Stock</title>
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
    <script src="js/script_adjusment.js"></script>
</head>
<body>
<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand" href="index.php">Adan Gun Shop</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="index.php">Dashboard</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="print_adjusment.php">Cetak</a>
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
      <form action="" class="form-cari-adjusment" method="post" role="search">
        <input class="form-control me-2" type="search" id="keyword_adjusment" name="keyword_adjusment" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success" name="cari_adjusment" id="tombol-cari-adjusment" type="submit">Search</button>
      </form>
    </div>
  </div>
</nav>
    <h1>Daftar Adjusment</h1>
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
    
    <table class="table table-bordered">
    <tr>
        <th>No</th>
        <th>Id Barang</th>
        <th>Nama Senjata</th>
        <th>Gambar</th>
        <th>Type Senjata</th>
        <th>Warna</th>
        <th>Adj Stock</th>
        <th>Harga</th>
        <th>Tanggal Update</th>
        <th>Tanggal Input</th>

    </tr>
    <?php $i = 1; ?>
    <?php foreach ($weapon as $row) : ?>
       <tr>
    <td><?= $i; ?></td>
        <td><?= $row["id_barang"];?></td>
        <td><?= $row["nama_senjata"];?></td>
        <td><img src="img/<?= $row["gambar"];?>"width="100"></td>
        <td><?= $row["type_senjata"];?></td>
        <td><?= $row["warna"];?></td>
        <td><?= $row["stock"];?></td>
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