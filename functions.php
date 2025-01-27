<?php

$conn = mysqli_connect('localhost','root','root','phpdasar');
date_default_timezone_set("Asia/Jakarta");
function query($query) {
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = [];
    while( $row = mysqli_fetch_assoc($result) ) {
        $rows[] = $row;
    }
    return $rows;
}

function tambah($data) {
    global $conn;
    $id_barang = htmlspecialchars($data["id_barang"]);
    $nama_senjata = htmlspecialchars($data["nama_senjata"]);
    $gambar = htmlspecialchars($data["gambar"]);
    $type_senjata = htmlspecialchars($data["type_senjata"]);
    $warna = htmlspecialchars($data["warna"]);
    $stock = htmlspecialchars($data["stock"]);
    $sisa_stock = htmlspecialchars($data["sisa_stock"]);
    $harga = htmlspecialchars($data["harga"]);
    $tgl_input = date("Y-m-d H:i:s");
    $tgl_update = date("Y-m-d H:i:s");
    $query = "INSERT INTO tokosenjata VALUES (0,'$id_barang', '$nama_senjata', '$gambar', '$type_senjata', '$warna', '$stock' ,'$sisa_stock' ,'$harga' ,'$tgl_input','$tgl_update')";
    
    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}

function ubah($data) {
    global $conn;
    $id = $data["id"];
    $id_barang = htmlspecialchars($data["id_barang"]);
    $nama_senjata = htmlspecialchars($data["nama_senjata"]);
    $gambarlama = htmlspecialchars($data["gambarlama"]);
    if($_FILES['gambar']['error'] === 4 ) {
        $gambar = $gambarlama;
    } else {
        $gambar = upload();
    }
    $type_senjata = htmlspecialchars($data["type_senjata"]);
    $warna = htmlspecialchars($data["warna"]);
    $stock = htmlspecialchars($data["stock"]);
    $harga = htmlspecialchars($data["harga"]);
    $tgl_update = date("Y-m-d H:i:s");
    
    $query = "UPDATE tokosenjata SET
            id_barang = '$id_barang',
            nama_senjata = '$nama_senjata',
            gambar = '$gambar',
            type_senjata = '$type_senjata',
            warna = '$warna',
            stock = '$stock',
            harga = '$harga',
            tgl_update = '$tgl_update'
            WHERE id = $id
            ";
    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}   

function upload() {
    $namaFile = $_FILES['gambar']['name'];
    $ukuranFile = $_FILES['gambar']['size'];
    $error = $_FILES['gambar']['error'];
    $tmpName = $_FILES['gambar']['tmp_name'];

    if($error === 4 ) {
        echo "<script>
        alert('pilih gambar terlebih dahulu');
        </script>";
        return false;
    }
    // cek apakah yang di upload gambar
    $ekstensiGambarValid = ['jpg','jpeg','png'];
    $ekstensiGambar = explode(0, $namaFile);
    $ekstensiGambar = strtolower(end($ekstensiGambar));
    if( in_array($ekstensiGambar, $ekstensiGambarValid) ) {
        echo "<script>
        alert('yang anda upload bukan gambar');
        </script>";
        return false;
    }

    if($ukuranFile > 1000000) {
        echo "<script>
        alert('ukuran gambar terlalu besar');
        </script>";
        return false;
    }

    $namaFileBaru = uniqid();
    $namaFileBaru .= '.';
    $namaFileBaru .= $ekstensiGambar;
    move_uploaded_file($tmpName, 'img/' . $namaFileBaru);

    return $namaFileBaru;
}

function cari($keyword) {
    $query = "SELECT * FROM tokosenjata 
            WHERE 
            id_barang LIKE '%$keyword%' OR
            nama_senjata LIKE '%$keyword%' OR
            type_senjata LIKE '%$keyword%' OR
            warna LIKE '%$keyword%' OR
            harga LIKE '%$keyword%' 
            ";
    return query($query);
}

function hapus($id) {
    global $conn;
    mysqli_query($conn, "DELETE FROM tokosenjata WHERE id = $id");
    return mysqli_affected_rows($conn);
}


