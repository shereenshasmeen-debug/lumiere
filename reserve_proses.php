<?php
session_start();
date_default_timezone_set('Asia/Jakarta');
include "koneksi.php";

if (!isset($_SESSION['id'])) {
    die("Must log in first!");
}

$user_id = $_SESSION['id'];


$datetime = $_POST['datetime'] ?? '';
$room     = $_POST['room'] ?? '';
$table    = $_POST['table'] ?? '';

if ($datetime == '' || $room == '' || $table == '') {
    echo "<script>alert('All data must be filled!'); window.location='Reserve.php';</script>";
    exit;
}


$reserveTimestamp = strtotime($datetime);
$nowTimestamp     = time();


if ($reserveTimestamp <= $nowTimestamp) {
    echo "<script>alert('Cannot make reservations after the time has passed'); window.location='Reserve.php';</script>";
    exit;
}


$jam = date("H:i", $reserveTimestamp);


if (!(
    ($jam >= "06:00" && $jam <= "23:59") ||
    ($jam >= "00:00" && $jam <= "01:59")
)) {
    echo "<script>alert('Reservation hours can only be at 06:00 - 01:59'); window.location='Reserve.php';</script>";
    exit;
}

// Pisahkan tanggal & jam
$tanggal = date("Y-m-d", $reserveTimestamp);
$waktu   = date("H:i:s", $reserveTimestamp);

// Mapping room
$room_map = [
    "Hall"         => "hall",
    "Private"      => "private_room",
    "Bar"          => "bar",
    "Beach Lounge" => "beach_lounge"
];

$room_db = $room_map[$room] ?? null;

if (!$room_db) {
    echo "<script>alert('Room is invalid!'); window.location='Reserve.php';</script>";
    exit;
}

// Ambil ID meja
$table_query = mysqli_query($conn, "
    SELECT id FROM tables_lumiere 
    WHERE table_number='$table' AND table_area='$room_db'
    LIMIT 1
");

$table_data = mysqli_fetch_assoc($table_query);

if (!$table_data) {
    echo "<script>alert('Table not found!'); window.location='Reserve.php';</script>";
    exit;
}

$table_id = $table_data['id'];

$check = mysqli_query($conn, "
    SELECT id FROM reservations 
    WHERE table_id='$table_id'
    AND reservation_date='$tanggal'
    AND reservation_time='$waktu'
    AND status='pending'
");

if (mysqli_num_rows($check) > 0) {
    echo "<script>alert('The table has been booked at that time!'); window.location='Reserve.php';</script>";
    exit;
}

$insert = mysqli_query($conn, "
    INSERT INTO reservations (user_id, table_id, reservation_date, reservation_time, status)
    VALUES ('$user_id', '$table_id', '$tanggal', '$waktu', 'pending')
");

if ($insert) {
    $_SESSION['reservation_id'] = mysqli_insert_id($conn);

    echo "<script>
        alert('Reserve successful!');
        window.location='Menu.php';
    </script>";
} else {
    echo "<script>alert('Failed to save reservation!'); window.location='Reserve.php';</script>";
}
?>
