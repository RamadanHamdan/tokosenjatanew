<?php
session_start();
if( !isset($_SESSION["login"]) ) {
    header("Location: login.php");
    exit;
}
require 'functions.php';

$id = $_GET["id"];

if(print_invoice($id) > 0 ) {
    echo "<script>
        alert('invoice berhasil dicetak');
        document.location.href = 'penjualan.php';
        </script>";
} else {
    echo "<script>
        alert('invoice gagal dicetak');
        document.location.href = 'penjualan.php';
        </script>";
}
?>