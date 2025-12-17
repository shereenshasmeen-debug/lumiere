<?php
session_start();
include "koneksi.php";

// cek login
if(!isset($_SESSION['username'])){
    echo "<script>alert('Must log in first!'); window.location='login.php';</script>";
    exit;
}

$cart = json_decode($_POST['cart_data'], true);
$user = $_SESSION['username'];

$reservation_id = $_SESSION['reservation_id'];

foreach($cart as $item){
    $nama   = $item['name'];
    $qty    = $item['qty'];
    $harga  = $item['price'];
    $catatan = $item['notes'];

    mysqli_query($conn, "
        INSERT INTO transaksi (reservation_id, username, menu, qty, harga, catatan)
        VALUES ('$reservation_id', '$user', '$nama', $qty, $harga, '$catatan')
    ");
}

echo "<script>
    alert('Checkout successful!');
    localStorage.removeItem('cart');
    window.location.href='Receipt.php';
</script>";
?>
