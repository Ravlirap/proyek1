<?php
// filepath: c:\laragon\www\proyek1\admin\auth_admin\admin_login.php
session_start();
include '../../database.php';

$error = "";
$name = "";

function generate_csrf_token() {
    if (empty($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf_token'];
}

function verify_csrf_token($token) {
    return isset($_SESSION['csrf_token']) && hash_equals($_SESSION['csrf_token'], $token);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST["name"] ?? '');
    $password = $_POST["password"] ?? '';
    $csrf_token = $_POST['csrf_token'] ?? '';

    if (!verify_csrf_token($csrf_token)) {
        $error = "Invalid CSRF token!";
    } else {
        $stmt = $conn->prepare("SELECT id, name, password FROM admin WHERE name = ?");
        $stmt->bind_param("s", $name);
        $stmt->execute();
        $result = $stmt->get_result();
        $admin = $result->fetch_assoc();

        if ($admin && password_verify($password, $admin["password"])) {
            session_regenerate_id(true);
            $_SESSION["admin_id"] = $admin["id"];
            $_SESSION["admin_name"] = $admin["name"];
            header("Location: ../admin_dashboard.php");
            exit;
        } else {
            $error = "Nama atau password salah!";
        }
        $stmt->close();
    }
}
$csrf_token = generate_csrf_token();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - ScondTrf</title>
    <link rel="stylesheet" href="../../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.11.3/font/bootstrap-icons.min.css">
    <style>
        body {
            background-image: url('../../img/background.jpg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Poppins', Arial, sans-serif;
        }
        .login-card {
            border-radius: 20px;
            box-shadow: 0 8px 32px rgba(0,0,0,0.13);
            background: rgba(255,255,255,0.97);
            padding: 2.5rem 2rem 2rem 2rem;
            max-width: 400px;
            margin: 2rem auto;
        }
        .login-card h3 {
            font-weight: 700;
            color: #2575fc;
            letter-spacing: 1px;
        }
        .login-card .form-label {
            font-weight: 500;
            color: #333;
        }
        .login-card .form-control {
            border-radius: 12px;
        }
        .btn-primary {
            background-color:rgb(68, 112, 255);
            border: none;
            border-radius: 12px;
            font-weight: 600;
            letter-spacing: 1px;
        }
        .btn-primary:hover {
            background-color:rgb(8, 44, 163);
        }
        .login-logo {
            width: 70px;
            height: 70px;
            border-radius: 50%;
            margin-bottom: 1rem;
            box-shadow: 0 2px 12px rgba(0,0,0,0.10);
            display: block;
            margin-left: auto;
            margin-right: auto;
        }
        .login-title {
            font-size: 1.5rem;
            font-weight: 700;
            color: #222;
            margin-bottom: 0.5rem;
        }
        .login-subtitle {
            color: #888;
            font-size: 1rem;
            margin-bottom: 1.5rem;
        }
        .input-group-text {
            background: #f3f3f3;
            border-radius: 12px 0 0 12px;
        }
        .alert {
            font-size: 0.98rem;
        }
        @media (max-width: 500px) {
            .login-card { padding: 1.2rem 0.5rem; }
        }
    </style>
</head>
<body>
<div class="login-card">
    <img src="../../img/logo ahmet.png" alt="logo" class="login-logo">
    <div class="login-title text-center mb-1">Admin Login</div>
    <div class="login-subtitle text-center mb-3">ScondTrf Admin Panel</div>
    <?php if ($error): ?>
        <div class="alert alert-danger text-center"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>
    <form method="POST" autocomplete="off">
        <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($csrf_token) ?>">
        <div class="mb-3">
            <label class="form-label" for="name">Nama</label>
            <div class="input-group">
                <span class="input-group-text"><i class="bi bi-person-fill"></i></span>
                <input type="text" id="name" name="name" class="form-control" placeholder="Masukkan name" required value="<?= htmlspecialchars($name) ?>">
            </div>
        </div>
        <div class="mb-3">
            <label class="form-label" for="password">Password</label>
            <div class="input-group">
                <span class="input-group-text"><i class="bi bi-lock-fill"></i></span>
                <input type="password" id="password" name="password" class="form-control" placeholder="Masukkan password" required>
            </div>
        </div>
        <button type="submit" class="btn btn-primary w-100 mt-2">Login</button>
    </form>
</div>
<script src="../../bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>