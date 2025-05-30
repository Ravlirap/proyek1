<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ScondTrf.</title>
    <link rel="stylesheet" href="../css/nav.css">
    
</head>
<body>
<nav class="navbar">
      <a href="#" class="navbar-logo">
        <img src="img/logo ahmet.png" class="logo" />
        Scond<span>trf</span>.
      </a>

      <div class="navbar-nav">
        <a href="index.php?page=home">Home</a>
        <a href="index.php?page=produk">Produk</a>
        <a href="index.php?page=about">About Store</a>
        <?php if (!isset($_SESSION['user'])): ?>
                <a href="auth/login.php" class="text-white me-3">Login</a>
                <a href="../auth/signup.php" class="text-white">Sign Up</a>
        <?php endif; ?>
      </div>

      <div class="navbar-extra">
        <a href="#" id="search-button"><i data-feather="search"></i></a>
        <a href="index.php?page=keranjang" id="shopping-cart-button"><i data-feather="shopping-cart"></i></a>
        <a href="../auth/profil.php" id="user-button"><i data-feather="user"></i></a>
        <a href="#" id="hamburger-menu"><i data-feather="menu"></i></a>
        
      </div>

    </nav>
</body>
</html>