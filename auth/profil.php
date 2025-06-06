<?php
session_start();
include '../database.php'; // koneksi ke database

if (!isset($_SESSION['id_user'])) {
  echo "<script>alert('Silakan login terlebih dahulu.'); window.location='login.php';</script>";
  exit;
}

$id_user = $_SESSION['id_user'];
$query = mysqli_query($conn, "SELECT * FROM users WHERE id_user = $id_user");
$user = mysqli_fetch_assoc($query);
?>
<link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">

<style>
body {
  background-image: url('../img/background.jpg');
  opacity: 0.9;
  background-size: cover;
  background-position: center;
  background-repeat: no-repeat;
  min-height: 100vh;
}
.profile-card {
  border-radius: 20px;
  background: #fff;
  box-shadow: 0 4px 24px rgba(0,0,0,0.08);
  padding: 2.5rem 2rem;
}
.profile-img {
  width: 140px;
  height: 140px;
  object-fit: cover;
  border-radius: 50%;
  border: 4px solid #f1f1f1;
  margin-bottom: 1rem;
}
.profile-info th {
  width: 140px;
  color: #6c757d;
  font-weight: 500;
}
.profile-info td {
  color: #212529;
}
@media (max-width: 767px) {
  .profile-card {
  padding: 1.5rem 0.5rem;
  }
  .profile-img {
  width: 100px;
  height: 100px;
  }
}
</style>

<div class="container mt-5">
  <div class="row justify-content-center">
    <div class="col-lg-6">
      <div class="profile-card d-flex flex-column align-items-center">
        <?php
        // Proses upload foto_profile profil
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['foto_profile'])) {
          $foto_profile = $_FILES['foto_profile'];
          $allowed = ['jpg', 'jpeg', 'png', 'gif'];
          $ext = strtolower(pathinfo($foto_profile['name'], PATHINFO_EXTENSION));
          if ($foto_profile['error'] === 0 && in_array($ext, $allowed) && $foto_profile['size'] <= 2 * 1024 * 1024) {
            $filename = 'profil_' . $id_user . '_' . time() . '.' . $ext;
            $target = '../img/' . $filename;
            if (move_uploaded_file($foto_profile['tmp_name'], $target)) {
              // Simpan nama file ke database
              mysqli_query($conn, "UPDATE users SET foto_profile='$filename' WHERE id_user=$id_user");
              $user['foto_profile'] = $filename;
            }
          }
        }

        // Ambil nama file foto_profile dari database jika ada
        $foto_profile_profil = !empty($user['foto_profile']) ? '../img/' . $user['foto_profile'] : '../img/profil.jpeg';
        ?>
        <img src="<?= htmlspecialchars($foto_profile_profil) ?>" alt="foto_profile Profil" class="profile-img shadow-sm mb-3">
        <form method="post" enctype="multipart/form-data" class="w-100 mb-3">
          <input type="file" name="foto_profile" accept="image/*" class="form-control form-control-sm mb-2">
          <button type="submit" class="btn btn-sm btn-outline-primary w-100">Upload foto_profile</button>
        </form>
        <h5 class="fw-bold mt-2 mb-1"><?= htmlspecialchars($user['nama']) ?></h5>
        <span class="badge bg-primary mb-3"><?= htmlspecialchars($user['email']) ?></span>
        <h4 class="mb-3 fw-semibold border-bottom pb-2 w-100 text-center">Informasi Akun</h4>
        <table class="table table-borderless profile-info mb-0 w-100">
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
        <div class="mt-4 d-flex gap-2 w-100 justify-content-center">
          <a href="logout.php" class="btn btn-danger px-4">Logout</a>
          <a href="../index.php" class="btn btn-secondary px-4">Kembali</a>
        </div>
      </div>
    </div>
  </div>
</div>
