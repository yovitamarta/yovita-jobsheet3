<?php
include "koneksi.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama_wali = trim($_POST['nama_wali']);
    $no_telepon = trim($_POST['no_telepon']);

    // Validasi input
    if (empty($nama_wali) || empty($no_telepon)) {
        $error = "Semua field harus diisi!";
    } elseif (!preg_match('/^[0-9]{10,15}$/', $no_telepon)) {
        $error = "Nomor telepon tidak valid! Harus terdiri dari 10-15 digit.";
    } else {
        // Menyimpan data ke database dengan prepared statements
        $stmt = $koneksi->prepare("INSERT INTO wali_murid (nama_wali, no_telepon) VALUES (?, ?)");
        $stmt->bind_param("ss", $nama_wali, $no_telepon);

        if ($stmt->execute()) {
            $success = "Data wali murid berhasil ditambahkan!";
        } else {
            $error = "Terjadi kesalahan: " . $stmt->error;
        }

        // Menutup statement
        $stmt->close();
    }
}

// Menutup koneksi
$koneksi->close();
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Wali Murid</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f1f3f7;
            font-family: 'Arial', sans-serif;
        }

        .container {
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            padding: 40px;
            margin-top: 60px;
        }

        h2 {
            color: #5f6368;
            font-size: 2rem;
            margin-bottom: 25px;
            text-align: center;
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

        .footer {
            text-align: center;
            margin-top: 30px;
            font-size: 0.9rem;
            color: #666;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>Tambah Wali Murid</h2>

        <?php if (!empty($error)) : ?>
            <div class="alert alert-danger">
                <?php echo $error; ?>
            </div>
        <?php endif; ?>

        <?php if (!empty($success)) : ?>
            <div class="alert alert-success">
                <?php echo $success; ?>
            </div>
        <?php endif; ?>

        <form method="post">
            <div class="mb-3">
                <label for="nama_wali" class="form-label">Nama Wali Murid</label>
                <input type="text" name="nama_wali" class="form-control" id="nama_wali" value="<?php echo isset($_POST['nama_wali']) ? htmlspecialchars($_POST['nama_wali']) : ''; ?>" required>
            </div>
            <div class="mb-3">
                <label for="no_telepon" class="form-label">No Telepon</label>
                <input type="text" name="no_telepon" class="form-control" id="no_telepon" value="<?php echo isset($_POST['no_telepon']) ? htmlspecialchars($_POST['no_telepon']) : ''; ?>" required>
            </div>
            <button type="submit" class="btn btn-success">Tambah Wali Murid</button>
            <a href="wali_murid.php" class="btn btn-primary">Kembali</a>
        </form>
    </div>

    <div class="footer">
        <p>&copy; 2025 Sekolah - All Rights Reserved</p>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>