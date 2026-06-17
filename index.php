<?php include 'auth.php'; ?>

<!DOCTYPE html>
<html>
<head>
    <title>Feet To Fit</title>
    <link rel="stylesheet" href="assets\style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container">
    <a class="navbar-brand" href="index.php">Feet To Fit</a>

    <div class="collapse navbar-collapse">
      <ul class="navbar-nav ms-auto">

        <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
        <li class="nav-item"><a class="nav-link" href="login.php">Login</a></li>
        <li class="nav-item"><a class="nav-link" href="register.php">Register</a></li>
        <li class="nav-item"><a class="nav-link" href="classes.php">Classes</a></li>
        <li class="nav-item"><a class="nav-link" href="trainers.php">Trainers</a></li>
        <li class="nav-item"><a class="nav-link" href="contact.php">Contact</a></li>
        <li class="nav-item"><a class="nav-link" href="membership.php">Membership</a></li>
        <li class="nav-item"><a class="nav-link" href="schedule.php">Schedule</a></li>
        <li class="nav-item"><a class="nav-link" href="account.php">Account</a></li>

        <?php if (isLoggedIn()): ?>
          <li class="nav-item"><a class="nav-link" href="account.php">Dashboard</a></li>
          <li class="nav-item"><a class="nav-link" href="logout.php">Logout</a></li>
        <?php endif; ?>

      </ul>
    </div>
  </div>
</nav>

    <?php if (isLoggedIn()): ?>
        <a href="account.php">My Account</a>
        <a href="logout.php">Logout</a>
    <?php endif; ?>
</div>

<div class="container mt-5">
  <div class="row">

    <div class="col-md-6">
      <div class="card p-4 shadow">
        <h2>Welcome to Feet To Fit Gym</h2>
        <p>Train smart. Stay fit. Change your life.</p>
        <a href="register.php" class="btn btn-primary">Join Now</a>
      </div>
    </div>

  </div>
</div>
<div id="gymCarousel" class="carousel slide" data-bs-ride="carousel">

  <div class="carousel-inner">

    <div class="carousel-item active">
      <img src="assets/images/gym1.jpg" class="d-block w-100" style="height:500px; object-fit:cover;">
      <div class="carousel-caption">
        <h3>Welcome to Feet To Fit</h3>
      </div>
    </div>

    <div class="carousel-item">
      <img src="assets/images/workout1.jpg" class="d-block w-100" style="height:500px; object-fit:cover;">
      <div class="carousel-caption">
        <h3>Train Hard</h3>
      </div>
    </div>

    <div class="carousel-item">
      <img src="assets/images/trainer1.jpg" class="d-block w-100" style="height:500px; object-fit:cover;">
      <div class="carousel-caption">
        <h3>Professional Trainers</h3>
      </div>
    </div>

  </div>

  <button class="carousel-control-prev" type="button" data-bs-target="#gymCarousel" data-bs-slide="prev">
    <span class="carousel-control-prev-icon"></span>
  </button>

  <button class="carousel-control-next" type="button" data-bs-target="#gymCarousel" data-bs-slide="next">
    <span class="carousel-control-next-icon"></span>
  </button>

</div>
<div class="container mt-5">

<h2 class="text-center">Upcoming Events</h2>

<div class="row">

  <div class="col-md-4">
    <div class="card p-3">
      <h4>Fitness Challenge</h4>
      <p>Join our 30-day transformation challenge.</p>
    </div>
  </div>

  <div class="col-md-4">
    <div class="card p-3">
      <h4>Yoga Weekend</h4>
      <p>Relax and improve flexibility.</p>
    </div>
  </div>

  <div class="col-md-4">
    <div class="card p-3">
      <h4>Strength Camp</h4>
      <p>Build muscle with expert trainers.</p>
    </div>
  </div>

</div>

</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>