<?php
// Include database connection
include '../../database.php';
$id = $_GET['id'];
$result = mysqli_query($conn, "SELECT * FROM admin WHERE id='$id'");
$data = mysqli_fetch_assoc($result);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    mysqli_query($conn, "UPDATE admin SET name='$name', password='$password',email='$email' WHERE id='$id'");
    header("location:read.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Admin</title>
    <link rel="stylesheet" href="../../bootstrap/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f4f6f9;
            font-family: Arial, sans-serif;
        }
        .container {
            max-width: 600px;
            background: #ffffff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin: 50px auto;
        }
        h2 {
            color: #333;
            font-weight: bold;
            text-align: center;
            margin-bottom: 20px;
        }
        .form-label {
            font-weight: bold;
            color: #555;
        }
        .form-control {
            border-radius: 5px;
            border: 1px solid #ddd;
        }
        .form-control:focus {
            border-color: #007bff;
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
        }
        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
            border-radius: 5px;
        }
        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #004085;
        }
        .btn-secondary {
            background-color: #6c757d;
            border-color: #6c757d;
            border-radius: 5px;
        }
        .btn-secondary:hover {
            background-color: #5a6268;
            border-color: #545b62;
        }
        .d-flex {
            gap: 10px;
        }
    </style>
</head>
<body>
<div class="container">
    <h2>Edit Data Admin</h2>
    <form method="POST">
        <div class="mb-3">
            <label for="name" class="form-label">name</label>
            <input type="text" id="name" name="name" class="form-control" value="<?php echo $data['name']; ?>" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" id="email" name="email" class="form-control" value="<?php echo $data['email']; ?>" required>
        </div>
        <div class="d-flex justify-content-between">
            <button type="submit" class="btn btn-primary">Update</button>
            <a href="read.php" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
</div>
<script src="../bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>
