<?php
session_start();
include '../database.php'; // koneksi ke database

if (!isset($_SESSION['user_id'])) {
    echo "<script>alert('Silakan login terlebih dahulu.'); window.location='index.php?halaman=login';</script>";
    exit;
}

$user_id = $_SESSION['user_id'];
$query = mysqli_query($conn, "SELECT * FROM users WHERE id = $user_id");
$user = mysqli_fetch_assoc($query);
?>

<div class="container mt-5 mb-5">
  <div class="card shadow p-4">
    <div class="row">
      <div class="col-md-4 text-center">
        <img src="img/profil.jpeg" alt="Foto Profil" class="img-fluid rounded-circle mb-3" style="width: 150px;">
        <h5 class="fw-bold"><?= htmlspecialchars($user['nama']) ?></h5>
        <p class="text-muted"><?= htmlspecialchars($user['email']) ?></p>
      </div>
      <div class="col-md-8">
        <h4 class="mb-3">Informasi Akun</h4>
        <table class="table table-borderless">
          <tr>
            <th>Nama Lengkap</th>
            <td>: <?= htmlspecialchars($user['nama']) ?></td>
          </tr>
          <tr>
            <th>Email</th>
            <td>: <?= htmlspecialchars($user['email']) ?></td>
          </tr>
          <tr>
            <th>No. Telepon</th>
            <td>: <?= htmlspecialchars($user['telepon']) ?></td>
          </tr>
          <tr>
            <th>Alamat</th>
            <td>: <?= nl2br(htmlspecialchars($user['alamat'])) ?></td>
          </tr>
        </table>
        <a href="logout.php" class="btn btn-danger mt-3 ms-2">Logout</a>
      </div>
    </div>
  </div>
</div>
