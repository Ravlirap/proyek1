<?php
include '../database.php';

// Contoh: Ambil jumlah data (ganti query sesuai kebutuhan)
$produk_count = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM produk"))['total'];
$admin_count = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM admin"))['total'];
$user_count = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM users"))['total'];
$traffic_count = 999; // Ganti dengan data traffic sebenarnya jika ada
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.11.3/font/bootstrap-icons.min.css">
    <style>
        body {
            background: linear-gradient(135deg, #e0eafc 0%, #cfdef3 100%);
            min-height: 100vh;
        }
        .navbar {
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
        }
        .dashboard-header {
            background: #fff;
            border-radius: 1rem;
            padding: 2rem 2rem 1rem 2rem;
            margin-bottom: 2rem;
            box-shadow: 0 2px 12px rgba(0,0,0,0.06);
            text-align: center;
        }
        .dashboard-header h2 {
            font-weight: 700;
            color: #2c3e50;
        }
        .card {
            border: none;
            border-radius: 1rem;
            box-shadow: 0 4px 24px rgba(0,0,0,0.07);
            transition: transform 0.2s, box-shadow 0.2s;
        }
        .card:hover {
            transform: translateY(-6px) scale(1.03);
            box-shadow: 0 8px 32px rgba(0,0,0,0.12);
        }
        .card-title {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 1.2rem;
        }
        .card-icon {
            font-size: 2.2rem;
        }
        .card-count {
            font-size: 2rem;
            font-weight: bold;
            margin-bottom: 0.5rem;
        }
        .chart-container {
            background: #fff;
            border-radius: 1rem;
            box-shadow: 0 2px 12px rgba(0,0,0,0.06);
            padding: 2rem;
            margin-top: 2rem;
        }
        @media (max-width: 767px) {
            .dashboard-header, .chart-container {
                padding: 1rem;
            }
        }
    </style>
</head>

<body>
<nav class="navbar navbar-dark bg-dark fixed-top">
  <div class="container">
    <a class="navbar-brand" href="#">
      <img src="../img/logo ahmet.png" alt="Logo Ahmet" width="38" height="38" class="d-inline-block align-text-top rounded-circle border border-light">
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
                <a class="nav-link" href="produk/read.php"><i class="bi bi-box-seam"></i> Data Produk</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="data_admin/read.php"><i class="bi bi-person-gear"></i> Data Admin</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="user/read.php"><i class="bi bi-people"></i> Data Users</a>
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

<div class="container" style="margin-top: 90px;">
    <div class="dashboard-header">
        <h2 class="mb-2">
            <i class="bi bi-house-door-fill text-primary me-2"></i>
            Selamat Datang, Admin!
        </h2>
        <p class="text-secondary mb-3 fs-5">
            Kelola <span class="fw-semibold text-primary">produk</span>, <span class="fw-semibold text-success">admin</span>, <span class="fw-semibold text-warning">user</span>, pantau <span class="fw-semibold text-info">traffic</span>, dan lihat <span class="fw-semibold text-danger">grafik penjualan</span> secara real-time.
        </p>
        <div class="d-flex justify-content-center gap-3 flex-wrap">
            <span class="badge bg-primary"><i class="bi bi-box-seam me-1"></i> Produk</span>
            <span class="badge bg-success"><i class="bi bi-person-gear me-1"></i> Admin</span>
            <span class="badge bg-warning text-dark"><i class="bi bi-people me-1"></i> Users</span>
            <span class="badge bg-info text-dark"><i class="bi bi-graph-up me-1"></i> Traffic</span>
            <span class="badge bg-danger"><i class="bi bi-bar-chart-line me-1"></i> Penjualan</span>
        </div>
    </div>
    <div class="row g-4">
        <!-- Card Data Produk -->
        <div class="col-md-3 col-sm-6">
            <div class="card text-bg-primary h-100">
                <div class="card-body text-center">
                    <div class="card-icon mb-2"><i class="bi bi-box-seam"></i></div>
                    <div class="card-count"><?= $produk_count ?></div>
                    <h5 class="card-title">Data Produk</h5>
                    <a href="produk/read.php" class="btn btn-light btn-sm mt-2">Lihat Produk</a>
                </div>
            </div>
        </div>
        <!-- Card Data Admin -->
        <div class="col-md-3 col-sm-6">
            <div class="card text-bg-success h-100">
                <div class="card-body text-center">
                    <div class="card-icon mb-2"><i class="bi bi-person-gear"></i></div>
                    <div class="card-count"><?= $admin_count ?></div>
                    <h5 class="card-title">Data Admin</h5>
                    <a href="data_admin/read.php" class="btn btn-light btn-sm mt-2">Lihat Admin</a>
                </div>
            </div>
        </div>
        <!-- Card Data Users -->
        <div class="col-md-3 col-sm-6">
            <div class="card text-bg-warning h-100">
                <div class="card-body text-center">
                    <div class="card-icon mb-2"><i class="bi bi-people"></i></div>
                    <div class="card-count"><?= $user_count ?></div>
                    <h5 class="card-title">Data Users</h5>
                    <a href="user/read.php" class="btn btn-light btn-sm mt-2">Lihat Users</a>
                </div>
            </div>
        </div>
        <!-- Card Traffic -->
        <div class="col-md-3 col-sm-6">
            <div class="card text-bg-info h-100">
                <div class="card-body text-center">
                    <div class="card-icon mb-2"><i class="bi bi-graph-up"></i></div>
                    <div class="card-count"><?= $traffic_count ?></div>
                    <h5 class="card-title">Traffic</h5>
                    <a href="#" class="btn btn-light btn-sm mt-2 disabled">Lihat Traffic</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Grafik Penjualan -->
    <div class="chart-container mt-5">
        <h4 class="mb-4 text-center">Grafik Penjualan Bulanan</h4>
        <canvas id="salesChart" height="100"></canvas>
    </div>
</div>
<script src="../bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Fake sales data for 12 months
    const salesData = {
        labels: [
            'Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 
            'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'
        ],
        datasets: [{
            label: 'Penjualan',
            data: [120, 150, 180, 140, 200, 170, 220, 210, 190, 230, 250, 270],
            backgroundColor: 'rgba(54, 162, 235, 0.2)',
            borderColor: '#36a2eb',
            borderWidth: 3,
            tension: 0.4,
            fill: true,
            pointBackgroundColor: '#36a2eb'
        }]
    };

    const config = {
        type: 'line',
        data: salesData,
        options: {
            responsive: true,
            plugins: {
                legend: { display: false }
            },
            scales: {
                y: { beginAtZero: true }
            }
        }
    };

    new Chart(document.getElementById('salesChart'), config);
</script>
</body>
</html>