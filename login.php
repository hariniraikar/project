<?php
include("db.php");
session_start();


$message = "";

if (isset($_POST['login'])) {

    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM user WHERE email='$email'";

    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) == 1) {

        $user = mysqli_fetch_assoc($result);

        if ($password == $user['Password']) {

            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['name'];

            header("Location: product.php");
            exit();

        } else {
            $message = "Wrong password.";
        }

    } else {
        $message = "User not found.";
    }
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

<header>
    <h1>Online Shopping</h1>
</header>

<div class="container">

<h2>Customer Login</h2>

<p class="error"><?php echo $message; ?></p>

<form method="POST">

    <label>Email</label>
    <input type="email" name="email" required>

    <label>Password</label>
    <input type="password" name="password" required>

    <input class="button" type="submit"
           name="login" value="Login">

</form>

</div>

</body>
</html>