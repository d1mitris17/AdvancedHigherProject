<?php
session_start();
include 'loggedin.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    
    <title>Book an Appointment</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<ul class="nav-bar">
        <li><a href="home.php"><img src="images/logo.png" alt="logo"></a></li>
        <li><a id="link" href="profile.php">Profile</a></li>
        <li><a id="link" href="BookAppointment.php">Book an Appointment</a></li>
        <li><a id="link" href="Prescriptions.php">Prescriptions</a></li>
        <li><a id="link" href="NewPatientAccountForm.php">Add Patient</a></li>
        <li><a id="link" href="NewStaffForm.php">Add Hospital Staff</a></li>
        <li><a id="link" href="signout.php">Sign Out</a></li>
    </ul>  
</body>
</html>