<?php
session_start();
if( !isset($_SESSION["login"]) ) {
    header("Location: login.php");
    exit;
}
require 'functions.php';

if(isset($_POST["submit"]) ) {
    if(tambah($_POST) > 0 ) {
        echo "<script>
            alert('data berhasil ditambahkan');
            document.location.href = 'index.php';
        </script>";
    } else {
        echo "<script>
                alert('data gagal ditambahkan');
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
    <title>Tambah Data Senjata</title>
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
          <a class="nav-link" href="#">Tambah Data</a>
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
    <form action="" method="post" class="row g-3">
 <div class="col-md-3">
    <label for="id_barang" class="form-label">SKU</label>
    <input type="text" class="form-control" id="id_barang" name="id_barang">
 </div>
  <div class="col-md-3">
    <label for="nama_senjata" class="form-label">Nama Senjata</label>
    <input type="text" class="form-control" id="nama_senjata" name="nama_senjata">
  </div>
  <div class="col-md-4">
    <label for="gambar" class="form-label">Gambar</label>
    <input type="file" class="form-control" id="gambar" name="gambar" placeholder="input gambar">
  </div>

  <div class="col-md-3">
    <label for="type_senjata" class="form-label">Type Senjata</label>
    <input type="text" class="form-control" id="type_senjata" name="type_senjata" placeholder="Type">
  </div>

  <div class="col-md-3">
    <label for="warna" class="form-label">Warna</label>
    <input type="text" class="form-control" id="warna" name="warna">
  </div>

  <div class="col-md-4">
    <label for="stock" class="form-label">Stock</label>
    <input type="number" class="form-control" id="stock" name="stock">
  </div>


  <div class="col-md-3">
    <label for="sisa_stock" class="form-label">Stock Awal</label>
    <input type="number" class="form-control" id="sisa_stock" name="sisa_stock">
  </div>


  <div class="col-md-3">
    <label for="harga" class="form-label">Harga</label>
    <input type="text" class="form-control" id="harga" name="harga">
  </div>

  <div class="col-md-4">
    <label for="tgl_input" class="form-label">Tanggal Input</label>
    <input type="date" class="form-control" id="tgl_input" value="<?=date("j F Y, G:i");?>">
  </div>
  <div class="col-12">
    <button type="submit" name="submit" class="btn btn-primary">Tambah Data</button>
  </div>
  </ul>
</form>
</body>
</html>