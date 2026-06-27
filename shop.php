<?php
include 'includes/db.php';
include 'includes/auth.php';
include 'includes/header.php';
include 'includes/navbar.php';

if (!isLoggedIn()) {
    header("Location: login.php");
    exit();
}
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}
?>


<div class="container mt-5">

    <h2 class="text-center mb-4">Fitness Shop</h2>
    <p class="text-center text-muted mb-4">
        Gym products and accessories
    </p>

    

        <h4>Your Cart</h4>

        <?php
        $total = 0;

        if (!empty($_SESSION['cart'])) {

          foreach ($_SESSION['cart'] as $index => $item) {

    echo "<div class='d-flex justify-content-between border-bottom py-2'>";

    echo "<span>" . htmlspecialchars($item['name']) . "</span>";

    echo "<div>";
    echo "<strong>Ksh " . number_format($item['price']) . "</strong> ";

    echo "<a href='remove_from_cart.php?index=$index'
            class='btn btn-danger btn-sm ms-2'
            onclick=\"return confirm('Remove this item?')\">
            Remove
          </a>";

    echo "</div>";
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


    
    <div class="row g-4">

        
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

        
        <div class="col-md-3">
            <div class="card shadow h-100">
                <img src="assets/images/women gym outfit.jpg" class="card-img-top" style="height:220px; object-fit:cover;">
                <div class="card-body text-center">
                    <h5>Women Training Outfit</h5>
                    <p>Ksh 4,000</p>

                  <form method="POST" action="add_to_cart.php">
                        <input type="hidden" name="name" value="Women Training Outfit">
                        <input type="hidden" name="price" value="4000">
                        <button class="btn btn-success">Add to Cart</button>
                    </form>

                </div>
            </div>
        </div>

        
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

        
        <div class="col-md-3">
            <div class="card shadow h-100">
                <img src="assets/images/men gym outfit.jpg" class="card-img-top" style="height:220px; object-fit:cover;">
                <div class="card-body text-center">
                    <h5>Gym Bag</h5>
                    <p>Ksh 2,000</p>
<form method="POST" action="add_to_cart.php">
                        <input type="hidden" name="name" value="Gym Bag">
                        <input type="hidden" name="price" value="2000">
                        <button class="btn btn-success">Add to Cart</button>
                    </form>

                </div>
            </div>
        </div>

    </div>

</div>

<?php include 'includes/footer.php'; ?>