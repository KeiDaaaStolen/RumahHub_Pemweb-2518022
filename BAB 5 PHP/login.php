<?php
session_start();
// Menangkap data username saat tombol login (link) ditekan atau form diproses
if (isset($_POST['username']) && !empty($_POST['username'])) {
    $_SESSION['user_rumahhub'] = $_POST['username'];
    header("Location: dashboard.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - RumahHub</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <header class="navbar">
        <div class="logo-container">
            <img src="assets/logo.png" alt="Logo" class="logo">
            <span class="brand-title">RUMAHHUB</span>
        </div>
        <nav class="nav-links">
            <a href="index.php">Home</a>
            <a href="dashboard.php">Dashboard</a>
            <a href="login.php" class="active">Login</a>
        </nav>
    </header>

    <main class="main-container">
        <div class="auth-wrapper">
            <div class="auth-left">
                <div>
                    <h2>Selamat Datang di RumahHub</h2>
                    <p>Temukan hunian terbaik untuk masa depan terbaik.</p>
                </div>
                <img src="assets/banner_properti1.jpg" alt="Banner Login">
            </div>
            <div class="auth-right">
                <h2>Masuk ke Akun RumahHub</h2>
                <!-- Form menggunakan method POST dan action diarahkan ke file ini sendiri -->
                <form action="" method="POST">
                    <div class="form-group">
                        <label>Username / Email</label>
                        <input type="text" name="username" placeholder="Masukkan username atau email" required>
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="password" placeholder="Masukkan password">
                    </div>
                    
                    <!-- Tombol login asli berbentuk <a> tetap dipertahankan, namun kita ubah jadi tipe submit/button agar mengeksekusi form, atau bisa di-submit via JS jika ingin tetap murni <a> -->
                    <button type="submit" name="btn_login" class="btn-submit" style="text-align: center; display: block; text-decoration: none; box-sizing: border-box; width: 100%; border: none; cursor: pointer; font-size: 16px;">Login</button>

                    <div class="auth-link">
                        Belum punya akun? <a href="register.php">Register Disini</a>
                    </div>
                </form>
            </div>
        </div>
    </main>

    <footer>
        <p>&copy; 2026 RumahHub - Katalog Hunian & Properti</p>
    </footer>
</body>
</html>