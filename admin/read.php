<?php
// Include database connection
include '../database.php';
$query = "SELECT * FROM produk ORDER BY kode_produk ASC";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Produk</title>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
<div class="container mt-5">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h3 class="mb-0">Daftar Produk</h3>
        </div>
        <div class="card-body">
            <table class="table table-hover table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th>ID</th>
                        <th>Nama</th>
                        <th>Gambar</th>
                        <th>Harga</th>
                        <th>Stok</th>
                        <th>jenis</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($row = mysqli_fetch_assoc($result)) { ?>
                    <tr>
                        <td><?= htmlspecialchars($row['kode_produk']); ?></td>
                        <td><?= htmlspecialchars($row['nama']); ?></td>
                        <td><img src="../img/produk/<?= htmlspecialchars($row['gambar']); ?>" alt="Gambar Produk" style="width: 70px; height: 70px;"></td>
                        <td><?= htmlspecialchars(number_format($row['harga'], 2, ',', '.')); ?></td>
                        <td><?= htmlspecialchars($row['stok']); ?></td>
                        <td><?= htmlspecialchars($row['jenis']); ?></td>
                        <td class="text-center">
                            <a href="update.php?kode_produk=<?= urlencode($row['kode_produk']); ?>" class="btn btn-warning btn-sm">Edit</a>
                            <a href="delete.php?kode_produk=<?= urlencode($row['kode_produk']); ?>" class="btn btn-danger btn-sm" onclick="return confirm('Hapus data ini?')">Delete</a>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
        <div class="card-footer text-center">
            <a href="create.php" class="btn btn-success">Tambah Produk</a>
        </div>
    </div>
</div>

