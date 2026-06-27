<?php
include 'includes/db.php';
include 'includes/auth.php';

if (!isLoggedIn() || !isAdmin()) {
    header("Location: dashboard.php");
    exit();
}

$id = intval($_GET['id']);

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $status = $_POST['status'];

    $stmt = $conn->prepare("UPDATE orders SET status=? WHERE id=?");
    $stmt->bind_param("si",$status,$id);

    if($stmt->execute()){
        header("Location: orders.php");
        exit();
    }
}

include 'includes/header.php';
include 'includes/navbar.php';
?>

<div class="container mt-5">

<div class="card shadow">

<div class="card-header bg-primary text-white">

<h3>Update Order Status</h3>

</div>

<div class="card-body">

<form method="POST">

<div class="mb-3">

<label>Status</label>

<select name="status" class="form-select">

<option>Pending</option>
<option>Processing</option>
<option>Delivered</option>
<option>Cancelled</option>

</select>

</div>

<button class="btn btn-success">

Save

</button>

<a href="orders.php" class="btn btn-secondary">

Back

</a>

</form>

</div>

</div>

</div>

<?php include 'includes/footer.php'; ?>