<?php
$servername = "localhost"; // Change if your server is different
$username = "root"; // Default username for phpMyAdmin
$password = ""; // Default password for phpMyAdmin (leave empty if none)
$database = "proyek1"; // Replace with your database name
 
// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>