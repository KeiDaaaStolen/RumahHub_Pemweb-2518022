<?php
session_start();
if (!isset($_SESSION['user_rumahhub'])) {
    header("Location: ../login.php");
    exit();
}
include '../koneksi.php';

function uploadFoto() {
    if (!isset($_FILES['foto']) || $_FILES['foto']['error'] === 4) {
        echo "<script>alert('Foto properti harus diunggah!'); window.location='properti-entry.php';</script>";
        return false;
    }

    $namaFile = $_FILES['foto']['name'];
    $tmpName  = $_FILES['foto']['tmp_name'];
    $ekstensiValid = ['jpg', 'jpeg', 'png'];
    $ekstensi = strtolower(pathinfo($namaFile, PATHINFO_EXTENSION));

    if (!in_array($ekstensi, $ekstensiValid)) {
        echo "<script>alert('Format foto harus JPG, JPEG, atau PNG!'); window.location='properti-entry.php';</script>";
        return false;
    }

    $namaBaru = uniqid('prop_') . '.' . $ekstensi;
    if (move_uploaded_file($tmpName, '../img_properti/' . $namaBaru)) {
        return $namaBaru;
    }
    return false;
}

if (isset($_POST['simpan'])) {
    $nama_properti = mysqli_real_escape_string($koneksi, $_POST['nama_properti']);
    $kategori      = mysqli_real_escape_string($koneksi, $_POST['kategori']);
    $lokasi        = mysqli_real_escape_string($koneksi, $_POST['lokasi']);
    $harga         = (int) $_POST['harga'];
    $deskripsi     = mysqli_real_escape_string($koneksi, $_POST['deskripsi']);
    $status_unit   = mysqli_real_escape_string($koneksi, $_POST['status_unit']);

    $foto = uploadFoto();
    if (!$foto) {
        exit();
    }

    $sql = "INSERT INTO tb_properti (nama_properti, kategori, lokasi, harga, deskripsi, foto, status_unit)
            VALUES ('$nama_properti', '$kategori', '$lokasi', $harga, '$deskripsi', '$foto', '$status_unit')";

    if (mysqli_query($koneksi, $sql)) {
        echo "<script>alert('Data properti berhasil ditambahkan!'); window.location='properti.php';</script>";
    } else {
        echo "<script>alert('Gagal menyimpan data properti.'); window.location='properti-entry.php';</script>";
    }
} elseif (isset($_POST['edit'])) {
    $id_properti   = (int) $_POST['id_properti'];
    $nama_properti = mysqli_real_escape_string($koneksi, $_POST['nama_properti']);
    $kategori      = mysqli_real_escape_string($koneksi, $_POST['kategori']);
    $lokasi        = mysqli_real_escape_string($koneksi, $_POST['lokasi']);
    $harga         = (int) $_POST['harga'];
    $deskripsi     = mysqli_real_escape_string($koneksi, $_POST['deskripsi']);
    $status_unit   = mysqli_real_escape_string($koneksi, $_POST['status_unit']);
    $fotoLama      = basename($_POST['fotoLama']);

    if ($_FILES['foto']['error'] === 4) {
        $foto = $fotoLama;
    } else {
        $fotoBaru = uploadFoto();
        if (!$fotoBaru) {
            exit();
        }
        if (!empty($fotoLama) && file_exists('../img_properti/' . $fotoLama)) {
            unlink('../img_properti/' . $fotoLama);
        }
        $foto = $fotoBaru;
    }

    $sql = "UPDATE tb_properti SET
            nama_properti = '$nama_properti',
            kategori = '$kategori',
            lokasi = '$lokasi',
            harga = $harga,
            deskripsi = '$deskripsi',
            foto = '$foto',
            status_unit = '$status_unit'
            WHERE id_properti = $id_properti";

    if (mysqli_query($koneksi, $sql)) {
        echo "<script>alert('Data properti berhasil diubah!'); window.location='properti.php';</script>";
    } else {
        echo "<script>alert('Gagal mengubah data properti.'); window.location='properti-edit.php?id=$id_properti';</script>";
    }
} elseif (isset($_POST['hapus'])) {
    $id_properti = (int) $_POST['id_properti'];
    $cek = mysqli_query($koneksi, "SELECT foto FROM tb_properti WHERE id_properti = $id_properti");
    $row = mysqli_fetch_assoc($cek);

    if ($row && !empty($row['foto']) && file_exists('../img_properti/' . $row['foto'])) {
        unlink('../img_properti/' . $row['foto']);
    }

    if (mysqli_query($koneksi, "DELETE FROM tb_properti WHERE id_properti = $id_properti")) {
        echo "<script>alert('Data properti berhasil dihapus!'); window.location='properti.php';</script>";
    } else {
        echo "<script>alert('Gagal menghapus data (mungkin masih terhubung ke data pesanan).'); window.location='properti.php';</script>";
    }
} else {
    header("Location: properti.php");
    exit();
}
?>