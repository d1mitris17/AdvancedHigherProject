<?php
session_start();
?>

<!DOCTYPE html>
<head>
    <title>Appointment</title>
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

    <div id="details">
    <?php
    $serverAddress = "localhost";
    $serverUsername = "root";
    $serverPassword = "";
    $serverDB = "hospitalmanagementsystem";
    $Appointment_pk = $_GET['id'];
    $connection = mysqli_connect($serverAddress, $serverUsername, $serverPassword, $serverDB);
    $sql_query = "SELECT * FROM appointments WHERE AppointmentID='$Appointment_pk'";
    $result = mysqli_query($connection, $sql_query);

    if(mysqli_num_rows($result)>0) {
        $row = mysqli_fetch_array($result);
        echo '<form action="edit_app.php" id="update-form" method="POST">
        <h1>Appointment Details</h1>
        <input type="hidden" name="OldDate" value="'.$row['AppDate'].'">
        <label for="AppDate">Appointment Date: </label>
        <input type="date" name="AppDate" value="'.$row['AppDate'].'" required>
        <br><br>
        <label for="StartTime">StartTime: </label>
        <input type="time" name="StartTime" value="'.$row['StartTime'].'" required>
        <br><br>
        <label for="EndTime">Email Address: </label>
        <input type="time" name="EndTime" value="'.$row['EndTime'].'" required>
        <br><br>
        <input type="hidden" name="AppointmentID" value="'.$row['AppointmentID'].'">
        <br><br>
        <input type="hidden" name="Staff_ID" value="'.$row['Staff_ID'].'">
        <br><br>
        <input type="submit" id="myButton2" value="Update" name="update">
        </form>';
        } else{
            header('Location: home.php');
        }
        
    ?>


    </div>
</body>
</html>