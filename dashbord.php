<?php
include 'auth.php';
include ' dashbord.php';
if (!isLoggedIn()) {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard | FEET TO FIT</title>
    <link rel="stylesheet" href="assets\style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
</head>
<body>

<div class="container mt-5">

    <h2>Welcome, <?= htmlspecialchars($_SESSION['user_name']) ?></h2>

    <div class="row mt-4">

        <div class="col-md-4">
            <div class="card p-3 shadow">
                <h4>My Account</h4>
                <a href="account.php" class="btn btn-primary">Open</a>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card p-3 shadow">
                <h4>My Bookings</h4>
                <a href="booking.php" class="btn btn-success">View</a>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card p-3 shadow">
                <h4>Shop Cart</h4>
                <a href="shop.php" class="btn btn-warning">Open Cart</a>
            </div>
        </div>

    </div>

</div>

</body>
</html>