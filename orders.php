<?php
include("db.php");

session_start();



if (!isset($_SESSION['admin'])) {
    header("Location: admin_login.php");
    exit();
}

$sql = "SELECT orders.*,
               user.name AS customer,
               user.email,
               product.name AS product
        FROM orders
        JOIN user
        ON orders.user_id = user.id
        JOIN product
        ON orders.product_id = product.id
        ORDER BY orders.id DESC";

$result = mysqli_query($conn, $sql);

?>

<!DOCTYPE html>
<html>

<head>

<title>Customer Orders</title>

<link rel="stylesheet" href="style.css">

</head>

<body>

<div class="container">

<h2>Customer Orders</h2>

<table>

<tr>
<th>Customer</th>
<th>Email</th>
<th>Product</th>
<th>Quantity</th>
<th>Total</th>
<th>Date</th>
</tr>

<?php

while ($row = mysqli_fetch_assoc($result)) {

?>

<tr>

<td><?php echo $row['customer']; ?></td>

<td><?php echo $row['email']; ?></td>

<td><?php echo $row['product']; ?></td>

<td><?php echo $row['quantity']; ?></td>

<td>&#8377;<?php echo $row['total_amount']; ?></td>

<td><?php echo $row['order_date']; ?></td>

</tr>

<?php

}

?>

</table>

<br>

<a href="add_product.php">Back to Admin</a>

</div>

</body>

</html>