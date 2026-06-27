<?php
include 'includes/auth.php';
include 'includes/db.php';

if (!isLoggedIn()) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Delete the logged-in user's account
$stmt = $conn->prepare("DELETE FROM members WHERE id = ?");
$stmt->bind_param("i", $user_id);

if ($stmt->execute()) {

    session_unset();
    session_destroy();

    header("Location: register.php?deleted=1");
    exit();

} else {

    include 'includes/header.php';
    include 'includes/navbar.php';
?>

<div class="container mt-5">

    <div class="alert alert-danger text-center shadow">

        <h4>Account Deletion Failed</h4>

        <p>Your account could not be deleted.</p>

        <a href="profile.php" class="btn btn-primary">
            Back to Profile
        </a>

    </div>

</div>

<?php
    include 'includes/footer.php';
}

$stmt->close();
$conn->close();
?>