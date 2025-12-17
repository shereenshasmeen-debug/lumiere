<?php
session_start();
include "../koneksi.php";

if (!isset($_SESSION['login']) || $_SESSION['role'] != 'admin') {
    header("Location: ../login.php");
    exit;
}

$id     = $_POST['reservation_id'];
$status = $_POST['status'];

if (!in_array($status, ['approved','cancelled'])) {
    die("Status tidak valid");
}

mysqli_query($conn, "
    UPDATE reservations
    SET status='$status'
    WHERE id='$id'
");

header("Location: dashboard.php");
exit;
