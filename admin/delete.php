<?php
// Include database connection
include '../database.php';

// Ambil id_produk dari URL
$id_produk = $_GET['id_produk'];

// Hapus data dari tabel produk berdasarkan id_produk
mysqli_query($conn, "DELETE FROM produk WHERE id_produk='$id_produk'");

// Redirect kembali ke halaman read.php
header("Location: read.php");
exit;
?>