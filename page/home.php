<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>ScondTrf.</title>

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
</head>

<body>
    <!-- Hero Section start -->
    <section class="hero" id="home">
        <div class="mask-container">
            <main class="content">
                <h1>Selamat Datang di <span>ScondTrf.</span></h1>
                <p>Temukan koleksi terbaik dengan harga terjangkau hanya di ScondTrf!</p>
                <a href="#products" class="btn-buy">Beli Sekarang!</a>
            </main>
        </div>
    </section>
    <!-- Hero Section end -->

    <!-- Merek Section -->
    <h1>Popular Brand</h1>
    <section id="merek" class="merek">
        <div class="merek-box">
            <img src="img/feltics.jpg" alt="feltics" />
            <h3>Feltics</h3>
        </div>
        <div class="merek-box">
            <img src="img/adidas.jpg" alt="adidas" />
            <h3>Adidas</h3>
        </div>
        <div class="merek-box">
            <img src="img/dickies.jpg" alt="dickiess" />
            <h3>Dickiess</h3>
        </div>
        <div class="merek-box">
            <img src="img/stone island.jpg" alt="stone island" />
            <h3>Stone Island</h3>
        </div>
        <div class="merek-box">
            <img src="img/carhart.png" alt="carhart" />
            <h3>Carhart</h3>
        </div>
        <!-- Merek Section end -->

        <!-- About Section -->
        <section id="about" class="about">
            <div class="row">
                <div class="about-img">
                    <img src="img/logo ahmet.png" alt="</div>ABOUT" />
                </div>
                <div class="content">
                    <h3>ABOUT STORE</h3>
                    <p>
                        Selamat datang di Scondtrf, tempat terbaik untuk menemukan pakaian vintage dan secondhand
                        berkualitas tinggi.
                        Kami menghadirkan koleksi eksklusif dari berbagai merek terkenal seperti Dickiess, Adidas,
                        Felticts, dan masih banyak lagi.
                    </p>
                    <br>
                    <p>
                        Thrift shop ini didirikan pada tahun 2021 oleh seorang mahasiswa bernama Ahmad
                        yang memiliki hobi dalam berbelanja pakaian vintage. Dengan semangat yang tinggi, Ahmad
                        memutuskan untuk membuka thrift shop ini agar orang-orang dapat menemukan pakaian vintage
                        berkualitas tinggi dengan harga terjangkau.
                    </p>
                </div>
            </div>
            <!-- About Section end -->

            <section id="products" class="products">
                <h1>Produk Kami</h1>
                <div class="product-container">
                    <?php
            include './database.php';

            $sql = "SELECT id_produk, nama, gambar, harga, stok, jenis FROM produk LIMIT 8";
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
                <div>
        <a href="index.php?page=produk" class="lihat-btn">Lihat Semua Produk</a>
        </div>
            </section>
            <script>
            document.addEventListener('DOMContentLoaded', function() {
                document.querySelector('.lihat-btn').addEventListener('click', function() {
                    localStorage.setItem('cart', JSON.stringify(cart));
                    window.location.href = 'produk.php';
                });
            });
            </script>
</section>
</body>
<!-- Feather Icons -->
<script> feather.replace();</script>
<!-- My Javascript -->
<script src="js/script.js"></script>
</html>