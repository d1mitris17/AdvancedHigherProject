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
    <script defer src="form_validation_NewPatientAccountForm.js"></script>
</head>
<body>

<div class="topnav" id="myTopnav">
        <a href="home.php">Home</a>
        <a href="profile.php">Profile</a>
        <a href="BookAppointment.php">Book an Appointment</a>
        <a href="show_conflicts.php">Show Conflicts</a>
        <a class='active' href="NewPatientAccountForm.php">Add Patient</a>
        <a href="NewStaffForm.php">Add Hospital Staff</a>
        <a href="signout.php">Sign Out</a>
        <a href="javascript:void(0);" class="icon" onclick="myFunction()">
        <i class="fa fa-bars"></i>
        </a>
    </div>


    <script type="text/javascript">
        function myFunction() {
            var x = document.getElementById("myTopnav");
            if (x.className === "topnav") {
                x.className += " responsive";
            } else {
                x.className = "topnav";
            }
    }
    </script> 
    
    <div class="addEntry">
        <div class="container">
        <form action="NewPatientAccountForm.php" method="POST" id="form">
            <input name="name" type="text" placeholder="Name" id="name">
            <input name="surname" type="text" placeholder="Surname" id="surname">
            <br><br>
            <input name="email" type="email" placeholder="Email" id="email">
            <input name="dob" type="date" placeholder="Date Of Birth" max="2023-12-31" id="dob">
            <br><br>
            <input type="password" name="password" id="password" placeholder="Password">
            <br><br>
            <label for="sex">Sex:</label>
            <select name="sex" id="sex" id="sex" >
                <option value="Male">Male</option>
                <option value="Female">Female</option>
            </select>
            <br><br>
            <input type="submit" name="Register" id="Register" value="Register">
        </form>
        
    </div>
    <div id="error"></div>
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