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
        <li><a id="link" href="show_conflicts.php">Show Conflicts</a></li>
        <li><a id="link" href="NewPatientAccountForm.php">Add Patient</a></li>
        <li><a id="link" href="NewStaffForm.php">Add Hospital Staff</a></li>
        <li><a id="link" href="signout.php">Sign Out</a></li>
    </ul>  
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
        echo ("<th>1</th>");
        echo("</tr>");
        while($row = $result->fetch_assoc()){
            echo "<tr>";
            echo "<td>".$row['PatientID']."</td>";
            echo "<td>".$row['Fname']."</td>";
            echo "<td>".$row['Surname']."</td>";
            echo "<td>".$row['EmailAddress']."</td>";
            echo "<td>".$row['DateofBirth']."</td>";
            echo "<td>".$row['Sex']."</td>";
            echo "<td><a href='http://localhost/projects/AdvancedHigherProject/BookAppointment2.php?id=".$row['PatientID']."'>Select</a></td>";
            echo "</tr>";
        }
    }
    ?>

</body>
</html>