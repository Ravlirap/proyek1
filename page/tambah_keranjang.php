<?php
session_start();
include '../database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_produk'])) {
    $id_produk = intval($_POST['id_produk']);
    $id_user = $_SESSION['id_user'] ?? 0;

    if ($id_user == 0) {
        header('Location: ../index.php?page=login');
        exit;
    }

    // Cek stok produk
    $produk = $conn->query("SELECT stok FROM produk WHERE id_produk = $id_produk")->fetch_assoc();
    if (!$produk) {
        die("Produk tidak ditemukan");
    }

    $stok = $produk['stok'];

    // Cek jumlah saat ini di keranjang
    $cek = $conn->query("SELECT jumlah FROM keranjang WHERE id_user = $id_user AND id_produk = $id_produk");
    if ($cek->num_rows > 0) {
        $data = $cek->fetch_assoc();
        $jumlah_sekarang = $data['jumlah'];

        if ($jumlah_sekarang < $stok) {
            // Update jumlah
            $conn->query("UPDATE keranjang SET jumlah = jumlah + 1 WHERE id_user = $id_user AND id_produk = $id_produk");
        }
        // Jika sudah mencapai batas stok, tidak ditambah
    } else {
        // Tambahkan jika belum ada
        if ($stok > 0) {
            $conn->query("INSERT INTO keranjang (id_user, id_produk, jumlah) VALUES ($id_user, $id_produk, 1)");
        }
    }

    header('Location: ../index.php?page=keranjang');
    exit;
} else {
    header('Location: ../index.php?page=produk');
    exit;
}