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
    $serverAddress = "localhost";
    $serverUsername = "root";
    $serverPassword = "";
    $serverDB = "hospitalmanagementsystem";
    
    
    $connection = mysqli_connect($serverAddress, $serverUsername, $serverPassword, $serverDB);
    
    
    if(mysqli_connect_errno()) {
        die("Failed to connect".mysqli_connect_errno());
    }

    $sql_query = "SELECT PatientID, Fname, Surname, EmailAddress, DateofBirth, Sex FROM patient";

    $result = mysqli_query($connection, $sql_query);
    
    if(mysqli_num_rows($result)>0){
        echo("<table>");
        $first_row = true;
        while ($row = mysqli_fetch_assoc($result)) {
            if ($first_row) {
                $first_row = false;
                echo '<tr>';
                foreach($row as $key => $field) {
                    echo '<th>' . htmlspecialchars($key) . '</th>';
                }
                echo '</tr>';
            }
            echo '<tr>';
            foreach($row as $key => $field) {
                echo '<td>' . htmlspecialchars($field) . '</td>';
            }
            echo "<td><a href='BookAppointment2.php?id=".$row['PatientID']."'>Select Patient</a></td>";
            echo '</tr>';
            }
        echo("</table>");
        

    }
    ?>
</body>
</html>