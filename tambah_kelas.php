<?php
include "koneksi.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama_kelas = isset($_POST['nama_kelas']) ? $_POST['nama_kelas'] : '';

    // Validasi input
    if (empty($nama_kelas)) {
        $error = "Nama kelas tidak boleh kosong!";
    } else {
        // Menyimpan data ke database
        $query = "INSERT INTO kelas (nama_kelas) VALUES ('$nama_kelas')";
        $result = mysqli_query($koneksi, $query);

        if ($result) {
            header("Location: kelas.php"); // Redirect ke halaman kelas setelah berhasil
            exit;
        } else {
            $error = "Terjadi kesalahan saat menambah data kelas.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Kelas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f4f7fc;
            font-family: 'Arial', sans-serif;
        }

        .container {
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 30px;
            margin-top: 50px;
        }

        h2 {
            color: #5c6bc0;
            font-size: 2rem;
            margin-bottom: 20px;
        }

        .btn {
            padding: 10px 20px;
            font-size: 1rem;
            border-radius: 5px;
        }

        .btn-success {
            background-color: #4caf50;
            border-color: #4caf50;
        }

        .btn-success:hover {
            background-color: #45a049;
            border-color: #45a049;
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }

        .alert {
            margin-bottom: 20px;
        }

        .form-control {
            border-radius: 5px;
            padding: 10px;
            font-size: 1rem;
        }

        .mb-3 {
            margin-bottom: 1.5rem;
        }

        .footer {
            text-align: center;
            margin-top: 30px;
            font-size: 0.9rem;
            color: #555;
        }
    </style>
</head>

<body>
    <div class="container mt-4">
        <h2>Tambah Kelas</h2>

        <?php if (isset($error)) : ?>
            <div class="alert alert-danger">
                <?php echo $error; ?>
            </div>
        <?php endif; ?>

        <form method="post">
            <div class="mb-3">
                <label for="nama_kelas" class="form-label">Nama Kelas</label>
                <input type="text" name="nama_kelas" class="form-control" id="nama_kelas" required>
            </div>

            <button type="submit" class="btn btn-success">Tambah Kelas</button>
            <a href="kelas.php" class="btn btn-primary">Kembali</a>
        </form>
    </div>

    <div class="footer">
        <p>&copy; 2025 Sekolah - All Rights Reserved</p>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>

