<?php
session_start();
include 'loggedin.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Book an Appointment</title>
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
<div class="topnav" id="myTopnav">
        <a href="home.php">Home</a>
        <a href="profile.php">Profile</a>
        <a class='active' href="BookAppointment.php">Book an Appointment</a>
        <a href="show_conflicts.php">Show Conflicts</a>
        <a href="NewPatientAccountForm.php">Add Patient</a>
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
    <div class="BookAppointment">
    <div style="overflow-x:auto;">
    <h1>Choose Patient: </h1>
    <?php

    include 'connect_to_db.php';

    $stmt = $conn->prepare("SELECT PatientID, Fname, Surname, EmailAddress, DateofBirth, Sex FROM patient");
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0){
        echo("<table>");
        echo("<tr>");
        echo ("<th>Patient ID</th>");
        echo ("<th>Name</th>");
        echo ("<th>Surname</th>");
        echo ("<th>Email Address</th>");
        echo ("<th>Date of Birth</th>");
        echo ("<th>Sex</th>");
        echo("</tr>");
        while($row = $result->fetch_assoc()){
            echo "<tr>";
            echo "<td>".$row['PatientID']." </td>";
            echo "<td>".$row['Fname']." </td>";
            echo "<td>".$row['Surname']." </td>";
            echo "<td>".$row['EmailAddress']." </td>";
            echo "<td>".$row['DateofBirth']." </td>";
            echo "<td>".$row['Sex']."</td>";
            echo "<td><a href='http://localhost/projects/AdvancedHigherProject/BookAppointment2.php?id=".$row['PatientID']."'>Select</a></td>";
            echo "</tr>";
        }
    }
    $conn->close();
    ?>
    </div>
    </div>
</body>
</html>