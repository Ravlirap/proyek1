<?php
session_start();

// Koneksi ke database
$host = "localhost";
$user = "root";
$pass = ""; // sesuaikan dengan password MySQL Anda
$db = "login_db";

$conn = new mysqli($host, $user, $pass, $db);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Ambil data dari form
$username = $_POST['username'];
$password = md5($_POST['password']); // Gunakan hash MD5

// Cek ke database
$sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $_SESSION['username'] = $username;
    echo "Login berhasil! <a href='dashboard.php'>Masuk ke Dashboard</a>";
} else {
    echo "Login gagal! Username atau Password salah.";
}

$conn->close();
?>
