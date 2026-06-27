<?php
include 'includes/db.php';
include 'includes/auth.php';

requireAdmin();

include 'includes/header.php';
include 'includes/navbar.php';

$result = $conn->query("
SELECT
orders.*,
members.first_name,
members.last_name
FROM orders
JOIN members
ON orders.user_id = members.id
ORDER BY order_date DESC
");
?>

<div class="container mt-5">

<div class="card shadow">

<div class="card-header bg-dark text-white">

<h3>Customer Orders</h3>

</div>

<div class="card-body">

<?php if($result->num_rows > 0){ ?>

<table class="table table-bordered table-striped">

<thead class="table-dark">

<tr>

<th>ID</th>
<th>Customer</th>
<th>Product</th>
<th>Qty</th>
<th>Total</th>
<th>Status</th>
<th>Date</th>
<th>Action</th>

</tr>

</thead>

<tbody>

<?php while($row = $result->fetch_assoc()){ ?>

<tr>

<td><?= $row['id']; ?></td>

<td>

<?= htmlspecialchars($row['first_name']." ".$row['last_name']); ?>

</td>

<td><?= htmlspecialchars($row['product_name']); ?></td>

<td><?= $row['quantity']; ?></td>

<td>Ksh <?= number_format($row['total']); ?></td>

<td>

<?php

if($row['status']=="Pending"){

echo "<span class='badge bg-warning'>Pending</span>";

}elseif($row['status']=="Paid"){

echo "<span class='badge bg-success'>Paid</span>";

}else{

echo "<span class='badge bg-secondary'>".$row['status']."</span>";

}

?>

</td>

<td><?= $row['order_date']; ?></td>

<td>

<a
href="update_order.php?id=<?= $row['id']; ?>"
class="btn btn-primary btn-sm">

Update

</a>

</td>

</tr>

<?php } ?>

</tbody>

</table>

<?php }else{ ?>

<div class="alert alert-info">

No orders found.

</div>

<?php } ?>

</div>

</div>

</div>

<?php include 'includes/footer.php'; ?>