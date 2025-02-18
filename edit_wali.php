<?php
include 'koneksi.php';

// Cek apakah ada ID yang dikirim untuk edit
if (!isset($_GET['id']) || empty($_GET['id'])) {
    echo "<script>alert('ID tidak ditemukan!'); window.location='wali_murid.php';</script>";
    exit;
}

$id_wali = intval($_GET['id']); // Pastikan ID berupa angka
$query = "SELECT * FROM wali_murid WHERE id_wali = $id_wali";
$result = mysqli_query($koneksi, $query);
$wali = mysqli_fetch_assoc($result);

if (!$wali) {
    echo "<script>alert('Data tidak ditemukan!'); window.location='wali_murid.php';</script>";
    exit;
}

// Proses update data
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama_wali = mysqli_real_escape_string($koneksi, $_POST['nama_wali']);
    $kontak = mysqli_real_escape_string($koneksi, $_POST['kontak']);

    // Validasi input
    if (empty($nama_wali) || empty($kontak)) {
        echo "<script>alert('Semua field harus diisi!'); window.history.back();</script>";
        exit;
    }

    // Query Update
    $query_update = "UPDATE wali_murid SET nama_wali = '$nama_wali', kontak = '$kontak' WHERE id_wali = $id_wali";

    if (mysqli_query($koneksi, $query_update)) {
        echo "<script>alert('Data berhasil diperbarui!'); window.location='wali_murid.php';</script>";
    } else {
        echo "Error: " . mysqli_error($koneksi);
    }
}

?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Wali Murid</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <h2 class="mb-3">Edit Wali Murid</h2>
        <form action="edit_wali.php?id=<?php echo $id_wali; ?>" method="POST">
            <div class="mb-3">
                <label for="nama_wali" class="form-label">Nama Wali Murid</label>
                <input type="text" class="form-control" id="nama_wali" name="nama_wali" value="<?php echo htmlspecialchars($wali['nama_wali']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="kontak" class="form-label">No. Telepon</label>
                <input type="text" class="form-control" id="kontak" name="kontak" value="<?php echo htmlspecialchars($wali['kontak']); ?>" required>
            </div>
            <button type="submit" class="btn btn-success">Update</button>
            <a href="wali_murid.php" class="btn btn-secondary">Batal</a>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
