<?php
include 'includes/db.php';
include 'includes/auth.php';

if (!isLoggedIn()) {
    header("Location: login.php");
    exit();
}

include 'includes/header.php';
include 'includes/navbar.php';

$user_id = $_SESSION['user_id'];

$stmt = $conn->prepare("
    SELECT product_name, quantity, total_price, order_date
    FROM orders
    WHERE user_id = ?
    ORDER BY order_date DESC
");

$stmt->bind_param("i", $user_id);
$stmt->execute();

$result = $stmt->get_result();
?>

<div class="container mt-5">

    <div class="card shadow">

        <div class="card-header bg-primary text-white">

            <h3>My Orders</h3>

        </div>

        <div class="card-body">

            <table class="table table-striped table-bordered">

                <thead class="table-dark">

                    <tr>
                        <th>Product</th>
                        <th>Quantity</th>
                        <th>Total</th>
                        <th>Date</th>
                    </tr>

                </thead>

                <tbody>

                <?php if ($result->num_rows > 0) { ?>

                    <?php while ($row = $result->fetch_assoc()) { ?>

                        <tr>

                            <td><?= htmlspecialchars($row['product_name']) ?></td>

                            <td><?= $row['quantity'] ?></td>

                            <td>Ksh <?= number_format($row['total_price']) ?></td>

                            <td><?= $row['order_date'] ?></td>

                        </tr>

                    <?php } ?>

                <?php } else { ?>

                    <tr>

                        <td colspan="4" class="text-center">

                            You have not placed any orders yet.

                        </td>

                    </tr>

                <?php } ?>

                </tbody>

            </table>

        </div>

    </div>

</div>

<?php
$stmt->close();
include 'includes/footer.php';
?>