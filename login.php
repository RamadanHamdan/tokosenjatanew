<?php
session_start();
require 'functions.php';
// cek cookie
if(isset($_COOKIE['id']) && (isset($_COOKIE['key'])) ) {
    $id = $_COOKIE['id'];
    $key = $_COOKIE['key'];

    // ambil username berdasarkan id
    $result = mysqli_query($conn,"SELECT username FROM user WHERE id = $id");
    $row = mysqli_fetch_assoc($result);
    
    if($key === hash('sha256', $row['username']) ) {
        $_SESSION['login'] = true;
    }
}

if( isset($_SESSION["login"])) {
    header("Location: index.php");
    exit;
}

if(isset($_POST["login"]) ) {

    $username = $_POST["username"];
    $password = $_POST["password"];

    $result = mysqli_query($conn, "SELECT * FROM user WHERE 
            username = '$username'");

    // cek username
    if(mysqli_num_rows($result) === 1 ) {

        // cek password
        $row = mysqli_fetch_assoc($result);
        if(password_verify($password, $row["password"]) ) {
            // set session
            $_SESSION["login"] = true;
            // cek remember me
            if(isset($_POST['remember']) ) {
                // buat cookie

                setcookie('id', $row['id'], time()+60);
                setcookie('key', hash('sha256', $row['username']), 
                time()+60);
            }
            header("Location: index.php");
            exit;
        }
    }

    $error = true;

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
    <style>
        .content {
            position: center;
            margin: 150px;
            padding: 150px;
            align-items: center;
            justify-items: center;
            align-content: center;
            justify-content: center;
        }
    </style>
    <title>Halaman Login</title>
</head>
<body>
    <div class="content">
    <h1>Login</h1>
    <?php if(isset($error) ) :?>
        <p style="color:red; font-style:italic">username / password salah</p>
    <?php endif;?>
    <form class="row g-3" action="" method="post">
  <div class="col-auto">
    <label for="username" class="navbar-brand">Username</label>
    <input type="text" class="form-control" id="username" name="username">
  </div>
  <div class="col-auto">
    <label for="password" class="navbar-brand">Password</label>
    <input type="password" class="form-control" id="password" name="password" placeholder="Password">
  </div>
  <label for="remember">Remember</label>
    <input type="checkbox" id="remember" name="remember">
    <div class="col-auto">
    <button type="submit" name="login" class="btn btn-primary mb-3">Login</button>
    </div>
  </form> <br>
  </div>
</body>
</html>