<?php
include "navigasi/header.php";
?>

<div class="content">
    <?php
    $page = isset($_GET['page']) ? $_GET['page'] : 'home';
    switch ($page) {
        case 'home':
            include "page/home.php";
            break;
        case 'produk':
            include "page/produk.php";
            break;
        case 'detail':
            include "page/detail.php";
            break;
        case 'keranjang':
            include "page/keranjang.php";
            break;
        case 'about':
            include "page/about.php";
            break;
        case 'riwayat':
            include "page/riwayat.php";
            break;
        case 'login':
            include "auth/login.php";
            break;
        case 'signup':
            include "auth/signup.php";
            break;
        case 'profil':
            include "auth/profil.php";
            break;
        case 'checkout':
            include "page/checkout.php";
            break;
        case 'dickiess':
            include "page/brand/dickiess.php";
            break;
        case 'feltics';
            include "page/brand/feltics.php";
            break;
        case 'adidas';
            include "page/brand/adidas.php";
            break;
        case 'stone';
            include "page/brand/stone.php";
            break;
        case 'carhart';
            include "page/brand/carhart.php";
            break;
        default:
            include "page/home.php";
            break;
    }
    ?>
</div>
<?php
include "navigasi/footer.php";
?>