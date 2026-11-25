<?php
include 'koneksi.php';

if (isset($_POST['register'])) {
    $nama_lengkap = mysqli_real_escape_string($koneksi, $_POST['nama_lengkap']);
    $email        = mysqli_real_escape_string($koneksi, $_POST['email']);
    $username     = mysqli_real_escape_string($koneksi, $_POST['username']);
    $passwordRaw  = $_POST['password'];

    if (empty($nama_lengkap) || empty($email) || empty($username) || empty($passwordRaw)) {
        echo "<script>alert('Pastikan semua data diisi!'); window.location='register.php';</script>";
        exit();
    }

    $password = password_hash($passwordRaw, PASSWORD_DEFAULT);
    $sql = "INSERT INTO tb_admin (nama_lengkap, email, username, password, role)
            VALUES ('$nama_lengkap', '$email', '$username', '$password', 'user')";

    if (mysqli_query($koneksi, $sql)) {
        echo "<script>alert('Registrasi berhasil! Silakan login.'); window.location='login.php';</script>";
    } else {
        echo "<script>alert('Registrasi gagal (username/email mungkin sudah terdaftar).'); window.location='register.php';</script>";
    }
}
?>