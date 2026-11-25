<?php
session_start();

// Cegah akses file HTML lama / redirect otomatis ke properti.php
$requestUri = $_SERVER['REQUEST_URI'] ?? '';
if (stripos($requestUri, 'daftarproperti.html') !== false || stripos($requestUri, 'daftar_properti.html') !== false) {
    header("Location: properti.php");
    exit();
}

if (!isset($_SESSION['user_rumahhub'])) {
    header("Location: ../login.php");
    exit();
}
include '../koneksi.php';

$sql = "SELECT * FROM tb_properti ORDER BY id_properti DESC";
$result = mysqli_query($koneksi, $sql);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Properti - RumahHub</title>
    <link rel="stylesheet" href="../css/style.css">
    <style>
        .crud-container {
            max-width: 1100px;
            margin: 30px auto;
            padding: 24px;
            background: #ffffff;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.06);
        }
        .crud-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            flex-wrap: wrap;
            gap: 10px;
        }
        .btn-tambah {
            padding: 9px 16px;
            background: #2b6cb0;
            color: #fff;
            text-decoration: none;
            border-radius: 6px;
            font-weight: 600;
        }
        .btn-kembali {
            padding: 9px 16px;
            background: #718096;
            color: #fff;
            text-decoration: none;
            border-radius: 6px;
        }
        table.tabel-properti {
            width: 100%;
            border-collapse: collapse;
        }
        table.tabel-properti th, table.tabel-properti td {
            border: 1px solid #e2e8f0;
            padding: 12px;
            text-align: left;
            vertical-align: middle;
        }
        table.tabel-properti th {
            background: #f7fafc;
            font-weight: 600;
        }
        table.tabel-properti img {
            width: 110px;
            height: 75px;
            object-fit: cover;
            border-radius: 6px;
        }
        .aksi-edit { color: #2b6cb0; font-weight: 600; text-decoration: none; }
        .aksi-hapus { color: #e53e3e; font-weight: 600; text-decoration: none; }
    </style>
</head>
<body>
    <main class="crud-container">
        <div class="crud-header">
            <h2>Daftar Data Properti</h2>
            <div style="display: flex; gap: 10px;">
                <a href="../dashboard.php" class="btn-kembali">&larr; Dashboard</a>
                <a href="properti-entry.php" class="btn-tambah">+ Tambah Properti</a>
            </div>
        </div>

        <table class="tabel-properti">
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
                if (mysqli_num_rows($result) == 0) {
                    echo "<tr><td colspan='7' style='text-align:center;'>Data Properti Kosong</td></tr>";
                } else {
                    while ($row = mysqli_fetch_assoc($result)) {
                        $namaFoto = $row['foto'];
                        if (!empty($namaFoto) && file_exists("../img_properti/" . $namaFoto)) {
                            $fotoPath = "../img_properti/" . htmlspecialchars($namaFoto);
                        } elseif (!empty($namaFoto) && file_exists("../assets/" . $namaFoto)) {
                            $fotoPath = "../assets/" . htmlspecialchars($namaFoto);
                        } else {
                            $fotoPath = "../assets/rumah_minimalis.jpg";
                        }

                        echo "<tr>
                            <td><img src='$fotoPath' alt='Foto Properti'></td>
                            <td>" . htmlspecialchars($row['nama_properti']) . "</td>
                            <td>" . htmlspecialchars($row['kategori']) . "</td>
                            <td>" . htmlspecialchars($row['lokasi']) . "</td>
                            <td>Rp " . number_format($row['harga'], 0, ',', '.') . "</td>
                            <td>" . htmlspecialchars($row['status_unit']) . "</td>
                            <td>
                                <a class='aksi-edit' href='properti-edit.php?id=" . $row['id_properti'] . "'>Edit</a> |
                                <a class='aksi-hapus' href='properti-hapus.php?id=" . $row['id_properti'] . "'>Hapus</a>
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