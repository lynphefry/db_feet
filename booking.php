<?php
include 'db.php';
include 'auth.php';

if (!isLoggedIn()) {
    die("Access denied. Please login first.");
}

$result = mysqli_query($conn, "
SELECT bookings.*, members.first_name
FROM bookings
JOIN members ON bookings.user_id = members.id
ORDER BY booking_date DESC
");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Bookings | FEET TO FIT</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">

        <a class="navbar-brand" href="index.php">FEET TO FIT</a>

        <div class="navbar-nav ms-auto">
            <a class="nav-link" href="index.php">Home</a>
            <a class="nav-link" href="trainers.php">Trainers</a>
            <a class="nav-link" href="classes.php">Classes</a>
            <a class="nav-link" href="schedule.php">Schedule</a>
            <a class="nav-link" href="membership.php">Membership</a>
            <a class="nav-link" href="shop.php">Shop</a>
            <a class="nav-link" href="contact.php">Contact</a>
            <a class="nav-link" href="account.php">Account</a>

            <?php if (isAdmin()) : ?>
                <a class="nav-link text-warning" href="admin.php">Admin</a>
            <?php endif; ?>

            <a class="nav-link text-danger" href="logout.php">Logout</a>
        </div>

    </div>
</nav>

<div class="container mt-5">

    <h2 class="mb-4">Bookings</h2>

    <table class="table table-striped table-bordered">

        <thead class="table-dark">
            <tr>
                <th>User</th>
                <th>Class</th>
                <th>Date</th>
            </tr>
        </thead>

        <tbody>

        <?php while ($b = mysqli_fetch_assoc($result)) { ?>

            <tr>
                <td><?= htmlspecialchars($b['first_name']) ?></td>
                <td><?= htmlspecialchars($b['class_name']) ?></td>
                <td><?= htmlspecialchars($b['booking_date']) ?></td>
            </tr>

        <?php } ?>

        </tbody>

    </table>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>