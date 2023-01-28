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

        include 'connect_to_db.php';

        $stmt = $conn->prepare("SELECT Staff_ID, Fname, Surname FROM staff WHERE StaffType='Doctor'");
        $stmt->execute();
        $result = $stmt->get_result();
        if($result->num_rows > 0){ 
            echo("<select name='doctor' id='doctor'>");
            while ($row = $result->fetch_assoc()) {
                echo "<option value='".$row['Staff_ID']."'>".$row['Fname']." ".$row['Surname']."</option>";
            }
            echo("</select>");
        }
        mysqli_close($conn);
        ?>
        <br><br>
        <label for="StartTime">Start Time: </label>
        <input type="time" name="StartTime" id="start_time" min="09:00" min="17:00">
        <br><br>
        <label for="EndTime">End Time: </label>
        <input type="time" name="EndTime" id="end_time" min="09:00" min="17:00">
        <br><br>
        <label for="date">Date: </label>
        <input type='date' name="date" min="<?php echo date('Y-m-d', strtotime(date('Y-m-d').'+ 1 days'));?>" value="<?php echo date('Y-m-d', strtotime(date('Y-m-d').'+ 1 days'));?>">
        <input type="hidden" value="<?php echo $_GET['id']; ?>" name="patient_id">
        <br><br>
        <input type="submit" name="Book" value="Book" id="login">
    </form>
    </div>
    


</body>
</html>