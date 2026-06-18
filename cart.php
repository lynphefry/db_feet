<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

$name = $_POST['name'];
$price = $_POST['price'];

$_SESSION['cart'][] = [
    'name' => $name,
    'price' => $price
];

header("Location: shop.php");
exit;
?>