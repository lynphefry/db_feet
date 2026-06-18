<?php
include 'auth.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>FEET TO FIT</title>

<link rel="stylesheet" href="assets/style.css">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
.carousel-item img{
    height:700px;
    object-fit:cover;
}

.hero-caption{
    background:rgba(0,0,0,0.4);
    padding:20px;
    border-radius:10px;
}

.navbar{
    z-index:1000;
}
</style>

</head>
<body>

<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg navbar-dark position-absolute w-100">

<div class="container">

<a class="navbar-brand fw-bold" href="index.php">
FEET TO FIT
</a>

<button class="navbar-toggler"
type="button"
data-bs-toggle="collapse"
data-bs-target="#navbarNav">

<span class="navbar-toggler-icon"></span>

</button>

<div class="collapse navbar-collapse" id="navbarNav">

<ul class="navbar-nav ms-auto">

<li class="nav-item">
<a class="nav-link text-white" href="index.php">Home</a>
</li>

<li class="nav-item">
<a class="nav-link text-white" href="trainers.php">Trainers</a>
</li>

<li class="nav-item">
<a class="nav-link text-white" href="classes.php">Classes</a>
</li>

<li class="nav-item">
<a class="nav-link text-white" href="schedule.php">Schedule</a>
</li>

<li class="nav-item">
<a class="nav-link text-white" href="register.php">register</a>
</li>

<li class="nav-item">
<a class="nav-link text-white" href="membership.php">Membership</a>
</li>

<li class="nav-item">
<a class="nav-link text-white" href="shop.php">Shop</a>
</li>

<li class="nav-item">
<a class="nav-link text-white" href="contact.php">contact</a>
</li>

<li class="nav-item">
<a class="nav-link text-white" href="booking.php">Booking</a>
</li>

<?php if(isLoggedIn()) : ?>

<li class="nav-item">
<a class="nav-link text-white" href="book_class.php">
Book Class
</a>
</li>

<li class="nav-item">
<a class="nav-link text-white" href="booking.php">
Bookings
</a>
</li>

<li class="nav-item">
<a class="nav-link text-white" href="account.php">
Account
</a>
</li>

<?php if(isAdmin()) : ?>

<li class="nav-item">
<a class="nav-link text-warning" href="admin.php">
Admin
</a>
</li>

<li class="nav-item">
<a class="nav-link text-warning" href="add_trainer.php">
Add Trainer
</a>
</li>

<?php endif; ?>

<li class="nav-item">
<a class="nav-link text-danger" href="logout.php">
Logout
</a>
</li>

<?php else : ?>

<li class="nav-item">
<a class="nav-link text-success" href="login.php">
Login
</a>
</li>

<li class="nav-item">
<a class="nav-link text-info" href="register.php">
Register
</a>
</li>

<?php endif; ?>

</ul>

</div>

</div>

</nav>

<!-- HERO CAROUSEL -->

<div id="heroCarousel"
class="carousel slide carousel-fade"
data-bs-ride="carousel">

<div class="carousel-inner">

<div class="carousel-item active">

<img src="assets/images/header 2.jpg"
class="d-block w-100"
alt="Gym">

<div class="carousel-caption hero-caption">

<h1 class="display-3 fw-bold">
WELCOME TO FEET TO FIT
</h1>

<p class="lead">
Train Smart. Stay Fit. Change Your Life.
</p>

<a href="register.php"
class="btn btn-primary btn-lg">
Join Now
</a>

</div>

</div>

<div class="carousel-item">

<img src="assets/images/gym 8.avif"
class="d-block w-100"
alt="Gym">

<div class="carousel-caption hero-caption">

<h1>
Professional Trainers
</h1>

<p>
Work with experienced fitness coaches.
</p>

</div>

</div>

<div class="carousel-item">

<img src="assets/images/gym 3.jpg"
class="d-block w-100"
alt="Gym">

<div class="carousel-caption hero-caption">

<h1>
Modern Equipment
</h1>

<p>
Everything you need to reach your goals.
</p>

</div>

</div>

<div class="carousel-item">

<img src="assets/images/gym13.jpeg"
class="d-block w-100"
alt="Gym">

<div class="carousel-caption hero-caption">

<h1>
Transform Your Body
</h1>

<p>
Join the FEET TO FIT community today.
</p>

</div>

</div>

</div>

<button class="carousel-control-prev"
type="button"
data-bs-target="#heroCarousel"
data-bs-slide="prev">

<span class="carousel-control-prev-icon"></span>

</button>

<button class="carousel-control-next"
type="button"
data-bs-target="#heroCarousel"
data-bs-slide="next">

<span class="carousel-control-next-icon"></span>

</button>

</div>

<!-- EVENTS -->

<<div class="container my-5">

    <h2 class="text-center fw-bold mb-4">
        Upcoming Events
    </h2>

    <p class="text-center text-muted mb-5">
        Join our exciting fitness programs and community events.
    </p>

    <div class="row g-4">

        <div class="col-md-4">
            <div class="card h-100 shadow border-0">

                <img src="assets\images\gymnastic 2.webp"
                     class="card-img-top"
                     style="height:250px; object-fit:cover;">

                <div class="card-body">

                    <span class="badge bg-info mb-2">
                        october 15
                    </span>

                    <h4 class="card-title">
                        gymnastic Challenge
                    </h4>

                    <p class="card-text">
                        Push your limits in our 30-day transformation challenge.
                    </p>

                    <a href="membership.php" class="btn btn-info">
                        Join Event
                    </a>

                </div>

            </div>
        </div>

        <div class="col-md-4">
            <div class="card h-100 shadow border-0">

                <img src="assets/images/pilate 1.jpg"
                     class="card-img-top"
                     style="height:250px; object-fit:cover;">

                <div class="card-body">

                    <span class="badge bg-info mb-2">
                        August 20
                    </span>

                    <h4 class="card-title">
                        Pilates Weekend
                    </h4>

                    <p class="card-text">
                        Improve flexibility, balance and relaxation with our experts.
                    </p>

                    <a href="membership.php" class="btn btn-info">
                        Register
                    </a>

                </div>

            </div>
        </div>

        <div class="col-md-4">
            <div class="card h-100 shadow border-0">

                <img src="assets/images/gym 11.webp"
                     class="card-img-top"
                     style="height:250px; object-fit:cover;">

                <div class="card-body">

                    <span class="badge bg-info mb-2">
                        September 30
                    </span>

                    <h4 class="card-title">
                        Strength Camp
                    </h4>

                    <p class="card-text">
                        Learn advanced strength training techniques from professionals.
                    </p>

                    <a href="membership.php" class="btn btn-info">
                        Learn More
                    </a>

                </div>

            </div>
        </div>

    </div>

</div>
<!-- FOOTER -->

<footer class="bg-dark text-light text-center py-4 mt-5">

<div class="container">

<h5>FEET TO FIT GYM</h5>

<p>
Transform Your Body, Transform Your Life
</p>

<p>
📍 Nairobi, Kenya |
📞 +254 705046184|
✉ info@feettofit.com
</p>

<p>
&copy; <?php echo date('Y'); ?>
FEET TO FIT. All Rights Reserved.
</p>

</div>

</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>