<?php
session_start();
include "koneksi.php";

if(!isset($_SESSION['username'], $_SESSION['id'])){
    die("Session tidak valid");
}

$username = $_SESSION['username'];
$user_id = $_SESSION['id'];

$res_q = mysqli_query($conn, "
    SELECT id, reservation_date, reservation_time, table_id
    FROM reservations
    WHERE user_id = '$user_id'
    ORDER BY id DESC
    LIMIT 1
");

if (mysqli_num_rows($res_q) == 0) {
    die("Belum ada reservation");
}

$res = mysqli_fetch_assoc($res_q);
$reservation_id = $res['id'];

$transaksi = mysqli_query($conn, "
    SELECT * FROM transaksi
    WHERE reservation_id='$reservation_id'
");
?>

<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Receipt</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
        min-height: 100vh;
        font-family: "Playfair Display", serif;
        background: linear-gradient(to bottom, #090909, #100d0d, #3f1117);
        color: white;
        padding: 40px;
        }
        .receipt {
            background: #fff;
            color: #3f1117;
            padding: 20px;
            border-radius: 15px;
            max-width: 600px;
            margin: auto;
            box-shadow: 0 0 10px rgba(0,0,0,0.3);
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 8px;
            border-bottom: 1px solid #ccc;
        }
        th {
            text-align: left;
        }
        .total {
            text-align: left;
            font-weight: bold;
            font-size: 18px;
            margin-top: 15px;
        }
        .footer {
            text-align: center;
            margin-top: 20px;
            font-size: 14px;
            color: #555;
        }
        h1 {
            padding-top: 15px;
            text-align:center;
        }
        h3 {
            text-align:center;
            font-size: 15px;
        }
        .print-btn {
        background: #3f1117;
        color: whitesmoke;
        border: none;
        padding: 10px 20px;
        border-radius: 8px;
        font-size: 18px;
        font-weight: 600;
        margin-top: 30px;
        margin-left: 500px;
        }
        .btn-close {
        position: absolute;
        top: 10px;
        right: 10px;
        padding: 8px 12px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        font-weight: bold;
        color: white;
        }
        .print-btn:hover {
        background: #b9a29d;
        color: black;
        }
    </style>
</head>

<body>

<div class="receipt">
    <img src="img/logo.jpeg" width="100px" height="100px" style="display:block; margin:auto; border-radius:50%;">
    <button class="btn-close btn-close-white" data-bs-dismiss="offcanvas" id="close"></button>
    <h1 style="text-align:center;">LUMIERE RESTAURANT</h1>
    <h3> 51, 53 Camberwell Church St, London SE5 8TR
        <br>
    </h3>

    <p><b>Customer:</b> <?= htmlspecialchars($username) ?></p>
    <p><b>Reservation Date:</b> <span id="res_date"></span></p>
    <p><b>Reservation Time:</b> <span id="res_time"></span></p>
    <p><b>Room:</b> <span id="res_room"></span></p>
    <p><b>Table:</b> <span id="res_table"></span></p>

    <hr>

    <h4>Order Items</h4>
    <table>
        <tr>
            <th>Menu</th>
            <th>Qty</th>
            <th>Price</th>
        </tr>

        <?php 
        $total = 0;
        while($row = mysqli_fetch_assoc($transaksi)) : 
            $hargaTotal = $row['harga'] * $row['qty'];
            $total += $hargaTotal;
        ?>
        <tr>
            <td><?= $row['menu'] ?></td>
            <td><?= $row['qty'] ?></td>
            <td>$<?= number_format($hargaTotal) ?></td>
        </tr>
        <?php endwhile; ?>
    </table>

    <h3 class="total">Total: $<?= number_format($total) ?></h3>

    <div class="footer">Thank you for dining with us! <br>
       - Lumiere Restaurant -
    </div>

    <div class="text-center mt-4">
    <a href="javascript:void(0);" onclick="window.print()" class="print-btn">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-down-circle" viewBox="0 0 16 16">
        <path fill-rule="evenodd" d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8m15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0M8.5 4.5a.5.5 0 0 0-1 0v5.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293z"/>
        </svg>
    </a>
    
</div>

</div>

<script>
// Ambil reservasi dari localStorage
document.getElementById("res_date").textContent  = localStorage.getItem("reservation_datetime")?.split("T")[0] || "-";
document.getElementById("res_time").textContent  = localStorage.getItem("reservation_datetime")?.split("T")[1] || "-";
document.getElementById("res_room").textContent  = localStorage.getItem("reservation_room") || "-";
document.getElementById("res_table").textContent = localStorage.getItem("reservation_table") || "-";

document.getElementById("close").addEventListener("click", () => {
      window.location.href = "Home.php"; 
  });
</script>

</body>
</html>
