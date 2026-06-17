<?php
include 'auth.php';
include 'db.php';

if (!isLoggedIn() || !isAdmin()) {
    die("Access denied");
}

$result = mysqli_query($conn, "SELECT * FROM members");
?>

<!DOCTYPE html>
<html>
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">

    <h2>Admin Dashboard</h2>

    <table class="table table-dark table-striped mt-3">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Plan</th>
            <th>Role</th>
        </tr>

        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
            <tr>
                <td><?= $row['id'] ?></td>
                <td><?= $row['first_name'] ?></td>
                <td><?= $row['email'] ?></td>
                <td><?= $row['plan'] ?></td>
                <td><?= $row['role'] ?></td>
            </tr>
        <?php } ?>

    </table>

</div>

</body>
</html>