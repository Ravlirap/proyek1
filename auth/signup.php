<?php
session_start();
include '../database.php'; // koneksi database

// Proses saat form disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $nama = htmlspecialchars($_POST['nama']);
  $email = htmlspecialchars($_POST['email']);
  $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
  $telepon = htmlspecialchars($_POST['telepon']);
  $alamat = htmlspecialchars($_POST['alamat']);

  // Cek apakah email sudah terdaftar
  $cek = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");
  if (mysqli_num_rows($cek) > 0) {
    $error = "Email sudah terdaftar. Silakan gunakan email lain.";
  } else {
    // Simpan ke database
    $query = "INSERT INTO users (nama, email, password, telepon, alamat)
              VALUES ('$nama', '$email', '$password', '$telepon', '$alamat')";
    if (mysqli_query($conn, $query)) {
      echo "<script>alert('Pendaftaran berhasil! Silakan login.'); window.location='login.php';</script>";
      exit;
    } else {
      $error = "Gagal mendaftar. Silakan coba lagi.";
    }
  }
  // Setelah INSERT berhasil
$user_id = mysqli_insert_id($conn);
$_SESSION['user_id'] = $user_id;
$_SESSION['nama'] = $_POST['nama'];
header("Location:login.php");
exit;

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Daftar Akun Baru</title>
  <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css"> 
  <style>
    body {
      background-image: url('../img/background.jpg');
      opacity: 0.9;
      background-size: cover;
      background-position: center;
      background-repeat: no-repeat;
      color: #fff;
      font-family: Arial, sans-serif;
      height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
      animation: fadeIn 1s ease-in-out;
    }
    .card {
       background: linear-gradient(to bottom, rgba(255, 255, 255, 0.9), rgba(71, 70, 70, 0.9));
      border-radius: 25px;
      width: 100%; /* Adjust width */
      max-width: 500px; /* Set maximum width */
      padding: 20px; /* Add padding for better spacing */
      animation: fadeIn 1.5s ease-in-out;
    }
    .btn-success {
      background-color:rgb(56, 152, 255);
      border: none;
    }
    .btn-success:hover {
      background-color:rgb(21, 0, 255);
    }
    .form-label {
      color: #333;
    }
    .form-control {
      border-radius: 20px;
    }
    .form-control:focus {
      border-color: #007bff;
      box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
    }
    .alert {
      border-radius: 20px;
    }
    @keyframes fadeIn {
            from {
            opacity: 0;
            transform: translateY(-20px);
            }
            to {
            opacity: 1;
            transform: translateY(0);
            }
        }
  </style>
</head>
<body>
<div class="container">
  <div class="row justify-content-center">
      <div class="col-md-5">
        <div class="card shadow p-3">
          <h4 class="mb-2 text-center"><strong>Daftar ke ScondTrf</strong>!</h4>
          <img src="../img/logo ahmet.png" alt="logo" class="img-fluid rounded-circle" style="width: 100px; display: block; margin: auto;">
          
        <?php if (isset($error)): ?>
        <div class="alert alert-danger"><?= $error ?></div>
        <?php endif; ?>

    <form method="POST">
      <div class="mb-1">
      <label for="nama" class="form-label">Nama Lengkap</label>
      <input type="text" name="nama" class="form-control" required>
      </div>

      <div class="mb-1">
      <label for="email" class="form-label">Email</label>
      <input type="email" name="email" class="form-control" required>
      </div>

      <div class="mb-1">
      <label for="password" class="form-label">Kata Sandi</label>
      <input type="password" name="password" class="form-control" required>
      </div>

      <div class="mb-1">
      <label for="telepon" class="form-label">No. Telepon</label>
      <input type="text" name="telepon" class="form-control" required>
      </div>

      <div class="mb-1">
      <label for="alamat" class="form-label">Alamat</label>
      <textarea name="alamat" class="form-control" rows="3" required></textarea>
      </div>

      <button type="submit" class="btn btn-success w-100">Daftar Sekarang</button>
    </form>

    <div class="mt-1 text-center">
      Sudah punya akun? <a href="login.php">Login di sini</a>
    </div>                
        </div>
      </div>
    </div>
  </div>
  <script src="../bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>
