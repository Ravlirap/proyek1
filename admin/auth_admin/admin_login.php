<?php
// filepath: c:\laragon\www\proyek1\admin\auth_admin\admin_login.php
session_start();
include '../../database.php';

$error = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $password = $_POST["password"];

    $query = mysqli_query($conn, "SELECT * FROM admin WHERE name='$name'");
    $admin = mysqli_fetch_assoc($query);

    if ($admin && password_verify($password, $admin["password"])) {
        $_SESSION["admin_id"] = $admin["id"];
        $_SESSION["admin_nama"] = $admin["nama"];
        header("Location: ../admin_dashboard.php");
        exit;
    } else {
        $error = "name atau password salah!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - ScondTrf</title>
    <link rel="stylesheet" href="../../bootstrap/css/bootstrap.min.css">
    <style>
        body {
            background: linear-gradient(120deg, #6a11cb 0%, #2575fc 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .card {
            border-radius: 16px;
            box-shadow: 0 6px 24px rgba(0,0,0,0.10);
        }
        .form-label {
            font-weight: 500;
        }
        .btn-primary {
            background-color: #6a11cb;
            border: none;
        }
        .btn-primary:hover {
            background-color: #2575fc;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card p-4">
                <h3 class="text-center mb-3">Admin Login</h3>
                <img src="../../img/logo ahmet.png" alt="logo" class="img-fluid rounded-circle mb-3" style="width: 80px; display: block; margin: auto;">
                <?php if ($error): ?>
                    <div class="alert alert-danger text-center"><?= $error ?></div>
                <?php endif; ?>
                <form method="POST">
                    <div class="mb-3">
                        <label class="form-label">name</label>
                        <input type="text" name="name" class="form-control" placeholder="Masukkan name" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" placeholder="Masukkan password" required>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Login</button>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="../../bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>