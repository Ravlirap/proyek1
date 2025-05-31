<?php
// Menghubungkan ke file database untuk koneksi ke database
include './database.php';

// Memeriksa apakah parameter 'id_produk' tersedia di URL
if (isset($_GET['id_produk'])) {
    $id = $_GET['id_produk']; // Mengambil nilai 'id_produk' dari URL

    // Menggunakan prepared statement untuk mencegah SQL injection
    $stmt = $conn->prepare("SELECT * FROM produk WHERE id_produk = ?");
    $stmt->bind_param("i", $id); // Mengikat parameter 'id' ke query
    $stmt->execute(); // Menjalankan query
    $result = $stmt->get_result(); // Mendapatkan hasil query

    // Memeriksa apakah produk ditemukan
    if ($result->num_rows > 0) {
        $produk = $result->fetch_assoc(); // Mengambil data produk
    } else {
        echo "<p>Produk tidak ditemukan.</p>"; // Menampilkan pesan jika produk tidak ditemukan
        exit; // Menghentikan eksekusi jika produk tidak ditemukan
    }
} else {
    echo "<p>id_produk produk tidak tersedia.</p>"; // Menampilkan pesan jika 'id_produk' tidak tersedia
    exit; // Menghentikan eksekusi jika 'id_produk' tidak tersedia
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Detail Produk</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,300;0,400;0,700;1,700&display=swap"
        rel="stylesheet" />

    <!-- Feather Icons -->
    <script src="https://unpkg.com/feather-icons"></script>

    <!-- My Style -->
    <link rel="stylesheet" href="css/style.css" />
    <link rel="stylesheet" href="css/nav.css" />
    <style>
    .detail-container {
        max-width: 800px;
        margin: 16px auto 40px auto;
        padding: 22px 24px;
        border: 1px solid #ddd;
        display: flex;
        gap: 20px;
        background-color: rgb(230, 230, 230);
        border-radius: 10px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        color: black;
        align-items: flex-start;
    }

    .detail-container img {
        max-width: 300px;
        border-radius: 10px;
        box-shadow: 0 2px 12px rgba(0, 0, 0, 0.08);
    }

    .product-info {
        flex: 1;
    }

    .product-info h2 {
        margin-bottom: 10px;
    }

    .btn-cart {
        display: inline-block;
        padding: 10px 20px;
        border: none;
        text-decoration: none;
        font-weight: bold;
        border-radius: 5px;
        text-align: center;
        background-color: #2d08ff;
    }

    .btn-cart:hover:enabled {
        background-color: rgb(46, 0, 183);
    }

    .btn-cart:disabled {
        background-color: grey;
        cursor: not-allowed;
        pointer-events: none;
        opacity: 0.7;
    }

    .btn-cart:disabled:hover {
        background-color: grey;
        color: #fff;
    }
    </style>
</head>

<body>
    <section id="products" class="products">
        <h1>Detail Produk</h1>
        <div class="detail-container">
            <img src="./img/produk/<?= htmlspecialchars($produk['gambar']) ?>"
                alt="<?= htmlspecialchars($produk['nama']) ?>">

            <div class="product-info">
                <h2><?= htmlspecialchars($produk['nama']) ?></h2>
                <p>Jenis: <?= htmlspecialchars($produk['jenis']) ?></p>
                <p>Stok: <?= $produk['stok'] ?></p>
                <p>Harga: Rp<?= number_format($produk['harga'], 0, ',', '.') ?></p>
                <p>Hoodie keren, stok terbatas, dan harga terangkau!</p>
                <?php if ($produk['stok'] > 0): ?>
                <form action="page/tambah_keranjang.php" method="POST">
                    <input type="hidden" name="id_produk" value="<?= $produk['id_produk'] ?>">
                    <button type="submit" class="btn-cart">Beli Sekarang</button>
                </form>
                <?php else: ?>
                <button class="btn-cart" disabled>Stok Habis</button>
                <?php endif; ?>
            </div>
        </div>
    </section>
</body>
<script>
feather.replace();
</script>

</html>