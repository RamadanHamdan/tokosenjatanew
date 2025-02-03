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
    <link src="node_modules/bootstrap/scss/_mixins.scss" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@floating-ui/core@1.6.9"></script>
    <script src="https://cdn.jsdelivr.net/npm/@floating-ui/dom@1.6.13"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"></script>
    <script src="js/jquery-3.7.1.min.js"></script>
    <script src="js/script.js"></script>
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
      <form action="" class="form-cari-penjualan" method="post" role="search">
        <input class="form-control me-2" type="search" id="keyword_penjualan" name="keyword_penjualan" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success" name="cari_penjualan" id="tombol-cari-penjualan" type="submit">Search</button>
      </form>
    </div>
  </div>
</nav>
    <h1>Daftar Penjualan</h1>
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