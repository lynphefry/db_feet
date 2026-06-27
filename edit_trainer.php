<?php
include 'includes\db.php';
include 'includes\auth.php';

if (!isAdmin()) {
    header("Location: trainers.php");
    exit();
}

if (!isset($_GET['id'])) {
    header("Location: trainers.php");
    exit();
}

$id = intval($_GET['id']);

$stmt = $conn->prepare("SELECT * FROM trainers WHERE id=?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 0) {
    die("Trainer not found.");
}

$trainer = $result->fetch_assoc();

$message = "";

if (isset($_POST['update'])) {

    $name = trim($_POST['name']);
    $specialty = trim($_POST['specialty']);
    $phone = trim($_POST['phone']);

    $image = $trainer['image'];

    // Upload new image if selected
    if (!empty($_FILES['image']['name'])) {

        // Delete old image
        if (!empty($trainer['image']) &&
            file_exists("assets/images/trainers/" . $trainer['image'])) {

            unlink("assets/images/trainers/" . $trainer['image']);
        }

        $image = time() . "_" . basename($_FILES['image']['name']);

        move_uploaded_file(
            $_FILES['image']['tmp_name'],
            "assets/images/trainers/" . $image
        );
    }

    $update = $conn->prepare("
        UPDATE trainers
        SET name=?, specialty=?, phone=?, image=?
        WHERE id=?
    ");

    $update->bind_param(
        "ssssi",
        $name,
        $specialty,
        $phone,
        $image,
        $id
    );

    if ($update->execute()) {

        header("Location: trainers.php");
        exit();

    } else {

        $message = "<div class='alert alert-danger'>
                        Failed to update trainer.
                    </div>";
    }
}
?>

<!DOCTYPE html>
<html>

<head>

<title>Edit Trainer</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>

<div class="container mt-5">

<div class="card shadow">

<div class="card-header bg-warning">

<h3>Edit Trainer</h3>

</div>

<div class="card-body">

<?php echo $message; ?>

<form method="POST" enctype="multipart/form-data">

<div class="mb-3">

<label>Name</label>

<input
type="text"
name="name"
class="form-control"
value="<?php echo htmlspecialchars($trainer['name']); ?>"
required>

</div>

<div class="mb-3">

<label>Specialty</label>

<input
type="text"
name="specialty"
class="form-control"
value="<?php echo htmlspecialchars($trainer['specialty']); ?>"
required>

</div>

<div class="mb-3">

<label>Phone</label>

<input
type="text"
name="phone"
class="form-control"
value="<?php echo htmlspecialchars($trainer['phone']); ?>"
required>

</div>

<div class="mb-3">

<label>Current Photo</label><br>

<img
src="assets/images/trainers/<?php echo htmlspecialchars($trainer['image']); ?>"
width="180"
class="img-thumbnail">

</div>

<div class="mb-3">

<label>Change Photo (Optional)</label>

<input
type="file"
name="image"
class="form-control">

</div>

<button
name="update"
class="btn btn-warning">

Update Trainer

</button>

<a
href="trainers.php"
class="btn btn-secondary">

Cancel

</a>

</form>

</div>

</div>

</div>

</body>
</html>