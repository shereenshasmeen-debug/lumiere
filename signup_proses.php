<?php
include 'koneksi.php';

$username = trim($_POST['username'] ?? '');
$email    = trim($_POST['email'] ?? '');
$password = trim($_POST['password'] ?? '');
$nama     = trim($_POST['nama'] ?? '');

if ($username == '' || $email == '' || $password == '' || $nama == '') {
      echo "<script>
            alert('All fields are required!');
            window.location='signup.php';
            </script>";
      exit();
}

$cek = mysqli_query($conn,
    "SELECT * FROM akun 
     WHERE username = '$username' 
     OR email = '$email'");



if(mysqli_num_rows($cek) > 0) {
      header("location: signup.php?pesan=gagal");
      exit();
}

$password = password_hash($password, PASSWORD_DEFAULT);

$query = mysqli_query($conn, "
      INSERT INTO akun (username, email, password, nama, role)
      VALUES ('$username', '$email', '$password', '$nama', 'user')
");

if($query) {
      header("location: login.php?pesan=berhasil");
      exit();
} else {
      header("location: signup.php?pesan=gagal");
      exit();
}
?>
