<?php
include './database.php';

if (!isset($_SESSION['id_user'])) {
    header("Location: auth/login.php");
    exit();
}

$id_user = $_SESSION['id_user'];

// Ambil riwayat pembelian dari tabel pembelian
$sql = "SELECT p.nama, p.gambar, b.jumlah_produk, b.metode_pembayaran, b.tanggal, b.status
        FROM pembelian b
        JOIN produk p ON b.id_produk = p.id_produk
        WHERE b.id_user = ?
        ORDER BY b.tanggal DESC";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id_user);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Pembelian</title>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,300;0,400;0,700;1,700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/nav.css">
    <script src="https://unpkg.com/feather-icons"></script>
    <style>
        .riwayat {
            padding: 40px 0;
            border-top: 1px solid #444;
        }

        .riwayat-container {
            max-width: 1100px;
            margin: 0 auto;
        }

        .riwayat-container h2 {
        text-align: center;
        margin-top: 0;
        margin-bottom: 28px;
        color: #2d08ff;
        font-size: 2rem;
        font-weight: 700;
        }

        .riwayat-table {
            width: 100%;
            border-collapse: collapse;
            background: #fff;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
            margin-bottom: 12px;
        }

        .riwayat-table th,
        .riwayat-table td {
            padding: 12px 10px;
            text-align: center;
            border-bottom: 1px solid #eee;
            font-size: 1rem;
            vertical-align: middle;
        }

        .riwayat-table th {
            background: #f2f2f2;
            color: #1a1aff;
            font-weight: 600;
        }

        .riwayat-table tr:last-child td {
            border-bottom: none;
        }

        .riwayat-table td {
            color: #1a1aff;
        }

        .riwayat-img {
            width: 50px;
            height: 50px;
            object-fit: cover;
            border-radius: 8px;
        }

        .riwayat-status {
            padding: 4px 8px;
            border-radius: 4px;
            color: #fff;
        }

        .riwayat-status.dipending {
        background: #fffbe6;
        color: #bfa100;
        }

        .riwayat-status.dibayar {
            background: #e6fff0;
            color: #009e4f;
        }

        .riwayat-status.selesai {
            background: rgb(230, 238, 255);
            color: rgb(105, 148, 196);
        }
        .riwayat-status.dibatalkan {
            background: #ffe6e6;
            color: #ff0000;
        }
    </style>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://unpkg.com/feather-icons"></script>
</head>

<body>
    <section id="riwayat" class="riwayat"></section>
    <h1>Riwayat Pembelian Anda</h1>
    <?php if ($result->num_rows == 0): ?>
    <p style="text-align:left; color:#1a1aff; margin-top:30px; margin-bottom:20px;">Belum ada
        riwayat pembelian.</p>
    <?php else: ?>
    <div class="riwayat-container">
        <table class="riwayat-table">
            <tr>
                <th>Produk</th>
                <th>Jumlah</th>
                <th>Metode Pembayaran</th>
                <th>Tanggal</th>
                <th>Status</th>
            </tr>
            <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td style="text-align: left;">
                    <div style="display: flex; align-items: center; gap: 12px;">
                        <img class="riwayat-img" src="img/produk/<?= htmlspecialchars($row['gambar']) ?>"
                            alt="<?= htmlspecialchars($row['nama']) ?>">
                        <span><?= htmlspecialchars($row['nama']) ?></span>
                    </div>
                </td>
                <td><?= $row['jumlah_produk'] ?></td>
                <td><?= $row['metode_pembayaran'] ?></td>
                <td><?= date('d-m-Y H:i', strtotime($row['tanggal'])) ?></td>
                <td>
                    <span class="riwayat-status <?= htmlspecialchars($row['status']) ?>">
                        <?= ucfirst($row['status']) ?>
                    </span>
                </td>
            </tr>
            <?php endwhile; ?>
        </table>
    </div>
    <?php endif; ?>
</body>
<script>
feather.replace();
</script>

</html>