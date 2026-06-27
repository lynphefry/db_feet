<?php
include 'includes/db.php';
include 'includes/auth.php';

include 'includes/header.php';
include 'includes/navbar.php';
?>

<style>
.carousel-item img{
    height:700px;
    object-fit:cover;
}

.hero-caption{
    background:rgba(0,0,0,0.5);
    padding:20px;
    border-radius:10px;
}
</style>

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

<section class="py-5 bg-light">

<div class="container">

<h2 class="text-center fw-bold mb-5">
Why Choose FEET TO FIT?
</h2>

<div class="row text-center">

<div class="col-md-3">

<div class="card shadow border-0 h-100">

<div class="card-body">

<h1>🏋️</h1>

<h4>Modern Equipment</h4>

<p>
Train with high-quality fitness equipment designed for every workout.
</p>

</div>

</div>

</div>

<div class="col-md-3">

<div class="card shadow border-0 h-100">

<div class="card-body">

<h1>👨‍🏫</h1>

<h4>Expert Trainers</h4>

<p>
Certified trainers help you reach your fitness goals safely.
</p>

</div>

</div>

</div>

<div class="col-md-3">

<div class="card shadow border-0 h-100">

<div class="card-body">

<h1>❤️</h1>

<h4>Healthy Lifestyle</h4>

<p>
Fitness programs designed to improve your strength and well-being.
</p>

</div>

</div>

</div>

<div class="col-md-3">

<div class="card shadow border-0 h-100">

<div class="card-body">

<h1>🤝</h1>

<h4>Friendly Community</h4>

<p>
Become part of a supportive fitness family that motivates you every day.
</p>

</div>

</div>

</div>

</div>

</div>

</section>
<?php

$featured = $conn->query("SELECT * FROM trainers LIMIT 3");

?>

<section class="container py-5">

<h2 class="text-center fw-bold mb-5">
Meet Our Trainers
</h2>

<div class="row">

<?php while($trainer = $featured->fetch_assoc()){ ?>

<div class="col-md-4">

<div class="card shadow h-100">

<img
src="assets/images/trainers/<?php echo $trainer['image'];?>"
class="card-img-top"
style="height:320px; object-fit:cover;">

<div class="card-body text-center">

<h4><?php echo htmlspecialchars($trainer['name']); ?></h4>

<p><?php echo htmlspecialchars($trainer['specialty']); ?></p>

<a href="trainers.php" class="btn btn-success">

View Profile

</a>

</div>

</div>

</div>

<?php } ?>

</div>

</section>
<section class="bg-dark text-white py-5">

<div class="container">

<h2 class="text-center mb-5">
What Our Members Say
</h2>

<div class="row">

<div class="col-md-4">

<div class="card bg-secondary text-white">

<div class="card-body">

★★★★★

<p class="mt-3">

Joining FEET TO FIT completely transformed my fitness journey. The trainers are amazing!

</p>

<h6>- Sarah W.</h6>

</div>

</div>

</div>

<div class="col-md-4">

<div class="card bg-secondary text-white">

<div class="card-body">

★★★★★

<p class="mt-3">

Excellent equipment and a motivating environment. I enjoy every workout session.

</p>

<h6>- Brian K.</h6>

</div>

</div>

</div>

<div class="col-md-4">

<div class="card bg-secondary text-white">

<div class="card-body">

★★★★★

<p class="mt-3">

The booking system is easy to use and the trainers are very professional.

</p>

<h6>- Grace N.</h6>

</div>

</div>

</div>

</div>

</div>

</section>
<section class="container py-5">

<h2 class="text-center fw-bold mb-5">

Membership Plans

</h2>

<div class="row">

<div class="col-md-4">

<div class="card shadow text-center">

<div class="card-body">

<h3>Basic</h3>

<h2 class="text-primary">

Ksh 2,500

</h2>

<p>Gym Access</p>

<p>Locker Access</p>

<p>1 Trainer Session</p>

<a href="membership.php" class="btn btn-primary">

Choose Plan

</a>

</div>

</div>

</div>

<div class="col-md-4">

<div class="card shadow border-success">

<div class="card-header bg-success text-white text-center">

Most Popular

</div>

<div class="card-body text-center">

<h3>Premium</h3>

<h2 class="text-success">

Ksh 5,000

</h2>

<p>Unlimited Gym</p>

<p>Unlimited Classes</p>

<p>Personal Trainer</p>

<a href="membership.php" class="btn btn-success">

Choose Plan

</a>

</div>

</div>

</div>

<div class="col-md-4">

<div class="card shadow text-center">

<div class="card-body">

<h3>VIP</h3>

<h2 class="text-danger">

Ksh 8,000

</h2>

<p>Premium Benefits</p>

<p>Nutrition Plan</p>

<p>VIP Support</p>

<a href="membership.php" class="btn btn-danger">

Choose Plan

</a>

</div>

</div>

</div>

</div>

</section>
<section class="bg-light py-5">

<div class="container">

<h2 class="text-center fw-bold mb-5">

Contact Us

</h2>

<div class="row">

<div class="col-md-6">

<h4>FEET TO FIT Gym</h4>

<p>📍 Nairobi, Kenya</p>

<p>📞 +254 712 345678</p>

<p>📧 info@feettofit.com</p>

<p>🕒 Mon - Sat: 6:00 AM - 10:00 PM</p>

</div>

<div class="col-md-6">

<iframe
src="https://www.google.com/maps?q=Nairobi&output=embed"
width="100%"
height="300"
style="border:0;"
loading="lazy">
</iframe>

</div>

</div>

</div>

</section>

<!-- EVENTS -->

<div class="container my-5">

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

                    <a href="register.php" class="btn btn-info">
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

                    <a href="register.php" class="btn btn-info">
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

                    <a href="register.php" class="btn btn-info">
                        Learn More
                    </a>

                </div>

            </div>
        </div>

    </div>

</div>
<?php include 'includes/footer.php'; ?>