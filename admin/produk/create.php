<?php
session_start();
// Include database connection
include '../../database.php';
$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_produk = $_POST['id_produk'];
    $nama = $_POST['nama'];
    $gambar = $_POST['gambar'];
    $harga = $_POST['harga'];
    $stok = $_POST['stok'];
    $jenis = $_POST['jenis'];

    // Validasi id_produk_kategori unik
    $check = mysqli_query($conn, "SELECT * FROM produk WHERE id_produk='$id_produk'");
    if (mysqli_num_rows($check) > 0) {
        $error = "id_produk kategori sudah digunakan!";
    } else {
        mysqli_query($conn, "INSERT INTO produk (id_produk,nama,gambar,harga,stok,jenis) VALUES ('$id_produk', '$nama', '$gambar', '$harga', '$stok', '$jenis')");
        $_SESSION['success'] = "Data berhasil dibuat!";
        header("Location: create.php");
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Produk</title>
    <link rel="stylesheet" href="../../bootstrap/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .form-container {
            background: #ffffff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .form-title {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 20px;
            color: #343a40;
        }
        .btn-custom {
            width: 100%;
        }
    </style>
</head>
<body>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="form-container">
                <h2 class="form-title text-center">Tambah Produk</h2>
                <?php 
                if (isset($_SESSION['success'])) {
                    echo "<div class='alert alert-success'>" . $_SESSION['success'] . "</div>";
                    unset($_SESSION['success']); // Clear the success message
                }
                if ($error) echo "<div class='alert alert-danger'>$error</div>"; 
                ?>
                <form method="POST">
                    <div class="mb-3">
                        <label for="id_produk" class="form-label">ID Produk</label>
                        <input type="text" id="id_produk" name="id_produk" class="form-control" required maxlength="5">
                    </div>
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama Produk</label>
                        <input type="text" id="nama" name="nama" class="form-control" required maxlength="100">
                    </div>
                    <div class="mb-3">
                        <label for="gambar" class="form-label">Gambar</label>
                        <input type="file" id="gambar" name="gambar" class="form-control" accept="image/*">
                    </div>
                    <div class="mb-3">
                        <label for="harga" class="form-label">Harga</label>
                        <input type="number" id="harga" name="harga" class="form-control" required min="0">
                    </div>
                    <div class="mb-3">
                        <label for="stok" class="form-label">Stok</label>
                        <input type="number" id="stok" name="stok" class="form-control" required min="0">
                    </div>
                    <div class="mb-3">
                        <label for="jenis" class="form-label">Jenis</label>
                        <input type="text" id="jenis" name="jenis" class="form-control" required maxlength="100">
                    </div>
                    <button type="submit" class="btn btn-success btn-custom">Simpan</button>
                    <a href="read.php" class="btn btn-secondary btn-custom mt-2">Kembali</a>
                </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>
