<?php
session_start();

$cart = $_SESSION['cart'] ?? [];
$total = 0;

foreach ($cart as $item) {
    $total += $item['price'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Shopping Cart | FEET TO FIT</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

<div class="container mt-5">

    <h2 class="mb-4">Your Shopping Cart</h2>

    <?php if (empty($cart)) : ?>

        <div class="alert alert-warning">
            Your cart is empty.
        </div>

        <a href="shop.php" class="btn btn-primary">
            Continue Shopping
        </a>

    <?php else : ?>

        <table class="table table-bordered">

            <thead class="table-dark">
                <tr>
                    <th>Product</th>
                    <th>Price (KES)</th>
                    <th>Action</th>
                </tr>
            </thead>

            <tbody>

            <?php foreach ($cart as $index => $item) : ?>

                <tr>
                    <td><?= htmlspecialchars($item['name']) ?></td>
                    <td><?= number_format($item['price']) ?></td>

                    <td>
                        <a href="remove_from_cart.php?index=<?= $index ?>"
                           class="btn btn-danger btn-sm">
                            Remove
                        </a>
                    </td>
                </tr>

            <?php endforeach; ?>

            </tbody>

        </table>

        <div class="card p-3">

            <h4>Total: KES <?= number_format($total) ?></h4>

            <div class="mt-3">

                <a href="shop.php" class="btn btn-secondary">
                    Continue Shopping
                </a>

                <a href="clear_cart.php" class="btn btn-warning">
                    Clear Cart
                </a>

                <a href="checkout.php" class="btn btn-success">
                    Checkout
                </a>

            </div>

        </div>

    <?php endif; ?>

</div>

</body>
</html>