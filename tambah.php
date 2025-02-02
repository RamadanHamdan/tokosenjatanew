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
    <h1>Tambah Data Senjata</h1>
    <ul>
    <form action="" method="post" class="row g-3">
 <div class="col-md-2">
    <label for="id_barang" class="form-label">Id Barang</label>
    <input type="text" class="form-control" id="id_barang">
 </div>
  <div class="col-md-5">
    <label for="nama_senjata" class="form-label">Nama Senjata</label>
    <input type="text" class="form-control" id="nama_senjata">
  </div>
  <div class="col-md-4">
    <label for="gambar" class="form-label">Gambar</label>
    <input type="file" class="form-control" id="gambar" placeholder="input gambar">
  </div>
<li>
  <div class="col-md-2">
    <label for="type_senjata" class="form-label">Type Senjata</label>
    <input type="text" class="form-control" id="type_senjata" placeholder="Type">
  </div>
</li>
  <div class="col-md-2">
    <label for="warna" class="form-label">Warna</label>
    <input type="text" class="form-control" id="warna">
  </div>

  <div class="col-md-1">
    <label for="stock" class="form-label">Stock</label>
    <input type="number" class="form-control" id="stock">
  </div>


  <div class="col-md-1">
    <label for="sisa_stock" class="form-label">Stock Awal</label>
    <input type="number" class="form-control" id="sisa_stock">
  </div>


  <div class="col-md-2">
    <label for="harga" class="form-label">Harga</label>
    <input type="text" class="form-control" id="harga">
  </div>

<li>
  <div class="col-md-2">
    <label for="tgl_input" class="form-label">Tanggal Input</label>
    <input type="date" class="form-control" id="tgl_input" value="<?=date("j F Y, G:i");?>">
  </div>
</li>
  <div class="col-12">
    <button type="submit" name="submit" class="btn btn-primary">Tambah Data</button>
  </div>
  <a href="index.php">Lihat Data</a>
  </ul>
</form>
</body>
</html>