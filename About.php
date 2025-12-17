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
        body {
            font-family: "Playfair Display", serif;
            background: linear-gradient(to bottom, #090909, #100d0d, #3f1117);
            color: white;
            overflow-x: hidden;
            min-height: 100vh;
        }
        .gambar {
            height: 60vh;
            width: 100%;
            opacity: 0.45;
            background-image: url("img/foto1.webp");
            position: relative;
            background-position: center;
            background-size: cover;
        }
        .content1 {
          font-size: 30px;
          text-align: center;
          margin:0 0 5px 0;
          padding-bottom: 80px;
          letter-spacing: 2px;
          font-weight: 300;
          text-shadow: 0 3px 6px rgba(0,0,0,0.5);
          position:absolute;
          top: 50%;
          left: 50%;
          transform: translate(-50%,-50%);
          z-index: 2;
        }
        .content2 {
          font-size: 50px;
          text-align: center;
          position:absolute;
          padding-bottom: 50px;
          letter-spacing: 2px;
          font-weight: 300;
          text-shadow: 0 3px 6px rgba(0,0,0,0.5);
          top: 57%;
          left: 50%;
          transform: translate(-50%,-50%);
          z-index: 2;
        }
        .content3{
          margin-left: 130px ;
          padding-top: 50px;
          max-width: 1000px;
          line-height: 1.6;
          font-size: 1.5rem;
          font-weight: bold;
          margin-bottom: 5px;
        }
        .content4 {
          justify-self: center;
          text-align: justify;
          margin-top: 0;
          margin-left: 0px ;
          padding-top: 15px;
          max-width: 1000px;
          line-height: 1.6;
          font-size: 1.1rem;
        }
        .member-container {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            gap: 40px;
            padding-bottom: 60px;
            margin-top: 50px;
        }
        .member {
            text-align: center;
            width: 180px;
        }
        .name {
            margin-top: 10px;
            font-size: 20px;
            font-weight: bold;
        }
        .name-img {
            width: 160px;
            height: 160px;
            border-radius: 50%;
        }
        .team {
            font-size: 30px;
            display: block;
            text-align: center;
        }
        
    </style>
<body>
<div class="gambar"></div>
<div class="content">
  <h1 class="content1">About</h1>
  <h1 class="content2">LUMIERE RESTAURANT</h1>
  <p class="content3">HIGH END RESTAURANT</p>
  <p class="content4"> Lumière Restaurant, whose name means “light” in French, is more than just 
    a place to dine—it’s a radiant experience for the senses. Specializing in refined French cuisine, 
    the restaurant offers a carefully curated selection of main courses, delightful desserts, and a wide 
    variety of beverages. Each dish is crafted with precision and passion, aiming not only to please the 
    palate but also to bring warmth and joy to the hearts of its guests. Whether you’re enjoying a savory 
    entrée, sipping a refreshing drink, or indulging in a sweet treat, Lumière Restaurant invites you to 
    bask in the glow of culinary excellence and heartfelt hospitality. </p>

</div>
<div class="member" style="justify-self: center; margin-top: 50px;">
    <b style="font-size: 30px;"> LEADER</b><br><br>
    <img src="img/daniel.jpg" class="name-img">
    <div class="name">Danielle Sugeharto</div><br><br>
</div>
<b class="team" >OUR TEAM</b>
    <div class="member-container">
        <div class="member">
            <img src="img/syalikha.jpg" class="name-img">
            <div class="name">Syalikhafaradhiya Agira</div>
        </div>
        <div class="member">
            <img src="img/nadhira.jpg" class="name-img">
            <div class="name">Nadhira Ameera Shereen Nasution</div>
        </div>
        <div class="member">
            <img src="img/farah.jpg" class="name-img">
            <div class="name">Farah Al Paris Pane</div>
        </div>
        <div class="member">
            <img src="img/hafiz.jpg" class="name-img">
            <div class="name">Hafiz Ahmad Aulia Situmeang</div>
        </div>

     </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
