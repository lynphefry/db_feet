<?php
include 'includes/auth.php';
include 'includes/db.php';
include 'includes/header.php';
include 'includes/navbar.php';

if(!isLoggedIn()){
    header("Location: login.php");
    exit();
}

if(!isset($_GET['plan']) || !isset($_GET['price'])){
    header("Location: membership.php");
    exit();
}

$plan = $_GET['plan'];
$price = (int)$_GET['price'];
?>

<div class="container mt-5">

<div class="row justify-content-center">

<div class="col-md-6">

<div class="card shadow">

<div class="card-header bg-success text-white">

<h3>Membership Payment</h3>

</div>

<div class="card-body">

<h4 class="text-center">

<?php echo htmlspecialchars($plan); ?> Membership

</h4>

<hr>

<p>

<strong>Plan:</strong>

<?php echo htmlspecialchars($plan); ?>

</p>

<p>

<strong>Amount:</strong>

Ksh <?php echo number_format($price); ?>

</p>

<form method="POST" action="membership_stk_push.php">

<input type="hidden"
name="plan"
value="<?php echo htmlspecialchars($plan); ?>">

<input type="hidden"
name="amount"
value="<?php echo $price; ?>">

<div class="mb-3">

<label>M-Pesa Phone Number</label>

<input
type="text"
name="phone"
class="form-control"
placeholder="2547XXXXXXXX"
required>

</div>

<button class="btn btn-success w-100">

Pay with M-Pesa

</button>

</form>

</div>

</div>

</div>

</div>

</div>

<?php include 'includes/footer.php'; ?>