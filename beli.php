<?php


require 'functions.php';
$id = $_GET["id"];
$weapon = query("SELECT * FROM tokosenjata WHERE id = $id")[0];

if(isset($_POST["beli"]) ) {
    if(beli($_POST) > 0 ) {
        echo "<script>
            alert('data berhasil dibeli');
            document.location.href = 'index.php';
        </script>";
    } else {
        echo "<script>
            alert('data gagal dibeli');
            document.location.href = 'index.php';
        </script>";
    }
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
    <title>Ubah Data</title>
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
        <li class="nav-item">
          <a class="nav-link" href="#">Beli</a>
        </li>
      </ul>
      <form action="" class="form-cari" method="post" role="search">
        <input class="form-control me-2" type="search" id="keyword" name="keyword" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success" name="cari" id="tombol-cari" type="submit">Search</button>
      </form>
    </div>
  </div>
</nav>
<ul>
    <form action="" method="post" enctype="multipart/form-data" class="row g-3"> 
    <input type="hidden" name="id" value="<?=$weapon["id"];?>">
    <input type="hidden" name="gambarlama" value="<?= $weapon["gambar"];?>">
        <label for="id_barang"></label>
            <input type="hidden" name="id_barang" id="id_barang" 
                value="<?= $weapon["id_barang"];?>">     
            <div class="col-md-3">
                <label for="nama_senjata" class="form-label">Nama Senjata</label>
                <input type="text" class="form-control" readonly name="nama_senjata" id="nama_senjata" 
                value="<?= $weapon["nama_senjata"];?>">
            </div>
            <div class="col-md-3">
                <label for="gambar" class="form-label">Gambar</label>
                <img src="img/<?= $weapon["gambar"];?>" width="90">
                <input type="file" class="form-control" readonly name="gambar" id="gambar">
            </div>
            <div class="col-md-4">
                <label for="type_senjata" class="form-label">Type_Senjata</label>
                <input type="text" class="form-control" readonly name="type_senjata" id="type_senjata" 
                value="<?= $weapon["type_senjata"];?>">
            </div>
            <div class="col-md-3">
                <label for="warna" class="form-label">Warna</label>
                <input type="text" class="form-control" readonly name="warna" id="warna" 
                value="<?= $weapon["warna"];?>">
            </div>
            <div class="col-md-3">
                <label for="stock" class="form-label">Stock</label>
                <input type="number" class="form-control" readonly name="stock" id="stock" 
                value="<?= $weapon["stock"];?>"> 
            </div>
            <div class="col-md-4">
                <label for="sisa_stock" class="form-label"></label>
                <input type="hidden" class="form-control" name="sisa_stock" id="sisa_stock" 
                value="<?= $weapon["sisa_stock"];?>">
            </div>
            <div class="col-md-3">
                <label for="qty_beli" class="form-label">Quantity Beli</label>
                <input type="number" class="form-control" name="qty_beli" id="qty_beli" min="1">
            </div>
            <div class="col-md-3">
                <label for="harga" class="form-label">Harga</label>
                <input type="text" class="form-control" readonly name="harga" id="harga"
                value="<?= $weapon["harga"];?>">
            </div>

                <label for="total"></label>
                <input type="hidden" name="total" id="total">

            <div class="col-md-4">
                <label for="tgl_input">Tanggal</label>
                <input type="date" class="form-control" name="tgl_input" id="tgl_input" 
                value="<?=date('Y-m-d H:i:s');?>">
            </div>
            <div class="col-12">
            <button type="beli" name="beli" id="beli" class="btn btn-primary">Beli Senjata</button><br>
            </div>
            </ul>
        </form>
    </body>
</html>