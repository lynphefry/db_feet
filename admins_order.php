<?php
include 'db.php';
include 'auth.php';

$result = mysqli_query($conn,
"SELECT orders.*, members.first_name
FROM orders
LEFT JOIN members ON orders.user_id = members.id
ORDER BY orders.id DESC");
?>

<h2>All Orders</h2>

<table class="table table-bordered">
<tr>
    <th>User</th>
    <th>Total</th>
    <th>Date</th>
</tr>

<?php while($row = mysqli_fetch_assoc($result)) { ?>
<tr>
    <td><?= $row['first_name'] ?></td>
    <td><?= $row['total'] ?></td>
    <td><?= $row['created_at'] ?></td>
</tr>
<?php } ?>

</table>