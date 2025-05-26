<?php
include '../../database.php';

$query = "SELECT id, name, email FROM admin ORDER BY id ASC";
$result = mysqli_query($conn, $query);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Produk</title>
    <link rel="stylesheet" href="../../bootstrap/css/bootstrap.min.css">
</head>

<body>
<nav class="navbar navbar-dark bg-dark fixed-top">
  <div class="container">
    <a class="navbar-brand" href="#">
    <img src="../../img/logo ahmet.png" alt="Logo Ahmet" width="38" height="38" class="d-inline-block align-text-top rounded-circle border border-light">
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
                <a class="nav-link active" aria-current="page" href="../produk/read.php">Data Produk</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Data Admin</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="../user/read.php">Data Users</a>
            </li>
        </ul>
        <form action="../logout.php" method="post" class="d-inline">
        <button type="submit" class="btn btn-danger btn-sm">Log Out</button>
        </form>
        </li>
      </div>
    </div>
  </div>
</nav>

<div class="container mt-5 pt-5">
    <div class="card shadow-sm">
        <div class="card-header bg-dark text-white">
            <h3 class="mb-0 text-center">Daftar Admin</h3>
        </div>
        <div class="card-body ">
            <table class="table table-hover table-striped">
            <thead>
      <tr>
        <th>ID</th>
        <th>Nama</th>
        <th>Email</th>
        <th class="text-center">Aksi</th>
      </tr>
    </thead>
    <tbody>
      <?php while ($row = mysqli_fetch_assoc($result)) { ?>
      <tr>
        <td><?= htmlspecialchars($row['id']); ?></td>
        <td><?= htmlspecialchars($row['name']); ?></td>
        <td><?= htmlspecialchars($row['email']); ?></td>
        <td class="text-center">
          <a href="update.php?id=<?= $row['id']; ?>" class="btn btn-warning btn-sm">Edit</a>
          <a href="delete.php?id=<?= $row['id']; ?>" class="btn btn-danger btn-sm">Delete</a>
        </td> 
      <?php } ?>
    </tbody>
    </table>
  </div>
  <div class="card-footer text-center">
    <a href="create.php" class="btn btn-primary">Tambah Admin</a>
  </div>
  </div>
</body>
<script src="../../bootstrap/js/bootstrap.bundle.min.js"></script>
</html>
