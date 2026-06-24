<?php
include 'db.php';
include 'auth.php';
include 'navbar.php';
$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $email = $_POST['email'];
    $password = $_POST['password'];

    $result = mysqli_query($conn, "SELECT * FROM members WHERE email='$email'");
    $user = mysqli_fetch_assoc($result);

    if ($user && password_verify($password, $user['password'])) {

        
        loginUser(
            $user['id'],
            $user['email'],
            $user['first_name'],
            $user['role']
        );

        header("Location: account.php");
        exit;

    } else {
        $error = "Invalid email or password";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="assets\style.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  
</head>
<body>
  
  <div class="container vh-100 d-flex justify-content-center align-items-center">

    <div class="card shadow-lg p-4" style="width:450px;border-radius:20px;">

        <h2 class="text-center mb-4 fw-bold">
            FEET TO FIT
        </h2>

        <p class="text-center text-muted">
            Welcome Back
        </p>

        <form method="POST">

            <div class="mb-3">
                <label>Email</label>
                <input type="email"
                       name="email"
                       class="form-control"
                       required>
            </div>

            <div class="mb-3">
                <label>Password</label>
                <input type="password"
                       name="password"
                       class="form-control"
                       required>
            </div>
<div class="text-end mb-3">
    <a href="#" class="fw-bold text-success text-decoration-none">Forgot Password?</a>
</div>
            <button class="btn btn-success w-100">
                Login
            </button>

        </form>

    <p class="text-center mt-4">
    New to FEET TO FIT?
    <a href="register.php" class="fw-bold text-success text-decoration-none">
        Create Account
    </a>
</p>    

</div>


  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>