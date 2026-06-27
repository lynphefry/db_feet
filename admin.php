<?php
include 'includes/db.php';
include 'includes/auth.php';

requireAdmin();

include 'includes/header.php';
include 'includes/navbar.php';

// Statistics
$members = $conn->query("SELECT COUNT(*) AS total FROM members")->fetch_assoc()['total'];
$trainers = $conn->query("SELECT COUNT(*) AS total FROM trainers")->fetch_assoc()['total'];
$bookings = $conn->query("SELECT COUNT(*) AS total FROM bookings")->fetch_assoc()['total'];
$orders = $conn->query("SELECT COUNT(*) AS total FROM orders")->fetch_assoc()['total'];

// Members list
$result = $conn->query("
    SELECT id, first_name, last_name, email, role
    FROM members
    ORDER BY id DESC
");
?>

<div class="container mt-5">

    <h2 class="mb-4 text-center">Admin Dashboard</h2>

    <!-- Statistics -->
    <div class="row mb-4">

        <div class="col-md-3">
            <div class="card text-center shadow border-primary">
                <div class="card-body">
                    <h1><?= $members ?></h1>
                    <p>Total Members</p>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card text-center shadow border-success">
                <div class="card-body">
                    <h1><?= $trainers ?></h1>
                    <p>Trainers</p>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card text-center shadow border-warning">
                <div class="card-body">
                    <h1><?= $bookings ?></h1>
                    <p>Bookings</p>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card text-center shadow border-danger">
                <div class="card-body">
                    <h1><?= $orders ?></h1>
                    <p>Orders</p>
                </div>
            </div>
        </div>

    </div>

    <!-- Quick Actions -->
    <div class="mb-4">

        <a href="add_trainer.php" class="btn btn-success">
            Add Trainer
        </a>

        <a href="trainers.php" class="btn btn-primary">
            Trainers
        </a>

        <a href="booking.php" class="btn btn-warning">
            Bookings
        </a>

        <a href="orders.php" class="btn btn-info">
            Orders
        </a>

    </div>

    <!-- Members Table -->
    <div class="card shadow">

        <div class="card-header bg-dark text-white">
            Registered Members
        </div>

        <div class="card-body">

            <table class="table table-bordered table-striped">

                <thead class="table-dark">

                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Role</th>
                    </tr>

                </thead>

                <tbody>

                <?php while($row = $result->fetch_assoc()) { ?>

                    <tr>

                        <td><?= $row['id']; ?></td>

                        <td>
                            <?= htmlspecialchars($row['first_name'].' '.$row['last_name']); ?>
                        </td>

                        <td><?= htmlspecialchars($row['email']); ?></td>

                        <td><?= ucfirst($row['role']); ?></td>

                    </tr>

                <?php } ?>

                </tbody>

            </table>

        </div>

    </div>

</div>

<?php include 'includes/footer.php'; ?>