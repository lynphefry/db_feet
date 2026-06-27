<?php
include 'includes/db.php';
include 'includes/auth.php';
include 'includes/header.php';
include 'includes/navbar.php';


if (!isLoggedIn()) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Admin sees all bookings, members see only their own
if (isAdmin()) {

    $sql = "SELECT
                bookings.id,
                members.first_name,
                members.last_name,
                trainers.name AS trainer_name,
                bookings.booking_date,
                bookings.booking_time
            FROM bookings
            JOIN members ON bookings.user_id = members.id
            JOIN trainers ON bookings.trainer_id = trainers.id
            ORDER BY booking_date DESC";

    $result = $conn->query($sql);

} else {

    $stmt = $conn->prepare("
        SELECT
            bookings.id,
            trainers.name AS trainer_name,
            bookings.booking_date,
            bookings.booking_time
        FROM bookings
        JOIN trainers ON bookings.trainer_id = trainers.id
        WHERE bookings.user_id=?
        ORDER BY booking_date DESC
    ");

    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
}
?>



<body>

<div class="container mt-5">

<div class="d-flex justify-content-between mb-3">

<h2>Bookings</h2>

<a href="add_booking.php" class="btn btn-success">
New Booking
</a>

</div>

<div class="card shadow">

<div class="card-body">

<table class="table table-striped table-bordered">

<thead class="table-dark">

<tr>

<th>ID</th>

<?php if(isAdmin()) { ?>
<th>Member</th>
<?php } ?>

<th>Trainer</th>
<th>Date</th>
<th>Time</th>
<th>Action</th>

</tr>

</thead>

<tbody>

<?php if($result->num_rows>0){ ?>

<?php while($row=$result->fetch_assoc()){ ?>

<tr>

<td><?php echo $row['id']; ?></td>

<?php if(isAdmin()){ ?>

<td>
<?php
echo htmlspecialchars(
$row['first_name']." ".$row['last_name']
);
?>
</td>

<?php } ?>

<td><?php echo htmlspecialchars($row['trainer_name']); ?></td>

<td><?php echo $row['booking_date']; ?></td>

<td><?php echo $row['booking_time']; ?></td>

<td>

<a
href="edit_booking.php?id=<?php echo $row['id']; ?>"
class="btn btn-warning btn-sm">

Edit

</a>

<a
href="delete_booking.php?id=<?php echo $row['id']; ?>"
class="btn btn-danger btn-sm"
onclick="return confirm('Delete this booking?')">

Delete

</a>

</td>

</tr>

<?php } ?>

<?php } else { ?>

<tr>

<td colspan="<?php echo isAdmin() ? 6 : 5; ?>" class="text-center">

No bookings found.

</td>

</tr>

<?php } ?>

</tbody>

</table>

<a href="dashboard.php" class="btn btn-secondary">

Back to Dashboard

</a>

</div>

</div>

</div>
<?php include 'includes/footer.php'; ?>
</body>
</html>