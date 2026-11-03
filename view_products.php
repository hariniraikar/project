
<?php
session_start();

include("db.php");

// Only admin can manage products
if (!isset($_SESSION['admin'])) {
    header("Location: admin_login.php");
    exit();
}

$message = "";

// Delete product
if (isset($_POST['delete_product'])) {

    $product_id = (int) $_POST['product_id'];

    // Remove the product from carts first
    mysqli_query(
        $conn,
        "DELETE FROM cart WHERE product_id = $product_id"
    );

    // Delete the product
    $delete = mysqli_query(
        $conn,
        "DELETE FROM product WHERE id = $product_id"
    );

    if ($delete && mysqli_affected_rows($conn) > 0) {
        $message = "Product deleted successfully!";
    } else {
        $message = "Product could not be deleted. It may be linked to an order.";
    }
}

// Get all products
$result = mysqli_query(
    $conn,
    "SELECT * FROM product ORDER BY id DESC"
);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Manage Products</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

<header>
    <h1>Manage Products</h1>

    <nav>
        <a href="add_product.php">Add Product</a>
        <a href="view_products.php">Manage Products</a>
        <a href="orders.php">View Orders</a>
        <a href="admin_login.php">Admin Login</a>
    </nav>
</header>

<div class="container">

    <h2>Manage Your Products</h2>

    <p class="message">
        <?php echo htmlspecialchars($message); ?>
    </p>

    <a class="button" href="add_product.php">
        + Add New Product
    </a>

    <div class="products">

    <?php if ($result && mysqli_num_rows($result) > 0) { ?>

        <?php while ($row = mysqli_fetch_assoc($result)) { ?>

            <div class="product">

                <img
                    src="images/<?php echo htmlspecialchars($row['Image']); ?>"
                    alt="<?php echo htmlspecialchars($row['Name']); ?>"
                >

                <h3>
                    <?php echo htmlspecialchars($row['Name']); ?>
                </h3>

                <h3>
                    &#8377;<?php echo htmlspecialchars($row['Price']); ?>
                </h3>

                <p>
                    <?php echo htmlspecialchars($row['description']); ?>
                </p>

                <form method="POST"
                      onsubmit="return confirm('Are you sure you want to delete this product?');">

                    <input type="hidden"
                           name="product_id"
                           value="<?php echo (int) $row['id']; ?>">

                    <button type="submit"
                            name="delete_product"
                            class="delete">
                        Delete Product
                    </button>

                </form>

            </div>

        <?php } ?>

    <?php } else { ?>

        <p>No products available.</p>

    <?php } ?>

    </div>

    <p>
        <a href="add_product.php">Add Another Product</a>
    </p>

</div>

</body>
</html>
