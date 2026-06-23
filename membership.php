<?php
include 'db.php';
include 'auth.php';

$message = "";


if (isset($_GET['plan'])) {

    if (!isLoggedIn()) {
        die("Please login first.");
    }

    $plan = $_GET['plan'];
    $user_id = $_SESSION['user_id'];

    
    $stmt = $conn->prepare("INSERT INTO memberships (user_id, plan) VALUES (?, ?)");
    $stmt->bind_param("is", $user_id, $plan);
    $stmt->execute();

    $message = "You joined the " . htmlspecialchars($plan) . " plan successfully!";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Membership | FEET TO FIT</title>

    <link rel="stylesheet" href="assets/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">

        <a class="navbar-brand" href="index.php">FEET TO FIT</a>

        <div class="navbar-nav ms-auto">

            <a class="nav-link text-white" href="index.php">Home</a>
            <a class="nav-link text-white" href="trainers.php">Trainers</a>
            <a class="nav-link text-white" href="classes.php">Classes</a>
            <a class="nav-link text-white" href="schedule.php">Schedule</a>
            <a class="nav-link text-white" href="membership.php">Membership</a>
            <a class="nav-link text-white" href="shop.php">Shop</a>
            <a class="nav-link text-white" href="contact.php">Contact</a>

            <?php if (isLoggedIn()) : ?>
                <a class="nav-link text-danger" href="logout.php">Logout</a>
            <?php else : ?>
                <a class="nav-link text-success" href="login.php">Login</a>
            <?php endif; ?>

        </div>

    </div>
</nav>

<!-- CONTENT -->
<div class="container mt-5">

    <h2 class="text-center fw-bold mb-4">Membership Plans</h2>

    <p class="text-center text-muted mb-4">
        Choose the plan that fits your fitness journey
    </p>

    <!-- SUCCESS MESSAGE -->
    <?php if (!empty($message)) : ?>
        <div class="alert alert-success text-center">
            <?= $message ?>
        </div>
    <?php endif; ?>

    <div class="row g-4">

        <!-- BASIC -->
        <div class="col-md-4">
            <div class="card shadow h-100 text-center">

                <div class="card-header bg-info text-white">
                    BASIC
                </div>

                <div class="card-body">
                    <h3>Ksh 2,000</h3>
                    <p>Gym access only</p>
                </div>

                <div class="card-footer">
                    <a href="membership.php?plan=basic" class="btn btn-info w-100">
                        Join Now
                    </a>
                </div>

            </div>
        </div>

        <!-- PREMIUM -->
        <div class="col-md-4">
            <div class="card shadow h-100 text-center">

                <div class="card-header bg-info text-white">
                    PREMIUM
                </div>

                <div class="card-body">
                    <h3>Ksh 5,000</h3>
                    <p>Gym + Trainer</p>
                </div>

                <div class="card-footer">
                    <a href="membership.php?plan=premium" class="btn btn-info w-100">
                        Join Now
                    </a>
                </div>

            </div>
        </div>

        <!-- VIP -->
        <div class="col-md-4">
            <div class="card shadow h-100 text-center">

                <div class="card-header bg-info text-dark">
                    VIP
                </div>

                <div class="card-body">
                    <h3>Ksh 8,000</h3>
                    <p>All access unlimited</p>
                </div>

                <div class="card-footer">
                    <a href="membership.php?plan=vip" class="btn btn-info w-100">
                        Join Now
                    </a>
                </div>

            </div>
        </div>

    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
