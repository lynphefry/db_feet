<?php
include 'db.php';
include 'auth.php';

if (!isLoggedIn() || !isAdmin()) {
    die("Access denied");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = $_POST['name'];
    $specialty = $_POST['specialty'];
    $phone = $_POST['phone'];

    mysqli_query($conn, "INSERT INTO trainers (name, specialty, phone)
    VALUES ('$name', '$specialty', '$phone')");

    echo "Trainer added successfully!";
}
?>

<!DOCTYPE html>
<html>
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets\style.css">
</head>
<body>

<div class="container mt-5">

    <h2>Add Trainer</h2>

    <form method="POST">

        <div class="mb-3">
            <label>Name</label>
            <input type="text" name="name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Specialty</label>
            <input type="text" name="specialty" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Phone</label>
            <input type="text" name="phone" class="form-control">
        </div>

        <button class="btn btn-primary">Add Trainer</button>

    </form>

</div>
<div class="container mt-5">

    <h2>Our Trainers</h2>

    <div class="row">

        <?php
        $result = mysqli_query($conn, "SELECT * FROM trainers");

        while ($t = mysqli_fetch_assoc($result)) {
        ?>

        <div class="col-md-4">
            <div class="card p-3 mb-3 shadow">

                <h4><?= $t['name'] ?></h4>
                <p>Specialty: <?= $t['specialty'] ?></p>
                <p>Phone: <?= $t['phone'] ?></p>

            </div>
        </div>

        <?php } ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>