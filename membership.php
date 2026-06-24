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
    <link rel="stylesheet" href="assets/style.css">
</head>

<body>


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
             <a class="nav-link text-white" href="dashbord.php">Dashboard</a>

            <?php if (isLoggedIn()) : ?>
                <a class="nav-link text-danger" href="logout.php">Logout</a>
            <?php else : ?>
                <a class="nav-link text-success" href="login.php">Login</a>
            <?php endif; ?>

        </div>

    </div>
</nav>


<div class="container mt-5">

    <h1 class="text-center fw-bold">Membership Plans</h1>

<p class="text-center text-muted mb-5">
    Choose a membership package that supports your fitness goals.
</p>

   <div class="row text-center mb-5">

    <div class="col-md-4">
        <h3>500+</h3>
        <p>Active Members</p>
    </div>

    <div class="col-md-4">
        <h3>20+</h3>
        <p>Professional Trainers</p>
    </div>

    <div class="col-md-4">
        <h3>50+</h3>
        <p>Weekly Classes</p>
    </div>

</div>

    
    <?php if (!empty($message)) : ?>
        <div class="alert alert-success text-center">
            <?= $message ?>
        </div>
    <?php endif; ?>

    <div class="row g-4">

        
        <div class="col-md-4">
            <div class="card shadow h-100 text-center">
<div class="card-header bg-info text-white">
    💪 BASIC
</div>

                <div class="card-body">
                   <h1 class="fw-bold">Ksh 2,000</h1>
<p class="text-muted">Per Month</p>
                    <p><ul class="list-unstyled mt-3">
    <li>✔ Gym Access</li>
    <li>✔ Locker Room Access</li>
    <li>✔ Fitness Assessment</li>
</ul></p>
                </div>

                <div class="card-footer">
                    <a href="membership.php?plan=basic" class="btn btn-info w-100">
                        Join Now
                    </a>
                </div>

            </div>
        </div>

      
<div class="col-md-4">
    <div class="card shadow h-100 text-center border-info">

        <div class="card-header bg-info text-white">
            🏋️ PREMIUM
        </div>

        <div class="card-body">
            <h1 class="fw-bold">Ksh 5,000</h1>
            <p class="text-muted">Per Month</p>

            <ul class="list-unstyled mt-3">
                <li>✔ Full Gym Access</li>
                <li>✔ Personal Trainer</li>
                <li>✔ Diet & Nutrition Plan</li>
                <li>✔ Locker Room Access</li>
                <li>✔ Fitness Assessment</li>
            </ul>
        </div>

        <div class="card-footer">
            <a href="membership.php?plan=premium" class="btn btn-info w-100">
                Join Now
            </a>
        </div>

    </div>
</div>
       
<div class="col-md-4">
    <div class="card shadow h-100 text-center border-info">

        <div class="card-header bg-info text-dark">
            👑 VIP
        </div>

        <div class="card-body">
            <h1 class="fw-bold">Ksh 8,000</h1>
            <p class="text-muted">Per Month</p>

            <ul class="list-unstyled mt-3">
                <li>✔ Everything in Premium</li>
                <li>✔ Unlimited Classes</li>
                <li>✔ Priority Booking</li>
                <li>✔ Nutrition Coaching</li>
                <li>✔ VIP Support</li>
            </ul>
        </div>

        <div class="card-footer">
            <a href="membership.php?plan=vip" class="btn btn-info w-100">
                Join Now
            </a>
        </div>

    </div>
</div>
<footer class="bg-dark text-white text-center py-3 mt-5">
    © 2026 FEET TO FIT | All Rights Reserved
</footer>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
