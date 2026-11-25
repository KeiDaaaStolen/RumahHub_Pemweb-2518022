<?php
session_start();
if (!isset($_SESSION['user_rumahhub'])) {
    header("Location: ../login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Properti - RumahHub</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <main class="main-container" style="padding: 24px; max-width: 600px;">
        <h2>Tambah Data Properti</h2>
        <form action="properti-proses.php" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label>Nama Properti</label>
                <input type="text" name="nama_properti" required>
            </div>
            <div class="form-group">
                <label>Kategori</label>
                <select name="kategori" required>
                    <option value="Rumah">Rumah</option>
                    <option value="Apartemen">Apartemen</option>
                    <option value="Ruko">Ruko</option>
                    <option value="Kost">Kost</option>
                </select>
            </div>
            <div class="form-group">
                <label>Lokasi</label>
                <input type="text" name="lokasi" required>
            </div>
            <div class="form-group">
                <label>Harga (angka)</label>
                <input type="number" name="harga" required>
            </div>
            <div class="form-group">
                <label>Deskripsi</label>
                <textarea name="deskripsi" rows="3"></textarea>
            </div>
            <div class="form-group">
                <label>Status Unit</label>
                <select name="status_unit">
                    <option value="Tersedia">Tersedia</option>
                    <option value="Disewa">Disewa</option>
                    <option value="Terjual">Terjual</option>
                </select>
            </div>
            <div class="form-group">
                <label>Foto Properti (JPG/JPEG/PNG)</label>
                <input type="file" name="foto" accept=".jpg,.jpeg,.png" required>
            </div>
            <button type="submit" name="simpan" class="btn-submit">Simpan Properti</button>
            <a href="properti.php" style="display:inline-block; margin-top:10px;">Kembali</a>
        </form>
    </main>
</body>
</html>