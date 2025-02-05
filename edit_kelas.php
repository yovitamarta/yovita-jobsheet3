<?php
include 'koneksi.php';

// Check if the 'id' parameter is provided
if (isset($_GET['id'])) {
    $id_kelas = $_GET['id'];

    // Fetch the class data
    $query = "SELECT * FROM kelas WHERE id_kelas = '$id_kelas'";
    $result = mysqli_query($koneksi, $query);
    
    if (mysqli_num_rows($result) > 0) {
        $kelas = mysqli_fetch_assoc($result);
    } else {
        echo "Kelas tidak ditemukan!";
        exit;
    }
} else {
    echo "ID Kelas tidak ada!";
    exit;
}

// Process the form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama_kelas = mysqli_real_escape_string($koneksi, $_POST['nama_kelas']);

    // Validate input
    if (empty($nama_kelas)) {
        $error = "Nama Kelas harus diisi!";
    } else {
        // Update the class data
        $update_query = "UPDATE kelas SET nama_kelas = '$nama_kelas' WHERE id_kelas = '$id_kelas'";
        $update_result = mysqli_query($koneksi, $update_query);

        if ($update_result) {
            header("Location: kelas.php"); // Redirect back to kelas page
            exit;
        } else {
            $error = "Terjadi kesalahan saat memperbarui data kelas.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Kelas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-4">
        <h2>Edit Kelas</h2>

        <?php if (isset($error)) : ?>
            <div class="alert alert-danger">
                <?php echo $error; ?>
            </div>
        <?php endif; ?>

        <form method="post">
            <div class="mb-3">
                <label for="nama_kelas" class="form-label">Nama Kelas</label>
                <input type="text" name="nama_kelas" id="nama_kelas" class="form-control" value="<?php echo htmlspecialchars($kelas['nama_kelas']); ?>" required>
            </div>
            <button type="submit" class="btn btn-success">Simpan Perubahan</button>
            <a href="kelas.php" class="btn btn-primary">Kembali</a>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
