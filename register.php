<?php

include("db.php");

$message = "";

if (isset($_POST['register'])) {

    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "INSERT INTO user (name, email, password)
            VALUES ('$name', '$email', '$password')";

    if (mysqli_query($conn, $sql)) {
        $message = "Registration successful!";
    } else {
        $message = "Registration failed. Email may already exist.";
    }
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

<header>
    <h1>Online Shopping</h1>
</header>

<div class="container">

<h2>Customer Registration</h2>

<p class="message"><?php echo $message; ?></p>

<form method="POST">

    <label>Name</label>
    <input type="text" name="name" required>

    <label>Email</label>
    <input type="email" name="email" required>

    <label>Password</label>
    <input type="password" name="password" required>

    <input class="button" type="submit"
           name="register" value="Register">

</form>

</div>

</body>
</html>