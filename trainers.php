<?php
include 'db.php';
include 'auth.php';
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Trainers | FEET TO FIT</title>
<link rel="stylesheet" href="assets\style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
</head>

<body>

<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">

        <a class="navbar-brand" href="index.php">FEET TO FIT</a>

        <div class="navbar-nav ms-auto">

            <a class="nav-link" href="index.php">Home</a>
            <a class="nav-link active" href="trainers.php">Trainers</a>
            <a class="nav-link" href="classes.php">Classes</a>
            <a class="nav-link" href="schedule.php">Schedule</a>
            <a class="nav-link" href="membership.php">Membership</a>
            <a class="nav-link" href="shop.php">Shop</a>
            <a class="nav-link" href="contact.php">Contact</a>
<a class="nav-link text-white" href="dashbord.php">Dashboard</a>

            <?php if (isLoggedIn()) : ?>
                <a class="nav-link" href="booking.php">Bookings</a>
                <a class="nav-link" href="account.php">Account</a>

                <?php if (isAdmin()) : ?>
                    <a class="nav-link text-warning" href="admin.php">Admin</a>
                    <a class="nav-link text-warning" href="add_trainer.php">Add Trainer</a>
                <?php endif; ?>

                <a class="nav-link text-danger" href="logout.php">Logout</a>

            <?php else : ?>
                <a class="nav-link text-success" href="login.php">Login</a>
                <a class="nav-link text-info" href="register.php">Register</a>
            <?php endif; ?>

        </div>

    </div>
</nav>

<!-- PAGE HEADER -->
<div class="container mt-5">

    <h2 class="text-center fw-bold">Our Trainers</h2>

    <p class="text-center text-muted mb-5">
        Meet our professional fitness trainers
    </p>

    <div class="row g-4">
<?php
    // fetch trainers from database
    $sql = "SELECT * FROM trainers";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        while ($t = $result->fetch_assoc()) {
            // choose image: use server filesystem to check, use URL for <img>
            $defaultUrl = 'assets/images/trainers/default.jpg';
            $imgFileUrl = $defaultUrl;

            if (!empty($t['image'])) {
                $filename = basename($t['image']); // avoid path traversal
                $fsPath = __DIR__ . '/assets/images/trainers/' . $filename; // filesystem path
                $urlPath = 'assets/images/trainers/' . rawurlencode($filename);   // url path

                if (is_file($fsPath) && is_readable($fsPath)) {
                    $imgFileUrl = $urlPath;
                }
            }
?>
            
        <div class="col-md-4">
            <div class="card shadow h-100">
                <img src="<?php echo htmlspecialchars($imgFileUrl, ENT_QUOTES); ?>" class="card-img-top" style="height:280px; width:100%; object-fit:cover;" alt="<?php echo htmlspecialchars($t['name'], ENT_QUOTES); ?>" onerror="this.onerror=null;this.src='assets/images/trainers/default.jpg';">
                <div class="card-body text-center">
                    <h4><?php echo htmlspecialchars($t['name'], ENT_QUOTES); ?></h4>
                    <p class="text-muted"><?php echo htmlspecialchars($t['specialty'], ENT_QUOTES); ?></p>
                    <p>📞 <?php echo htmlspecialchars($t['phone'], ENT_QUOTES); ?></p>
                </div>
            </div>
        </div>
        <?php
        } // end while
    } else {
        ?>
        <div class="col-12 text-center">
            <div class="alert alert-warning">
                <h4>No Trainers Found</h4>
                <p>Add trainers from the admin panel.</p>
            </div>
        </div>
        <?php
    }
?>
  </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>