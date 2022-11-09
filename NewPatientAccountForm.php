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
<div class="nav-bar">
    <a href="home.php"><img src="images/logo.png" alt="logo"></a>
    <ul>
        <li><a href="profile.php">Profile</a></li>
        <li><a href="Appointments.php">Appointments</a></li>
        <li><a href="BookAppointment.php">Book an Appointment</a></li>
        <li><a href="Prescriptions.php">Prescriptions</a></li>
        <li><a href="NewPatientAccountForm.php">Add Patient</a></li>
        <li><a href="NewStaffForm.php">Add Hospital Staff</a></li>
        <li><a href="signout.php">Sign Out</a></li>
    </ul>    
    </div>
<div class="details-form">
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
                <option value="Male">Male</option>
                <option value="Female">Female</option>
            </select>
            <br><br>
            <input type="hidden" name="table" value="patient">
            <input type="submit" name="Register" id="Register" value="Register">
        </form>
    </div>
</body>
</html>