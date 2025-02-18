<?php
include 'koneksi.php';

// Pastikan ada parameter ID yang dikirim
if (isset($_GET['id'])) {
    $id_kelas = $_GET['id'];
    
    // Periksa apakah ada siswa yang masih terdaftar di kelas ini
    $check_query = "SELECT COUNT(*) AS total FROM siswa WHERE id_kelas = ?";
    $stmt_check = mysqli_prepare($koneksi, $check_query);
    mysqli_stmt_bind_param($stmt_check, "i", $id_kelas);
    mysqli_stmt_execute($stmt_check);
    $result_check = mysqli_stmt_get_result($stmt_check);
    $row_check = mysqli_fetch_assoc($result_check);
    mysqli_stmt_close($stmt_check);
    
    if ($row_check['total'] > 0) {
        echo "<script>alert('Tidak bisa menghapus kelas, masih ada siswa yang terdaftar.'); window.location='kelas.php';</script>";
    } else {
        // Query untuk menghapus kelas berdasarkan ID
        $query = "DELETE FROM kelas WHERE id_kelas = ?";
        $stmt = mysqli_prepare($koneksi, $query);
        mysqli_stmt_bind_param($stmt, "i", $id_kelas);
        
        if (mysqli_stmt_execute($stmt)) {
            echo "<script>alert('Data kelas berhasil dihapus.'); window.location='kelas.php';</script>";
        } else {
            echo "<script>alert('Gagal menghapus data kelas.'); window.location='kelas.php';</script>";
        }
        
        mysqli_stmt_close($stmt);
    }
} else {
    echo "<script>alert('ID kelas tidak ditemukan.'); window.location='kelas.php';</script>";
}

mysqli_close($koneksi);
?>
