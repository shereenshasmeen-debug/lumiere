<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="profile.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

</head>
<body>
  <div class="wrapper">
    <div class="img-area">
      <div class="inner-area">
        <img src="https://png.pngtree.com/png-clipart/20200224/original/pngtree-avatar-icon-profile-icon-member-login-vector-isolated-png-image_5247852.jpg" alt="">
      </div>
    </div>
    <a class="icon arrow" href="Home.php"><i class="fas fa-arrow-left"></i>
    </a>

        <div class="icon dots" id="menuDots">
            <i class="fas fa-ellipsis-v"></i>
        </div>

        <div id="dropdownMenu" class="dropdown-menu custom-dropdown">
            <a id="logoutBtn" href="Logout.php" class="dropdown-item logout">
                Logout
            </a>
        </div>

    <div class="username"><b>
        <?php echo $_SESSION['username']; ?>
    </b></div>
    <div class="about"><b>LUMIERE MEMBER</b></div>
    
<script src="js/bootstrap.bundle.js"></script>
<script>
    const dots = document.getElementById("menuDots");
    const menu = document.getElementById("dropdownMenu");

    dots.addEventListener("click", () => {
        menu.style.display = menu.style.display === "block" ? "none" : "block";
    });

    // Hide menu if clicking outside
    document.addEventListener("click", (e) => {
        if (!dots.contains(e.target) && !menu.contains(e.target)) {
            menu.style.display = "none";
        }
    });

</script>

</body>
</html>