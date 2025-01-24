<?php
session_start();
if( !isset($_SESSION["login"]) ) {
    header("Location: login.php");
    exit;
}
require 'functions.php';
$id = $_GET["id"];
$weapon = query("SELECT * FROM tokosenjata WHERE id = $id")[0];

if(isset($_POST["submit"]) ) {
    if(ubah($_POST) > 0 ) {
        echo "<script>
        alert('data berhasil diubah!');
        document.location.href = 'index.php';
        </script>";
} else {
    echo "<script>
        alert('data gagal diubah!');
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
    <title>Ubah Data</title>
</head>
<body>
    <form action="" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?=$weapon["id"];?>">
        <input type="hidden" name="gambarlama" value="<?= $weapon["gambar"];?>">
        <ul>
            <li>
                <label for="nama_senjata">Nama Senjata</label>
                <input type="text" name="nama_senjata" id="nama_senjata" 
                value="<?= $weapon["nama_senjata"];?>">
            </li>
            <li>
                <label for="id_barang">SKU</label>
                <input type="text" name="id_barang" id="id_barang" 
                value="<?= $weapon["id_barang"];?>">
            </li>
            <li>
                <label for="gambar">Gambar</label>
                <img src="img/<?= $weapon["gambar"];?>" width="90">
                <input type="file" name="gambar" id="gambar">
            </li>
            <li>
                <label for="type_senjata">Type_Senjata</label>
                <input type="text" name="type_senjata" id="type_senjata" 
                value="<?= $weapon["type_senjata"];?>">
            </li>
            <li>
                <label for="warna">Warna</label>
                <input type="text" name="warna" id="warna" 
                value="<?= $weapon["warna"];?>">
            </li>
            <li>
                <label for="stock">Stock</label>
                <input type="number" name="stock" id="stock"
                value="<?= $weapon["stock"];?>">
            </li>
            <li>
                <label for="harga">Harga</label>
                <input type="text" name="harga" id="harga" 
                value="<?= $weapon["harga"];?>">
            </li>
            <li>
                <label for="tgl_update">Tanggal</label>
                <input type="date" class="form-control" name="tgl_update" id="tgl_update" 
                value="<?php echo  date("j F Y, G:i");?>">
            </li>
            <button type="submit" name="submit">Ubah Data</button><br>
            <a href="index.php">Lihat Data</a>
        </ul>
    </form>
</body>
</html>