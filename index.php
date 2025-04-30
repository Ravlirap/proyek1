<?php
include "navigasi/header.php";

$page = isset($_GET['page']) ? $_GET['page'] : 'home';
switch ($page) {
    case 'home':
        include "home.php";
        break;
    case 'login':
        include "login.php";
        break;
    case 'produk':
        include "produk.php";
        break;
    case 'about':
        include "about.php";
        break;
    default:
        include "home.php";
        break;
}
include "navigasi/footer.php";
?>