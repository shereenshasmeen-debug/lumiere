<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
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
    </style>
</head>
<body>
  <nav class="navbar sticky-top custom-navbar">
    <div class="container-fluid">
        <a class="navbar-brand d-flex align-items-center gap-2">
            <img src="https://png.pngtree.com/png-clipart/20200224/original/pngtree-avatar-icon-profile-icon-member-login-vector-isolated-png-image_5247852.jpg" width="40" height="40" class="rounded-circle">
            <span class="text-white" style="font-size: 20px;">
              Admin
            </span>
       </a>
        <div class="d-flex align-items-center gap-2">
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
                    <li><a class="nav-link text-white" href="dashboard.php">Dashboard</a></li>
                    <li><a class="nav-link text-white" href="all_reservation.php">History</a></li>
                    <li><a class="nav-link text-white" href="Logout.php">Logout</a></li>
                </ul>
            </div>
        </div>
    </div>
</nav>