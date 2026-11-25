<?php
$servername = 'localhost';
$username = 'root';
$password = ''; // kosongkan jika default Laragon tanpa password
$database = 'db_rumahhub';

$koneksi = mysqli_connect($servername, $username, $password, $database);

if (!$koneksi) {
    die('Koneksi gagal: ' . mysqli_connect_error());
}
?>