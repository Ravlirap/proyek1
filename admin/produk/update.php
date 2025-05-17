<?php
// Include database connection
include '../../database.php';
$id_produk = $_GET['id_produk'];
$result = mysqli_query($conn, "SELECT * FROM produk WHERE id_produk='$id_produk'");
$data = mysqli_fetch_assoc($result);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST['nama'];
    $gambar = $_POST['gambar'];
    $harga = $_POST['harga'];
    $stok = $_POST['stok'];
    $jenis = $_POST['jenis'];
    mysqli_query($conn, "UPDATE produk SET nama='$nama',gambar='$gambar',harga='$harga',harga='$harga',stok='$stok', jenis='$jenis' WHERE id_produk='$id_produk'");
    header("location:read.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Produk</title>
    <link rel="stylesheet" href="../../bootstrap/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f4f6f9;
            font-family: Arial, sans-serif;
        }
        .container {
            max-width: 600px;
            background: #ffffff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin: 50px auto;
        }
        h2 {
            color: #333;
            font-weight: bold;
            text-align: center;
            margin-bottom: 20px;
        }
        .form-label {
            font-weight: bold;
            color: #555;
        }
        .form-control {
            border-radius: 5px;
            border: 1px solid #ddd;
        }
        .form-control:focus {
            border-color: #007bff;
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
        }
        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
            border-radius: 5px;
        }
        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #004085;
        }
        .btn-secondary {
            background-color: #6c757d;
            border-color: #6c757d;
            border-radius: 5px;
        }
        .btn-secondary:hover {
            background-color: #5a6268;
            border-color: #545b62;
        }
        .d-flex {
            gap: 10px;
        }
    </style>
</head>
<body>
<div class="container">
    <h2>Edit Produk</h2>
    <form method="POST">
        <div class="mb-3">
            <label class="form-label">id_produk Produk</label>
            <input type="text" name="id_produk" value="<?= htmlspecialchars($data['id_produk']); ?>" class="form-control" readonly>
        </div>
        <div class="mb-3">
            <label class="form-label">Nama Produk</label>
            <input type="text" name="nama" value="<?= htmlspecialchars($data['nama']); ?>" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Gambar</label>
            <input type="file" name="gambar" class="form-control" accept="image/*">
        </div>
        <div class="mb-3">
            <label class="form-label">Harga</label>
            <input type="text" name="harga" value="<?= htmlspecialchars($data['harga']); ?>" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Stok</label>
            <input type="text" name="stok" value="<?= htmlspecialchars($data['stok']); ?>" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Jenis</label>
            <input type="text" name="jenis" value="<?= htmlspecialchars($data['jenis']); ?>" class="form-control" required>
        </div>
        <div class="d-flex justify-content-between">
            <button type="submit" class="btn btn-primary">Update</button>
            <a href="read.php" class="btn btn-secondary">Kembali</a>
        </div>
    </form>
</div>
<script src="../../bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>
