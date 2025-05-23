<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produk</title>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,300;0,400;0,700;1,700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/nav.css">

</head>

<body>
    
    <section id="products" class="products">
        <h1>Produk Kami</h1>
        <div class="product-container">
            <?php
            include './database.php';

            $sql = "SELECT id_produk, nama, gambar, harga, stok, jenis FROM produk";
            $result = $conn->query($sql);

            while ($row = $result->fetch_assoc()) {
                echo '
                <div class="product-card">
                    <div class="product-image">
                        <a href="index.php?page=detail&id_produk=' . $row["id_produk"] . '">
                            <img src="img/produk/' . $row["gambar"] . '" alt="' . $row["nama"] . '">
                        </a>
                    </div>
                    <div class="product-info">
                        <h3>' . $row["nama"] . '</h3>
                        <p>Jenis: ' . $row["jenis"] . '</p>
                        <p>Stok: ' . $row["stok"] . '</p>
                        <p>Harga: Rp' . number_format($row["harga"], 0, ',', '.') . '</p>';

                if ($row["stok"] > 0) {
                    echo '
                        <form action="page/tambah_keranjang.php" method="POST">
                            <input type="hidden" name="id_produk" value="' . $row["id_produk"] . '">
                            <button type="submit" class="btn-cart">Beli</button>
                        </form>';
                } else {
                    echo '<button class="btn-cart sold-out" disabled>Sold Out</button>';
                }

                echo '
                    </div>
                </div>';
            }
            ?>
        </div>
    </section>
</body>

</html>