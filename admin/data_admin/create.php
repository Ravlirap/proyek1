<?php
// Include database connection file
include '../../database.php';

// Initialize variables
$name = $email = $password = "";
$name_err = $email_err = $password_err = "";

// Process form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate name
    if (empty(trim($_POST["name"]))) {
        $name_err = "Please enter a name.";
    } else {
        $name = trim($_POST["name"]);
    }

    // Validate email
    if (empty(trim($_POST["email"]))) {
        $email_err = "Please enter an email.";
    } elseif (!filter_var(trim($_POST["email"]), FILTER_VALIDATE_EMAIL)) {
        $email_err = "Invalid email format.";
    } else {
        $email = trim($_POST["email"]);
    }

    // Validate password
    if (empty(trim($_POST["password"]))) {
        $password_err = "Please enter a password.";
    } elseif (strlen(trim($_POST["password"])) < 6) {
        $password_err = "Password must have at least 6 characters.";
    } else {
        $password = password_hash(trim($_POST["password"]), PASSWORD_DEFAULT);
    }

    // Check for errors before inserting into database
    if (empty($name_err) && empty($email_err) && empty($password_err)) {
        $sql = "INSERT INTO admin (name, email, password) VALUES (?, ?, ?)";

        if ($stmt = $conn->prepare($sql)) {
            $stmt->bind_param("sss", $param_name, $param_email, $param_password);

            $param_name = $name;
            $param_email = $email;
            $param_password = $password;

            if ($stmt->execute()) {
                header("location: read.php");
                exit();
            } else {
                echo "Something went wrong. Please try again later.";
            }

            $stmt->close();
        }
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2 class="mb-4">Create Admin</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="mb-3">
                <label class="form-label">Name</label>
                <input type="text" name="name" class="form-control <?php echo (!empty($name_err)) ? 'is-invalid' : ''; ?>" value="<?php echo htmlspecialchars($name); ?>" required>
                <div class="invalid-feedback">
                    <?php echo $name_err; ?>
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control <?php echo (!empty($email_err)) ? 'is-invalid' : ''; ?>" value="<?php echo htmlspecialchars($email); ?>" required>
                <div class="invalid-feedback">
                    <?php echo $email_err; ?>
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label">Password</label>
                <input type="password" name="password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>" required>
                <div class="invalid-feedback">
                    <?php echo $password_err; ?>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
            <a href="read.php" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>