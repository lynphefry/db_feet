<?php
include 'includes/auth.php';

// User must be logged in
if (!isLoggedIn()) {
    header("Location: login.php");
    exit();
}

if (isset($_GET['index']) && is_numeric($_GET['index'])) {

    $index = (int)$_GET['index'];

    if (isset($_SESSION['cart'][$index])) {

        unset($_SESSION['cart'][$index]);

        // Re-index the array
        $_SESSION['cart'] = array_values($_SESSION['cart']);
    }
}

header("Location: shop.php");
exit();