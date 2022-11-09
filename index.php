<?php
session_start();
include 'loggedin2.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Log in - Exemplar Healthcare</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="details-form">
        <img src="images/logo.png" alt="logo">
        <form action="verify.php" method="POST">
            <input name="email" type="email" placeholder="Email" required>
            <br><br>
            <input type="password" name="password" required placeholder="Password">
            <br><br>
            <input type="submit" name="login" id="login" value="Log in">
            <br><br>
        </form>
        <a href="ResetPassword.php">Forgoten yout Password?</a>
    </div>
</body>
</html>