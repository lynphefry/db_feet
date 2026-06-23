<?php
session_start();

$id = $_POST['id'];
$name = $_POST['name'];
$price = $_POST['price'];

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

$_SESSION['cart'][] = [
    'id' => $id,
    'name' => $name,
    'price' => $price
];

header("Location: cart.php");
exit;
?>