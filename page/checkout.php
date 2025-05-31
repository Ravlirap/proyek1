<?php
session_start();
include './database.php';

if (!isset($_SESSION['id_user'])) {
    header("Location: ../auth/login.php");
    exit();
}

$id_user = $_SESSION['id_user'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $metode = $_POST['metode'];

    $sql = "SELECT * FROM keranjang WHERE id_user = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id_user);
    $stmt->execute();
    $result = $stmt->get_result();

    while ($item = $result->fetch_assoc()) {
        $id_produk = $item['id_produk'];
        $jumlah = $item['jumlah'];

        $insert = $conn->prepare("INSERT INTO pembelian (id_user, id_produk, jumlah_produk, metode_pembayaran, tanggal, status) VALUES (?, ?, ?, ?, NOW(), 'dipending')");
        $insert->bind_param("iiis", $id_user, $id_produk, $jumlah, $metode);
        $insert->execute();

        $updateStok = $conn->prepare("UPDATE produk SET stok = stok - ? WHERE id_produk = ?");
        $updateStok->bind_param("ii", $jumlah, $id_produk);
        $updateStok->execute();
    }

    $delete = $conn->prepare("DELETE FROM keranjang WHERE id_user = ?");
    $delete->bind_param("i", $id_user);
    $delete->execute();

    echo "<script>alert('Checkout berhasil!'); window.location.href='index.php?page=riwayat';</script>";
    exit();
}

// Ambil data keranjang untuk ditampilkan
$sql = "SELECT k.*, p.nama, p.harga, p.gambar FROM keranjang k JOIN produk p ON k.id_produk = p.id_produk WHERE k.id_user = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id_user);
$stmt->execute();
$result = $stmt->get_result();

// Ambil data user
$user_sql = "SELECT alamat FROM users WHERE id_user = ?";
$user_stmt = $conn->prepare($user_sql);
$user_stmt->bind_param("i", $id_user);
$user_stmt->execute();
$user_stmt->bind_result($alamat);
$user_stmt->fetch();
$user_stmt->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,300;0,400;0,700;1,700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="../css/style.css">
    <script src="https://unpkg.com/feather-icons"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
    .order-container {
        max-width: 900px;
        margin: 18px auto 40px auto;
        background: #ffff;
        border-radius: 12px;
        box-shadow: 0 2px 12px rgba(0, 0, 0, 0.08);
        padding: 32px 28px 32px 28px;
    }

    .order-container .alamat-box {
        margin-bottom: 24px;
        background: #f7f7f7;
        padding: 18px 28px;
        border-radius: 8px;
        border: 1px solid #eee;
        min-width: 320px;
        max-width: 901px;
        width: 100%;
        text-align: left;
        margin-left: auto;
        margin-right: auto;
    }

    .order-container .alamat-box strong {
        font-size: 1.1rem;
        color: #222;
    }

    .order-container .alamat-box span {
        font-size: 1.08rem;
        color: #444;
    }

    .order-detail-table {
        width: 100%;
        border-collapse: collapse;
        background: #fff;
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
    }

    .order-detail-table thead {
        background: #f2f2f2;
    }

    .order-detail-table th,
    .order-detail-table td {
        padding: 16px 10px;
        font-size: 1.05rem;
    }

    .order-detail-table th {
        text-align: left;
    }

    .order-detail-table td {
        vertical-align: middle;
    }

    .order-detail-table td img {
        width: 60px;
        height: 60px;
        object-fit: cover;
        border-radius: 7px;
        border: 1px solid #eee;
        margin-right: 10px;
    }

    .order-detail-total-row {
        background: #f9f9f9;
        font-weight: bold;
    }

    .order-detail-total-row td {
        color: #1a1aff;
    }

    .order-container .form-group {
        margin-top: 28px;
    }

    .order-container label[for=metode] {
        font-weight: 500;
        font-size: 1.05rem;
    }

    .order-container select[name=metode] {
        margin-left: 14px;
        padding: 7px 14px;
        border-radius: 4px;
        border: 1px solid #ccc;
        font-size: 1rem;
    }

    .order-container button[type=submit] {
        margin-top: 32px;
        padding: 13px 36px;
        background: #1a1aff;
        color: #fff;
        border: none;
        border-radius: 7px;
        font-size: 1.13rem;
        font-weight: 600;
        cursor: pointer;
        box-shadow: 0 2px 8px rgba(26, 26, 255, 0.08);
        transition: background 0.2s;
    }

    .order-container button[type=submit]:hover {
        background: #0d0dbb;
    }

    .h1-checkout {
        margin-top: 100px;
        text-align: center;
        color: black;
    }
    </style>
</head>

<body>
    <h1 class="h1-checkout">Checkout</h1>
    <div class=" order-container">
        <div class="alamat-box">
            <strong>Alamat Pengiriman:</strong><br>
            <span><?= htmlspecialchars($alamat) ?></span>
        </div>
        <form method="post">
            <table class="order-detail-table">
                <thead>
                    <tr>
                        <th style="text-align:center;">Produk</th>
                        <th style="text-align:right;">Harga</th>
                        <th style="text-align:center;">Jumlah</th>
                        <th style="text-align:right;">Total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $grand_total = 0;
                    while ($row = $result->fetch_assoc()) {
                        $total = $row['harga'] * $row['jumlah'];
                        $grand_total += $total;
                        echo "<tr style='border-bottom:1px solid #eee;'>
                            <td style='padding:14px 10px;'>
                                <div style=\"display:flex;align-items:center;gap:14px;\">
                                    <img src='../img/produk/{$row['gambar']}' alt='{$row['nama']}' style='width:60px;height:60px;object-fit:cover;border-radius:7px;border:1px solid #eee;'>
                                    <span style='font-weight:500;font-size:1.05rem;'>{$row['nama']}</span>
                                </div>
                            </td>
                            <td style='padding:14px 10px; text-align:right; font-size:1.04rem;'>Rp" . number_format($row['harga'], 0, ',', '.') . "</td>
                            <td style='padding:14px 10px; text-align:center; font-size:1.04rem;'>{$row['jumlah']}</td>
                            <td style='padding:14px 10px; text-align:right; font-size:1.04rem;'>Rp" . number_format($total, 0, ',', '.') . "</td>
                        </tr>";
                    }
                    ?>
                    <tr class="order-detail-total-row">
                        <td colspan="3" style="padding:16px; text-align:right; font-size:1.08rem;">Total</td>
                        <td style="padding:16px; text-align:right; font-size:1.08rem; color:#1a1aff;">
                            Rp<?= number_format($grand_total, 0, ',', '.') ?></td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <label for="metode">Metode Pembayaran:</label>
                <select name="metode" required>
                    <option value="Transfer Bank">Transfer Bank</option>
                    <option value="COD">Bayar di Tempat (COD)</option>
                    <option value="Dana">Dana</option>
                </select>
            </div>
            <button type="submit">Bayar Sekarang</button>
        </form>
    </div>
</body>
<script>
feather.replace();
// Konfirmasi sebelum submit form checkout
document.querySelector('form').addEventListener('submit', function(e) {
    e.preventDefault();

    Swal.fire({
        title: 'Konfirmasi Checkout',
        text: "Apakah Anda yakin ingin melakukan checkout sekarang?",
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#1a1aff',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, Checkout',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            e.target.submit();
        }
    });
});
</script>


</html>