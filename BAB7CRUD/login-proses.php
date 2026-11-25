<?php
session_start();
include 'koneksi.php';

if (isset($_POST['login'])) {
    $inputUser = mysqli_real_escape_string($koneksi, $_POST['username']);
    $inputPass = $_POST['password'];

    $sql = "SELECT * FROM tb_admin WHERE username = '$inputUser' OR email = '$inputUser' LIMIT 1";
    $result = mysqli_query($koneksi, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        if (password_verify($inputPass, $row['password'])) {
            $_SESSION['user_rumahhub'] = $row['username'];
            $_SESSION['role_rumahhub'] = $row['role'];
            header("Location: dashboard.php");
            exit();
        }
    }

    echo "<script>alert('Username/email atau password salah!'); window.location='login.php';</script>";
}
?>
