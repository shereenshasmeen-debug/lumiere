<?php
session_start();
?>

<?php if(isset($_SESSION['username'])): ?>
    <!-- Sudah login -->
    <?php include 'NavSidebarAfter.php'; ?>
<?php else: ?>
    <!-- Belum login -->
    <?php include 'NavSidebarBefore.php'; ?>
<?php endif; ?>

  <style>
    .btn-light {
      padding: 12px 32px;
      font-size: 15px;
      font-weight: bold;
      border: none;
      border-radius: 18px;
      background-color: white;
      color: #7b0000;
      text-transform: uppercase;
      letter-spacing: 2px;
      margin-top: 20px;
      transition: 0.3s;
    }
    .btn-light:hover{
      background: #b9a29d;
      color: black;
    }
    .btn-disabled {
      padding: 12px 32px;
      font-size: 15px;
      font-weight: bold;
      border-radius: 18px;
      background-color: #ccc;
      color: #666;
      cursor: not-allowed;
      text-transform: uppercase;
      letter-spacing: 2px;
      margin-top: 20px;
    }
    .btn-cart {
      background: none;
      border: none;
      color: white;
      font-size: 10px;
    }
    .carousel-item img {
      height: 300px;
      object-fit: cover;
      border-radius: 8px;
    }
    .open-time {
      text-align: center;
      margin-top: 190px;
      margin-bottom: 190px;
      color: white;
      font-family: 'Playfair Display', serif; 
    }

    .open-time h4 {
      font-size: 28px;
      font-weight: 700;
      margin-bottom: 10px;
    }

    .open-time p {
      font-size: 18px;
      margin: 4px 0;
    }
    </style>
<body>
<div class="theme">
  <div class="row align-items-center">
    <div class="col-md-6">
      <h3 class="title-brand">HIGH END RESTAURANT</h3>
      <h1 class="brand">LUMIERE</h1>
      <?php if(isset($_SESSION['username'])): ?>
        <!-- Sudah login -->
        <a href="Reserve.php" class="btn btn-light">Reserve</a>
      <?php else: ?>
        <!-- Belum login -->
        <a href="Login.php" class="btn btn-light">Reserve</a>
      <?php endif; ?>
    </div>
    <div class="col-md-6">
      <div id="carouselExampleCaptions" class="carousel slide">
        <div class="carousel-inner">
          <div class="carousel-item active">
            <img src="img/foto1.webp" class="d-block w-100" alt="..." style="margin-bottom: 10px;">
            <h5>Private Room</h5>
            <p>An exclusive space for guests seeking privacy, perfect for business meetings or special occasions.</p>
          </div>
          <div class="carousel-item">
            <img src="img/foto4.webp" class="d-block w-100" alt="..." style="margin-bottom: 10px;">
            <h5>Bar</h5>
            <p>A relaxed area for enjoying drinks like cocktails and wine, with a lively and stylish atmosphere.</p>
          </div>
          <div class="carousel-item">
            <img src="img/foto2.webp" class="d-block w-100" alt="..." style="margin-bottom: 10px;">
            <h5>Hall</h5>
            <p>A spacious room designed for formal dining or events, featuring elegant decor and multiple tables.</p>
          </div>
          <div class="carousel-item">
            <img src="img/foto3.webp" class="d-block w-100" alt="..." style="margin-bottom: 10px;">
            <h5>Beach Lounge</h5>
            <p>An open-air space near the coast, offering comfortable seating and scenic ocean views—ideal for unwinding.</p>
          </div>
        </div>
        <div class="text-center mt-2">
          <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
          </button>
          <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
          </button>
        </div>
        </div>
    </div>
  </div>
        <div class="open-time">
          <h4>See You Soon!</h4>
        </br>
          <p> At 51, 53 Camberwell Church St, London SE5 8TR</p>
          <p>From 06:00 AM – 01:59 AM</p>
        </div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>