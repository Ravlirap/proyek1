<?php
// Include database connection
include '../database.php';
$kode = $_GET['kode_produk'];
$result = mysqli_query($conn, "SELECT * FROM produk WHERE kode_produk='$kode'");
$data = mysqli_fetch_assoc($result);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST['nama'];
    $gambar = $_POST['gambar'];
    $harga = $_POST['harga'];
    $stok = $_POST['stok'];
    $jenis = $_POST['jenis'];
    mysqli_query($conn, "UPDATE produk SET nama='$nama',gambar='$gambar',harga='$harga',harga='$harga',stok='$stok', jenis='$jenis' WHERE kode_produk='$kode'");
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
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
<div class="container mt-4">
    <h2>Edit Produk</h2>
    <form method="POST">
        <div class="mb-3">
            <label>Kode Produk</label>
            <input type="text" name="kode_produk" value="<?= $data['kode_produk']; ?>" class="form-control" readonly>
        </div>
        <div class="mb-3">
            <label>Nama Produk</label>
            <input type="text" name="nama" value="<?= $data['nama']; ?>" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Gambar</label>
            <input type="text" name="gambar" value="<?= $data['gambar']; ?>" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Harga</label>
            <input type="text" name="harga" value="<?= $data['harga']; ?>" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Stok</label>
            <input type="text" name="stok" value="<?= $data['stok']; ?>" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>jenis</label>
            <input type="text" name="jenis" value="<?= $data['jenis']; ?>" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
        <a href="read.php" class="btn btn-secondary">Kembali</a>
    </form>
</div>
