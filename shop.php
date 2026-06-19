<?php

include 'auth.php';

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Shop | FEET TO FIT</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">

        <a class="navbar-brand" href="index.php">FEET TO FIT</a>

        <div class="navbar-nav ms-auto">
            <a class="nav-link" href="index.php">Home</a>
            <a class="nav-link" href="trainers.php">Trainers</a>
            <a class="nav-link" href="classes.php">Classes</a>
            <a class="nav-link" href="schedule.php">Schedule</a>
            <a class="nav-link" href="membership.php">Membership</a>
            <a class="nav-link active" href="shop.php">Shop</a>
            <a class="nav-link" href="contact.php">Contact</a>
        </div>

    </div>
</nav>

<div class="container mt-5">

    <h2 class="text-center mb-4">Fitness Shop</h2>
    <p class="text-center text-muted mb-4">
        Gym products and accessories
    </p>

    <!-- CART SECTION -->
    <div class="card p-3 mb-4 shadow-sm">

        <h4>Your Cart</h4>

        <?php
        $total = 0;

        if (!empty($_SESSION['cart'])) {

            foreach ($_SESSION['cart'] as $item) {
                echo "<div class='d-flex justify-content-between border-bottom py-1'>";
                echo "<span>{$item['name']}</span>";
                echo "<strong>Ksh {$item['price']}</strong>";
                echo "</div>";

                $total += $item['price'];
            }

            echo "<hr>";
            echo "<h5>Total: Ksh $total</h5>";
            echo "<a href='checkout.php' class='btn btn-primary mt-2'>Checkout</a>";

        } else {
            echo "<p class='text-muted'>Cart is empty</p>";
        }
        ?>

    </div>


    <!-- PRODUCTS -->
    <div class="row g-4">

        <!-- PRODUCT 1 -->
        <div class="col-md-3">
            <div class="card shadow h-100">
                <img src="assets/images/black gym outfit.jpg" class="card-img-top" style="height:220px; object-fit:cover;">
                <div class="card-body text-center">
                    <h5>Men Training Outfit</h5>
                    <p>Ksh 3,500</p>

                    <form method="POST" action="add_to_cart.php">
                        <input type="hidden" name="name" value="Men Training Outfit">
                        <input type="hidden" name="price" value="3500">
                        <button class="btn btn-success">Add to Cart</button>
                    </form>

                </div>
            </div>
        </div>

        <!-- PRODUCT 2 -->
        <div class="col-md-3">
            <div class="card shadow h-100">
                <img src="assets/images/women gym outfit.jpg" class="card-img-top" style="height:220px; object-fit:cover;">
                <div class="card-body text-center">
                    <h5>Women Training Outfit</h5>
                    <p>Ksh 4,000</p>

                    <form method="POST" action="cart.php">
                        <input type="hidden" name="name" value="Women Training Outfit">
                        <input type="hidden" name="price" value="4000">
                        <button class="btn btn-success">Add to Cart</button>
                    </form>

                </div>
            </div>
        </div>

        <!-- PRODUCT 3 -->
        <div class="col-md-3">
            <div class="card shadow h-100">
                <img src="assets/images/short gym outfit.jpg" class="card-img-top" style="height:220px; object-fit:cover;">
                <div class="card-body text-center">
                    <h5>Gym Shorts</h5>
                    <p>Ksh 1,200</p>

                    <form method="POST" action="cart.php">
                        <input type="hidden" name="name" value="Gym Shorts">
                        <input type="hidden" name="price" value="1200">
                        <button class="btn btn-success">Add to Cart</button>
                    </form>

                </div>
            </div>
        </div>

        <!-- PRODUCT 4 -->
        <div class="col-md-3">
            <div class="card shadow h-100">
                <img src="assets/images/men gym outfit.jpg" class="card-img-top" style="height:220px; object-fit:cover;">
                <div class="card-body text-center">
                    <h5>Gym Bag</h5>
                    <p>Ksh 2,000</p>

                    <form method="POST" action="cart.php">
                        <input type="hidden" name="name" value="Gym Bag">
                        <input type="hidden" name="price" value="2000">
                        <button class="btn btn-success">Add to Cart</button>
                    </form>

                </div>
            </div>
        </div>

    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>