<?php
include '../../database.php';
$query = "SELECT * FROM produk ORDER BY id_produk ASC";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Produk</title>
    <link rel="stylesheet" href="../../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.11.3/font/bootstrap-icons.min.css">
    <style>
        .table-hover tbody tr:hover {
            background-color: #f1f3f5;
            transition: background 0.2s;
        }
        .produk-img {
            width: 70px;
            height: 70px;
            object-fit: cover;
            border-radius: 10px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
        }
        .table thead th {
            vertical-align: middle;
            text-align: center;
            font-weight: bold;
            background: #212529;
            color: #fff;
        }
        .btn-action {
            margin-right: 4px;
        }
        .search-box {
            max-width: 350px;
        }
    </style>
</head>

<body>
<nav class="navbar navbar-dark bg-dark fixed-top">
  <div class="container">
    <a class="navbar-brand" href="../admin_dashboard.php">
      <img src="../../img/logo ahmet.png" alt="Logo Ahmet" width="38" height="38" class="d-inline-block align-text-top rounded-circle border border-light">
      <strong>Admin Panel</strong>
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasDarkNavbar" aria-controls="offcanvasDarkNavbar" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="offcanvas offcanvas-end text-bg-dark" tabindex="-1" id="offcanvasDarkNavbar" aria-labelledby="offcanvasDarkNavbarLabel">
      <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvasDarkNavbarLabel">Menu</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
      </div>
      <div class="offcanvas-body">
        <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
            <li class="nav-item">
                <a class="nav-link" href="read.php"><i class="bi bi-box-seam"></i> Data Produk</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="../data_admin/read.php"><i class="bi bi-person-gear"></i> Data Admin</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="../user/read.php"><i class="bi bi-people"></i> Data Users</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#"><i class="bi bi-graph-up"></i> Traffic</a>
            </li>
        </ul>
        <form action="../logout.php" method="post" class="d-inline">
          <button type="submit" class="btn btn-danger btn-sm mt-3">Log Out</button>
        </form>
      </div>
    </div>
  </div>
</nav>

<div class="container mt-5 pt-5">
    <div class="card shadow-sm">
        <div class="card-header bg-dark text-white">
            <h3 class="mb-0 text-center">Daftar Produk</h3>
        </div>
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <form class="d-flex search-box" method="get">
                    <input class="form-control me-2" type="search" name="cari" placeholder="Cari produk..." aria-label="Search" value="<?= isset($_GET['cari']) ? htmlspecialchars($_GET['cari']) : '' ?>">
                    <button class="btn btn-outline-dark" type="submit"><i class="bi bi-search"></i></button>
                </form>
                <a href="create.php" class="btn btn-success"><i class="bi bi-plus-circle"></i> Tambah Produk</a>
            </div>
            <table class="table table-hover table-striped align-middle">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nama</th>
                        <th>Gambar</th>
                        <th>Harga</th>
                        <th>Stok</th>
                        <th>Jenis</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Filter pencarian
                    if (isset($_GET['cari']) && $_GET['cari'] !== '') {
                        $cari = mysqli_real_escape_string($conn, $_GET['cari']);
                        $query = "SELECT * FROM produk WHERE nama LIKE '%$cari%' OR jenis LIKE '%$cari%' ORDER BY id_produk ASC";
                        $result = mysqli_query($conn, $query);
                    }
                    while($row = mysqli_fetch_assoc($result)) { ?>
                    <tr>
                        <td class="text-center"><?= htmlspecialchars($row['id_produk']); ?></td>
                        <td><?= htmlspecialchars($row['nama']); ?></td>
                        <td class="text-center">
                            <img src="../../img/produk/<?= htmlspecialchars($row['gambar']); ?>" alt="Gambar Produk" class="produk-img">
                        </td>
                        <td>Rp <?= htmlspecialchars(number_format($row['harga'], 2, ',', '.')); ?></td>
                        <td>
                            <?php if ($row['stok'] > 0): ?>
                                <span class="badge bg-success"><?= htmlspecialchars($row['stok']); ?></span>
                            <?php else: ?>
                                <span class="badge bg-danger">Habis</span>
                            <?php endif; ?>
                        </td>
                        <td><?= htmlspecialchars($row['jenis']); ?></td>
                        <td class="text-center">
                            <a href="update.php?id_produk=<?= urlencode($row['id_produk']); ?>" class="btn btn-warning btn-sm btn-action" title="Edit"><i class="bi bi-pencil-square"></i></a>
                            <a href="delete.php?id_produk=<?= urlencode($row['id_produk']); ?>" class="btn btn-danger btn-sm btn-action" title="Delete" onclick="return confirm('Hapus data ini?')"><i class="bi bi-trash"></i></a>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<script src="../../bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>
