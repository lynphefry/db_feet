<?php
include 'includes/auth.php';

// User must be logged in
if (!isLoggedIn()) {
    header("Location: login.php");
    exit();
}

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (isset($_POST['name'], $_POST['price'])) {

        $name = trim($_POST['name']);
        $price = (float)$_POST['price'];

        $found = false;

        // If the product already exists, increase quantity
        foreach ($_SESSION['cart'] as &$item) {

            if ($item['name'] === $name) {

                $item['quantity']++;
                $found = true;
                break;
            }
        }

        unset($item);

        // New product
        if (!$found) {

            $_SESSION['cart'][] = [

                'name' => $name,
                'price' => $price,
                'quantity' => 1

            ];
        }
    }
}

header("Location: shop.php");
exit();
?>