<?php
$host = "localhost";
$user = "root";
$pass = "";
$db = "sekolah_db";

// Membuat koneksi ke database
$koneksi = mysqli_connect($host, $user, $pass, $db);

// Cek koneksi
if (!$koneksi) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}

?>