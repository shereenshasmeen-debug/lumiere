<?php
session_start();
require_once 'koneksi.php';

$username = $_POST['username'];
$password = $_POST['password'];

$query = mysqli_query($conn,
    "SELECT * FROM akun 
     WHERE (username='$username' OR email='$username')
    ");

$data = mysqli_fetch_assoc($query);

if(!$data) {
    echo "<script>alert('Login failed! Username / Email not found');
          window.location='Login.php';</script>";
    exit;
}

if (!password_verify($password, $data['password'])) {
    echo "<script>
          alert('Login failed!'); 
          window.location='login.php';
    </script>";
    exit;
}



$_SESSION['login']    = true;
$_SESSION['id']       = $data['id'];       
$_SESSION['username'] = $data['username'];
$_SESSION['nama']     = $data['nama'];
$_SESSION['role']     = $data['role'];


if($data['role'] == 'admin') {
    header("location: admin/dashboard.php");
    exit;
} else {
    header("location: Home.php");
    exit;
}
?>
