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
    <div class="details-form">
    <form action="FinaliseAppointment.php" method="POST">
        <label for="doctor">Doctor: </label>
        <?php  
        $serverAddress = "localhost";
        $serverUsername = "root";
        $serverPassword = "";
        $serverDB = "hospitalmanagementsystem";
        $connection = mysqli_connect($serverAddress, $serverUsername, $serverPassword, $serverDB);
        if(mysqli_connect_errno()) {
        die("Failed to connect".mysqli_connect_errno());
        }
        $sql_query = "SELECT Staff_ID, Fname, Surname FROM staff WHERE StaffType LIKE 'Doctor'";
        $result = mysqli_query($connection, $sql_query);
        if(mysqli_num_rows($result)>0){
            echo("<select name='doctor' id='doctor' required>");
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<option value='".$row['Staff_ID']."'>".$row['Fname']." ".$row['Surname']."</option>";
            }
        echo("</select>");
        }?>

        <br><br>
        <label for="StartTime">Start Time: </label>
        <input type="time" name="StartTime" id="start_time" min="09:00" min="17:00">
        <br><br>
        <label for="EndTime">End Time: </label>
        <input type="time" name="EndTime" id="end_time" min="09:00" min="17:00">
        <br><br>
        <label for="date">Date: </label>
        <input type='date' name="date" min="<?php echo date('Y-m-d', strtotime(date('Y-m-d').'+ 1 days'));?>" value="<?php echo date('Y-m-d', strtotime(date('Y-m-d').'+ 1 days'));?>">
        <input type="hidden" value="<?php 
        if (isset($_GET['id'])){
            echo $_GET['id'];
        } else {
            header('Location: BookAppointment.php');
        }
        ?>" name="patient_id">
        <br><br>
        <input type="submit" name="Book" value="Book" id="login">
    </form>
    </div>
    


</body>
</html>