<?php
include "koneksi.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nis = mysqli_real_escape_string($koneksi, $_POST['NIS']);
    $nama = mysqli_real_escape_string($koneksi, $_POST['nama']);
    $jenis_kelamin = mysqli_real_escape_string($koneksi, $_POST['jenis_kelamin']);
    $tempat_lahir = mysqli_real_escape_string($koneksi, $_POST['tempat_lahir']);
    $tanggal_lahir = mysqli_real_escape_string($koneksi, $_POST['tanggal_lahir']);
    $id_kelas = mysqli_real_escape_string($koneksi, $_POST['id_kelas']);
    $wali_murid = mysqli_real_escape_string($koneksi, $_POST['wali_murid']);
    
    $query = "INSERT INTO siswa (nis, nama, jenis_kelamin, tempat_lahir, tanggal_lahir, id_kelas, wali_murid) VALUES ('$nis', '$nama', '$jenis_kelamin', '$tempat_lahir', '$tanggal_lahir', '$id_kelas', '$wali_murid')";
    if (mysqli_query($koneksi, $query)) {
        echo "<script>alert('Siswa berhasil ditambahkan!'); window.location.href='index.php';</script>";
    } else {
        echo "<script>alert('Gagal menambahkan siswa! Error: " . mysqli_error($koneksi) . "');</script>";
    }    
    mysqli_close($koneksi); // Tutup koneksi agar query gagal
}

$kelas_result = mysqli_query($koneksi, "SELECT * FROM kelas");
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Siswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

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

<body>
    <div class="container mt-4">
        <h2>Tambah Siswa</h2>
        
        <form method="post">
        <div class="mb-3">
                <label for="NIS" class="form-label">NIS</label>
                <input type="text" name="NIS" id="NIS" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="nama" class="form-label">Nama</label>
                <input type="text" name="nama" id="nama" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                <select name="jenis_kelamin" id="jenis_kelamin" class="form-control" required>
                    <option value="">Pilih Jenis Kelamin</option>
                    <option value="Laki-laki">Laki-laki</option>
                    <option value="Perempuan">Perempuan</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="tempat_lahir" class="form-label">Tempat Lahir</label>
                <input type="text" name="tempat_lahir" id="tempat_lahir" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                <input type="date" name="tanggal_lahir" id="tanggal_lahir" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="id_kelas" class="form-label">Kelas</label>
                <select name="id_kelas" id="id_kelas" class="form-control" required>
                    <option value="">Pilih Kelas</option>
                    <option value="">PPLG 1</option>
                    <option value="">PPLG 2</option>
                    <?php while ($kelas = mysqli_fetch_assoc($kelas_result)) : ?>
                        <option value="<?php echo $kelas['id_kelas']; ?>">
                            <?php echo $kelas['nama_kelas']; ?>
                        </option>
                    <?php endwhile; ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="wali_murid" class="form-label">Wali Murid</label>
                <input type="text" name="wali_murid" id="wali_murid" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-success">Tambah siswa</button>
            <a href="index.php" class="btn btn-primary">Kembali</a>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
