<?php

session_start();

include("db.php");

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

if (isset($_POST['place_order'])) {

    $sql = "SELECT cart.product_id,
                   cart.quantity,
                   product.price
            FROM cart
            JOIN product
            ON cart.product_id = product.id
            WHERE cart.user_id='$user_id'";

    $result = mysqli_query($conn, $sql);

    while ($row = mysqli_fetch_assoc($result)) {

        $total = $row['price'] * $row['quantity'];

        mysqli_query(
            $conn,
            "INSERT INTO orders
            (user_id, product_id, quantity, total_amount)
            VALUES
            ('$user_id',
             '{$row['product_id']}',
             '{$row['quantity']}',
             '$total')"
        );
    }

    mysqli_query(
        $conn,
        "DELETE FROM cart WHERE user_id='$user_id'"
    );

    echo "<h2>Order placed successfully!</h2>";

    echo "<a href='orders.php'>View My Orders</a>";
}

?>

<!DOCTYPE html>

<html>

<head>

<title>Checkout</title>

<link rel="stylesheet" href="style.css">

</head>

<body>

<div class="container">

<h2>Checkout</h2>

<form method="POST">

<input class="button"
       type="submit"
       name="place_order"
       value="Place Order">

</form>

</div>

</body>

</html>