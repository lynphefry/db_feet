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

    
    $imageName = $_FILES['image']['name'];
    $tmpName = $_FILES['image']['tmp_name'];
    $folder = "assets/images/" . $imageName;

    move_uploaded_file($tmpName, $folder);

    $stmt = $conn->prepare("INSERT INTO trainers (name, specialty, phone, image) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $name, $specialty, $phone, $imageName);
    $stmt->execute();

    header("Location: trainers.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="assets/style.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">

<h2>Add Trainer</h2>

<form method="POST" enctype="multipart/form-data">

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

    <div class="mb-3">
        <label>Trainer Image</label>
        <input type="file" name="image" class="form-control" required>
    </div>

    <button class="btn btn-primary">Add Trainer</button>

</form>

</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>