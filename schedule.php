

<?php
include 'auth.php';
?>

<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Schedule | FEET TO FIT</title>

```
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
```

</head>

<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">

```
    <a class="navbar-brand" href="index.php">FEET TO FIT</a>

    <div class="navbar-nav ms-auto">

        <a class="nav-link text-white" href="index.php">Home</a>
        <a class="nav-link text-white" href="trainers.php">Trainers</a>
        <a class="nav-link text-white" href="classes.php">Classes</a>
        <a class="nav-link text-warning" href="schedule.php">Schedule</a>
        <a class="nav-link text-white" href="membership.php">Membership</a>
        <a class="nav-link text-white" href="shop.php">Shop</a>
        <a class="nav-link text-white" href="contact.php">Contact</a>

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
```

</nav>

<div class="container mt-5">

```
<h2 class="text-center fw-bold mb-4">Class Schedule</h2>

<p class="text-center text-muted mb-4">
    Plan your workouts and stay consistent
</p>

<div class="card shadow p-4">

    <table class="table table-striped table-hover text-center">

        <thead class="table-dark">
            <tr>
                <th>Day</th>
                <th>Class</th>
                <th>Time</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>

        <tbody>

            <tr>
                <td>Monday</td>
                <td>Yoga</td>
                <td>6:00 AM</td>
                <td><span class="badge bg-success">Available</span></td>
                <td>
                    <a href="booking.php?class=Yoga" class="btn btn-success btn-sm">
                        Book Now
                    </a>
                </td>
            </tr>

            <tr>
                <td>Tuesday</td>
                <td>Gymnastics</td>
                <td>5:00 PM</td>
                <td><span class="badge bg-success">Available</span></td>
                <td>
                    <a href="booking.php?class=Gymnastics" class="btn btn-success btn-sm">
                        Book Now
                    </a>
                </td>
            </tr>

            <tr>
                <td>Wednesday</td>
                <td>Zumba</td>
                <td>5:00 PM</td>
                <td><span class="badge bg-success">Available</span></td>
                <td>
                    <a href="booking.php?class=Zumba" class="btn btn-success btn-sm">
                        Book Now
                    </a>
                </td>
            </tr>

            <tr>
                <td>Thursday</td>
                <td>Pilates</td>
                <td>5:00 PM</td>
                <td><span class="badge bg-warning text-dark">Limited</span></td>
                <td>
                    <a href="booking.php?class=Pilates" class="btn btn-warning btn-sm">
                        Book Now
                    </a>
                </td>
            </tr>

            <tr>
                <td>Friday</td>
                <td>Strength Training</td>
                <td>6:00 PM</td>
                <td><span class="badge bg-warning text-dark">Limited</span></td>
                <td>
                    <a href="booking.php?class=Strength Training" class="btn btn-warning btn-sm">
                        Book Now
                    </a>
                </td>
            </tr>

            <tr>
                <td>Saturday</td>
                <td>Zumba</td>
                <td>5:00 PM</td>
                <td><span class="badge bg-success">Available</span></td>
                <td>
                    <a href="booking.php?class=Zumba" class="btn btn-success btn-sm">
                        Book Now
                    </a>
                </td>
            </tr>

        </tbody>

    </table>

</div>
```

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
