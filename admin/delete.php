<?php
// Include database connection
include '../database.php';

// Ambil kode_produk dari URL
$kode_produk = $_GET['kode_produk'];

// Hapus data dari tabel produk berdasarkan kode_produk
mysqli_query($conn, "DELETE FROM produk WHERE kode_produk='$kode_produk'");

// Redirect kembali ke halaman read.php
header("Location: read.php");
exit;
?>