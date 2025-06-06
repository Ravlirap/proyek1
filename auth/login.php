<?php
session_start();
include '../database.php'; // koneksi ke database

// Proses login jika form disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $email = $_POST["email"];
  $password = $_POST["password"];

  $query = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");
  $user = mysqli_fetch_assoc($query);

  if ($user && password_verify($password, $user["password"])) {
    // Login sukses, simpan data user ke session
    $_SESSION["id_user"] = $user["id_user"];
    $_SESSION["nama"] = $user["nama"];
    $_SESSION['user'] = $username;
    header("Location: ../index.php?page=home");
    exit;
  } else {
    $error = "Email atau password salah!";
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login ScondTrf</title>
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
            animation: fadeIn 1.5s ease-in-out;
        }
        .btn-primary {
            background-color:rgb(56, 152, 255);
            border: none;
        }
        .btn-primary:hover {
            background-color:rgb(21, 0, 255);
        }
        .form-label {
            color: #333;
        }
        .form-control {
            border-radius: 20px;
            border: 1px solid #ccc;
        }
        .form-control:focus {
            border-color: #007bff;
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
        }
        .alert {
            border-radius: 20px;
        }
        .btn-secondary {
            background-color: #6c757d;
            border: none;
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
                <div class="card shadow p-4">
                    <h4 class="mb-4 text-center"><strong>Login ke ScondTrf</strong>!</h4>
                    <img src="../img/logo ahmet.png" alt="logo" class="img-fluid mb-3 rounded-circle" style="width: 100px; display: block; margin: auto;">
                    
                    <?php if (isset($error)): ?>
                        <div class="alert alert-danger"><?= $error ?></div>
                    <?php endif; ?>
                    
                    <form method="POST">
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" name="email" required>
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Kata Sandi</label>
                            <input type="password" class="form-control" name="password" required>
                        </div>

                        <button type="submit" class="btn btn-primary w-100">Login</button>
                    </form>

                    <div class="mt-3 text-center">
                        Belum punya akun? <a href="../auth/signup.php" class="text-primary">Daftar di sini</a>
                    </div>
                    <div class="mt-4 text-center mb-3 md-3">
                        <a href=" ../index.php?page=home" class="btn btn-secondary">Kembali ke Beranda</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="../bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>
