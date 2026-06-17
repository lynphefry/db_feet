<?php
include 'auth.php';

if (!isLoggedIn()) {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">

    <div class="card shadow p-4">

        <h2>Welcome, <?= $_SESSION['user_name']; ?></h2>

        <p>Email: <?= $_SESSION['user_email']; ?></p>

        <hr>

        <h4>Quick Actions</h4>

        <a href="book_class.php" class="btn btn-primary">Book Class</a>
        <a href="trainers.php" class="btn btn-secondary">View Trainers</a>

        <?php if (isAdmin()) { ?>
            <a href="admin.php" class="btn btn-warning">Admin Panel</a>
            <a href="add_trainer.php" class="btn btn-success">Add Trainer</a>
            <a href="bookings.php" class="btn btn-info">View Bookings</a>
        <?php } ?>

    </div>

</div>

</body>
</html>