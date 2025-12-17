<?php
session_start();

if (!isset($_SESSION['login']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../login.php");
    exit;
}

include "../koneksi.php";

$query = mysqli_query($conn, "
    SELECT 
        r.id AS reservation_id,
        COALESCE(NULLIF(a.nama,''), a.username) AS nama_customer,
        r.reservation_date,
        r.reservation_time,
        r.status,
        t.table_number,
        t.table_area,
        GROUP_CONCAT(tr.menu SEPARATOR ', ') AS menu_pesanan,
        SUM(tr.harga * tr.qty) AS total_harga
    FROM reservations r
    JOIN akun a ON r.user_id = a.id
    JOIN tables_lumiere t ON r.table_id = t.id
    LEFT JOIN transaksi tr ON tr.reservation_id = r.id
    GROUP BY r.id
    ORDER BY r.created_at DESC
");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Reservations</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&display=swap" rel="stylesheet">

<style>
body {  
    margin: 0;
    font-family: 'Playfair Display', serif !important;
    min-height: 100vh;
    background: linear-gradient(to bottom, #090909, #100d0d, #3f1117);
}

.navbar h2 {
    margin: 0;
}

.navbar .admin-name {
    font-size: 18px;
}

.big-card {
    background: white;
    margin: 40px;
    padding: 30px;
    border-radius: 25px;
}

.reservation-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr); 
    gap: 25px;
}

.reservation-card {
    background: #f4f4f4;
    border-radius: 18px;
    padding: 20px;
    box-shadow: 0 6px 12px rgba(0,0,0,.2);
    color: #32040b;
}

.row-item {
    display: flex;
    margin-bottom: 10px;
}

.label {
    width: 110px;
    font-weight: bold;
}

.colon {
    width: 15px;
    text-align: center;
}

.value {
    flex: 1;
}

.status {
    margin-top:10px;
    font-weight:bold;
}
.status.pending { color:orange; }
.status.approved { color:green; }
.status.cancelled { color:red; }

.total {
    margin-top: 15px;
    font-size: 18px;
    font-weight: bold;
    text-align: right;
}
</style>
</head>

<body>
    <?php include 'NavSidebarAfter.php'; ?>

<div class="big-card">
    <h2 class="mb-4">All Customer Reservations</h2>

    <div class="reservation-grid">

    <?php if(mysqli_num_rows($query) > 0): ?>
        <?php while($row = mysqli_fetch_assoc($query)): ?>


        <div class="reservation-card">

            <div class="row-item">
                <div class="label">Customer</div>
                <div class="colon">:</div>
                <div class="value"><?= htmlspecialchars($row['nama_customer']) ?></div>
            </div>

            <div class="row-item">
                <div class="label">Date</div>
                <div class="colon">:</div>
                <div class="value">
                    <?= $row['reservation_date'] ?> <?= $row['reservation_time'] ?>
                </div>
            </div>

            <div class="row-item">
                <div class="label">Room</div>
                <div class="colon">:</div>
                <div class="value">
                    <?= ucfirst(str_replace('_',' ', $row['table_area'])) ?>
                </div>
            </div>

            <div class="row-item">
                <div class="label">Table</div>
                <div class="colon">:</div>
                <div class="value"><?= $row['table_number'] ?></div>
            </div>

            <div class="row-item">
                <div class="label">Menu</div>
                <div class="colon">:</div>
                <div class="value">
                    <?= $row['menu_pesanan'] ?: 'Belum pesan menu' ?>
                </div>
            </div>

            <div class="status <?= $row['status'] ?>">
                Status : <?= ucfirst($row['status']) ?>
            </div>

            <div class="total">
                Total : $
                <?= number_format($row['total_harga'] ?? 0, 2) ?>
            </div>

        </div>

        <?php endwhile; ?>
    <?php else: ?>
        <p>No reservation.</p>
    <?php endif; ?>

    </div>
</div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    function toggleContact() {
        const box = document.getElementById("contactBox");
        box.style.display = (box.style.display === "none") ? "block" : "none";
    }
    </script>

</body>
</html>
