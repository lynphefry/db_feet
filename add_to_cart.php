<?php
session_start();

<<<<<<< HEAD
$id = $_POST['id'];
$name = $_POST['name'];
$price = $_POST['price'];

=======
>>>>>>> 0d80c0551d466af3f3ba7e168ec6fd78a4bde92d
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

<<<<<<< HEAD
$_SESSION['cart'][] = [
    'id' => $id,
    'name' => $name,
    'price' => $price
];

header("Location: cart.php");
=======
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $name = $_POST['name'];
    $price = $_POST['price'];

    $_SESSION['cart'][] = [
        'name' => $name,
        'price' => $price
    ];
}

header("Location: shop.php");
>>>>>>> 0d80c0551d466af3f3ba7e168ec6fd78a4bde92d
exit;
?>