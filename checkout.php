<?php

include 'db.php';
include 'auth.php';

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

if (empty($_SESSION['cart'])) {
    echo "<div class='container mt-5'><div class='alert alert-warning'>Your cart is empty</div></div>";
    exit;
}

$total = 0;
foreach ($_SESSION['cart'] as $item) {
    $total += (float)$item['price'];
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Checkout</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

<?php include 'navbar.php'; ?>

<div class="container mt-5">

    <h2>Checkout</h2>

    <div class="card p-3">

        <h4>Total: KES <?= $total ?></h4>

        <form method="POST" action="stk_push.php">

            <input type="hidden" name="amount" value="<?= $total ?>">

            <input type="text"
                   name="phone"
                   class="form-control mb-3"
                   placeholder="Enter M-Pesa number (2547XXXXXXXX)"
                   required>

            <button type="submit" class="btn btn-success w-100">
                Pay with M-Pesa
            </button>

        </form>

    </div>

</div>

</body>
</html>