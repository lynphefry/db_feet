<?php
include 'includes/db.php';
include 'includes/auth.php';
include 'includes/header.php';
include 'includes/navbar.php';


if (!isLoggedIn()) {
    header("Location: login.php");
    exit;
}

$success = "";

// HANDLE BOOKING
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $class = $_POST['class'];
    $user_id = $_SESSION['user_id'];

    // CHECK DOUBLE BOOKING
    $check = $conn->prepare("
        SELECT id FROM bookings 
        WHERE user_id = ? AND class_name = ?
    ");

    $check->bind_param("is", $user_id, $class);
    $check->execute();
    $check->store_result();

    if ($check->num_rows > 0) {

        $success = "⚠ You already booked this class!";

    } else {

        $stmt = $conn->prepare("
            INSERT INTO bookings (user_id, class_name) 
            VALUES (?, ?)
        ");

        $stmt->bind_param("is", $user_id, $class);
        $stmt->execute();

        $success = "✅ Class booked successfully!";
    }
}
?>



<body>

<!-- NAVBAR -->
<?php include 'navbar.php'; ?>

<div class="container mt-5">

    <h2 class="mb-4">Book a Class</h2>

    <?php if (!empty($success)) : ?>
        <div class="alert alert-info">
            <?= $success ?>
        </div>
    <?php endif; ?>

    <form method="POST">

        <div class="mb-3">
            <label class="form-label">Select Class</label>

            <select name="class" class="form-control" required>
                <option value="Yoga">Yoga</option>
                <option value="Strength Training">Strength Training</option>
                <option value="Cardio">Cardio</option>
                <option value="Zumba">Zumba</option>
                <option value="Gymnastics">Gymnastics</option>
                <option value="Boxing">Boxing</option>
                <option value="Pilates">Pilates</option>
            </select>

        </div>

        <button type="submit" class="btn btn-primary">
            Book Class
        </button>

    </form>

</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>