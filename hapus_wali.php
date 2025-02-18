<?php
include 'koneksi.php';

// Pastikan ada parameter ID yang dikirim
if (isset($_GET['id'])) {
    $id_wali = $_GET['id'];
    
    // Periksa apakah ada siswa yang masih terkait dengan wali ini
    $check_query = "SELECT COUNT(*) AS total FROM siswa WHERE id_wali = ?";
    $stmt_check = mysqli_prepare($koneksi, $check_query);
    mysqli_stmt_bind_param($stmt_check, "i", $id_wali);
    mysqli_stmt_execute($stmt_check);
    $result_check = mysqli_stmt_get_result($stmt_check);
    $row_check = mysqli_fetch_assoc($result_check);
    mysqli_stmt_close($stmt_check);
    
    if ($row_check['total'] > 0) {
        echo "<script>alert('Tidak bisa menghapus wali murid, masih ada siswa yang terkait.'); window.location='wali_murid.php';</script>";
    } else {
        // Query untuk menghapus wali murid berdasarkan ID
        $query = "DELETE FROM wali_murid WHERE id_wali = ?";
        $stmt = mysqli_prepare($koneksi, $query);
        mysqli_stmt_bind_param($stmt, "i", $id_wali);
        
        if (mysqli_stmt_execute($stmt)) {
            echo "<script>alert('Data wali murid berhasil dihapus.'); window.location='wali_murid.php';</script>";
        } else {
            echo "<script>alert('Gagal menghapus data wali murid.'); window.location='wali_murid.php';</script>";
        }
        
        mysqli_stmt_close($stmt);
    }
} else {
    echo "<script>alert('ID wali murid tidak ditemukan.'); window.location='wali_murid.php';</script>";
}

mysqli_close($koneksi);
?>