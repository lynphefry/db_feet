<?php
include 'includes/db.php';
include 'includes/auth.php';
include 'includes/header.php';
include 'includes/navbar.php';


if (!isAdmin()) {
    die("Access denied");
}

$users = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM users"));
$memberships = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM memberships"));
?>



<body class="bg-light">

<div class="container mt-5">

    <h1 class="fw-bold">Admin Dashboard</h1>
    <p class="text-muted">Manage FEET TO FIT System</p>

    <div class="row mt-4">

        <div class="col-md-6">
            <div class="card shadow border-0 text-center">
                <div class="card-body">
                    <h1><?= $users ?></h1>
                    <h5>Total Users</h5>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card shadow border-0 text-center">
                <div class="card-body">
                    <h1><?= $memberships ?></h1>
                    <h5>Total Memberships</h5>
                </div>
            </div>
        </div>

    </div>

    <div class="card shadow border-0 mt-4">

        <div class="card-header">
            Recent Members
        </div>

        <div class="card-body">

            <table class="table">

                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                </tr>

                <?php
                $result = mysqli_query($conn,"SELECT * FROM users ORDER BY id DESC LIMIT 10");

                while($row = mysqli_fetch_assoc($result)){
                    echo "
                    <tr>
                        <td>{$row['id']}</td>
                        <td>{$row['name']}</td>
                        <td>{$row['email']}</td>
                    </tr>";
                }
                ?>

            </table>

        </div>

    </div>

</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>