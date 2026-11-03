<?php

session_start();

include("db.php");

$result = mysqli_query($conn, "SELECT * FROM product");

?>

<!DOCTYPE html>
<html>
<head>

     <meta charset="UTF-8">
    <title>Product</title>

    <link rel="stylesheet" href="style.css">

</head>

<body>

<header>

<h1>Online Shopping</h1>

<nav>
    <a href="index.php">Home</a>
    <a href="product.php">Product</a>
    <a href="cart.php">Cart</a>
</nav>

</header>

<div class="container">

<h2>Our Products</h2>

<div class="product">

<?php

while ($row = mysqli_fetch_assoc($result)) {

?>

<div class="product">

    <img src="images/<?php echo $row['Image']; ?>">

    <h3><?php echo $row['Name']; ?></h3>

    <p><?php echo $row['description']; ?></p>

    <h3>&#8377;<?php echo $row['Price']; ?></h3>

    <?php

    if (isset($_SESSION['user_id'])) {

    ?>

        <a class="button"
           href="cart.php?add=<?php echo $row['id']; ?>">
           Add to Cart
        </a>

    <?php

    } else {

    ?>

        <a class="button" href="login.php">
            Login to Buy
        </a>

    <?php

    }

    ?>

</div>

<?php

}

?>

</div>

</div>

</body>
</html>