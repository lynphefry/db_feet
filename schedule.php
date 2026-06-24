

<?php
include 'auth.php';
?>

<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Schedule | FEET TO FIT</title>

<link rel="stylesheet" href="assets\style.css">
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
        <a class="nav-link text-warning" href="schedule.php">Schedule</a>
        <a class="nav-link text-white" href="membership.php">Membership</a>
        <a class="nav-link text-white" href="shop.php">Shop</a>
        <a class="nav-link text-white" href="contact.php">Contact</a>
        <a class="nav-link text-white" href="dashbord.php">Dashboard</a>

        <?php if (isLoggedIn()) : ?>
            <a class="nav-link text-white" href="booking.php">Bookings</a>
            <a class="nav-link text-white" href="account.php">Account</a>
            <a class="nav-link text-danger" href="logout.php">Logout</a>
        <?php else : ?>
            <a class="nav-link text-success" href="login.php">Login</a>
            <a class="nav-link text-info" href="register.php">Register</a>
        <?php endif; ?>

    </div>

</div>


</nav>

<div class="container mt-5">


<h2 class="text-center fw-bold mb-4">Class Schedule</h2>

<p class="text-center text-muted mb-4">
    Plan your workouts and stay consistent
</p>

<div class="card shadow-lg border-0 rounded-4 p-4">


<table class="table table-hover text-center align-middle">

    <thead class="table-dark">
        <tr>
            <th>Day</th>
            <th>Class</th>
            <th>Trainer</th>
            <th>Time</th>
            <th>Slots</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
    </thead>

    <tbody>

        <tr>
            <td>Monday</td>
            <td>Yoga</td>
            <td>Mary Wanjiku</td>
            <td>6:00 AM</td>
            <td>15 / 20</td>
            <td><span class="badge bg-primary">Available</span></td>
            <td>
                <a href="book_class.php?class=Yoga" class="btn btn-primary btn-sm">
                    Book Now
                </a>
            </td>
        </tr>

        <tr>
            <td>Tuesday</td>
            <td>Gymnastics</td>
            <td>David Mwangi</td>
            <td>5:00 PM</td>
            <td>12 / 20</td>
            <td><span class="badge bg-primary">Available</span></td>
            <td>
                <a href="book_class.php?class=Gymnastics" class="btn btn-primary btn-sm">
                    Book Now
                </a>
            </td>
        </tr>

        <tr>
            <td>Wednesday</td>
            <td>Zumba</td>
            <td>Angie Wambui</td>
            <td>5:00 PM</td>
            <td>18 / 20</td>
            <td><span class="badge bg-primary">Available</span></td>
            <td>
                <a href="book_class.php?class=Zumba" class="btn btn-primary btn-sm">
                    Book Now
                </a>
            </td>
        </tr>

        <tr>
            <td>Thursday</td>
            <td>Pilates</td>
            <td>Amina Noor</td>
            <td>5:00 PM</td>
            <td>19 / 20</td>
            <td><span class="badge bg-danger text-dark">Limited</span></td>
            <td>
                <a href="book_class.php?class=Pilates" class="btn btn-danger btn-sm">
                    Book Now
                </a>
            </td>
        </tr>

        <tr>
            <td>Friday</td>
            <td>Strength Training</td>
            <td>John Mwangi</td>
            <td>6:00 PM</td>
            <td>20 / 20</td>
            <td><span class="badge bg-danger">Full</span></td>
            <td>
                <button class="btn btn-danger btn-sm" disabled>
                    Full
                </button>
            </td>
        </tr>

        <tr>
            <td>Saturday</td>
            <td>Zumba</td>
            <td>Brian Otieno</td>
            <td>5:00 PM</td>
            <td>10 / 20</td>
            <td><span class="badge bg-primary">Available</span></td>
            <td>
                <a href="book_class.php?class=Zumba" class="btn btn-primary btn-sm">
                    Book Now
                </a>
            </td>
        </tr>

    </tbody>

</table>
```

</div>

<footer class="bg-dark text-white text-center py-3 mt-5 rounded">
    © 2026 FEET TO FIT | Transform Your Body, Transform Your Life
</footer>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
