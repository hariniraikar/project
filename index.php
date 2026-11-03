<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Online Shopping</title>
    <link rel="stylesheet" href="style.css">
    <style type="text/css">
<!--
.style1 {
	color: #0033FF;
	font-style: italic;
}
.style2 {
	color: #000000;
	font-weight: bold;
}
body {
	background-color: #FFFFFF;
}
.style4 {color: #0000CC}
-->
    </style>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"></head>

<body>

<header>
    <h1><span class="style4"></span>Online Shopping Management System</h1>

    <nav>
        <a href="index.php">Home</a>
		<a href="register.php">Register</a>
            <a href="login.php">Login</a>
        <a href="product.php">Product</a>

        <?php
        if (isset($_SESSION['user_id'])) {
        ?>
            <a href="cart.php">Cart</a>
            <a href="my_orders.php">My Orders</a>
            <a href="logout.php">Logout</a>
        
        <?php
        }
        ?>
    </nav>
</header>

<div class="container">

    <h2 class="style1">Welcome to Our Online Shop</h2>

    <p><span class="style2">Shop your favourite products easily and conveniently</span>.</p>

    <a class="button" href="product.php">View Product</a>

</div>

</body>
</html>
