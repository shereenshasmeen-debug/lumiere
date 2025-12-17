<?php
session_start();
include '../koneksi.php';


$username = "-";
$reservation_date = "-";
$reservation_time = "-";
$table_number = "-";
$status = '-';
$total = 0;
$transaksi = null;

$isCleared = isset($_SESSION['clear_dashboard']) && $_SESSION['clear_dashboard'] === true;

if (!$isCleared) {

    $reservasi = mysqli_query($conn, "
        SELECT r.id, r.reservation_date, r.reservation_time, r.status,
       t.table_number,
       COALESCE(NULLIF(a.nama,''), a.username) AS username

        FROM reservations r
        JOIN akun a ON a.id = r.user_id
        JOIN tables_lumiere t ON t.id = r.table_id
        ORDER BY r.id DESC
        LIMIT 1
    ");

    if ($resv = mysqli_fetch_assoc($reservasi)) {
        $reservation_id   = $resv['id'];
        $username         = $resv['username'];
        $reservation_date = $resv['reservation_date'];
        $reservation_time = $resv['reservation_time'];
        $table_number     = $resv['table_number'];
        $status = $resv['status'];


        $transaksi = mysqli_query($conn, "
            SELECT * FROM transaksi
            WHERE reservation_id='$reservation_id'
        ");

        $total_q = mysqli_fetch_assoc(mysqli_query($conn, "
            SELECT SUM(harga * qty) AS total
            FROM transaksi
            WHERE reservation_id='$reservation_id'
        "));
        $total = $total_q['total'] ?? 0;
    }
}

unset($_SESSION['clear_dashboard']);
?>



<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>ADMIN</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&display=swap" rel="stylesheet">

<style>
    body {
        margin: 0;
        background: linear-gradient(to bottom, #090909, #100d0d, #3f1117);
        font-family: 'Playfair Display', serif !important;
        min-height: 100vh;
    }

    .cust-box {
        background: white;
        width: 500px;
        margin: 40px 0 0 25px;
        padding: 10px 20px;
        font-size: 20px;
        border-radius: 15px;
        color: rgb(69, 8, 8);
        font-weight: bold;
    }

    .big-card {
        background: white;
        width: 850px;
        margin: 40px 0 0 25px;
        padding: 35px;
        border-radius: 30px;
        color: rgb(69, 8, 8);
        font-size: 20px;
    }

    .data-row, .total-row {
        display: flex;
        align-items: center;
        margin-bottom: 28px;
        
    }

    .col-label {
        width: 140px;
        font-weight: 600;
        letter-spacing: 1px;
    }

    .col-colon {
        width: 40px;
        text-align: center;
        font-weight: bold;
    }

    .col-value {
        flex: 1;
        text-align: left;
    }

    .total-row {
        margin-top: 35px;
    }

    .clear-btn {
        display: inline-block;
        margin: 30px;  
        background: white;
        color: rgb(69, 8, 8);
        padding: 15px 35px;
        border: none;
        font-size: 20px;
        border-radius: 10px;
        cursor: pointer;
        box-shadow: 0 6px 12px rgba(0,0,0,0.8);
        text-align: center;
    }


    .clear-btn:hover { opacity: 0.8; }
</style>
</head>
<body>
<?php include 'NavSidebarAfter.php'; ?>
<div class="cust-box">NAME CUST :  <?= $username ?></div>

<div class="big-card">
    <div class="data-row">
        <span class="col-label">DATE</span>
        <span class="col-colon">:</span>
        <span class="col-value"><?= $reservation_date ?> <?= $reservation_time ?></span>
    </div>

    <div class="data-row">
        <span class="col-label">TABLE</span>
        <span class="col-colon">:</span>
        <span class="col-value"><?= $table_number ?></span>
    </div>

    <div class="data-row">
        <span class="col-label">STATUS</span>
        <span class="col-colon">:</span>
        <span class="col-value" style="font-weight:bold;
            color:
            <?= $status=='pending'?'orange':
                ($status=='approved'?'green':'red') ?>">
            <?= strtoupper($status) ?>
        </span>
    </div>


    <div class="data-row">
        <span class="col-label">MENU</span>
        <span class="col-colon">:</span>
        <span class="col-value">
            <div class="col-value">
            <?php if(!$isCleared && $transaksi): ?>
                <?php while ($row = mysqli_fetch_assoc($transaksi)): ?>
                    <?= $row['menu'] ?> (<?= $row['qty'] ?> pcs)<br>
                <?php endwhile; ?>
            <?php else: ?>
                -
            <?php endif; ?>
            </div>
        </span>
    </div>

    <div class="total-row">
        <span class="col-label">TOTAL</span>
        <span class="col-colon">:</span>
        <span class="col-value">
            $<?= number_format($total, 2) ?>
        </span>
    </div>

    <?php if ($status == 'pending'): ?>
        <form action="update_status.php" method="POST" style="margin-top:25px;">
            <input type="hidden" name="reservation_id" value="<?= $reservation_id ?>">

            <button name="status" value="approved"
                style="padding:10px 15px; margin-right:10px; border-radius:15px;">
                APPROVE
            </button>

            <button name="status" value="cancelled"
                style="padding:10px 15px; border-radius:15px;">
                CANCEL
            </button>
        </form>
    <?php endif; ?>

</div>

<form action="clear_dashboard.php" method="POST">
    <button type="submit" class="clear-btn"
        onclick="return confirm('Are you sure you want to clear the dashboard view?')">
        CLEAR DATA
    </button>
</form>




<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
    // document.getElementById("adminName").textContent = localStorage.getItem("customer_name") || "unknown";

    function toggleContact() {
        const box = document.getElementById("contactBox");
        box.style.display = (box.style.display === "none") ? "block" : "none";
    }

    function savePhone() {
        const phone = document.getElementById("phoneInput").value.trim();
        const display = document.getElementById("phoneDisplay");

        if (phone === "") {
            display.textContent = "Please enter a phone number.";
            display.style.color = "yellow";
            return;
        }

        display.textContent = "Phone Number: " + phone;
        display.style.color = "white";
    }
</script>

</body>
</html>
