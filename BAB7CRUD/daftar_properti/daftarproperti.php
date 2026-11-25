<?php
session_start();
if (!isset($_SESSION['user_rumahhub'])) {
    header("Location: ../login.php");
    exit();
}
include '../koneksi.php';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Kelola Data Properti - RumahHub</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <header class="navbar">
        <div class="logo-container">
            <span class="brand-title">RUMAHHUB</span>
        </div>
        <nav class="nav-links">
            <a href="../index.php">Home</a>
            <a href="../dashboard.php">Dashboard</a>
            <a href="../logout.php">Logout</a>
        </nav>
    </header>

    <main class="main-container" style="padding: 24px;">
        <h2>Data Properti RumahHub</h2>
        <a href="properti-entry.php" style="display:inline-block; margin: 12px 0; padding: 8px 14px; background:#3182ce; color:#fff; text-decoration:none; border-radius:6px;">+ Tambah Properti</a>

        <table border="1" cellpadding="10" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th>Foto</th>
                    <th>Nama Properti</th>
                    <th>Kategori</th>
                    <th>Lokasi</th>
                    <th>Harga</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT * FROM tb_properti ORDER BY id_properti DESC";
                $result = mysqli_query($koneksi, $sql);
                if (mysqli_num_rows($result) == 0) {
                    echo "<tr><td colspan='7' align='center'>Data Properti Kosong</td></tr>";
                } else {
                    while ($row = mysqli_fetch_assoc($result)) {
                        $fotoPath = !empty($row['foto']) ? "../img_properti/" . htmlspecialchars($row['foto']) : "../assets/rumah_minimalis.jpg";
                        echo "<tr>
                            <td><img src='$fotoPath' width='120' alt='Foto Properti'></td>
                            <td>" . htmlspecialchars($row['nama_properti']) . "</td>
                            <td>" . htmlspecialchars($row['kategori']) . "</td>
                            <td>" . htmlspecialchars($row['lokasi']) . "</td>
                            <td>Rp " . number_format($row['harga'], 0, ',', '.') . "</td>
                            <td>" . htmlspecialchars($row['status_unit']) . "</td>
                            <td>
                                <a href='properti-edit.php?id=" . $row['id_properti'] . "'>Edit</a> |
                                <a href='properti-hapus.php?id=" . $row['id_properti'] . "' onclick=\"return confirm('Yakin hapus data ini?')\">Hapus</a>
                            </td>
                        </tr>";
                    }
                }
                ?>
            </tbody>
        </table>
    </main>
</body>
</html>