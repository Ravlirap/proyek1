<?php
// Include database connection
include '../database.php';
$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $kode = $_POST['kode_produk'];
    $nama = $_POST['nama'];
    $gambar = $_POST['gambar'];
    $harga = $_POST['harga'];
    $stok = $_POST['stok'];
    $jenis = $_POST['jenis'];

    // Validasi kode_kategori unik
    $check = mysqli_query($conn, "SELECT * FROM produk WHERE kode_produk='$kode'");
    if (mysqli_num_rows($check) > 0) {
        $error = "Kode kategori sudah digunakan!";
    } else {
        mysqli_query($conn, "INSERT INTO produk (kode_produk,nama,gambar,harga,stok,jenis) VALUES ('$kode', '$nama', '$gambar', '$harga', '$stok', '$jenis')");
        header("read.php");
    }
}
?>

<!DOCTYPE html>
<html lang="en"></html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Produk</title>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
<div class="container mt-4">
    <h2>Tambah Produk</h2>
    <?php if ($error) echo "<div class='alert alert-danger'>$error</div>"; ?>
    <form method="POST">
        <div class="mb-3">
            <label>Kode Produk</label>
            <input type="text" name="kode_produk" class="form-control" required maxlength="5">
        </div>
        <div class="mb-3">
            <label>Nama Produk</label>
            <input type="text" name="nama" class="form-control" required maxlength="100">
        </div>
        <div class="mb-3">
            <label>Gambar</label>
            <input type="text" name="gambar" class="form-control" required maxlength="100">
        </div>
        <div class="mb-3">
            <label>Harga</label>
            <input type="number" name="harga" class="form-control" required min="0">
        </div>
        <div class="mb-3">
            <label>Stok</label>
            <input type="number" name="stok" class="form-control" required min="0">
        </div>
        <div class="mb-3">
            <label>jenis</label>
            <input type="text" name="jenis" class="form-control" required maxlength="100">
        </div>
        <button type="submit" class="btn btn-success">Simpan</button>
        <a href="read.php" class="btn btn-secondary">Kembali</a>
    </form>
</div>
</html>
