<?php

include("db.php");
session_start();



if (!isset($_SESSION['admin'])) {
    header("Location: admin.php");
    exit();
}

$message = "";

if (isset($_POST['add'])) {

    $name = $_POST['name'];
    $price = $_POST['price'];
    $description = $_POST['description'];

    $image = $_FILES['image']['name'];

    $target = "images/" . $image;

    move_uploaded_file(
        $_FILES['image']['tmp_name'],
        $target
    );

    $sql = "INSERT INTO product
            (name, price, description, image)
            VALUES
            ('$name', '$price', '$description', '$image')";

    if (mysqli_query($conn, $sql)) {
        $message = "Product added successfully!";
    }
}

?>

<!DOCTYPE html>
<html>

<head>

<title>Add Product</title>

<link rel="stylesheet" href="style.css">
<style type="text/css">
<!--
.style1 {
	color: #0000FF;
	font-style: italic;
	font-size: 24px;
}
-->
</style>
</head>

<body>

<div class="container">

<h2 align="center" class="style1">Add Product</h2>

<p align="center" class="message">
<?php echo $message; ?></p>

<form method="POST" enctype="multipart/form-data">

<label><strong>Product Name</strong></label>

<strong>
<input type="text" name="name" required>
</strong>

<label>Price</label>

<input type="number" name="price" required>

<label>Description</label>

<textarea name="description" required></textarea>

<label>Product Photo</label>

<label></label>

<input type="file" name="image" required>

<input class="button"
       type="submit"
       name="add"
       value="Add Product">
</form>

<br>

<a href="view_products.php">View Product</a>

<br><br>

<a href="orders.php">View Orders</a></div>

</body>

</html>
