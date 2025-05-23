<?php
session_start();
include './database.php';

if (!isset($_SESSION['id_user'])) {
    header("Location: ../auth/login.php");
    exit();
}

$id_user = $_SESSION['id_user'];

// Tambah jumlah
if (isset($_GET['add'])) {
    $id_produk = $_GET['add'];

    // Ambil stok dan jumlah saat ini
    $stmt = $conn->prepare("SELECT p.stok, k.jumlah 
        FROM produk p 
        JOIN keranjang k ON p.id_produk = k.id_produk
        WHERE k.id_user = ? AND k.id_produk = ?");
    $stmt->bind_param("ii", $id_user, $id_produk);
    $stmt->execute();
    $stmt->bind_result($stok, $jumlah);
    if ($stmt->fetch()) {
        if ($jumlah < $stok) {
            $stmt->close();
            $stmt = $conn->prepare("UPDATE keranjang SET jumlah = jumlah + 1 
                WHERE id_user = ? AND id_produk = ?");
            $stmt->bind_param("ii", $id_user, $id_produk);
            $stmt->execute();
        }
    }
    $stmt->close();
    header("Location: index.php?page=keranjang");
    exit();
}

// Kurangi jumlah
if (isset($_GET['remove'])) {
    $id_produk = $_GET['remove'];

    $stmt = $conn->prepare("SELECT jumlah FROM keranjang 
        WHERE id_user = ? AND id_produk = ?");
    $stmt->bind_param("ii", $id_user, $id_produk);
    $stmt->execute();
    $stmt->bind_result($jumlah);
    if ($stmt->fetch() && $jumlah > 1) {
        $stmt->close();
        $stmt = $conn->prepare("UPDATE keranjang SET jumlah = jumlah - 1 
            WHERE id_user = ? AND id_produk = ?");
        $stmt->bind_param("ii", $id_user, $id_produk);
        $stmt->execute();
    } elseif ($jumlah == 1) {
        $stmt->close();
        $stmt = $conn->prepare("DELETE FROM keranjang WHERE id_user = ? AND id_produk = ?");
        $stmt->bind_param("ii", $id_user, $id_produk);
        $stmt->execute();
    }
    $stmt->close();
    header("Location: index.php?page=keranjang");
    exit();
}

// Hapus langsung produk
if (isset($_GET['hapus'])) {
    $id_produk = $_GET['hapus'];
    $stmt = $conn->prepare("DELETE FROM keranjang WHERE id_user = ? AND id_produk = ?");
    $stmt->bind_param("ii", $id_user, $id_produk);
    $stmt->execute();
    $stmt->close();
    header("Location: index.php?page=keranjang");
    exit();
}

// Ambil isi keranjang
$sql = "SELECT k.id_keranjang, p.id_produk, p.nama, p.gambar, p.harga, p.stok, k.jumlah
        FROM keranjang k 
        JOIN produk p ON k.id_produk = p.id_produk
        WHERE k.id_user = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id_user);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keranjang Belanja</title>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,300;0,400;0,700;1,700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <!-- Tambahkan ini di dalam <head> sebelum </head> -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
    .cart-container {
        max-width: 800px;
        margin: auto;
        margin-top: 10px;
        padding: 20px;
    }

    .cart-item {
        display: flex;
        align-items: center;
        border: 1px solid #ddd;
        padding: 16px;
        margin-bottom: 16px;
        border-radius: 8px;
        background: #f9f9f9;
    }

    .cart-item img {
        width: 150px;
        height: 180px;
        border-radius: 8px;
        margin-right: 20px;
    }

    .cart-item h3 {
        margin: 0;
        font-size: 18px;
    }

    .cart-item .price {
        font-weight: bold;
    }

    .cart-actions {
        margin-left: auto;
        text-align: right;
    }

    .cart-actions a {
        display: inline-block;
        padding: 5px 10px;
        font-size: 14px;
        color: #fff;
        background-color: #007bff;
        border: none;
        border-radius: 5px;
        text-decoration: none;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    .cart-actions a:hover {
        background-color: #0056b3;
    }

    .cart-actions .btn-trash {
        background-color: #dc3545;
    }

    .cart-actions .btn-trash:hover {
        background-color: #a71d2a;
    }

    .checkout-btn {
        margin-top: 24px;
        padding: 12px 20px;
        background: #1a2adb;
        color: #fff;
        border: none;
        border-radius: 6px;
        cursor: pointer;
    }
    </style>
</head>

<body>
    <div class="cart-container">
        <h1>Keranjang Belanja</h1>
        <?php
        $grand_total = 0;
        if ($result->num_rows > 0) {
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
    <button class='btn btn-decrease'>-</button>
    <span style='margin: 0 10px; font-weight: bold;' class='quantity'>{$row['jumlah']}</span>
    <button class='btn btn-increase'>+</button>
    <button class='btn btn-trash btn-delete'>🗑</button>
</div>
</div>";
            }
            echo "<p><strong>Total: Rp" . number_format($grand_total, 0, ',', '.') . "</strong></p>";
            echo "<button class='checkout-btn' onclick=\"window.location.href='index.php?page=checkout.php'\">Check Out</button>";
        } else {
            echo "<p>Keranjang kosong.</p>";
        }
        ?>
    </div>
    <script>
    $(document).on('click', '.btn-increase', function() {
        console.log('Tambah diklik'); // Debugging log
        const id = $(this).closest('.cart-actions').data('id');
        console.log('ID:', id); // Debugging log
        updateCart('add', id);
    });

    $(document).on('click', '.btn-decrease', function() {
        console.log('Kurangi diklik'); // Debugging log
        const id = $(this).closest('.cart-actions').data('id');
        console.log('ID:', id); // Debugging log
        updateCart('remove', id);
    });

    $(document).on('click', '.btn-delete', function() {
        console.log('Hapus diklik'); // Debugging log
        const id = $(this).closest('.cart-actions').data('id');
        console.log('ID:', id); // Debugging log
        updateCart('hapus', id);
    });

    function updateCart(action, id) {
        $.post('page/keranjang_action.php', { // Perbaikan jalur file
            action: action,
            id: id
        }, function(response) {
            console.log('Respons:', response); // Debugging log
            $('.cart-container').html(response);
        }).fail(function(jqXHR, textStatus, errorThrown) {
            console.error('AJAX Error:', textStatus, errorThrown); // Debugging log
            alert('Terjadi kesalahan. Silakan coba lagi.');
        });
    }
    </script>

</body>

</html>