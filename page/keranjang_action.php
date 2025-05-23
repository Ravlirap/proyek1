<?php
session_start();
include '../database.php';

error_reporting(E_ALL);
ini_set('display_errors', 1);

$action = $_POST['action'] ?? '';
$id_keranjang = $_POST['id'] ?? '';

file_put_contents('debug.log', "Action: $action, ID: $id_keranjang\n", FILE_APPEND);

if (!$action || !$id_keranjang) {
    file_put_contents('debug.log', "Invalid input: Action or ID is missing\n", FILE_APPEND);
    exit();
}

if ($conn->connect_error) {
    file_put_contents('debug.log', "Database connection error: " . $conn->connect_error . "\n", FILE_APPEND);
    exit();
}

if (!isset($_SESSION['id_user'])) {
    echo "<p>Silakan login terlebih dahulu.</p>";
    exit();
}

$id_user = $_SESSION['id_user'];

if ($action && $id_keranjang) {
    // Ambil info produk dari id_keranjang
    $stmt = $conn->prepare("SELECT k.id_produk, k.jumlah, p.stok
        FROM keranjang k 
        JOIN produk p ON k.id_produk = p.id_produk
        WHERE k.id_keranjang = ? AND k.id_user = ?");
    $stmt->bind_param("ii", $id_keranjang, $id_user);
    $stmt->execute();
    $stmt->bind_result($id_produk, $jumlah, $stok);
    
    if ($stmt->fetch()) {
        $stmt->close();

        if ($action === 'add' && $jumlah < $stok) {
            $stmt = $conn->prepare("UPDATE keranjang SET jumlah = jumlah + 1 WHERE id_keranjang = ?");
            $stmt->bind_param("i", $id_keranjang);
            $stmt->execute();
        } elseif ($action === 'remove') {
            if ($jumlah > 1) {
                $stmt = $conn->prepare("UPDATE keranjang SET jumlah = jumlah - 1 WHERE id_keranjang = ?");
                $stmt->bind_param("i", $id_keranjang);
                $stmt->execute();
            } else {
                $stmt = $conn->prepare("DELETE FROM keranjang WHERE id_keranjang = ?");
                $stmt->bind_param("i", $id_keranjang);
                $stmt->execute();
            }
        } elseif ($action === 'hapus') {
            $stmt = $conn->prepare("DELETE FROM keranjang WHERE id_keranjang = ?");
            $stmt->bind_param("i", $id_keranjang);
            $stmt->execute();
        }
    } else {
        $stmt->close();
    }
}

// Tampilkan ulang isi keranjang
$sql = "SELECT k.id_keranjang, p.id_produk, p.nama, p.gambar, p.harga, p.stok, k.jumlah
        FROM keranjang k 
        JOIN produk p ON k.id_produk = p.id_produk
        WHERE k.id_user = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id_user);
$stmt->execute();
$result = $stmt->get_result();

$grand_total = 0;

if ($result->num_rows > 0) {
    echo "<h1>Keranjang Belanja</h1>";
    while ($row = $result->fetch_assoc()) {
        $total = $row['harga'] * $row['jumlah'];
        $grand_total += $total;

        echo "<div class='cart-item'>
            <img src='img/produk/{$row['gambar']}' alt='{$row['nama']}'>
            <div>
                <h3>{$row['nama']}</h3>
                <p class='price'>Rp" . number_format($row['harga'], 0, ',', '.') . "</p>
            </div>
            <div class='cart-actions' data-id='{$row['id_keranjang']}'>
                <button type='button' class='btn btn-decrease'>-</button>
                <span style='margin: 0 10px; font-weight: bold;' class='quantity'>{$row['jumlah']}</span>
                <button type='button' class='btn btn-increase'>+</button>
                <button type='button' class='btn btn-trash btn-delete'>🗑</button>
            </div>
        </div>";
    }

    echo "<p><strong>Total: Rp" . number_format($grand_total, 0, ',', '.') . "</strong></p>";
    echo "<button class='checkout-btn'>Check Out</button>";
} else {
    echo "<p>Keranjang kosong.</p>";
}
?>