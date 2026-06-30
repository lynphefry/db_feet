<?php
include 'includes/db.php';
include 'includes/auth.php';
include 'includes/header.php';
include 'includes/navbar.php';

if (!isLoggedIn() || $_SESSION['role'] != 'trainer') {
    header("Location: login.php");
    exit();
}

// Find the trainer profile linked to this member
$stmt = $conn->prepare("
SELECT id, name
FROM trainers
WHERE member_id=?
");

$stmt->bind_param("i", $_SESSION['user_id']);
$stmt->execute();
$trainer = $stmt->get_result()->fetch_assoc();

if (!$trainer) {
    echo "<div class='container mt-5'>
            <div class='alert alert-danger'>
                Your trainer profile has not been linked by the administrator.
            </div>
          </div>";
    include 'includes/footer.php';
    exit();
}

$trainer_id = $trainer['id'];


// Handle Approve/Cancel
if(isset($_GET['action']) && isset($_GET['booking'])){

    $status = ($_GET['action']=="approve")
        ? "Approved"
        : "Cancelled";

    $booking = $_GET['booking'];

    $update = $conn->prepare("
        UPDATE bookings
        SET status=?
        WHERE id=? AND trainer_id=?
    ");

    $update->bind_param(
        "sii",
        $status,
        $booking,
        $trainer_id
    );

    $update->execute();
}


// Load bookings
$stmt = $conn->prepare("
SELECT
bookings.*,
members.first_name,
members.last_name
FROM bookings
JOIN members
ON bookings.user_id=members.id
WHERE trainer_id=?
ORDER BY booking_date, booking_time
");

$stmt->bind_param("i",$trainer_id);
$stmt->execute();

$bookings = $stmt->get_result();
?>

<div class="container mt-5">

<div class="card shadow">

<div class="card-header bg-success text-white">

<h3>My Training Schedule</h3>

</div>

<div class="card-body">

<table class="table table-bordered table-hover">

<thead class="table-dark">

<tr>

<th>Member</th>
<th>Date</th>
<th>Time</th>
<th>Status</th>
<th>Action</th>

</tr>

</thead>

<tbody>

<?php while($row=$bookings->fetch_assoc()){ ?>

<tr>

<td>
<?= htmlspecialchars($row['first_name']." ".$row['last_name']) ?>
</td>

<td><?= $row['booking_date'] ?></td>

<td><?= date("g:i A",strtotime($row['booking_time'])) ?></td>

<td>

<?php

if($row['status']=="Approved"){

    echo "<span class='badge bg-success'>Approved</span>";

}elseif($row['status']=="Cancelled"){

    echo "<span class='badge bg-danger'>Cancelled</span>";

}else{

    echo "<span class='badge bg-warning text-dark'>Pending</span>";

}

?>

</td>

<td>

<?php if($row['status']=="Pending"){ ?>

<a
href="?action=approve&booking=<?= $row['id'] ?>"
class="btn btn-success btn-sm">

Approve

</a>

<a
href="?action=cancel&booking=<?= $row['id'] ?>"
class="btn btn-danger btn-sm">

Cancel

</a>

<?php } ?>

</td>

</tr>

<?php } ?>

</tbody>

</table>

</div>

</div>

</div>

<?php include 'includes/footer.php'; ?>