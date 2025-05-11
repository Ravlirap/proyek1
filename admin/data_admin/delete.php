<?php
// Include database connection
include '../../database.php';

// Ambil kode_produk dari URL
$id = $_GET['id'];

// Hapus data dari tabel produk berdasarkan kode_produk
mysqli_query($conn, "DELETE FROM admin WHERE id='$id'");

// Redirect kembali ke halaman read.php
header("Location: data_admin/read.php");
exit;
?>