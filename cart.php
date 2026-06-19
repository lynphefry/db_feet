<?php
session_start();

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

$total = 0;

foreach ($_SESSION['cart'] as $index => $item) {
    echo "<div class='d-flex justify-content-between align-items-center border-bottom py-2'>";

    echo "<div>";
    echo "<strong>{$item['name']}</strong><br>";
    echo "Ksh {$item['price']}";
    echo "</div>";

    // REMOVE BUTTON
    echo "
    <form method='POST' action='remove.php'>
        <input type='hidden' name='index' value='$index'>
        <button class='btn btn-danger btn-sm'>Remove</button>
    </form>
    ";

    echo "</div>";

    $total += $item['price'];
}

echo "<hr>";
echo "<h4>Total: Ksh $total</h4>";
?>