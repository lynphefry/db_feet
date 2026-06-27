<?php
include 'includes/db.php';
include 'includes/auth.php';
include 'includes/header.php';
include 'includes/navbar.php';
if (!isLoggedIn()) {
    header("Location: login.php");
    exit();
}

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header("Location: booking.php");
    exit();
}

$id = (int)$_GET['id'];
$user_id = $_SESSION['user_id'];

// Admin can delete any booking
if (isAdmin()) {

    $stmt = $conn->prepare("DELETE FROM bookings WHERE id = ?");
    $stmt->bind_param("i", $id);

} else {

    // Members can only delete their own bookings
    $stmt = $conn->prepare("DELETE FROM bookings WHERE id = ? AND user_id = ?");
    $stmt->bind_param("ii", $id, $user_id);

}

if ($stmt->execute()) {

    header("Location: booking.php?deleted=1");
    exit();

} else {

    include 'includes/header.php';
    include 'includes/navbar.php';
?>

<div class="container mt-5">

    <div class="alert alert-danger text-center shadow">

        <h4>Delete Failed</h4>

        <p>The booking could not be deleted.</p>

        <a href="booking.php" class="btn btn-primary">
            Back to Bookings
        </a>

    </div>

</div>

<?php
    include 'includes/footer.php';
}

$stmt->close();
$conn->close();
?>