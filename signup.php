<?php
session_start();
include 'loggedin2.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Register - Springfield General Hospital </title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="details-form">
        <h1>Springfield General Hospital</h1>
        <form action="addpatient.php" method="POST">
            <input name="name" type="text" placeholder="Name" required>
            <input name="surname" type="text" placeholder="Surname" required>
            <br><br>
            <input name="email" type="email" placeholder="Email" required>
            <input name="dob" type="date" placeholder="Date Of Birth" max="2023-12-31" required>
            <br><br>
            <input type="password" name="password" required placeholder="Password">
            <label for="sex">Sex:</label>
            <select name="sex" id="sex" required >
                <option value="male">Male</option>
                <option value="female">Female</option>
            </select>
            <br><br>
            <input type="submit" name="Register" id="Register" value="Register">
        </form>
    </div>
    <div class="details-form">
        <p class="register">Already have an account? <a class="register" href="index.php">Log in</a></p>
    </div>
</body>
</html>