<?php
include 'db.php';
include 'auth.php';

if (!isAdmin()) {
    header("Location: trainers.php");
    exit();
}

if (!isset($_GET['id'])) {
    header("Location: trainers.php");
    exit();
}

$id = intval($_GET['id']);

// Get trainer image
$stmt = $conn->prepare("SELECT image FROM trainers WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();

$result = $stmt->get_result();

if ($result->num_rows == 0) {
    header("Location: trainers.php");
    exit();
}

$trainer = $result->fetch_assoc();

// Delete image from folder
if (!empty($trainer['image'])) {

    $imagePath = "assets/images/trainers/" . $trainer['image'];

    if (file_exists($imagePath) && $trainer['image'] != "default.jpg") {
        unlink($imagePath);
    }
}

// Delete trainer
$delete = $conn->prepare("DELETE FROM trainers WHERE id = ?");
$delete->bind_param("i", $id);

if ($delete->execute()) {
    header("Location: trainers.php?deleted=1");
    exit();
} else {
    echo "<div class='alert alert-danger text-center mt-5'>
            Failed to delete trainer.
          </div>";
}

$delete->close();
$conn->close();
?>