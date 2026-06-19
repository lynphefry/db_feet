<?php
include 'db.php';
include 'auth.php';

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
<html>
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/style.css">
</head>
<body> 
    
</body>
</html>

      <?php if (isLoggedIn()): ?>
        <a class="btn btn-warning btn-sm" href="account.php">Dashboard</a>
        <a class="btn btn-danger btn-sm" href="logout.php">Logout</a>
      <?php else: ?>
        <a class="btn btn-success btn-sm" href="login.php">Login</a>
      <?php endif; ?>
      <a class="btn btn-info btn-sm" href="register.php">Register</a>
      <a class="btn btn-info btn-sm" href="contact.php">Contact</a>
      
      

      <?php if (isLoggedIn() && isAdmin()): ?>
        <a class="btn btn-info btn-sm" href="admin.php">Admin</a>
      <?php endif; ?>

    </div>

  </div>
</nav>

<h2>Login</h2>

<div class="container mt-5">

  <div class="row justify-content-center">

    <div class="col-md-5">

      <div class="card shadow p-4">

        <h3 class="text-center mb-3">Login</h3>
  <?php if (!empty($error)) { ?>
            <div class="alert alert-danger">
                <?= $error ?>
            </div>
        <?php } ?>

        <form method="POST">

          <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control" required>
          </div>

          <div class="mb-3">
            <label>Password</label>
            <input type="password" name="password" class="form-control" required>
          </div>

          <button class="btn btn-success w-100">Login</button>

        </form>

      </div>

    </div>

  </div>

</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>