function registrasi($data) {
    global $conn;
    $username = strtolower(stripslashes($data["username"]));
    $password = mysqli_real_escape_string($conn, $data["password"]);
    $password2 = mysqli_real_escape_string($conn, $data["password2"]);

    // cek username sudah ada atau belum
    $result = mysqli_query($conn, "SELECT username FROM user 
    WHERE username = '$username'");
    if(mysqli_fetch_assoc($result) ) {
        echo "<script>
                alert('username sudah terdaftar!');
            </script>";
        return false;
    }

    if($password !== $password2) {
        echo "<script>
            alert('password tidak sesuai');
        </script>";
        return false;
    }

    // enkripsi password
    $password = password_hash($password, PASSWORD_DEFAULT);
    mysqli_query($conn, "INSERT INTO user VALUES
    (0, '$username', '$password')");
    return mysqli_affected_rows($conn);
}

function beli($data) {
    global $conn;
    $id = $data["id"];
    $id_barang = $data["id_barang"];
    $nama_senjata = $data["nama_senjata"];
    $gambarlama = $data["gambarlama"];
    if($_FILES['gambar']['error'] === 4 ) {
        $gambar = $gambarlama;
    } else {
        $gambar = upload();
    }
    $type_senjata = $data["type_senjata"];
    $warna = $data["warna"];
    $stock = $data["stock"];
    $qty = $data["qty"];
    $total = $data["total"];
    $harga = $data["harga"];
    $sisa_stock = $data["sisa_stock"];
    $tgl_update = date("Y-m-d H:i:s");
    $tgl_input = date("Y-m-d H:i:s");
    // $query = "INSERT INTO transaksi 
    // SELECT tokosenjata.id_transaksi, 
    // tokosenjata.id_barang, 
    // tokosenjata.nama_senjata,
    // tokosenjata.gambar,
    // tokosenjata.type_senjata,
    // tokosenjata.warna,
    // HAVING SUM(penjualan.$qty*tokosenjata.harga) as total,
    // tokosenjata.tgl_input,
    // tokosenjata.tgl_update FROM tokosenjata LEFT JOIN penjualan ON tokosenjata.id = penjualan.id_penjualan 
    // GROUP BY tokosenjata.id_barang ORDER BY id DESC";
    $query = "UPDATE tokosenjata SET
            id_barang = '$id_barang',
            nama_senjata = '$nama_senjata',
            gambar = '$gambar',
            type_senjata = '$type_senjata',
            warna = '$warna',
            tgl_input = '$tgl_input',
            tgl_update = '$tgl_update',
            stock = '$sisa_stock',
            sisa_stock = '$stock' - '$qty'
            WHERE id = $id
            ";
    $query = "INSERT INTO penjualan VALUES 
    (0 , '$id_barang','$nama_senjata', '$gambar', '$type_senjata', '$warna', '$qty', '$harga', '$total', '$tgl_input', '$tgl_update')";
    // $query = "SELECT "
    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}


// function penjualan($data) {
//     global $conn;
//     $id = $data["id"];
//     $id_barang = $data["id_barang"];
//     $nama_senjata = $data["nama_senjata"];
//     $gambarlama = $data["gambarlama"];
//     if($_FILES['gambar']['error'] === 4 ) {
//         $gambar = $gambarlama;
//     } else {
//         $gambar = upload();
//     }
//     $type_senjata = $data["type_senjata"];
//     $warna = $data["warna"];
//     $qty = $data["qty"];
//     $stock = $data["stock"];
//     $total = $data["total"];
//     $tgl_input = date("Y-m-d H:i:s");
//     $tgl_update = date("Y-m-d H:i:s");
//     $query = "UPDATE tokosenjata SET
//             nama_senjata = '$nama_senjata',
//             gambar = '$gambar',
//             type_senjata = '$type_senjata',
//             warna = '$warna',
//             stock = '$stock',
//             tgl_input = '$tgl_input',
//             tgl_update = '$tgl_update'
//             WHERE id = $id
//             ";
//     $query = "INSERT INTO penjualan VALUES 
//     (0 , '$id_barang','$nama_senjata', '$gambar', '$type_senjata', '$warna', '$qty', '$total', '$tgl_input', '$tgl_update')";
//     mysqli_query($conn, $query);
//     return mysqli_affected_rows($conn);
// }

if(!function_exists('date')) {
    function date($format = 'Y-m-d H:i:s', $timestamp = null) {
        if($timestamp === null) {
            $timestamp = time();
        }
        return gmdate($format, $timestamp);
    }
}