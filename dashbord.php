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
    <title>Dashboard | FEET TO FIT</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
!-- NAVBAR -->
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

            
<div class="container mt-5">

    <h2>Welcome to your Dashboard</h2>

    <div class="row mt-4">

        <div class="col-md-3">
            <div class="card text-center shadow">
                <div class="card-body">
                    <h5>Bookings</h5>
                    <a href="book_class.php" class="btn btn-primary">View</a>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card text-center shadow">
                <div class="card-body">
                    <h5>My Orders</h5>
                    <a href="my_orders.php" class="btn btn-success">View</a>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card text-center shadow">
                <div class="card-body">
                    <h5>Membership</h5>
                    <a href="membership.php" class="btn btn-info">View</a>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card text-center shadow">
                <div class="card-body">
                    <h5>Account</h5>
                    <a href="account.php" class="btn btn-warning">View</a>
                </div>
            </div>
        </div>

    </div>

</div>

</body>
</html>