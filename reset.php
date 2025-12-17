<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require 'koneksi.php';

$msg = "";
$showResetForm = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // STEP 1: CEK EMAIL
    if (isset($_POST['email']) && !isset($_POST['code'])) {

        $email = $_POST['email'];

        // cek email ada atau tidak
        $stmt = $conn->prepare(
            "SELECT email FROM akun WHERE email=?"
        );
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $res = $stmt->get_result();

        if ($res->num_rows === 1) {

            // email VALID → buat kode
            $code   = rand(100000, 999999);
            $stmt = $conn->prepare(
    "UPDATE akun SET reset_code=?, reset_expiry = DATE_ADD(NOW(), INTERVAL 10 MINUTE)
     WHERE email=?"
);
$stmt->bind_param("is", $code, $email);
$stmt->execute();

            // DEBUG MODE
            $msg = '
                <div style="color:white; text-align:center;">
                    <b>Email found.</b><br>
                    Reset code: <b>' . $code . '</b><br>
                </div>
            ';

            $showResetForm = true;

        } else {
            // email TIDAK ADA
            $msg = "<div style='color:white;text-align:center;'>Email is not registered.</div";
            
        }
    }

    // STEP 2: RESET PASSWORD
    if (isset($_POST['code'], $_POST['password'], $_POST['confirm'])) {

        if ($_POST['password'] !== $_POST['confirm']) {
            $msg = "<div style='color:white; text-align:center;'>
            Password and confirmation do not match.</div>";
            $showResetForm = true;
        } else {

            $code = $_POST['code'];
            $pass = password_hash($_POST['password'], PASSWORD_DEFAULT);

            $stmt = $conn->prepare(
                "SELECT email FROM akun
                 WHERE reset_code=? AND reset_expiry > NOW()"
            );
            $stmt->bind_param("s", $code);
            $stmt->execute();
            $res = $stmt->get_result();

            if ($res->num_rows === 1) {

                $stmt = $conn->prepare(
                    "UPDATE akun
                     SET password=?, reset_code=NULL, reset_expiry=NULL
                     WHERE reset_code=?"
                );
                $stmt->bind_param("ss", $pass, $code);
                $stmt->execute();

                $msg = "<div style='color:white; text-align:center;'>Password has been reset succcessfully. Please <a href='Login.php' style='color:white;'> log in</a>.</div>";

            } else {
                $msg = "<div style='color:white; text-align:center;'>Invalid or expired code.</div>";
                $showResetForm = true;
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset_Pass</title>
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
    body {
        background: linear-gradient(to bottom, #090909, #100d0d, #3f1117);
        min-height: 100vh;
        color: white;
        font-family: 'Playfair Display', serif; 
        justify-self: center;
    }
    h3 {
        text-align: center;
        padding-top: 50px;
        font-size: 30px;
        margin-bottom: 30px;
        margin-top: 20px;
    }
    form {
        text-align: center;
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
    .reset-box {
        display: inline-flex;
        background: rgba(255, 255, 255, 0.95);
        padding: 6px 8px 6px 14px;
        margin: 0 auto;
        box-shadow: 0 8px 20px rgba(0,0,0,0.35);
        border-radius: 20px;
        width: 400px;
        justify-content: center;
    }
    .rescode, .newpass, .confpass {
        display: block;          
        background: rgba(255, 255, 255, 0.95);
        padding: 6px 14px;
        margin: 10px auto;       
        box-shadow: 0 8px 20px rgba(0,0,0,0.35);
        border-radius: 20px;
        width: 350px;
    }
    .reset-box input, .rescode input, .newpass input, .confpass input{
        border: none;
        outline: none;
        width: 220px;
        font-family: "Playfair Display", serif;
        font-size: 14px;
        background: transparent;
        color: black;
    }
    .reset-box button {
        border: none;
        background: #8b0000;
        color: #ffffffff;
        padding: 8px 18px;
        margin-left: 40px;
        border-radius: 18px;
        font-size: 14px;
        cursor: pointer;
        transition: all 0.3s ease;
    }
    .respass {
        border: none;
        background: #8b0000;
        color: #ffffffff;
        padding: 8px 18px;
        margin-top: 35px;
        margin-bottom: 35px;
        border-radius: 18px;
        font-size: 14px;
        cursor: pointer;
        transition: all 0.3s ease;
    }
    .reset-box button:hover, .respass button:hover {
        background: #3f1117;
        transform: scale(1.05);
    }
</style>
</head>
<body>
<button class="btn-close btn-close-white" data-bs-dismiss="offcanvas" id="close"></button>

<h3>Reset Password</h3>

<?php if (!$showResetForm): ?>
<!-- STEP 1 -->
<form method="post" class="reset-box">
    <input type="email" name="email" required placeholder="Enter your email">
    <button>Check Email</button>
</form>
<?php else: ?>
<!-- STEP 2 -->
<form method="post">
    <input class="rescode" type="text" name="code" required placeholder="Reset code">
    <input class="newpass" type="password" name="password" required placeholder="New password">
    <input class="confpass" type="password" name="confirm" required placeholder="Confirm password">
    <button class="respass" >Reset Password</button>
</form>
<?php endif; ?>

<p><?= $msg ?></p>

<script>
    document.getElementById("close").addEventListener("click", () => {
        window.location.href = "Home.php"; 
    });
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>