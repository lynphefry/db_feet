<?php


if (isset($_GET['index'])) {

    $index = (int)$_GET['index'];

    if (isset($_SESSION['cart'][$index])) {
        unset($_SESSION['cart'][$index]);

        // Re-index array
        $_SESSION['cart'] = array_values($_SESSION['cart']);
    }
}

header("Location: shop.php");
exit;