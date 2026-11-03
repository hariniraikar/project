<?php

session_start();

if (isset($_POST['login'])) {

    $username = $_POST['username'];
    $password = $_POST['password'];

    if ($username == "admin" && $password == "harini26") {

        $_SESSION['admin'] = true;

        header("Location: add_product.php");

        exit();

    } else {

        $message = "Invalid admin login.";

    }
}

?>

<!DOCTYPE html>
<html>

<head>

<title>Admin Login</title>

<link rel="stylesheet" href="style.css">

</head>

<body>

<div class="container">

<h2>Admin Login</h2>

<p class="error">
<?php
if (isset($message)) echo $message;
?>
</p>

<form method="POST">

<label>Username</label>

<input type="text" name="username" required>

<label>Password</label>

<input type="password" name="password" required>

<input class="button"
       type="submit"
       name="login"
       value="Login">

</form>

</div>

</body>

</html>