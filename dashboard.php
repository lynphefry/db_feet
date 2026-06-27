<?php
include 'includes/db.php';
include 'includes/auth.php';

// Only logged-in users can access the dashboard
if (!isLoggedIn()) {
    header("Location: login.php");
    exit();
}

include 'includes/header.php';
include 'includes/navbar.php';
?>

<div class="container mt-5">

    <div class="card shadow">

        <div class="card-body text-center">

            <h2>Welcome, <?php echo htmlspecialchars($_SESSION['first_name']); ?>! 👋</h2>

            <p class="text-muted">
                You have successfully logged in to FEET TO FIT.
            </p>

            <div class="mt-4">

                <a href="profile.php" class="btn btn-primary">
                    My Profile
                </a>

                <a href="trainers.php" class="btn btn-success">
                    Trainers
                </a>

                <a href="booking.php" class="btn btn-warning">
                    Bookings
                </a>

                <?php if (isAdmin()) { ?>

                    <a href="admin.php" class="btn btn-dark">
                        Admin Panel
                    </a>

                <?php } ?>

                <a href="logout.php" class="btn btn-danger">
                    Logout
                </a>

            </div>

        </div>

    </div>

</div>

<?php include 'includes/footer.php'; ?>