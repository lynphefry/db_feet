<?php
include 'auth.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Classes | FEET TO FIT</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
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
            

            <?php if (isLoggedIn()) : ?>
                <a class="nav-link text-white" href="booking.php">My Bookings</a>
                <a class="nav-link text-white" href="account.php">Account</a>
                <a class="nav-link text-danger" href="logout.php">Logout</a>
            <?php else : ?>
                <a class="nav-link text-success" href="login.php">Login</a>
            <?php endif; ?>

        </div>

    </div>
</nav>

<!-- HEADER -->
<div class="container mt-5">

    <h2 class="text-center fw-bold mb-4">
        Our Gym Classes
    </h2>

    <p class="text-center text-muted mb-5">
        Choose a class that fits your fitness goals.
    </p>

    <!-- CLASSES GRID -->
    <div class="row g-4">

        <div class="col-md-4">
            <div class="card shadow h-100">

                <img src="assets/images/yoga 1.jpg"
                     class="card-img-top"
                     style="height:220px; object-fit:cover;">

                <div class="card-body">

                    <h4>Morning Yoga</h4>
                    <p>Start your day with flexibility and calmness.</p>

                    <a href="book_class.php" class="btn btn-success w-100">
                        Book Class
                    </a>

                </div>

            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow h-100">

                <img src="assets/images/cardio.avif"
                     class="card-img-top"
                     style="height:220px; object-fit:cover;">

                <div class="card-body">

                    <h4>Cardio Blast</h4>
                    <p>Burn calories fast with high-intensity workouts.</p>

                    <a href="book_class.php" class="btn btn-success w-100">
                        Book Class
                    </a>

                </div>

            </div>
        </div>

         <div class="col-md-4">
            <div class="card shadow h-100">

                <img src="assets/images/boxing.jpg"
                     class="card-img-top"
                     style="height:220px; object-fit:cover;">

                <div class="card-body">

                    <h4>Boxing</h4>
                    <p>Unleash your inner fighter with our boxing classes.</p>

                    <a href="book_class.php" class="btn btn-success w-100">
                        Book Class
                    </a>

                </div>

            </div>
        </div>

         <div class="col-md-4">
            <div class="card shadow h-100">

                <img src="assets/images/pilate 1.jpg"
                     class="card-img-top"
                     style="height:220px; object-fit:cover;">

                <div class="card-body">

                    <h4>Pilates</h4>
                    <p>Improve flexibility, balance and relaxation with our Pilates classes.</p>

                    <a href="book_class.php" class="btn btn-success w-100">
                        Book Class
                    </a>

                </div>

            </div>
        </div>

         <div class="col-md-4">
            <div class="card shadow h-100">

                <img src="assets/images/gymnastic 2.webp"
                     class="card-img-top"
                     style="height:220px; object-fit:cover;">

                <div class="card-body">

                    <h4>Gymnastic</h4>
                    <p>Improve flexibility and strength with our gymnastic classes.</p>

                    <a href="book_class.php" class="btn btn-success w-100">
                        Book Class
                    </a>

                </div>

            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow h-100">

                <img src="assets/images/zumba.jpg"
                     class="card-img-top"
                     style="height:220px; object-fit:cover;">

                <div class="card-body">

                    <h4>Zumba Training</h4>
                    <p>Dance your way to fitness with our Zumba classes.</p>

                    <a href="book_class.php" class="btn btn-success w-100">
                        Book Class
                    </a>

                </div>

            </div>
        </div>

    </div>

</div>

</body>
</html>