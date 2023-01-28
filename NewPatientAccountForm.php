<?php
session_start();
include 'loggedin.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Register - Exemplar Healthcare</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Ubuntu:wght@500&display=swap');
    </style>
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
            <input type="submit" name="Register" id="Register" value="Register">
        </form>
    </div>
    <?php

    include 'connect_to_db.php';


if(isset($_POST['Register'])) {
    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $email = $_POST['email'];
    $dob = $_POST['dob'];
    $pword = $_POST['password'];
    $hashed_pword = password_hash($pword, PASSWORD_DEFAULT);
    $sex = $_POST['sex'];


    $sql_query = "INSERT INTO patient(Pword, Fname, Surname, EmailAddress, DateofBirth, Sex) VALUES(?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql_query);
        $stmt->bind_param("ssssss", $hashed_pword, $name, $surname, $email, $dob, $sex);
        $stmt->execute();

    if($stmt->affected_rows > 0){
        $conn->close();
        header('Location: home.php');
        exit();
    } else{
        $conn->close();
        // Operation failed message
        exit();
    }

    }


?>
</body>
</html>