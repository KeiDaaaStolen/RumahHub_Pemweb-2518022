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
    echo "<script>alert('Data properti tidak ditemukan'); window.location='properti.php';</script>";
    exit();
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Properti - RumahHub</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <main class="main-container" style="padding: 24px; max-width: 600px;">
        <h2>Edit Data Properti</h2>
        <form action="properti-proses.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="id_properti" value="<?= $data['id_properti'] ?>">
            <input type="hidden" name="fotoLama" value="<?= htmlspecialchars($data['foto']) ?>">

            <div class="form-group">
                <label>Nama Properti</label>
                <input type="text" name="nama_properti" value="<?= htmlspecialchars($data['nama_properti']) ?>" required>
            </div>
            <div class="form-group">
                <label>Kategori</label>
                <select name="kategori" required>
                    <option value="Rumah" <?= $data['kategori'] == 'Rumah' ? 'selected' : '' ?>>Rumah</option>
                    <option value="Apartemen" <?= $data['kategori'] == 'Apartemen' ? 'selected' : '' ?>>Apartemen</option>
                    <option value="Ruko" <?= $data['kategori'] == 'Ruko' ? 'selected' : '' ?>>Ruko</option>
                    <option value="Kost" <?= $data['kategori'] == 'Kost' ? 'selected' : '' ?>>Kost</option>
                </select>
            </div>
            <div class="form-group">
                <label>Lokasi</label>
                <input type="text" name="lokasi" value="<?= htmlspecialchars($data['lokasi']) ?>" required>
            </div>
            <div class="form-group">
                <label>Harga</label>
                <input type="number" name="harga" value="<?= htmlspecialchars($data['harga']) ?>" required>
            </div>
            <div class="form-group">
                <label>Deskripsi</label>
                <textarea name="deskripsi" rows="3"><?= htmlspecialchars($data['deskripsi']) ?></textarea>
            </div>
            <div class="form-group">
                <label>Status Unit</label>
                <select name="status_unit">
                    <option value="Tersedia" <?= $data['status_unit'] == 'Tersedia' ? 'selected' : '' ?>>Tersedia</option>
                    <option value="Disewa" <?= $data['status_unit'] == 'Disewa' ? 'selected' : '' ?>>Disewa</option>
                    <option value="Terjual" <?= $data['status_unit'] == 'Terjual' ? 'selected' : '' ?>>Terjual</option>
                </select>
            </div>
            <div class="form-group">
                <label>Foto Saat Ini</label><br>
                <?php if (!empty($data['foto'])): ?>
                    <img src="../img_properti/<?= htmlspecialchars($data['foto']) ?>" width="150" style="margin:8px 0;">
                <?php endif; ?>
                <input type="file" name="foto" accept=".jpg,.jpeg,.png">
            </div>
            <button type="submit" name="edit" class="btn-submit">Simpan Perubahan</button>
            <a href="properti.php" style="display:inline-block; margin-top:10px;">Batal</a>
        </form>
    </main>
</body>
</html>