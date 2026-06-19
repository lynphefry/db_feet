<?php
include 'db.php';
include 'auth.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Trainers | FEET TO FIT</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">

        <a class="navbar-brand" href="index.php">FEET TO FIT</a>

        <div class="navbar-nav ms-auto">

            <a class="nav-link" href="index.php">Home</a>
            <a class="nav-link active" href="trainers.php">Trainers</a>
            <a class="nav-link" href="classes.php">Classes</a>
            <a class="nav-link" href="schedule.php">Schedule</a>
            <a class="nav-link" href="membership.php">Membership</a>
            <a class="nav-link" href="shop.php">Shop</a>
            <a class="nav-link" href="contact.php">Contact</a>

            <?php if (isLoggedIn()) : ?>
                <a class="nav-link" href="booking.php">Bookings</a>
                <a class="nav-link" href="account.php">Account</a>

                <?php if (isAdmin()) : ?>
                    <a class="nav-link text-warning" href="admin.php">Admin</a>
                    <a class="nav-link text-warning" href="add_trainer.php">Add Trainer</a>
                <?php endif; ?>

                <a class="nav-link text-danger" href="logout.php">Logout</a>

            <?php else : ?>
                <a class="nav-link text-success" href="login.php">Login</a>
                <a class="nav-link text-info" href="register.php">Register</a>
            <?php endif; ?>

        </div>

    </div>
</nav>

<!-- PAGE HEADER -->
<div class="container mt-5">

    <h2 class="text-center fw-bold">Our Trainers</h2>

    <p class="text-center text-muted mb-5">
        Meet our professional fitness trainers
    </p>

    <div class="row g-4">

        <?php

        $result = mysqli_query($conn, "SELECT * FROM trainers");

        if ($result && mysqli_num_rows($result) > 0) {

            while ($t = mysqli_fetch_assoc($result)) {

                $imgFile = "assets/images/default.jpg";

                if (!empty($t['image'])) {

                    $possibleImage = "assets/images/" . $t['image'];

                    if (file_exists($possibleImage)) {
                        $imgFile = $possibleImage;
                    }
                }
        ?>

        <div class="col-md-4">

            <div class="card shadow h-100">

                <img
                    src="<?= htmlspecialchars($imgFile) ?>"
                    class="card-img-top"
                    style="height:280px; width:100%; object-fit:cover;"
                    alt="<?= htmlspecialchars($t['name']) ?>">

               <div class="card-body text-center">

    <h4>
        <?= htmlspecialchars($t['name'] ?? 'Trainer') ?>
    </h4>

    <?php if (isset($t['specialization'])) : ?>
        <p class="text-muted">
            <?= htmlspecialchars($t['specialization']) ?>
        </p>
    <?php endif; ?>

    <?php if (isset($t['phone'])) : ?>
        <p>
            📞 <?= htmlspecialchars($t['phone']) ?>
        </p>
    <?php endif; ?>

</div>
        <?php
            }

        } else {
        ?>

            <div class="col-12 text-center">

                <div class="alert alert-warning">

                    <h4>No Trainers Found</h4>

                    <p>
                        Add trainers from the admin panel.
                    </p>

                </div>

            </div>

        <?php
        }
        ?>

    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>