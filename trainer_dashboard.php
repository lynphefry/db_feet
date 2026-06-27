<?php
include 'includes/auth.php';
include 'includes/header.php';
include 'includes/navbar.php';

if(!isLoggedIn() || $_SESSION['role']!='trainer'){
    die("Access denied.");
}
?>

<div class="container mt-5">

<div class="card shadow">

<div class="card-header bg-success text-white">

<h2>Trainer Dashboard</h2>

</div>

<div class="card-body">

<h4>

Welcome

<?php echo $_SESSION['first_name']; ?>

</h4>

<hr>

<a href="booking.php"
class="btn btn-primary">

My Bookings

</a>

<a href="profile.php"
class="btn btn-warning">

My Profile

</a>

<a href="logout.php"
class="btn btn-danger">

Logout

</a>

</div>

</div>

</div>

<?php include 'includes/footer.php'; ?>