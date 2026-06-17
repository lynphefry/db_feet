<?php
include 'db.php';
?>

<!DOCTYPE html>
<html>
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">

    <h2>Our Trainers</h2>

    <div class="row">

        <?php
        $result = mysqli_query($conn, "SELECT * FROM trainers");

        while ($t = mysqli_fetch_assoc($result)) {
        ?>

        <div class="col-md-4">
            <div class="card p-3 mb-3 shadow">

                <h4><?= htmlspecialchars($t['name']) ?></h4>
                <p>Specialty: <?= htmlspecialchars($t['specialty']) ?></p>
                <p>Phone: <?= htmlspecialchars($t['phone']) ?></p>

            </div>
        </div>

        <?php } ?>

    </div>

</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>