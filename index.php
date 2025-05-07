<?php
include "navigasi/header.php";

$page = isset($_GET['page']) ? $_GET['page'] : 'home';
switch ($page) {
    case 'home':
        include "page/home.php";
        break;
    case 'produk':
        include "page/produk.php";
        break;
    case 'about':
        include "page/about.php";
        break;
    case 'produk':
        include "page/produk.php";
        break;
    default:
        include "home.php";
        break;
}
include "navigasi/footer.php";
?>