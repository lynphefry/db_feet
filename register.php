<?php
include 'db.php';
include 'auth.php';
include 'navbar.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $sql = "INSERT INTO members (first_name, email, password)
            VALUES ('$name', '$email', '$password')";

    mysqli_query($conn, $sql);

    echo "Registered successfully!";
}
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="assets\style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
</head>
<body>
  

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container">

    <a class="navbar-brand" href="index.php">Feet To Fit</a>

    <div class="ms-auto">

      <a class="btn btn-outline-light btn-sm" href="index.php">Home</a>
      <a class="btn btn-outline-light btn-sm" href="trainers.php">Trainers</a>
      <a class="btn btn-outline-light btn-sm" href="book_class.php">Classes</a>
      <a class="nav-link text-white" href="dashbord.php">Dashboard</a>

      <?php if (isLoggedIn()): ?>
        <a class="btn btn-warning btn-sm" href="account.php">Dashboard</a>
        <a class="btn btn-danger btn-sm" href="logout.php">Logout</a>
      <?php else: ?>
        <a class="btn btn-success btn-sm" href="login.php">Login</a>
      <?php endif; ?>

      <?php if (isLoggedIn() && isAdmin()): ?>
        <a class="btn btn-info btn-sm" href="admin.php">Admin</a>
      <?php endif; ?>

    </div>

  </div>
</nav>



<div class="container mt-5">

  <div class="row justify-content-center">

    <div class="col-md-6">

      <div class="card shadow p-4">

        <h3 class="text-center">Register</h3>

        

        <form method="POST">

    <div class="mb-3">
        <label class="form-label">Full Name</label>
        <input type="text"
               name="name"
               class="form-control"
               placeholder="Enter your name"
               required>
    </div>

    <div class="mb-3">
        <label class="form-label">Email</label>
        <input type="email"
               name="email"
               class="form-control"
               placeholder="Enter your email"
               required>
    </div>

    <div class="mb-3">
        <label class="form-label">Password</label>
        <input type="password"
               name="password"
               class="form-control"
               placeholder="Create password"
               required>
    </div>

    <button type="submit" class="btn btn-success w-100">
        Create Account
    </button>

</form>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>