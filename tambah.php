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
    <title>Tambah Data Senjata</title>
</head>
<body>
    <h1>Tambah Data Senjata</h1>
    <form action="" method="post">
    <ul>
        <li>
            <label for="nama_senjata">Nama Senjata</label>
            <input type="text" name="nama_senjata" id="nama_senjata">
        </li>
        <li>
            <label for="gambar">Gambar</label>
            <input type="file" name="gambar" id="gambar">
        </li>
        <li>
            <label for="type_senjata">Type Senjata</label>
            <input type="text" name="type_senjata" id="type_senjata">
        </li>
        <li>
            <label for="warna">Warna</label>
            <input type="text" name="warna" id="warna">
        </li>
        <li>
            <label for="qty">Qty</label>
            <input type="text" name="qty" id="qty">
        </li>
        <li>
            <label for="harga">Harga</label>
            <input type="text" name="harga" id="harga"> <br>
        <li>
            <label for="tgl_input">Tanggal</label>
            <input type="date" class="form-control" name="tgl_input" id="tgl_input" 
                value="<?=date("j F Y, G:i");?>">
        </li>
        <button type="submit" name="submit">Tambah</button>
        <li>
            <a href="index.php">Lihat Data</a>
        </li>
    </ul>
    </form>
</body>
</html>