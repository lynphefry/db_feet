<?php
include 'includes/db.php';
include 'includes/auth.php';
include 'includes/header.php';
include 'includes/navbar.php';


if (!isLoggedIn()) {
    header("Location: login.php");
    exit();
}

if (!isset($_GET['id'])) {
    header("Location: booking.php");
    exit();
}

$id = intval($_GET['id']);
$user_id = $_SESSION['user_id'];

// Admin can edit any booking
if (isAdmin()) {

    $stmt = $conn->prepare("SELECT * FROM bookings WHERE id=?");
    $stmt->bind_param("i", $id);

} else {

    // Members can edit only their own bookings
    $stmt = $conn->prepare("SELECT * FROM bookings WHERE id=? AND user_id=?");
    $stmt->bind_param("ii", $id, $user_id);
}

$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 0) {
    header("Location: booking.php");
    exit();
}

$booking = $result->fetch_assoc();
$stmt->close();

$message = "";

// Update booking
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $trainer_id = $_POST['trainer_id'];
    $booking_date = $_POST['booking_date'];
    $booking_time = $_POST['booking_time'];
if ($booking_date < date("Y-m-d")) {

    $message = "<div class='alert alert-danger'>
                    Booking date cannot be in the past.
                </div>";

} else {
    $update = $conn->prepare("
        UPDATE bookings
        SET trainer_id=?, booking_date=?, booking_time=?
        WHERE id=?
    ");

    $update->bind_param(
        "issi",
        $trainer_id,
        $booking_date,
        $booking_time,
        $id
    );

    if ($update->execute()) {

        header("Location: booking.php?updated=1");
        exit();

    } else {

        $message = "<div class='alert alert-danger'>
                        Failed to update booking.
                    </div>";
    }

    $update->close();}
}

// Get trainers
$trainers = $conn->query("SELECT id,name FROM trainers ORDER BY name");
?>



<div class="container mt-5">

<div class="card shadow">

<div class="card-header bg-warning">

<h3>Edit Booking</h3>

</div>

<div class="card-body">

<?php echo $message; ?>

<form method="POST">

<div class="mb-3">

<label>Trainer</label>

<select name="trainer_id" class="form-select" required>

<?php while($trainer = $trainers->fetch_assoc()) { ?>

<option
value="<?php echo $trainer['id']; ?>"
<?php if($trainer['id']==$booking['trainer_id']) echo "selected"; ?>>

<?php echo htmlspecialchars($trainer['name']); ?>

</option>

<?php } ?>

</select>

</div>

<div class="mb-3">

<label>Booking Date</label>

<input
type="date"
name="booking_date"
class="form-control"
value="<?php echo $booking['booking_date']; ?>"
required>

</div>

<div class="mb-3">

<label>Booking Time</label>

<input
type="date"
name="booking_date"
class="form-control"
value="<?php echo $booking['booking_date']; ?>"
min="<?php echo date('Y-m-d'); ?>"
required>

</div>


<div class="d-grid gap-2 d-md-flex">

<button class="btn btn-warning">

<i class="bi bi-pencil-square"></i>
Update Booking

</button>

<a href="booking.php" class="btn btn-secondary">

<i class="bi bi-arrow-left"></i>
Cancel

</a>

</div>

<a href="booking.php" class="btn btn-secondary">

Cancel

</a>

</form>

</div>

</div>

</div>
<?php include 'includes/footer.php'; ?>
