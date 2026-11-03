<?php

include("db.php");
session_start();



if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

/* Add product */

if (isset($_GET['add'])) {

    $product_id = $_GET['add'];

    $check = mysqli_query(
        $conn,
        "SELECT * FROM cart
         WHERE user_id='$user_id'
         AND product_id='$product_id'"
    );

    if (mysqli_num_rows($check) == 0) {

        mysqli_query(
            $conn,
            "INSERT INTO cart (user_id, product_id, quantity)
             VALUES ('$user_id', '$product_id', 1)"
        );

    }

    header("Location: cart.php");
    exit();
}

/* Remove */

if (isset($_GET['remove'])) {

    $cart_id = $_GET['remove'];

    mysqli_query(
        $conn,
        "DELETE FROM cart
         WHERE id='$cart_id'
         AND user_id='$user_id'"
    );

    header("Location: cart.php");
    exit();
}

?>

<!DOCTYPE html>
<html>

<head>

<title>Shopping Cart</title>

<link rel="stylesheet" href="style.css">

</head>

<body>

<header>

<h1>Shopping Cart</h1>

<nav>
<a href="index.php">Home</a>
<a href="product.php">Products</a>
<a href="orders.php">My Orders</a>
<a href="logout.php">Logout</a>
</nav>

</header>

<div class="container">

<h2>My Cart</h2>

<?php

$sql = "SELECT cart.id AS cart_id,
               product.name,
               product.price,
               cart.quantity
        FROM cart
        JOIN product
        ON cart.product_id = product.id
        WHERE cart.user_id='$user_id'";

$result = mysqli_query($conn, $sql);

$total = 0;

if (mysqli_num_rows($result) > 0) {

    while ($row = mysqli_fetch_assoc($result)) {

        $subtotal = $row['price'] * $row['quantity'];

        $total += $subtotal;

?>

<div class="cart-item">

<h3><?php echo $row['name']; ?></h3>

<p>Price: &#8377;<?php echo $row['price']; ?></p>

<p>Quantity: <?php echo $row['quantity']; ?></p>

<p>Subtotal: &#8377;<?php echo $subtotal; ?></p>

<a class="delete"
href="cart.php?remove=<?php echo $row['cart_id']; ?>">
Remove
</a>

</div>

<?php

    }

?>

<h2>Total: &#8377;<?php echo $total; ?></h2>

<a class="button" href="checkout.php">
Checkout
</a>

<?php

} else {

echo "<p>Your cart is empty.</p>";

}

?>

</div>

</body>
</html>