<?php
session_start();
if (!isset($_SESSION['user_rumahhub'])) {
    header("Location: ../login.php");
    exit();
}
include '../koneksi.php';

if (!isset($_GET['id'])) {
    echo "<script>alert('ID tidak ditemukan'); window.location='properti.php';</script>";
    exit();
}

$id = (int) $_GET['id'];
$query = mysqli_query($koneksi, "SELECT * FROM tb_properti WHERE id_properti = $id");
$data = mysqli_fetch_assoc($query);

if (!$data) {
    echo "<script>alert('Data tidak ditemukan'); window.location='properti.php';</script>";
    exit();
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Hapus Properti - RumahHub</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <main class="main-container" style="padding: 24px; max-width: 500px;">
        <h3>Hapus Data Properti</h3>
        <p>Yakin ingin menghapus properti <b><?= htmlspecialchars($data['nama_properti']) ?></b>?</p>
        <form action="properti-proses.php" method="POST">
            <input type="hidden" name="id_properti" value="<?= $data['id_properti'] ?>">
            <button type="submit" name="hapus" class="btn-submit">Ya, Hapus</button>
            <a href="properti.php" style="display:inline-block; margin-top:10px;">Tidak</a>
        </form>
    </main>
</body>
</html>