<?php
include 'koneksi.php';

// Pastikan ada parameter ID yang dikirim
if (isset($_GET['id'])) {
    $id_siswa = $_GET['id'];
    
    // Query untuk menghapus siswa berdasarkan ID
    $query = "DELETE FROM siswa WHERE id_siswa = ?";
    $stmt = mysqli_prepare($koneksi, $query);
    mysqli_stmt_bind_param($stmt, "i", $id_siswa);
    
    if (mysqli_stmt_execute($stmt)) {
        echo "<script>alert('Data siswa berhasil dihapus.'); window.location='index.php';</script>";
    } else {
        echo "<script>alert('Gagal menghapus data siswa.'); window.location='index.php';</script>";
    }
    
    mysqli_stmt_close($stmt);
} else {
    echo "<script>alert('ID siswa tidak ditemukan.'); window.location='index.php';</script>";
}

mysqli_close($koneksi);
?>

