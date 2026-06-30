<?php
include 'includes/db.php';
include 'includes/auth.php';
include 'includes/header.php';
include 'includes/navbar.php';

if (!isLoggedIn()) {
    header("Location: login.php");
    exit();
}

$message = "";

// Automatically select trainer if coming from trainers.php
$selectedTrainer = $_GET['trainer_id'] ?? "";

// Fetch trainers
$trainers = $conn->query("SELECT id, name FROM trainers ORDER BY name ASC");

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $user_id = $_SESSION['user_id'];
    $trainer_id = $_POST['trainer_id'];
    $booking_date = $_POST['booking_date'];
    $booking_time = $_POST['booking_time'];

    // Prevent booking dates in the past
    if ($booking_date < date("Y-m-d")) {

        $message = "<div class='alert alert-danger'>
                        Booking date cannot be in the past.
                    </div>";

    } else {

        // Check if trainer is already booked
        $check = $conn->prepare("
            SELECT id
            FROM bookings
            WHERE trainer_id = ?
            AND booking_date = ?
            AND booking_time = ?
        ");

        $check->bind_param("iss", $trainer_id, $booking_date, $booking_time);
        $check->execute();
        $check->store_result();

        if ($check->num_rows > 0) {

            $message = "<div class='alert alert-danger'>
                            This trainer is already booked for the selected date and time.
                        </div>";

        } else {

            $stmt = $conn->prepare("
                INSERT INTO bookings
                (user_id, trainer_id, booking_date, booking_time)
                VALUES (?, ?, ?, ?)
            ");

            $stmt->bind_param(
                "iiss",
                $user_id,
                $trainer_id,
                $booking_date,
                $booking_time
            );

            if ($stmt->execute()) {

                header("Location: booking.php");
                exit();

            } else {

                $message = "<div class='alert alert-danger'>
                                Booking failed:<br>
                                " . $stmt->error . "
                            </div>";
            }

            $stmt->close();
        }

        $check->close();
    }
}
?>

<div class="container mt-5">

    <div class="card shadow">

        <div class="card-header bg-primary text-white">
            <h3>Book a Training Session</h3>
        </div>

        <div class="card-body">

            <?php echo $message; ?>

            <form method="POST">

                <div class="mb-3">

                    <label>Select Trainer</label>

                    <select name="trainer_id" class="form-select" required>

                        <option value="">Choose Trainer</option>

                        <?php while ($trainer = $trainers->fetch_assoc()) { ?>

                            <option
                                value="<?php echo $trainer['id']; ?>"
                                <?php if ($selectedTrainer == $trainer['id']) echo "selected"; ?>>

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
                        min="<?php echo date('Y-m-d'); ?>"
                        required>

                </div>

                <div class="mb-3">

                    <label>Booking Time</label>

                    <input
                        type="time"
                        name="booking_time"
                        class="form-control"
                        required>

                </div>

                <div class="d-grid gap-2 d-md-flex">

                    <button type="submit" class="btn btn-primary">
                        Book Now
                    </button>

                    <a href="booking.php" class="btn btn-secondary">
                        Back
                    </a>

                </div>

            </form>

        </div>

    </div>

</div>

<?php include 'includes/footer.php'; ?>