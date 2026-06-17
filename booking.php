<?php
include 'db.php';
include 'auth.php';

if (!isLoggedIn() || !isAdmin()) {
    die("Access denied");
}

$result = mysqli_query($conn, "
SELECT bookings.*, members.first_name 
FROM bookings 
JOIN members ON bookings.user_id = members.id
");
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="assets/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<a href="book_class.php">Book Class</a>
<a href="bookings.php">View Bookings (Admin)</a>
<div class="container mt-5">

    <h2>All Bookings</h2>

    <table class="table table-dark table-striped">

        <tr>
            <th>User</th>
            <th>Class</th>
            <th>Date</th>
        </tr>

        <?php while ($b = mysqli_fetch_assoc($result)) { ?>
        <tr>
            <td><?= htmlspecialchars($b['first_name']) ?></td>
            <td><?= htmlspecialchars($b['class_name']) ?></td>
            <td><?= $b['booking_date'] ?></td>
        </tr>
        <?php } ?>

    </table>

</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>