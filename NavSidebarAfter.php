<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require 'koneksi.php';

$hasReceipt = false;

if (isset($_SESSION['id'])) {
    $user_id = $_SESSION['id'];

    $stmt = $conn->prepare("
        SELECT id FROM reservations 
        WHERE user_id = ? 
        LIMIT 1
    ");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();

    if ($stmt->get_result()->num_rows > 0) {
        $hasReceipt = true;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Home</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&display=swap" rel="stylesheet">
  <style>
    .custom-navbar {
      background-color: #30040b;
      font-family:'Playfair Display', serif;
      height: 70px;
      padding-top: 0px;
    }
    .navbar-toggler-icon {
      background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='%23ffffff' viewBox='0 0 30 30'%3E%3Cpath d='M4 7h22v2H4zm0 7h22v2H4zm0 7h22v2H4z'/%3E%3C/svg%3E");
    }
    .navbar-toggler {
      background-color: #3f1117;
    }
    .navbar-brand span, .nav-link {
      color: white !important;
      justify-items: flex-end;
    }
    .theme {
      background: linear-gradient(to bottom, #090909, #100d0d, #3f1117);
      color: white;
      padding: 60px;
      min-height: 100vh;
      font-family:'Playfair Display', serif;         
    }
    .title-brand {
      font-size: 20px;
      letter-spacing: 5px;
      color: #ccc;
      margin-bottom: 10px;
      text-transform: uppercase;
      margin-top: 0px;
      font-family:'Playfair Display', serif;
    }
    .brand {
      font-size: 80px;
      font-weight: bold;
      color: #ffffff;
      letter-spacing: 10px;
      font-family: 'Georgia', serif;
      margin-top: 20px;
      font-family:'Playfair Display', serif;
    }
    .offcanvas.offcanvas-end {
      width: 260px;
      font-size: 22px;
      color: white;
      background-color: #30040b;
    }
    .btn-cart {
      background: none;
      border: none;
      color: white;
      font-size: 10px;
    }
    </style>
</head>
<body>
  <nav class="navbar sticky-top custom-navbar">
    <div class="container-fluid">
        <a class="navbar-brand d-flex align-items-center gap-2" href="Profile.php">
            <img src="https://png.pngtree.com/png-clipart/20200224/original/pngtree-avatar-icon-profile-icon-member-login-vector-isolated-png-image_5247852.jpg" width="40" height="40" class="rounded-circle">
            <span class="text-white" style="font-size: 20px;">
              <?php if (isset($_SESSION['username'])): ?>
               <span><?= htmlspecialchars($_SESSION['username']) ?></span>
              <?php else: ?>
                  <span>Login</span>
              <?php endif; ?>
       </a>
        <div class="d-flex align-items-center gap-2">
          <a class="btn btn-cart" href="Cart.php">
            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-cart3" viewBox="0 0 16 16">
              <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .49.598l-1 5a.5.5 0 0 1-.465.401l-9.397.472L4.415 11H13a.5.5 0 0 1 0 1H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5M3.102 4l.84 4.479 9.144-.459L13.89 4zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4m7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4m-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2m7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2"></path>
            </svg>
          </a>

          <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#menu">
            <span class="navbar-toggler-icon"></span>
          </button>
        </div>
        <div class="offcanvas offcanvas-end text-white" style="background:#3b060b;" id="menu">
            <div class="offcanvas-header">
                <h5><b>Lumiere</b></h5>
                <button class="btn-close btn-close-white" data-bs-dismiss="offcanvas"></button>
            </div>
            <div class="offcanvas-body">
                <ul class="navbar-nav">
                    <li><a class="nav-link text-white" href="Home.php">Home</a></li>
                    <li>
                        <?php if ($hasReceipt): ?>
                            <a class="nav-link text-white" href="Receipt.php">Reservation</a>
                        <?php else: ?>
                            <a class="nav-link text-white" href="#" onclick="noReceipt()">Reservation</a>
                        <?php endif; ?>
                        </li>
                    <li><a class="nav-link text-white" href="https://wa.me/6285101404626">Contact Us</a></li>
                    <li><a class="nav-link text-white" href="faq.html">FAQ</a></li>
                    <li><a class="nav-link text-white" href="About.php">About</a></li>
                </ul>
            </div>
        </div>
    </div>
</nav>
<script>
function noReceipt() {
    alert("You don't have any reservation yet.");
}
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>