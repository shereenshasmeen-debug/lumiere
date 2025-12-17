<?php
session_start();

// Hapus semua session login user
session_unset();
session_destroy();

// Reset cart supaya hilang ketika user login ulang
echo "<script>
    alert('Logout successful.');
    window.location.href = '/lumiere/Home.php';   // arahkan ke halaman home
</script>";
?>
