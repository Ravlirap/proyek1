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

    <style>
    .products {
        padding: 2rem;
        text-align: center;
        background-color: #f9f9f9;
    }

    .products h1 {
        font-size: 2.5rem;
        margin-bottom: 2rem;
        color: #333;
    }

    .product-container {
        display: flex;
        flex-wrap: wrap;
        gap: 2rem;
        justify-content: center;
    }

    .product-card {
        background: #fff;
        border: 1px solid #ddd;
        border-radius: 10px;
        width: 250px;
        overflow: hidden;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s, box-shadow 0.3s;
    }

    .product-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
    }

    .product-image img {
        width: 100%;
        height: 200px;
        object-fit: cover;
    }

    .product-info {
        padding: 1rem;
        text-align: left;
    }

    .product-info h3 {
        font-size: 1.5rem;
        margin-bottom: 0.5rem;
        color: #333;
    }

    .product-info p {
        font-size: 1rem;
        margin: 0.5rem 0;
        color: #555;
    }

    .product-info p span {
        font-weight: bold;
        color: #000;
    }

    .btn-cart {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 100%;
        background: #28a745;
        color: #fff;
        border: none;
        padding: 0.75rem;
        border-radius: 5px;
        cursor: pointer;
        transition: background 0.3s;
        margin-top: 1rem;
    }

    .btn-cart i {
        width: 20px;
        height: 20px;
    }

    .btn-cart:hover {
        background: #218838;
    }
    </style>
</head>

<body>
    <!-- Hero Section start -->
    <section class="hero" id="home">
        <div class="mask-container">
            <main class="content">
                <h1>Selamat Datang di <span>ScondTrf.</span></h1>
                <p>Temukan koleksi terbaik dengan harga terjangkau hanya di ScondTrf!</p>
                <a href="produk.php" class="btn-buy">Beli Sekarang!</a>
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
      include 'database.php';

      $sql = "SELECT nama, gambar, harga, stok, jenis FROM produk";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo '
          <div class="product-card">
            <div class="product-image">
               <img src="img/produk/' . $row["gambar"] . '" alt="' . $row["nama"] . '">
            </div>
            <div class="product-info">
                <h3>' . $row["nama"] . '</h3>
                <p>jenis: ' . $row["jenis"] . '</p>
                <p>Stok: ' . $row["stok"] . '</p>
                <p>Harga: Rp.' . $row["harga"] . '</p>
                <button class="btn-cart">Add to Cart</button>
            </div>
          </div>';
        }
    } else {
        echo "<p>No products available</p>";
    }
      ?>
        </div>
        <div>
        <a href="produk.php" class="btn-buy">Lihat Semua Produk</a>
        </div>
</section>
</body>
<!-- Feather Icons -->
<script> feather.replace();</script>
<!-- My Javascript -->
<script src="js/script.js"></script>
</html>