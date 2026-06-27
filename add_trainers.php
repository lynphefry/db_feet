<?php
include 'includes\db.php';
include 'includes\auth.php';

if (!isAdmin()) {
    header("Location: trainers.php");
    exit();
}

$message = "";

if (isset($_POST['add'])) {

    $name = trim($_POST['name']);
    $specialty = trim($_POST['specialty']);
    $phone = trim($_POST['phone']);

    $image = "";

    if (!empty($_FILES['image']['name'])) {

        $image = time() . "_" . basename($_FILES['image']['name']);

        move_uploaded_file(
            $_FILES['image']['tmp_name'],
            "assets/images/trainers/" . $image
        );
    }

    $stmt = $conn->prepare("INSERT INTO trainers(name, specialty, phone, image)
                            VALUES(?,?,?,?)");

    $stmt->bind_param("ssss", $name, $specialty, $phone, $image);

    if ($stmt->execute()) {
        $message = "<div class='alert alert-success'>Trainer added successfully.</div>";
    } else {
        $message = "<div class='alert alert-danger'>Failed to add trainer.</div>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>

<title>Add Trainer</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>

<div class="container mt-5">

<h2>Add Trainer</h2>

<?php echo $message; ?>

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
<input type="text" name="phone" class="form-control" required>
</div>

<div class="mb-3">
<label>Photo</label>
<input type="file" name="image" class="form-control" required>
</div>

<button name="add" class="btn btn-success">
Add Trainer
</button>

<a href="trainers.php" class="btn btn-secondary">
Back
</a>

</form>

</div>

</body>
</html>