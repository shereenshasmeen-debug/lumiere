<?php

if (isset($_GET['pesan'])) {
    if($_GET['pesan'] == "berhasil") {
        echo "<script>alert('Sign up successful! Please login.');</script>";
    } elseif($_GET['pesan'] == "gagal") {
        echo "<script>alert('Sign up failed! Please try again.');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lumiere login</title>
    <link rel="stylesheet" href="style2.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&display=swap" rel="stylesheet">
</head>
<body> 
    <button class="btn-close btn-close-white" data-bs-dismiss="offcanvas" id="close"></button>
    <div class="login-container">
        <div class="login-card">
            <div class="login-header">
                 <div class="logo">
                    <img src="img/logo.jpeg" class="logo-square">
                </div>
                <h2>Sign In</h2>
                <p>Enter your credentials</p>
            </div>
            
            <form class="login-form" id="loginForm" method="POST" action="login_proses.php">
                <div class="form-group">
                    <label for="username" class="form-label">Username</label>
                    <div class="input-wrapper">
                        <input type="text" id="username" name="username" required autocomplete="username">
                    </div>
                    <span class="error-message" id="usernameError"></span>
                </div>

                <div class="form-group">
                    <label for="password" class="form-label">Password</label>
                    <div class="input-wrapper password-wrapper">
                        <input type="password" id="password" name="password" required autocomplete="current-password">
                        <button type="button" class="password-toggle" id="passwordToggle" aria-label="Toggle password visibility">
                            <span class="toggle-text">SHOW</span>
                        </button>
                    </div>
                    <span class="error-message" id="passwordError"></span>
                </div>

                <div class="form-options">
                    <a href="reset.php" class="forgot-link">Forgot password?</a>
                </div>

                <button type="submit" class="login-btn">
                    <span class="btn-text">SIGN IN</span>
                    <div class="btn-loader">
                        <div class="loader-bar"></div>
                        <div class="loader-bar"></div>
                        <div class="loader-bar"></div>
                    </div>
                </button>
            </form>

    

            <div class="signup-link">
                <span>No account? </span>
                <a href="Signup.php">Create one</a>
            </div>

            <div class="success-message" id="successMessage">
                <div class="success-icon">✓</div>
                <h3>Success</h3>
                <p>Redirecting...</p>
            </div>
        </div>
    </div>

    <script src="../../shared/js/form-utils.js"></script>
    <script>
        document.getElementById("close").addEventListener("click", () => {
            window.location.href = "Home.php"; 
        });
    </script>
    <script>
    const passwordInput = document.getElementById("password");
    const toggleBtn = document.getElementById("passwordToggle");
    const toggleText = toggleBtn.querySelector(".toggle-text");

    toggleBtn.addEventListener("click", () => {
        if (passwordInput.type === "password") {
        passwordInput.type = "text";
        toggleText.textContent = "HIDE";
        } else {
        passwordInput.type = "password";
        toggleText.textContent = "SHOW";
        }
    });
    </script>
    <!-- <script src="script.js"></script> -->
</body>
</html>