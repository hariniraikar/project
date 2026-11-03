
<?php
session_start();
include("db.php");

// Check customer login
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Fetch only the logged-in customer's orders
$sql = "SELECT orders.*,
               product.name AS product
        FROM orders
        JOIN product
        ON orders.product_id = product.id
        WHERE orders.user_id = ?
        ORDER BY orders.id DESC";

$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "i", $user_id);
mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);
?>

<!DOCTYPE html>
<html>
<head>
    <title>My Orders</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container">

    <h2>My Orders</h2>

    <?php if (mysqli_num_rows($result) > 0) { ?>

        <table>
            <tr>
                <th>Order ID</th>
                <th>Product</th>
                <th>Quantity</th>
                <th>Total</th>
                <th>Date</th>
            </tr>

            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo htmlspecialchars($row['product']); ?></td>
                    <td><?php echo $row['quantity']; ?></td>
                    <td>&#8377;<?php echo $row['total_amount']; ?></td>
                    <td><?php echo $row['order_date']; ?></td>
                </tr>
            <?php } ?>

        </table>

    <?php } else { ?>

        <p>You have not placed any orders yet.</p>

    <?php } ?>

    <br>
    <a href="customer.php">Back to Home</a>

</div>

</body>
</html>
