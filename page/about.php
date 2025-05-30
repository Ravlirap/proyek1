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
    <script src="https://unpkg.com/feather-icons"></script>
</head>
<style>
body {
    font-family: 'Poppins', Arial, sans-serif;
    background: #f8f9fa;
    margin: 0;
    padding: 0;
    color: #222;
}

.about-store {
    max-width: 900px;
    margin: 40px auto;
    background: #fff;
    border-radius: 16px;
    box-shadow: 0 4px 24px rgba(0,0,0,0.07);
    padding: 40px 32px;
}

.about-store h1 {
    font-size: 2.2rem;
    font-weight: 700;
    margin-bottom: 24px;
    color: #2d3a4b;
    text-align: center;
}

.about-content {
    display: flex;
    flex-wrap: wrap;
    gap: 32px;
    align-items: flex-start;
    margin-bottom: 32px;
}

.about-info {
    flex: 1 1 300px;
}

.about-info p {
    font-size: 1.05rem;
    margin-bottom: 18px;
    line-height: 1.7;
}

.about-info ul {
    list-style: none;
    padding: 0;
    margin: 0;
}

.about-info li {
    margin-bottom: 8px;
    font-size: 1rem;
}

.about-image {
    flex: 0 0 320px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.about-image img {
    width: 100%;
    max-width: 300px;
    border-radius: 10px;
    box-shadow: 0 2px 12px rgba(0,0,0,0.08);
}

.about-social {
    margin: 32px 0 24px 0;
    text-align: center;
}

.about-social h2 {
    font-size: 1.3rem;
    margin-bottom: 14px;
    color: #2d3a4b;
}

.about-social a {
    display: inline-block;
    margin: 0 12px 8px 0;
    color: #4267b2;
    text-decoration: none;
    font-size: 1.05rem;
    transition: color 0.2s;
    vertical-align: middle;
}

.about-social a i {
    margin-right: 6px;
    vertical-align: middle;
}

.about-social a:hover {
    color: #e1306c;
}

.about-faq {
    margin-top: 32px;
}

.about-faq h2 {
    font-size: 1.2rem;
    margin-bottom: 16px;
    color: #2d3a4b;
}

.faq-item {
    margin-bottom: 18px;
    background: #f1f3f6;
    border-radius: 8px;
    padding: 16px 18px;
}

.faq-item h3 {
    font-size: 1.05rem;
    margin: 0 0 6px 0;
    color: #1a2233;
}

.faq-item p {
    margin: 0;
    font-size: 0.98rem;
    color: #444;
}

@media (max-width: 800px) {
    .about-content {
        flex-direction: column;
        gap: 20px;
    }
    .about-store {
        padding: 24px 8px;
    }
    .about-image {
        justify-content: flex-start;
    }
}
</style>
<body>
    <section id="about" class="about-store">
        <h1>Tentang Toko Kami</h1>
        <div class="about-content">
            <div class="about-info">
                <p>
                    Selamat datang di <strong>Proyek1 Store</strong>! Kami adalah toko online yang menyediakan berbagai produk berkualitas dengan harga terjangkau. Kepuasan pelanggan adalah prioritas utama kami. Kami selalu berusaha memberikan pelayanan terbaik dan produk-produk terbaru untuk memenuhi kebutuhan Anda.
                </p>
                <ul>
                    <li><strong>Alamat:</strong> Jl. Contoh No.123, Jakarta</li>
                    <li><strong>Email:</strong> info@proyek1store.com</li>
                    <li><strong>Telepon:</strong> 0812-3456-7890</li>
                </ul>
            </div>
            <div class="about-image">
                <img src="img/about-store.jpg" alt="Tentang Toko" style="max-width: 300px; border-radius: 10px;">
            </div>
        </div>
        <div class="about-social">
            <h2>Ikuti Kami</h2>
            <a href="https://instagram.com/proyek1store" target="_blank"><i data-feather="instagram"></i> Instagram</a>
            <a href="https://facebook.com/proyek1store" target="_blank"><i data-feather="facebook"></i> Facebook</a>
            <a href="https://wa.me/6281234567890" target="_blank"><i data-feather="message-circle"></i> WhatsApp</a>
        </div>
        <div class="about-faq">
            <h2>Pertanyaan Umum</h2>
            <div class="faq-item">
                <h3>Bagaimana cara memesan produk?</h3>
                <p>Anda dapat memilih produk yang diinginkan dan klik tombol "Beli". Setelah itu, ikuti instruksi untuk menyelesaikan pesanan.</p>
            </div>
            <div class="faq-item">
                <h3>Apakah produk bisa dikirim ke seluruh Indonesia?</h3>
                <p>Ya, kami melayani pengiriman ke seluruh wilayah Indonesia.</p>
            </div>
            <div class="faq-item">
                <h3>Bagaimana cara menghubungi customer service?</h3>
                <p>Anda dapat menghubungi kami melalui WhatsApp, email, atau media sosial yang tertera di atas.</p>
            </div>
        </div>
    </section>
</body>
<!-- Feather Icons -->
<script> feather.replace();</script>
</html>