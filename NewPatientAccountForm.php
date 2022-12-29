<?php
session_start();
include 'loggedin.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Register - Exemplar Healthcare</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <ul class="nav-bar">
        <li><a href="home.php"><img src="images/logo.png" alt="logo"></a></li>
        <li><a id="link" href="profile.php">Profile</a></li>
        <li><a id="link" href="BookAppointment.php">Book an Appointment</a></li>
        <li><a id="link" href="show_conflicts.php">Show Conflicts</a></li>
        <li><a id="link" href="NewPatientAccountForm.php">Add Patient</a></li>
        <li><a id="link" href="NewStaffForm.php">Add Hospital Staff</a></li>
        <li><a id="link" href="signout.php">Sign Out</a></li>
    </ul>  
<div class="details-form">
        <form action="NewPatientAccountForm.php" method="POST">
            <input name="name" type="text" placeholder="Name" required>
            <input name="surname" type="text" placeholder="Surname" required>
            <br><br>
            <input name="email" type="email" placeholder="Email" required>
            <input name="dob" type="date" placeholder="Date Of Birth" max="2023-12-31" required>
            <br><br>
            <input type="password" name="password" required placeholder="Password">
            <label for="sex">Sex:</label>
            <select name="sex" id="sex" required >
                <option value="Male">Male</option>
                <option value="Female">Female</option>
            </select>
            <br><br>
            <input type="hidden" name="table" value="patient">
            <input type="submit" name="Register" id="Register" value="Register">
        </form>
    </div>
    <?php

$serverAddress = "localhost";
$serverUsername = "root";
$serverPassword = "";
$serverDB = "hospitalmanagementsystem";


$connection = mysqli_connect($serverAddress, $serverUsername, $serverPassword, $serverDB);

if(mysqli_connect_errno()){
    die("Failed to connect".mysqli_connect_errno());
}


if(isset($_POST['Register'])) {
    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $email = $_POST['email'];
    $dob = $_POST['dob'];
    $pword = $_POST['password'];
    $hashed_pword = password_hash($pword, PASSWORD_DEFAULT);
    $sex = $_POST['sex'];


    $sql_query = "INSERT INTO patient(Pword, Fname, Surname, EmailAddress, DateofBirth, Sex) VALUES('$hashed_pword','$name','$surname','$email','$dob','$sex')";

    if(mysqli_query($connection, $sql_query)){
        mysqli_close($connection);
        header('Location: home.php');
    } else{
        mysqli_close($connection);
        header('Location: home.php');
    }

    }


?>
</body>
</html>